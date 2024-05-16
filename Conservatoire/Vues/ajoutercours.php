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


    <div class="container-fluid position-relative mt-3">
        <h2 class="position-absolute top-0 start-50 translate-middle">Ajouter une Seance</h2>
        <form action="index.php?uc=cours&action=ajouter" method="post">
            <div class="row mt-3">
                <div class="col">
                    <label for="idprof" class="form-label">Prof</label>
                    <select class="form-control" id="idprof" name="idprof">
                        <?php foreach ($profs as $prof): ?>
                            <option value="<?php echo $prof["idprof"]; ?>">
                                <?php echo $prof["nom"]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="tranche" class="form-label">Horaire</label>
                    <select class="form-control" id="tranche" name="tranche">
                        <?php foreach ($heures as $heure): ?>
                            <option value="<?php echo $heure["tranche"]; ?>">
                                <?php echo $heure["tranche"]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="jour" class="form-label">Jour</label>
                    <select class="form-control" id="jour" name="jour">
                        <?php foreach ($jours as $jour): ?>
                            <option value="<?php echo $jour["jour"]; ?>">
                                <?php echo $jour["jour"]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="niveau" class="form-label">Niveau :</label>
                <select class="form-control" id="niveau" name="niveau" required>
                    <option value="">Niveau</option>
                    <option value="1">Débutant</option>
                    <option value="2">Moyen</option>
                    <option value="3">Avancé</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="capacite" class="form-label">Capacité :</label>
                <input type="number" class="form-control" id="capacite" name="capacite" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Ajouter">
        </form>
    </div>
</body>

</html>
