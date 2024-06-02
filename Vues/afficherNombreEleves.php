// Vues/afficherNombreEleves.php

<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/inscription.class.php';

MonPdo::checkSessionAndRedirect();

$classId = isset($_GET['classId']) ? intval($_GET['classId']) : 0;
$studentCount = Inscription::getStudentCountByClass($classId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombre d'élèves inscrits</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
</head>

<body>
<?php include("header/header.php") ?>

<div class="container mt-5">
    <h2>Nombre d'élèves inscrits dans le cours</h2>
    <p>Le nombre d'élèves inscrits dans le cours avec l'ID <?php echo htmlspecialchars($classId); ?> est : <?php echo htmlspecialchars($studentCount); ?></p>
    <a href="index.php?uc=inscription&action=liste" class="btn btn-secondary">Retour à la liste des inscriptions</a>
</div>
</body>
</html>
