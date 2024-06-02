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
    <title>Ajouter une Séance - Conservatoire</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
    <style>
        .form-container {
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include("header/header.php") ?>

    <div class="container mt-5 form-container">
        <h2>Ajouter une Séance</h2>
        <form action="index.php?uc=cours&action=ajoutercours" method="post">
            <div class="mb-3">
                <label for="idprof" class="form-label">Prof</label>
                <select class="form-select" id="idprof" name="idprof" required>
                    <?php foreach ($profs as $prof): ?>
                        <option value="<?php echo $prof["idprof"]; ?>">
                            <?php echo $prof["nom"]; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tranche" class="form-label">Horaire</label>
                <select class="form-select" id="tranche" name="tranche" required>
                    <?php foreach ($heures as $heure): ?>
                        <option value="<?php echo $heure["tranche"]; ?>">
                            <?php echo $heure["tranche"]; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="jour" class="form-label">Jour</label>
                <select class="form-select" id="jour" name="jour" required>
                    <?php foreach ($jours as $jour): ?>
                        <option value="<?php echo $jour["jour"]; ?>">
                            <?php echo $jour["jour"]; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="niveau" class="form-label">Niveau</label>
                <select class="form-select" id="niveau" name="niveau" required>
                    <option value="">Sélectionner le niveau</option>
                    <option value="1">Débutant</option>
                    <option value="2">Moyen</option>
                    <option value="3">Avancé</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="capacite" class="form-label">Capacité</label>
                <input type="number" class="form-control" id="capacite" name="capacite" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
</body>

</html>
