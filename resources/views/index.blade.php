<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel ="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lobster&family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Edulib</title>

</head>
<body>
<header>
    <nav>
        <li class="edulib">
            <a href="/index">EduLib</a>
        </li>
        <ul class="menu">
            <li><a href="{{ route('login') }}" class="login">Se connecter</a></li>
            <li><a href="{{ route('register') }}" class="register">S'enregister</a></li>
        </ul>
    </nav>
</header>
<main>
    <section class="title">
        <h1>Bienvenue sur EduLib</h1>
        <p>Élevez votre potentiel avec notre expertise : des cours de qualité pour un avenir réussi.</p>
        <button class="button">Prendre rendez vous !</button>
    </section>
    <section class="info">
        <div class="info-item">
            <h2>Sujet 1</h2>
            <p>Description du sujet 1</p>
            <a href="#" class="learn-more">En savoir plus</a>
        </div>
        <div class="info-item">
            <h2>Sujet 2</h2>
            <p>Description du sujet 2</p>
            <a href="#" class="learn-more">En savoir plus</a>
        </div>
        <div class="info-item">
            <h2>Sujet 3</h2>
            <p>Description du sujet 3</p>
            <a href="#" class="learn-more">En savoir plus</a>
        </div>
    </section>
</main>
</body>
</html>
