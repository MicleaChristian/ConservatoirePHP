<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/cours.class.php';
require_once 'Modeles/personne.class.php';

MonPdo::checkSessionAndRedirect();

$lesSeances = Seance::afficherTous();
$lesEleves = personne::affichereleve();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Inscription</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
</head>

<body>
    <?php include("header/header.php") ?>

    <div class="container-fluid position-relative mt-3">
        <h2 class="position-absolute top-0 start-50 translate-middle">Ajouter une inscription</h2>
        <form action="index.php?uc=inscription&action=ajouter" method="post" id="form">
            <div class="mb-3">
                <label for="ideleve" class="form-label">Élève :</label>
                <select class="form-control" id="ideleve" name="ideleve" required>
                    <?php foreach ($lesEleves as $eleve): ?>
                        <option value="<?php echo $eleve->getID(); ?>">
                            <?php echo $eleve->getNOM() . ' ' . $eleve->getPRENOM(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="numseance" class="form-label">Séance :</label>
                <select class="form-control" id="numseance" name="numseance" required>
                    <?php foreach ($lesSeances as $seance): ?>
                        <option value="<?php echo $seance->getNUMSEANCE(); ?>">
                            <?php echo "Prof: " . $seance->getIDPROF() . " - Jour: " . $seance->getJOUR() . " - Tranche: " . $seance->getTRANCHE(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" class="btn btn-primary" value="Ajouter">
        </form>
    </div>
</body>
</html>
