<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservatoire</title>
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
                        Élèves
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?uc=personne&action=liste">Afficher les élèves</a></li>
                        <li><a class="dropdown-item" href="index.php?uc=personne&action=ajout_form">Ajouter un élève</a></li>
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

<div class="container mt-5 form-container">
    <h2>Ajouter une Personne</h2>
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
            <label for="niveau" class="form-label">Niveau :</label>
            <input type="number" class="form-control" id="niveau" name="niveau" placeholder="Niveau" required>
        </div>
        <input type="hidden" id="bourse" name="bourse" value="0">
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>
</body>
</html>
