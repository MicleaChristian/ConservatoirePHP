<?php
require_once 'Modeles/monPdo.php';

MonPdo::checkSessionAndRedirect();
$userId = $_SESSION['user_id'];
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
        <h2 class="position-absolute top-0 start-50 translate-middle">Ajouter une personne</h2>
        <form action="index.php?uc=personne&action=ajouter" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Mail :</label>
                <input type="mail" class="form-control" id="mail" name="mail" placeholder="Mail" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Téléphone :</label>
                <input type="text" class="form-control" id="tel" name="tel" placeholder="Tel" required>
            </div>

            <div class="mb-3">
                <label for="adress" class="form-label">Adresse :</label>
                <input type="text" class="form-control" id="adress" name="adress" placeholder="Adresse" required>
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
                <label for="bourse" class="form-label">Bourse :</label>
                <select class="form-control" id="bourse" name="bourse" required>
                    <option value="">Sélectionner si payée ou impayée</option>
                    <option value="1">Payée</option>
                    <option value="0">Impayée</option>
                </select>
            </div>

            <!-- Hidden field for parentId -->
            <input type="hidden" name="parentId" id="parentId" value="<?php echo $_SESSION['user_id']; ?>">

            <input type="submit" class="btn btn-primary" value="Ajouter">
        </form>
    </div>
</body>

</html>
