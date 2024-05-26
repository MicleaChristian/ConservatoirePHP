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
    <h2>Modifier les informations de <?php echo $personne->getNOM() . " " . $personne->getPRENOM(); ?></h2>
    <form action="index.php?uc=personne&action=editerprof&id=<?php echo $personne->getID(); ?>" method="POST">
        <div class="row mt-3">
            <div class="col">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $personne->getNOM(); ?>" required>
            </div>
            <div class="col">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $personne->getPRENOM(); ?>" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="mail" class="form-label">Mail</label>
                <input type="email" class="form-control" id="mail" name="mail" value="<?php echo $personne->getMAIL(); ?>" required>
            </div>
            <div class="col">
                <label for="tel" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $personne->getTEL(); ?>" required>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="index.php?uc=personne&action=listeprof" class="btn btn-secondary ms-3">Retour à la liste des profs</a>
        </div>
    </form>
</div>
</body>
</html>
