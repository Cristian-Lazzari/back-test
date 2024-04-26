<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ordine annullato</title>
</head>
<body>
    <img src="https://db.dashboardristorante.it/public/images/or.png" alt="simbolo ordine">
    <h1>Ordine annullato</h1>
    <p>
        Gentile {{ $order['name'] }},<br>
        le comunichiamo con profondo rammarico che il suo ordine per la data {{$order['date_slot']}} è stato annullato<br> 
        La ringraziamo per avervci scelto e ci scusiamo per il disagio.
    </p>

    <p>Cordialmente,</p>
    <p>Kojo Sushi</p>
</body>
</html>