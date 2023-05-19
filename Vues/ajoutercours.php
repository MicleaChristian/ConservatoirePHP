<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservatoire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" </head>

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
                            <li><a class="dropdown-item" href="index.php?uc=personne&action=editer_form">Modifier un élève</a></li>
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
                    <div class="relative">
                        <form class="position-absolute top-50 start-50 translate-middle" action="index.php" method="POST">
                            <input type="hidden" name="uc" value="logout">
                            <input type="hidden" name="action" value="deconnexion">
                            <ul class="navbar-nav">
                                <li class="d-flex">
                                    <p class="me-5"> Bonjour <?php echo $_SESSION['user_id']; ?> </p>
                                    <button type="submit" class="btn btn-danger">Déconnexion</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>


<div class="container-fluid position-relative mt-3">
    <h2 class="position-absolute top-0 start-50 translate-middle">Ajouter une personne</h2>
    <form action="index.php?uc=personne&action=ajouter" method="POST">
        <div class="mb-3">
            <label for="idprof" class="form-label">IDPROF :</label>
            <input type="surname" class="form-control" id="idprof" name="idprof" required>
        </div>
        <div class="mb-3">
            <label for="tranche" class="form-label">Tranche :</label>
            <input type="name" class="form-control" id="tranche" name="tranche" required>
        </div>
        <div class="mb-3">
            <label for="jour" class="form-label">Jour :</label>
            <input type="date" class="form-control" id="jour" name="jour" required>
        </div>
        <div class="mb-3">
            <label for="niveau" class="form-label">Niveau :</label>
            <input type="text" class="form-control" id="niveau" name="niveau" required>
        </div>
        <div class="mb-3">
            <label for="capacite" class="form-label">Capacité :</label>
            <input type="text" class="form-control" id="capacite" name="capacite" required>
        </div>
        <input type="submit" class="btn btn-primary" value="Ajouter">
    </form>
</div>
</body>
</html>
