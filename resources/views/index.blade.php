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
                        <p class="commentary">"EduLib a rendu la réservation de cours tellement plus facile ! Avant,
                            je devais passer des heures à essayer de trouver des créneaux disponibles qui convenaient
                            à mon emploi du temps. Maintenant, en quelques clics, je peux réserver mes cours et recevoir
                            une confirmation instantanée. C'est vraiment pratique et efficace."</p>
                    </center>
                </div>
                <div class = "card-testimony">
                    <img src="{{ asset('images/profil_image.png') }}" alt="Profil Image">
                    <h5><strong>Kevin</strong></h5>
                    <p>Élève de terminale</p>
                    <center>
                        <p class="commentary">"J'adore utiliser EduLib pour réserver mes cours de langue. L'interface
                            est intuitive et facile à utiliser, et je peux voir tous les cours disponibles d'un coup d'œil.
                            De plus, je reçois des rappels par e-mail pour ne jamais oublier un cours. Cela a vraiment
                            amélioré mon organisation et mes résultats."</p>
                    </center>
                </div>
                <div class = "card-testimony">
                    <img src="{{ asset('images/profil_image.png') }}" alt="Profil Image">
                    <h5><strong>Casper</strong></h5>
                    <p>Élève en première année de CPGE</p>
                    <center>
                        <p class="commentary">"EduLib m'a sauvé la vie plus d'une fois. Lorsque j'ai des changements de
                            dernière minute dans mon emploi du temps, je peux rapidement annuler ou reprogrammer mes
                            cours sans stress. Le service client est également très réactif et toujours prêt à aider
                            en cas de besoin. Je recommande vivement EduLib à tous mes amis."</p>
                    </center>

                </div>

            </div>
            <a href="#" class="learn-more">En savoir plus</a>
        </div>
        <div class="info-item">
            <h2>FAQ - Questions Fréquemment Posées</h2>
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Comment puis-je m'inscrire sur EduLib ?</span>
                        <button class="faq-button">+</button>
                    </div>
                    <div class="faq-answer">Cliquez sur le bouton "S'inscrire" en haut à droite
                        de la page d'accueil. Remplissez le formulaire d'inscription avec vos
                        informations personnelles et suivez les instructions pour compléter votre inscription.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Quels types de cours sont disponibles sur EduLib ?</span>
                        <button class="faq-button">+</button>
                    </div>
                    <div class="faq-answer">EduLib propose une large gamme de cours,
                        y compris des cours de langues, d'informatique, de sciences, d'arts,
                        et bien plus encore. Consultez notre calendrier des cours pour voir l'offre complète.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Comment puis-je réserver un cours ?</span>
                        <button class="faq-button">+</button>
                    </div>
                    <div class="faq-answer">Une fois inscrit, connectez-vous à votre compte,
                        naviguez vers la section des cours, choisissez le cours qui vous intéresse
                        et cliquez sur "Réserver". Vous recevrez une confirmation de réservation par e-mail.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Puis-je accéder à mes cours depuis plusieurs appareils ?</span>
                        <button class="faq-button">+</button>
                    </div>
                    <div class="faq-answer">Oui, vous pouvez accéder à vos cours depuis n'importe
                        quel appareil connecté à Internet. Notre plateforme est compatible avec
                        les ordinateurs, les tablettes et les smartphones.</div>
                </div>
            </div>
        </div>
        <button class="back-to-top">↑</button>
    </section>

    <script>

        document.querySelectorAll('.faq-question, .faq-button').forEach(element => {
            element.addEventListener('click', () => {
                const answer = element.closest('.faq-item').querySelector('.faq-answer');
                const button = element.closest('.faq-item').querySelector('.faq-button');
                answer.style.display = (answer.style.display === 'block') ? 'none' : 'block';
                button.textContent = (button.textContent === '+') ? '-' : '+';
            });
        });

        // Bouton Retour en haut
        const backToTopButton = document.querySelector('.back-to-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 250) {
                backToTopButton.style.display = 'block';
                setTimeout(() => {
                    backToTopButton.style.opacity = 1;
                }, 10);
            } else {
                backToTopButton.style.display = 'none';
                backToTopButton.style.opacity = 0;
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });


    </script>

</main>
@endsection
