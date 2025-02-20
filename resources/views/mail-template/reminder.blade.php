<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rappel de rendez-vous</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 0 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Bannière en pleine largeur */
        .banner {
            width: 100%;
            background-color: #2e7d32;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
        }

        .banner i {
            margin-right: 10px;
        }

        h4 {
            color: #1b5e20;
            text-align: center;
        }

        p {
            font-size: 16px;
            color: #333;
            line-height: 1.5;
            text-align: center;
        }

        .description {
            background-color: #c8e6c9;
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
            font-style: italic;
            font-size: 14px;
        }

        /* Footer en pleine largeur */
        .footer {
            width: 100%;
            font-size: 12px;
            text-align: center;
            color: #777;
            padding: 10px 15px;
            background-color: #c8e6c9;
        }
    </style>
</head>
<body>
<div class="banner">
    <i class="fas fa-calendar-check"></i> Rappel de votre rendez-vous
</div>

<h4>Bonjour {{ $appointment->name }},</h4>
<p>Voici un rappel pour votre rendez-vous :</p>

<div class="description">
    <p><strong>📅 Date :</strong> {{ $appointment->date->format('d/m/Y') }}</p>
    <p><strong>🕒 Heure :</strong> {{ $appointment->start_time }} - {{ $appointment->end_time }}</p>
    <p><strong>📌 Sujet :</strong> {{ $appointment->title }}</p>
    <p><strong>💰 Prix :</strong> {{ $appointment->price }} €</p>
</div>

<p>Merci et à bientôt !</p>

<div class="footer">
    Vous recevez cet email car vous avez réservé un rendez-vous avec nous. Si vous avez des questions, n'hésitez pas à nous contacter.
</div>
</body>
</html>
