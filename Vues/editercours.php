<?php
require_once 'Modeles/monPdo.php';

MonPdo::checkSessionAndRedirect();
?>

<!DOCTYPE html>
<html lang="en">

<?php
require_once 'Modeles/cours.class.php';
require_once 'Modeles/prof.class.php';
require_once 'Modeles/heure.class.php';
require_once 'Modeles/niveau.class.php';
require_once 'Modeles/jour.class.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Séance - Conservatoire</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
    <style>
        .form-container {
            max-width: 800px;
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
        <h2>Modifier les informations de <?php echo $seance->getJOUR() . " " . $seance->getTRANCHE(); ?></h2>
        <form action="index.php?uc=cours&action=editer&idseance=<?php echo $seance->getNUMSEANCE(); ?>" method="post">
            <div class="row mt-3">
                <div class="col">
                    <label for="idprof" class="form-label">Professeur</label>
                    <select class="form-select" id="idprof" name="idprof">
                        <?php
                        $profs = prof::getAll();
                        foreach ($profs as $prof) {
                            $selected = ($prof['idprof'] == $seance->getIDPROF()) ? 'selected' : '';
                            echo "<option value='" . $prof['idprof'] . "' $selected>" . $prof['nom'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="tranche" class="form-label">Tranche horaire</label>
                    <select class="form-select" id="tranche" name="tranche">
                        <?php
                        $heures = heure::getAll();
                        foreach ($heures as $heure) {
                            $selected = ($heure['tranche'] == $seance->getTRANCHE()) ? 'selected' : '';
                            echo "<option value='" . $heure['tranche'] . "' $selected>" . $heure['tranche'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="jour" class="form-label">Jour</label>
                    <select class="form-select" id="jour" name="jour">
                        <?php
                        $jours = jour::getAll();
                        foreach ($jours as $jour) {
                            $selected = ($jour['jour'] == $seance->getJOUR()) ? 'selected' : '';
                            echo "<option value='" . $jour['jour'] . "' $selected>" . $jour['jour'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="niveau" class="form-label">Niveau</label>
                    <select class="form-select" id="niveau" name="niveau">
                        <?php
                        $niveaux = niveau::getAll();
                        foreach ($niveaux as $niveau) {
                            $selected = ($niveau['niveau'] == $seance->getNIVEAU()) ? 'selected' : '';
                            echo "<option value='" . $niveau['niveau'] . "' $selected>" . $niveau['niveau'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="capacite" class="form-label">Capacité</label>
                    <input type="number" class="form-control" id="capacite" name="capacite" value="<?php echo $seance->getCAPACITE(); ?>" required>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                <a href="index.php?uc=cours&action=liste" class="btn btn-secondary ms-3">Retour à la liste des cours</a>
            </div>
        </form>
    </div>
</body>

</html>
