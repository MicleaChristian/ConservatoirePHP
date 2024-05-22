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
</head>

<body>
    <?php include("header/header_accueil.php") ?>
    <p style="display: flex; justify-content: center; font-family: Tit; font-size: 2vw; color:#CCC;">
        Bonjour <?php echo $_SESSION['user_name']; ?>. Que voulez vous faire aujourd'hui?
    </p>
    <div class="caroussel container" style="display: flex; justify-content: center;">
        <div id="carouselExampleIndicators" class="carousel slide" style="height: 50vh; width: 100vw;" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" style="height: 50vh; width: 100vw;">
                <div class="carousel-item active">
                    <img src="images/conservatoire.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Conservatoire pour tous</h5>
                        <p>Bienvenue sur l'interface Administrateur</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/cons1.jpg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Conservatoire pour tous</h5>
                        <p>Bienvenue sur l'interface Administrateur</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/cons2.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Conservatoire pour tous</h5>
                        <p>Bienvenue sur l'interface Administrateur</p>
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
    <?php if($_SESSION['user_role'] == 'parent') :?>
        <div class="admin-buttons">
                <a class="button-row" href="index.php?uc=personne&action=liste"><p class="link">Gérer les élèves</p></a>
                <a class="button-row" href="index.php?uc=personne&action=listeprof"><p class="link">Gérer les profs</p></a>
                <a class="button-row" href="index.php?uc=cours&action=liste"><p class="link">Gérer les cours</p></a>
        </div>
    <?php endif; ?>

    <?php if ($_SESSION['user_role'] == 'admin') : ?>
        <div class="admin-buttons">
            <a class="button-row" href="index.php?uc=personne&action=liste"><p class="link">Gérer les élèves</p></a>
            <a class="button-row" href="index.php?uc=personne&action=listeprof"><p class="link">Gérer les profs</p></a>
            <a class="button-row" href="index.php?uc=cours&action=liste"><p class="link">Gérer les cours</p></a>
        </div>

        <div class="admin-buttons">
            <a class="button-row" href="index.php?uc=personne&action=ajout_form"><p class="link">Ajouter un élève</p></a>
            <a class="button-row" href="index.php?uc=personne&action=ajoutprof_form"><p class="link">Ajouter un prof</p></a>
            <a class="button-row" href="index.php?uc=cours&action=ajout_form"><p class="link">Ajouter un cours</p></a>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
