<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::paginate(10);

        return view('admin.notifications.index', compact('notifications'));
    }

    // public function store(Request $request) {
    //     $data = $request->all();

    //     $newNot = new Notification();
    //     $newNot->title = $data['title'];
    //     $newNot->message = $data['message'];
    //     $newNot->source = $data['source'];
    //     $newNot->source_id = $data['source_id'];
    //     $newNot->save();
    // }
}
