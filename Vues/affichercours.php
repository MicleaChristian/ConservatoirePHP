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
    <div class="position-relative mt-5 mb-3">
        <h2 class="position-absolute top-0 start-50 translate-middle">Nos cours</h2>
    </div>
    <div class="container-fluid position-relative mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Idprof</th>
                    <th scope="col">Tranche</th>
                    <th scope="col">Jour</th>
                    <th scope="col">Niveau</th>
                    <th scope="col">Capacité</th>
                </tr>
            </thead>
            <tbody>


                <?php
                foreach ($lesSeances as $seance) {
                    echo "<tr>";
                    echo "<td>" . $seance->getIDPROF() . "</td>";
                    echo "<td>" . $seance->getTRANCHE() . "</td>";
                    echo "<td>" . $seance->getJOUR() . "</td>";
                    echo "<td>" . $seance->getNIVEAU() . "</td>";
                    echo "<td>" . $seance->getCAPACITE() . "</td>";
                    echo "<td><a href='index.php?uc=personne&action=supprimer&id=". $seance->getNUMSEANCE() ."' class='btn btn-danger'>Supprimer</a></td>";
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