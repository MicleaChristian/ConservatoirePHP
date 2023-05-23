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
    <link href="style.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?uc=accueil">Conservatoire</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="index.php?uc=accueil">Accueil</a>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Eleves
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?uc=personne&action=liste">Afficher les élèves</a></li>
                            <li><a class="dropdown-item" href="index.php?uc=personne&action=ajout_form">Ajouter un élève</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profs
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?uc=personne&action=listeprof">Afficher les profs</a></li>
                            <li><a class="dropdown-item" href="index.php?uc=personne&action=ajoutprof_form">Ajouter un prof</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cours
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="index.php?uc=cours&action=liste">Nos cours</a></li>
                            <li><a class="nav-link" href="index.php?uc=cours&action=ajout_form">Ajouter un cours</a></li>
                        </ul>
                    </div>
                    <?php include("header/header.php") ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="position-relative mt-5 mb-3">
        <h2 class="position-absolute top-0 start-50 translate-middle">Modifier les informations de <?php echo $personne->getNOM() . " " . $personne->getPRENOM(); ?></h2>
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
        <div class="position-absolute bottom-0 end-0 mb-3 me-3">
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="index.php?uc=personne&action=liste" class="btn btn-secondary">Retour à la liste des élèves</a>
        </div>
    </form>
</div>
</body>
</html>
