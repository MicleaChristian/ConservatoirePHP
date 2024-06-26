<?php
require_once 'Modeles/monPdo.php';

MonPdo::checkSessionAndRedirect();
?>

<!DOCTYPE html>
<html lang="en">

<?php
require_once 'Modeles/personne.class.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les Informations - Conservatoire</title>
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
    <h2>Modifier les informations de <?php echo htmlspecialchars($personne->getNOM(), ENT_QUOTES, 'UTF-8') . " " . htmlspecialchars($personne->getPRENOM(), ENT_QUOTES, 'UTF-8'); ?></h2>
    <form action="index.php?uc=personne&action=editer&id=<?php echo htmlspecialchars($personne->getID(), ENT_QUOTES, 'UTF-8'); ?>" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo personne::generateCSRFToken(); ?>">
        <div class="row mt-3">
            <div class="col">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($personne->getNOM(), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="col">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($personne->getPRENOM(), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="mail" class="form-label">Mail</label>
                <input type="email" class="form-control" id="mail" name="mail" value="<?php echo htmlspecialchars($personne->getMAIL(), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="col">
                <label for="tel" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="tel" name="tel" value="<?php echo htmlspecialchars($personne->getTEL(), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="bourse" class="form-label">Bourse</label>
                <select class="form-select" id="bourse" name="bourse" required>
                    <option value="1" <?php echo $personne->getBOURSE() == 1 ? 'selected' : ''; ?>>Payée</option>
                    <option value="0" <?php echo $personne->getBOURSE() == 0 ? 'selected' : ''; ?>>Impayée</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="index.php?uc=personne&action=liste" class="btn btn-secondary ms-3">Retour à la liste des élèves</a>
        </div>
    </form>
</div>
</body>
</html>
