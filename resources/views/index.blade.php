@extends('layouts.app')

@section('content')
<main>
    <section class="title">
        <h1>Bienvenue sur EduLib</h1>
        <p>Élevez votre potentiel avec notre expertise : des cours de qualité pour un avenir réussi.</p>
        <button class="button">Prendre rendez vous !</button>
    </section>
    <section class="info">
        <div class="info-item">
            <h2>Des cours passionnants</h2>
            <p>Améliorez vos compétences en <strong>français, mathématiques, physique-chimie et plein d'autres</strong>
                avec nos cours interactifs et personnalisés. Nos enseignants expérimentés vous guideront à travers
                la grammaire, le vocabulaire et la culture française.</p>
            <a href="#" class="learn-more">En savoir plus</a>
        </div>
        <div class="info-item" style="text-align: center;">
            <h2>Témoignage</h2>
            <p>Découvrez ce que nos élèves disent de nous et comment nos cours les ont aidés à atteindre leurs objectifs.</p>
            <div class = "card-box">
                <div class = "card-testimony">
                    <img src="{{ asset('images/profil_image.png') }}" alt="Profil Image">
                    <h5><strong>Titouan</strong></h5>
                    <p>Élève de 3ème</p>
                    <center>
                        <p class="commentary">Meilleur expérience de ma vie j'eesiae juste de faire un texte méga gros taz capté</p>
                    </center>
                </div>
                <div class = "card-testimony">
                    <img src="{{ asset('images/profil_image.png') }}" alt="Profil Image">
                    <h5><strong>Kevin</strong></h5>
                    <p>Élève de terminale</p>
                    <center>
                        <p class="commentary">Meilleur expérience de ma vie j'eesiae juste de faire un texte méga gros taz capté</p>
                    </center>
                </div>
                <div class = "card-testimony">
                    <img src="{{ asset('images/profil_image.png') }}" alt="Profil Image">
                    <h5><strong>Casper</strong></h5>
                    <p>Élève en première année de CPGE</p>
                    <center>
                        <p class="commentary">Meilleur expérience de ma vie j'eesiae juste de faire un texte méga gros taz capté</p>
                    </center>

                </div>

            </div>
            <a href="#" class="learn-more">En savoir plus</a>
        </div>
        <div class="info-item">
            <h2>Sujet 3</h2>
            <p>Description du sujet 3</p>
            <a href="#" class="learn-more">En savoir plus</a>
        </div>
    </section>
</main>
@endsection
