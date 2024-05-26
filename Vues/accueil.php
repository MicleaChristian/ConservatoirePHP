<?php
require_once 'Modeles/monPdo.php';

MonPdo::checkSessionAndRedirect();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservatoire</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css.css">
    <style>
        .carousel-inner img {
            height: 50vh;
            object-fit: cover;
        }
        .carousel-caption h5, .carousel-caption p {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 0.5rem;
            border-radius: 0.5rem;
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
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 2rem;
        }
        .admin-buttons .button-row {
            margin: 1rem;
            padding: 1rem 2rem;
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
            text-align: center;
            border-radius: 0.5rem;
            text-decoration: none;
            backdrop-filter: blur(10px);
            transition: background-color 0.3s ease;
        }
        .admin-buttons .button-row:hover {
            background-color: rgba(255, 255, 255, 0.6);
            color: black;
        }
    </style>
</head>

<body>
    <?php include("header/header_accueil.php") ?>

    <p class="welcome-message">
        Bonjour <?php echo $_SESSION['user_name']; ?>. Que voulez-vous faire aujourd'hui?
    </p>

    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/conservatoire.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Conservatoire pour tous</h5>
                        <p><?php echo $_SESSION['user_role'] == 'admin' ? 'Bienvenue sur l\'interface Administrateur' : 'Bienvenue sur l\'interface Parent'; ?></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/cons1.jpg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Conservatoire pour tous</h5>
                        <p><?php echo $_SESSION['user_role'] == 'admin' ? 'Bienvenue sur l\'interface Administrateur' : 'Bienvenue sur l\'interface Parent'; ?></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/cons2.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Conservatoire pour tous</h5>
                        <p><?php echo $_SESSION['user_role'] == 'admin' ? 'Bienvenue sur l\'interface Administrateur' : 'Bienvenue sur l\'interface Parent'; ?></p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </a>
        </div>
    </div>

    <?php if ($_SESSION['user_role'] == 'parent') : ?>
        <div class="admin-buttons">
            <a class="button-row" href="index.php?uc=personne&action=liste">Gérer mes enfants</a>
            <a class="button-row" href="index.php?uc=personne&action=listeprof">Afficher les profs</a>
            <a class="button-row" href="index.php?uc=cours&action=liste">Afficher les cours</a>
        </div>
    <?php endif; ?>

    <?php if ($_SESSION['user_role'] == 'admin') : ?>
        <div class="admin-buttons">
            <a class="button-row" href="index.php?uc=personne&action=liste">Gérer les élèves</a>
            <a class="button-row" href="index.php?uc=personne&action=listeprof">Gérer les profs</a>
            <a class="button-row" href="index.php?uc=cours&action=liste">Gérer les cours</a>
        </div>

        <div class="admin-buttons">
            <a class="button-row" href="index.php?uc=personne&action=ajout_form">Ajouter un élève</a>
            <a class="button-row" href="index.php?uc=personne&action=ajoutprof_form">Ajouter un prof</a>
            <a class="button-row" href="index.php?uc=cours&action=ajout_form">Ajouter un cours</a>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
