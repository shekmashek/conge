<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="Les logiciels de gestion de paie permettent de gérer les fiches de paie,
    mais aussi les heures de travail ou encore les congés.
    Ces solutions offrent une opportunité bien moins coûteuse qu'un expert-comptable et permettent de gagner 2 à 3 jours par mois par rapport à une gestion de la paie manuelle.">
    <meta name="keywords" content="salaire, gestion de salaire, comptabilité, compta, gestion, paie, banque, solution de paie, payer">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- Lien font awesome icons --}}
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="shortcut icon" href="{{asset('img/logos_all/iconConge.webp') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/css/index_accueil.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <title> Conge.mg - Logiciel de gestion de congé </title>
</head>

<body>
    <button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
        <i class="fa fa-arrow-up"></i>
    </button>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top pb-0">
            <div class="container-fluid">
                <div class="left_menu ms-2">
                    <a href="{{route('accueil_perso')}}">
                        <p class="titre_text m-0 p-0">
                            <img class="img-fluid" src="{{ asset('img/logos_all/iconConge.webp') }}" alt="logo">
                            Conge.mg
                        </p>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown icon_background">
                            <a class="nav-link dropdown-toggle links" href="" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Fonctionnalités</a>
                            <ul class="dropdown-menu p-3" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item pt-2" href="#" rel="noopener noreferrer"><i
                                            class="far fa-mouse-pointer center icon_back"></i> &nbsp; Moderne, flexible
                                        et sécurisé</a></li>
                                <li><a class="dropdown-item pt-2" href="#" rel="noopener noreferrer"><i
                                            class="far fa-user icon_back5"></i> &nbsp; Bulettin de paie</a></li>
                                <li><a class="dropdown-item pt-2" href="#" rel="noopener noreferrer"><i
                                            class="fad fa-file-alt icon_back2"></i> &nbsp; Gestion de salaire</a>
                                </li>
                                <li><a class="dropdown-item pt-2" href="#" rel="noopener noreferrer"><i
                                            class="fad fa-clipboard icon_back6"></i> &nbsp; Paramétrage personnalisé</a></li>
                                <li><a class="dropdown-item pt-2" href="#" rel="noopener noreferrer"><i
                                            class="fad fa-euro-sign icon_back3"></i> &nbsp; Gestion financière</a></li>
                                <li><a class="dropdown-item pt-2" href="#" rel="noopener noreferrer"><i
                                            class="fad fa-calendar-check icon_back4"></i> &nbsp; Gestion
                                        administrative</a></li>
                                <li><a class="dropdown-item pt-2" href="#" rel="noopener noreferrer"><i
                                            class="fad fa-search icon_back9"></i> &nbsp; Fonctionnalités avancées</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item ms-2">
                            <a class="nav-link links " href="{{url('tarifs')}}" target="_blank" rel="noopener noreferrer">Tarifs</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link links" href="#apropos">À propos</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link links" href="{{url('contact')}}" target="_blank" rel="noopener noreferrer">Contactez-nous</a>
                        </li>

                    </ul>
                    <div class="menu_action">
                        <ul class="d-flex">
                            <li class="nav-item">
                                <a href="{{ route('sign-in') }}" class="btn_login me-2" role="button">Se connecter</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('create-compte')}}" class="btn_creerCompte me-2"
                                    role="button">Créer un compte</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="mt-5 mb-5">
        <div class="container-fluid g-0 p-0">
            <section class="section1 mb-5">
                <div class="row h-100">
                    <div class="container p-0 g-0">
                        <div class="col-6 section1_text g-0 m-0">
                            <h1>Plateforme de gestion de congé en ligne</h1>
                            <p class="pt-5 pe-5">La première plateforme malagasy de gestion de paie, un outil
                                incontournable et innovateur du milieu professionnel. <br> Découvrez les horizons
                                de notre logiciel et en quoi il vous est indispensable.
                            </p>
                            <a href="{{ route('sign-in') }}" role="button" class="commencer">Commencer</a>
                        </div>
                    </div>
                </div>
            </section>
            <div id="apropos"></div>
            <section class="section2">
                <div class="row">
                    <div class="container">
                        <div class="col-12 section2_img">
                            <img src="{{asset('img/logos_all/iconConge.webp')}}" alt="logo" class="img-fluid">
                        </div>
                        <h2 class="text-center mb-3">Bienvenue chez Conge.mg</h2>
                        <div class="text_about">
                            <p >Conge.mg offre la meilleur de l'innovation numérique aux
                                différentes petites et grandes entreprises. Le logiciel de gestion de paie permet de gérer les fiches de paie,
                                mais aussi les heures de travail ou encore les congés.
                                Ces solutions offrent une opportunité bien moins coûteuse qu'un expert-comptable et permettent de gagner
                                2 à 3 jours par mois par rapport à une gestion de la paie manuelle.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 image">
                            <img src="{{asset('images/background_images/18section3 - copie.webp')}}" alt="image1" class="img-fluid">
                        </div>
                        <div class="col-6 text">
                            <h2 class="mb-5">Logiciel de congé, Solution Autonome</h2>
                            <p>Toutes nos fonctionnalités sont faites pour perfectionner vos services !</p>
                            <p>Dans un contexte d’évolutions légales permanentes, la production de votre paie doit rimer avec conformité et fiabilité.
                                Quels que soient la taille de votre entreprise et vos besoins,<br>
                                Conge.mg vous propose une solution : un logiciel de paie pour
                                gérer vous même vos bulletins .
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 text">
                            <h2 class="mb-5">Sécurité et Sérénité</h2>
                            <p>Parce que l’essentiel est la sécurité de votre paie, Conge.mg offrira à votre entreprise une sécurité des
                                données et une productivité accrue grâce à un programmateur de paie experimenté,<br>
                                une gestion des tâches de saisie collectives simple, de datation des événements automatisés, mais également
                                la possibilité de paramétrer des champs et faire un suivi des dossiers pour une sécurité renforcée..
                            </p>
                            <p>
                                Profitez d’une solution toujours à jour pour travailler en toute sérénité...
                            </p>
                        </div>
                        <div class="col-6 image">
                            <lottie-player src="{{asset('lottie/security.json')}}" background="transparent"  speed="0.6"  style="width: 75%;" loop autoplay></lottie-player>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 text">
                            <h2 class="mb-5 text-center text-white">Parlons de vos projets !</h2>
                        </div>
                        <div class="col-6 image text-center">
                            <a href="{{url('contact')}}" target="_blank" rel="noopener noreferrer" role="button" class="commencer">Nous contacter</a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section6">
                <div class="row">
                    <div class="container">
                        <div class="card_fonctions mt-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4 card_content">
                                        <div class="icon text-center">
                                            <i class='fa fa-cog'></i>
                                        </div>
                                        <h4 class="mt-4 text-center">Ergonomie et performance</h4>
                                        <p class="">Un gain de temps et d'efficacité garanti pour le traitement de vos tâches quotidiennes</p>
                                    </div>
                                    <div class="col-4 card_content">
                                        <div class="icon text-center">
                                            <i class='fa fa-puzzle-piece'></i>
                                        </div>
                                        <h4 class="mt-4 text-center">Fonctionnalités abouties</h4>
                                        <p class="">Tout est pensé pour vous faire gagner du temps à chaque étape de la gestion quotidienne de votre centre de formation</p>
                                    </div>
                                    <div class="col-4 card_content">
                                        <div class="icon text-center">
                                            <i class='fas fa-euro-sign'></i>
                                        </div>
                                        <h4 class="mt-4 text-center">Coût maîtrisé</h4>
                                        <p class="">Un abonnement mensuel pour une solution cloud tout-en-un, fiable et qui évolue régulièrement</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer>
        <section class="section9">
            <div class="container-fluid">
                <div class="row d-flex flex-column">
                    <div class="d-flex mb-3">
                        <div class="bordure">&copy; Copyright 2022</div>
                        <div class="bordure"><a href="{{url('info_legale')}}" target="_blank" rel="noopener noreferrer">Informations légales</a></div>
                        <div class="bordure"><a href="{{url('contact')}}" target="_blank" rel="noopener noreferrer">Contactez-nous</a></div>
                        <div class="bordure"><a href="{{url('politique_confidentialites')}}" target="_blank" rel="noopener noreferrer">Politique de
                                confidentialités</a></div>

                        <div class="bordure">
                            <a href="{{route('condition_generale_de_vente')}}" target="_blank" rel="noopener noreferrer">
                                Condition
                                d'utilisation
                            </a>
                        </div>
                        <div class="bordure"> <a href="{{url('tarifs')}}" target="_blank" rel="noopener noreferrer"> Tarifs</a></div>
                        <div class="bordure"><a href="#" target="_blank" rel="noopener noreferrer">Crédits</a></div>
                        <div class="ps-3 version">V 1.0.9</div>
                    </div>
                    <div class="droits">2022 @ Conge.mg - Tous les droits sont réservés -
                        <span>
                        <a href="{{route('condition_generale_de_vente')}}" target="_blank" rel="noopener noreferrer">
                            CGU
                        </a>
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        let mybutton = document.getElementById("btn-back-to-top");
        window.onscroll = function () {
            scrollFunction();
        };
        function scrollFunction() {
        if (
            document.body.scrollTop > 300 ||
            document.documentElement.scrollTop > 300
        ) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
        }
        mybutton.addEventListener("click", backToTop);
        function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
</body>

</html>
