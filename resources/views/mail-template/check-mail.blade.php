<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $subject }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
    <i class="fas fa-envelope"></i> Notification - Edulib
</div>
<div style="width: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center">
    <h4>{{ $subject }}</h4>
    <p>{{ $mailMessage }}</p>

    <div class="description">
        Edulib est une plateforme qui facilite la prise de rendez-vous pour des cours particuliers.
        Trouvez le professeur idéal et planifiez vos sessions en toute simplicité.
    </div>
</div>


<div class="footer">
    Cet email a été généré automatiquement. Merci de ne pas y répondre.
</div>

</body>
</html>
