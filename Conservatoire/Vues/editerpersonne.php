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
    <title>Conservatoire</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
</head>

<body>
<?php include("header/header.php") ?>

    <div class="position-relative mt-5 mb-3">
        <h2 class="d-flex justify-content-center mt-5">Modifier les informations de <?php echo $personne->getNOM() . " " . $personne->getPRENOM(); ?></h2>
    </div>
    <div class="container-fluid position-relative mt-3">
        <form action="index.php?uc=personne&action=editer&id=<?php echo $personne->getID(); ?>" method="POST">
            <div class="row">
                <div class="col">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $personne->getNOM(); ?>">
                </div>
                <div class="col">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $personne->getPRENOM(); ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="mail" class
                    ="form-label">Mail</label>
                <input type="email" class="form-control" id="mail" name="mail" value="<?php echo $personne->getMAIL(); ?>">
            </div>
            <div class="col">
                <label for="tel" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $personne->getTEL(); ?>">
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="index.php?uc=personne&action=liste" class="btn btn-secondary">Retour à la liste des élèves</a>
        </div>
    </form>
</div>
</body>
</html>
