<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Tag;
use App\Models\Date;
use App\Models\Order;
use App\Models\Project;
use App\Models\Category;
use App\Mail\confermaOrdine;
use App\Models\Notification;
use App\Models\OrderProject;
use Illuminate\Http\Request;
use App\Mail\confermaOrdineAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;

class OrderController extends Controller
{

    private $validations = [
        'name'          => 'required|string|min:5|max:50',
        'phone'         => 'required|string|min:5|max:20',
        'email'         => 'required|email|max:100',
        'message'       => 'nullable|string|min:5|max:1000',
    ];

    public function store(Request $request)
    {
        $request->validate($this->validations);
        // salvare i dati del Order nel database
        $total_price = 0;
        $data = $request->all();

        $arrvar = str_replace('\\', '', $data['products']);
        $arrvar2 = json_decode($arrvar, true);
        // $total_pz_q = 0;
        // $total_pz_t = 0;
        $total_pz = 0;


        try {
            for ($i = 0; $i < count($arrvar2); ++$i) {
                // Calcolo il numero di pezzi ordinati in base alla categoria
                $project = Project::where('id', $arrvar2[$i]['p_id'])->first();
                $category = Category::where('id', $project->category_id)->first();
                if ($category->slot !== 0) {
                    $total_pz ++;
                } 

                // Calcolo il prezzo totale (senza aggiunte)
                $total_price += $project->price *  $arrvar2[$i]['counter'];
            }

            // Considero le aggiunte nel prezzo totale
            for ($i = 0; $i < count($arrvar2); ++$i) {
                for ($z = 0; $z < count($arrvar2[$i]['addicted']); $z++) {
                    $ingredient = Tag::where('name', $arrvar2[$i]['addicted'][$z])->first();
                    $total_price += $ingredient->price * $arrvar2[$i]['counter'];
                }
            }

            $date = Date::where('id', $data['date_id'])->firstOrFail();

            $newOrder = new Order();
            $newOrder->name          = $data['name'];
            $newOrder->phone         = $data['phone'];
            $newOrder->email         = $data['email'];
            $newOrder->message       = $data['message'];
            $newOrder->date_slot     = $date->date_slot;
            $newOrder->total_price   = $total_price;
            $newOrder->total_pz   = $total_pz;
          
            $newOrder->status        = 0;
            if (isset($data['comune'])) {
                $newOrder->comune = $data['comune'];
                $newOrder->indirizzo = $data['indirizzo'];
                $newOrder->civico = $data['civico'];
                if ($date->reserved_domicilio <= $date->max_domicilio) {
                    $date->reserved_domicilio ++;
                    if ($date->reserved_domicilio == $date->max_domicilio) {
                        $date->visible_d = 0;
                    };
                } else {
                    // se non ci sono più posti rispondo picche
                    return response()->json([
                        'success' => false,
                        'message' => 'Il numero massimo di ordini a domicilio per questa data e orario è già stato raggiunto',
                    ]);
                }
            }



            
            if ($date->reserved_asporto <= $date->max_asporto) {  
                $date->reserved_asporto ++;
                if ($date->max_asporto == $date->reserved_asporto) {
                    $date->visible_asporto = 0;
                }
                
                $date->save();
                $newOrder->save();
            } else {
                // se non ci sono più posti rispondo picche
                return response()->json([
                    'success' => false,
                    'message' => 'Il numero massimo di ordini per questa data e orario è già stato raggiunto',
                ]);
            }
            

            foreach ($arrvar2 as $elem) {
                $item_order = new OrderProject();
                $item_order->order_id = $newOrder->id;
                $item_order->project_id = $elem['p_id'];
                $item_order->quantity_item = $elem['counter'];
                $item_order->deselected = json_encode($elem['deselected']);
                $item_order->addicted = json_encode($elem['addicted']);
                $item_order->save();
            }
            // Invio notifica a dashboard
            $newNot = new Notification();
            $newNot->title = 'Nuovo ordine da: ' . $data['name'];
            $newNot->message = `Hai un nuovo ordine: ` . $newOrder->total_pz . ' pezzi per ' . $date->date_slot;
            $newNot->source = 1;
            $newNot->source_id = $newOrder->id;
            $newNot->save();

            // Invio Email
            $mail = new confermaOrdine($newOrder, $arrvar2);
            Mail::to($data['email'])->send($mail);

            $mailAdmin = new confermaOrdineAdmin($newOrder, $arrvar2);
            Mail::to('test@dashboardristorante.it')->send($mailAdmin);

            // ritornare un valore di successo al frontend
            return response()->json([
                'success' => true,
                'order' => $newOrder
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore del database: ' . $e->getMessage(),
            ]);
        } catch (Exception $e) {
            $trace = $e->getTrace();
            $errorInfo = [
                'success' => false,
                'error' => 'Si è verificato un errore durante l\'elaborazione della richiesta: ' . $e->getMessage(),

            ];

            return response()->json($errorInfo, 500);
        }

        return response()->json($request->all()); // solo per debuggare
    }
}
