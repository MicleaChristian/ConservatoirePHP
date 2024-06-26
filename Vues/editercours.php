<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/cours.class.php';
require_once 'Modeles/prof.class.php';
require_once 'Modeles/heure.class.php';
require_once 'Modeles/niveau.class.php';
require_once 'Modeles/jour.class.php';

MonPdo::checkSessionAndRedirect();

$seanceId = $_GET['idseance'];
$seance = Seance::getBynumseance($seanceId);

// Generate CSRF token and store in session
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>

<!DOCTYPE html>
<html lang="en">
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
        <h2>Modifier les informations de <?php echo htmlspecialchars($seance->getJOUR() . " " . $seance->getTRANCHE(), ENT_QUOTES, 'UTF-8'); ?></h2>
        <form action="index.php?uc=cours&action=editer&idseance=<?php echo htmlspecialchars($seance->getNUMSEANCE(), ENT_QUOTES, 'UTF-8'); ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
            <div class="row mt-3">
                <div class="col">
                    <label for="idprof" class="form-label">Professeur</label>
                    <select class="form-select" id="idprof" name="idprof">
                        <?php
                        $profs = prof::getAll();
                        foreach ($profs as $prof) {
                            $selected = ($prof['idprof'] == $seance->getIDPROF()) ? 'selected' : '';
                            echo "<option value='" . htmlspecialchars($prof['idprof'], ENT_QUOTES, 'UTF-8') . "' $selected>" . htmlspecialchars($prof['nom'], ENT_QUOTES, 'UTF-8') . "</option>";
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
                            echo "<option value='" . htmlspecialchars($heure['tranche'], ENT_QUOTES, 'UTF-8') . "' $selected>" . htmlspecialchars($heure['tranche'], ENT_QUOTES, 'UTF-8') . "</option>";
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
                            echo "<option value='" . htmlspecialchars($jour['jour'], ENT_QUOTES, 'UTF-8') . "' $selected>" . htmlspecialchars($jour['jour'], ENT_QUOTES, 'UTF-8') . "</option>";
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
                            echo "<option value='" . htmlspecialchars($niveau['niveau'], ENT_QUOTES, 'UTF-8') . "' $selected>" . htmlspecialchars($niveau['niveau'], ENT_QUOTES, 'UTF-8') . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col">
                    <label for="capacite" class="form-label">Capacité</label>
                    <input type="number" class="form-control" id="capacite" name="capacite" value="<?php echo htmlspecialchars($seance->getCAPACITE(), ENT_QUOTES, 'UTF-8'); ?>" required>
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

<?php
// In the file where the form is processed, add the following code to verify the CSRF token
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !Seance::verifyCSRFToken($_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    // Process the form data
}
?>
