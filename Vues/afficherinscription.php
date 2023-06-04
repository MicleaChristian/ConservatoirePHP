<?php
require_once 'Modeles/monPdo.php';


MonPdo::checkSessionAndRedirect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservatoire</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
</head>

<body>
    <?php include("header/header.php") ?>


    <!-- fait moi un formulaire qui inscrit un eleve a un cours -->

    <div class="position-relative mt-5 mb-3">
        <h2 class="d-flex justify-content-center mt-5">Nos cours</h2>
    </div>
    <div class="container-fluid position-relative mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Eleves</th>
                    <th scope="col">Cours</th>
                    <th scope="col">Horaire</th>
                    <th scope="col">Date d'ajout</th>
                </tr>
            </thead>
            <tbody>




</body>
