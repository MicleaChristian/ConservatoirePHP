<!DOCTYPE html>
<html lang="fr">
<?php

MonPdo::checkSessionAndRedirect(); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservatoire</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css.css">
    <style>
        .carousel {
            width: 100%;
            height: 100vh;
            position: relative;
        }

        .carousel-inner img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }

        .fixed-caption {
            position: absolute;
            top: 50%;
            left: 50px;
            transform: translateY(-50%);
            text-align: left;
            padding: 1rem;
            border-radius: 0.5rem;
            background-color: rgba(0, 0, 0, 0.5);
            max-width: 700px;
            color: white;
            font-size: 1.5rem;
            font-family: Tit;
        }

        .fixed-caption h5 {
            font-size: 3.5rem;
            margin-bottom: 0.5rem;
        }

        .fixed-caption p {
            font-size: 1.8rem;
        }

        .welcome-message {
            display: flex;
            justify-content: center;
            font-family: Tit;
            font-size: 2vw;
            color: #333;
            margin-top: 2rem;
        }

        .admin-buttons {
            margin-top: 2rem;
        }

        .cards {
            margin-bottom: 1rem;
            background-color: #343a40;
            color: white;
            border: none;
        }

        .card-title {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .card-body a {
            display: block;
            margin: 0.5rem 0;
            padding: 0.75rem;
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
            text-align: center;
            border-radius: 0.5rem;
            text-decoration: none;
            backdrop-filter: blur(10px);
            transition: background-color 0.3s ease;
        }

        .card-body a:hover {
            background-color: rgba(255, 255, 255, 0.6);
            color: black;
        }

        .card-header {
            background-color: #495057;
            border-bottom: none;
            text-align: center;
        }

        .card-footer {
            background-color: #495057;
            border-top: none;
            text-align: center;
        }

        .btn-planning-container {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn-planning {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: #007bff;
            color: white;
            text-align: center;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: background-color 0.3s ease;
            white-space: nowrap;
        }

        .btn-planning:hover {
            background-color: #0056b3;
            color: white;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: 1fr;
            }

            .fixed-caption {
                display: none; /* Hide the caption on smaller screens */
            }
        }
    </style>
</head>

<body>
    <div class="fixed-top">
        <?php include("header/header.php") ?>
    </div>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/conservatoire.jpg" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="images/cons1.jpg" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="images/cons2.jpg" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
        <div class="fixed-caption">
            <h5>Bienvenue sur notre site</h5>
            <p><?php echo $_SESSION['user_role'] == 'admin' ? 'Bienvenue sur l\'interface Administrateur' : 'Bienvenue sur l\'interface Parent'; ?></p>
        </div>
    </div>

    <p class="welcome-message">
        Bienvenue sur notre site ! Nous sommes ravis de vous accueillir au Conservatoire.
    </p>

    <div class="btn-planning-container">
        <a class="btn-planning" href="index.php?uc=planning&action=liste">Afficher le planning</a>
    </div>

    <?php if ($_SESSION['user_role'] == 'parent') : ?>
        <div class="container admin-buttons grid-container">
            <div class="cards">
                <div class="card-header">
                    <h5 class="card-title">Gestion des Enfants</h5>
                </div>
                <div class="card-body">
                    <a href="index.php?uc=personne&action=liste">Gérer mes enfants</a>
                </div>
                <div class="card-footer"></div>
            </div>
            <div class="cards">
                <div class="card-header">
                    <h5 class="card-title">Afficher les Profs</h5>
                </div>
                <div class="card-body">
                    <a href="index.php?uc=personne&action=listeprof">Afficher les profs</a>
                </div>
                <div class="card-footer"></div>
            </div>
            <div class="cards">
                <div class="card-header">
                    <h5 class="card-title">Afficher les Cours</h5>
                </div>
                <div class="card-body">
                    <a href="index.php?uc=cours&action=liste">Afficher les cours</a>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($_SESSION['user_role'] == 'admin') : ?>
        <div class="container admin-buttons grid-container">
            <div class="cards">
                <div class="card-header">
                    <h5 class="card-title">Gestion des Élèves</h5>
                </div>
                <div class="card-body">
                    <a href="index.php?uc=personne&action=liste">Gérer les élèves</a>
                </div>
                <div class="card-footer"></div>
            </div>
            <div class="cards">
                <div class="card-header">
                    <h5 class="card-title">Gestion des Profs</h5>
                </div>
                <div class="card-body">
                    <a href="index.php?uc=personne&action=listeprof">Gérer les profs</a>
                    <a href="index.php?uc=personne&action=ajoutprof_form">Ajouter un prof</a>
                </div>
                <div class="card-footer"></div>
            </div>
            <div class="cards">
                <div class="card-header">
                    <h5 class="card-title">Gestion des Cours</h5>
                </div>
                <div class="card-body">
                    <a href="index.php?uc=cours&action=liste">Gérer les cours</a>
                    <a href="index.php?uc=cours&action=ajout_form">Ajouter un cours</a>
                    <a href="index.php?uc=inscription&action=ajout_form">Ajouter une inscription</a>
                </div>
                <div class="card-footer"></div>
            </div>
            <div class="cards">
                <div class="card-header">
                    <h5 class="card-title">Gestion des Utilisateurs</h5>
                </div>
                <div class="card-body">
                    <a href="index.php?uc=utilisateurs">Gérer les utilisateurs</a>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
