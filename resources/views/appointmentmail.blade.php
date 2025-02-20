<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<form action="/sendmail" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Votre email" required>
    <input type="date" name="date" required>
    <input type="number" name="heure" placeholder="Heure (ex: 15)" required>
    <button type="submit">Envoyer</button>
</form>

</body>
</html>
