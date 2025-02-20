@extends('layouts.app')

{{--
    @section content
    This section represents the homepage of EduLib.
    It contains:
    - A welcome message
    - An introduction to the services
    - Student testimonials
    - Links to learn more
--}}


@section('content')

<main>
        {{-- welcome section --}}
    <section class="title">
        <div class="text-container">
            <h1>Bienvenue sur EduLib</h1>
            <p>Élevez votre potentiel avec notre expertise : des cours de qualité pour un avenir réussi.</p>
            @auth
                <a href="{{ route('reservation') }}">
                    <button class="button">Prendre rendez-vous !</button>
                </a>
            @else
                <a href="{{ route('register') }}">
                    <button class="button">Prendre rendez-vous !</button>
                </a>
            @endauth

        </div>
        <img src="{{ asset('images/woman_teacher.png') }}" alt="Woman Image">
    </section>
    {{-- information section on courses and testimonials --}}
    <section class="features">
        <h2>Votre allié pour une éducation d'excellence au quotidien</h2>
        <div class="feature-container">
            <div class="feature">
                <img src="{{ asset('images/icon_ressources.png') }}" alt="Icône 1" class="icon">
                <h3>Accédez à des cours interactifs</h3>
                <p>Participez à des cours en ligne interactifs avec des experts dans divers domaines.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('images/icon_calendar.png') }}" alt="Icône 2" class="icon">
                <h3>Apprenez à votre rythme</h3>
                <p>Accédez à des ressources pédagogiques à tout moment et progressez selon votre propre calendrier.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('images/icon_community.png') }}" alt="Icône 3" class="icon">
                <h3>Communauté d'apprentissage</h3>
                <p>Rejoignez une communauté d'apprenants pour échanger, collaborer et grandir ensemble.</p>
            </div>
        </div>
    </section>

    <section class="info">
        <div class="info-item" style="width: 90%;">
            <h2>Des cours passionnants</h2>
            <p>Améliorez vos compétences en <strong>français, mathématiques, physique-chimie et plein d'autres</strong>
                avec nos cours interactifs et personnalisés. Nos enseignants expérimentés vous guideront à travers
                la grammaire, le vocabulaire et la culture française.</p>
            <a href="#" class="learn-more">En savoir plus</a>
        </div>
            {{-- student testimonials --}}
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
                  {{-- kevin's testimony --}}
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
                 {{-- casper's testimony --}}
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
            {{-- other subject presented on the site --}}



        <div class="cta-div">
            <h2>Et pourquoi pas vous ?</h2>
            <p>Commencez dès maintenant et découvrez tous les avantages de EduLib.</p>
            @guest
                <a href="{{ route('register') }}">
                    <button class="cta-button">Inscrivez-vous</button>
                </a>
            @endguest

            @auth
                <a href="{{ route('reservation') }}">
                    <button class="cta-button">Prendre rendez-vous</button>
                </a>
            @endauth
        </div>


        <div class="info-item">
            <h2>FAQ - Questions Fréquemment Posées</h2>
            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Comment puis-je m'inscrire sur EduLib ?</span>
                        <button1 class="faq-button">+</button1>
                    </div>
                    <div class="faq-answer">Cliquez sur le bouton "S'inscrire" en haut à droite
                        de la page d'accueil. Remplissez le formulaire d'inscription avec vos
                        informations personnelles et suivez les instructions pour compléter votre inscription.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Quels types de cours sont disponibles sur EduLib ?</span>
                        <button1 class="faq-button">+</button1>
                    </div>
                    <div class="faq-answer">EduLib propose une large gamme de cours,
                        y compris des cours de langues, d'informatique, de sciences, d'arts,
                        et bien plus encore. Consultez notre calendrier des cours pour voir l'offre complète.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Comment puis-je réserver un cours ?</span>
                        <button1 class="faq-button">+</button1>
                    </div>
                    <div class="faq-answer">Une fois inscrit, connectez-vous à votre compte,
                        naviguez vers la section des cours, choisissez le cours qui vous intéresse
                        et cliquez sur "Réserver". Vous recevrez une confirmation de réservation par e-mail.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Puis-je accéder à mes cours depuis plusieurs appareils ?</span>
                        <button1 class="faq-button">+</button1>
                    </div>
                    <div class="faq-answer">Oui, vous pouvez accéder à vos cours depuis n'importe
                        quel appareil connecté à Internet. Notre plateforme est compatible avec
                        les ordinateurs, les tablettes et les smartphones.</div>
                </div>
            </div>
        </div>
        <button1 class="back-to-top">↑</button1>
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
                backToTopButton.style.visibility = 'visible';
                backToTopButton.style.opacity = 1;
            } else {
                backToTopButton.style.opacity = 0;
                setTimeout(() => {
                    if (window.scrollY <= 250) {
                        backToTopButton.style.visibility = 'hidden';
                    }
                }, 500);
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
