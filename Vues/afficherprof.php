<!DOCTYPE html>
<html lang="en">

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
        <h2 class="d-flex justify-content-center mt-5">Les Professeurs</h2>
    </div>
    <div class="container-fluid position-relative mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tel</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Instrument</th>
                    <th scope="col">Salaire</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>


                <?php
                foreach ($lesPersonnes as $personne) {
                    echo "<tr>";
                    echo "<td>" . $personne->getNOM() . "</td>";
                    echo "<td>" . $personne->getPRENOM() . "</td>";
                    echo "<td>" . $personne->getMAIL() . "</td>";
                    echo "<td>" . $personne->getTEL() . "</td>";
                    echo "<td>" . $personne->getADRESSE() . "</td>";
                    echo "<td>" . $personne->getINSTRUMENT() . "</td>";
                    echo "<td>" . $personne->getSALAIRE() . "</td>";
                    echo "<td><a href='index.php?uc=personne&action=supprimerprof&id=". $personne->getID() ."' class='btn btn-danger'>Supprimer</a></td>";
                    echo "<td><a href='index.php?uc=personne&action=editer_form&id=". $personne->getID() ."' class='btn btn-warning'>Modifier</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Miclea Christian</p>
    </footer>

</body>



</html>
