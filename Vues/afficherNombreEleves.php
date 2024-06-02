<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/inscription.class.php';

MonPdo::checkSessionAndRedirect();

$classId = isset($_GET['classId']) ? intval($_GET['classId']) : 0;
$students = Inscription::getStudentsByClass($classId);
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
    <h2>Élèves inscrits dans le cours</h2>
    <p>Liste des élèves inscrits dans le cours avec l'ID <?php echo htmlspecialchars($classId); ?> :</p>
    <ul>
        <?php
        foreach ($students as $student) {
            echo '<li>' . htmlspecialchars($student['PRENOM']) . ' ' . htmlspecialchars($student['NOM']) . '</li>';
        }
        ?>
    </ul>
    <a href="index.php?uc=cours&action=liste" class="btn btn-secondary">Retour à la liste des cours</a>
</div>
</body>
</html>
