<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/cours.class.php';
require_once 'Modeles/personne.class.php';
require_once 'Modeles/inscription.class.php';

MonPdo::checkSessionAndRedirect();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$eleveId = $_GET['eleve'];
$eleve = personne::getById($eleveId);
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
        <h2 class="d-flex justify-content-center mt-5">Inscrire <?php echo htmlspecialchars($eleve->getNOM() . ' ' . $eleve->getPRENOM(), ENT_QUOTES, 'UTF-8'); ?> à un cours</h2>
        <form action="index.php?uc=inscription&action=ajouterclass" method="post" id="form">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="eleveId" value="<?php echo htmlspecialchars($eleveId, ENT_QUOTES, 'UTF-8'); ?>">
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
                        <?php if (empty($eligibleSeances)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Aucun cours disponible pour cet élève</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($eligibleSeances as $seance): ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="numseance[]" value="<?php echo htmlspecialchars($seance->getNUMSEANCE(), ENT_QUOTES, 'UTF-8'); ?>">
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($seance->getIDPROF(), ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($seance->getJOUR(), ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($seance->getTRANCHE(), ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($seance->getNIVEAU(), ENT_QUOTES, 'UTF-8'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
