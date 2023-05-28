<?php
require_once 'Modeles/MonPdo.php'; // replace with the path to your MonPdo.php file

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
    <link href="style.css" rel="stylesheet">
</head>

<body>
<?php include("header/header.php") ?>


<div class="container-fluid position-relative mt-3">
    <h2 class="position-absolute top-0 start-50 translate-middle">Ajouter une personne</h2>
    <form action="index.php?uc=personne&action=ajouter" method="POST">
        <div class="mb-3">
            <label for="idprof" class="form-label">IDPROF :</label>
            <input type="surname" class="form-control" id="idprof" name="idprof" required>
        </div>
        <div class="mb-3">
            <label for="tranche" class="form-label">Tranche :</label>
            <input type="name" class="form-control" id="tranche" name="tranche" required>
        </div>
        <div class="mb-3">
            <label for="jour" class="form-label">Jour :</label>
            <input type="date" class="form-control" id="jour" name="jour" required>
        </div>
        <div class="mb-3">
            <label for="niveau" class="form-label">Niveau :</label>
            <input type="text" class="form-control" id="niveau" name="niveau" required>
        </div>
        <div class="mb-3">
            <label for="capacite" class="form-label">Capacité :</label>
            <input type="text" class="form-control" id="capacite" name="capacite" required>
        </div>
        <input type="submit" class="btn btn-primary" value="Ajouter">
    </form>
</div>
</body>
</html>
