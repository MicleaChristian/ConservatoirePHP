<?php
require_once 'Modeles/monPdo.php'; // Remplacez par le chemin vers votre fichier MonPdo.php

MonPdo::checkSessionAndRedirect();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservatoire</title>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <?php include("header/header.php") ?>

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
                    <h5>Afficher les élèves</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/conservatoire.jpg" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Afficher les professeurs</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/conservatoire.jpg" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Afficher les cours</h5>
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/conservatoire.jpg" class="card-img-top" alt="Image 1">
                    <div class="card-body">
                        <h5 class="card-title">Afficher les élève</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/conservatoire.jpg" class="card-img-top" alt="Image 2">
                    <div class="card-body">
                        <h5 class="card-title">Afficher les professeurs</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/conservatoire.jpg" class="card-img-top" alt="Image 3">
                    <div class="card-body">
                        <h5 class="card-title">Afficher les cours</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
