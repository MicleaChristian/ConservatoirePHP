<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/cours.class.php';
require_once 'Modeles/personne.class.php';
require_once 'Modeles/inscription.class.php';

MonPdo::checkSessionAndRedirect();
$eleveId = $_GET['eleve'];
$eleve = personne::getById($eleveId);
$lesSeances = Seance::afficherTous();
$assignedSeances = Inscription::getAssignedStudentsByClass($eleveId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigner Classes</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
    <style>
        .table-responsive {
            margin: 0;
        }
    </style>
</head>
<body>
    <?php include("header/header.php") ?>

    <div class="container-fluid position-relative mt-3">
        <h2 class="d-flex justify-content-center mt-5">Assigner des classes à <?php echo $eleve->getNOM() . ' ' . $eleve->getPRENOM(); ?></h2>
        <form action="index.php?uc=inscription&action=assign" method="post" id="form">
            <input type="hidden" name="eleveId" value="<?php echo $eleveId; ?>">
            <div class="table-responsive mt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="table_h" scope="col">Sélectionner</th>
                            <th class="table_h" scope="col">Professeur</th>
                            <th class="table_h" scope="col">Jour</th>
                            <th class="table_h" scope="col">Tranche</th>
                            <th class="table_h" scope="col">Niveau</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lesSeances as $seance): ?>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="numseance[]" value="<?php echo $seance->getNUMSEANCE(); ?>" <?php echo in_array($seance->getNUMSEANCE(), $assignedSeances) ? 'checked' : ''; ?>>
                                    </div>
                                </td>
                                <td><?php echo $seance->getIDPROF(); ?></td>
                                <td><?php echo $seance->getJOUR(); ?></td>
                                <td><?php echo $seance->getTRANCHE(); ?></td>
                                <td><?php echo $seance->getNIVEAU(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                <input type="submit" class="btn btn-primary" value="Assigner">
            </div>
        </form>
    </div>
</body>
</html>
