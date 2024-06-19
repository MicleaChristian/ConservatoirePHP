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
    <title>Ajouter un Professeur - Conservatoire</title>
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
    <h2>Ajouter un Professeur</h2>
    <form action="index.php?uc=personne&action=ajouterprof" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo personne::generateCSRFToken(); ?>">
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
            <input type="email" class="form-control" id="mail" name="mail" placeholder="Mail" required>
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Téléphone :</label>
            <input type="text" class="form-control" id="tel" name="tel" placeholder="Téléphone" required>
        </div>
        <div class="mb-3">
            <label for="adress" class="form-label">Adresse :</label>
            <input type="text" class="form-control" id="adress" name="adress" placeholder="Adresse" required>
        </div>
        <div class="mb-3">
            <label for="libelle" class="form-label">Instrument :</label>
            <select class="form-select" id="libelle" name="libelle" required>
                <?php foreach ($instruments as $instrument): ?>
                    <option value="<?php echo htmlspecialchars($instrument["libelle"], ENT_QUOTES, 'UTF-8'); ?>">
                        <?php echo htmlspecialchars($instrument["libelle"], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="salaire" class="form-label">Salaire :</label>
            <input type="number" class="form-control" id="salaire" name="salaire" placeholder="Salaire" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>
</body>

</html>
