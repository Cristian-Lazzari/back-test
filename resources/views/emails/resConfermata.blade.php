<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prenotazione confermata</title>
</head>
<body>
    <img src="https://db.dashboardristorante.it/public/images/res.png" alt="simbolo ordine">
    <h1>Prenotazione confermata</h1>
    <p>
        Gentile {{ $reservation['name'] }},<br>
        siamo lieti di comunicarle che la sua prenotazione per la data {{$order['date_slot']}} è stata confermata<br> 
        Grazie di averci scelto
    </p>

    <p>Cordialmente,</p>
    <p>Kojo Sushi</p>

</body>
</html>