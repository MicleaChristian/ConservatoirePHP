<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservatoire</title>
    <style>
        /* Espacement entre les catégories */
        .navbar-nav .dropdown,
        .navbar-nav .border {
            margin-right: 10px;
        }

        /* Style de l'encadré */
        .border {
            border: 2px solid #007bff;
            border-radius: 4px;
            padding: 10px;
        }

        /* Style des liens du header */
        .navbar-nav .nav-link {
            color: #000;
            font-weight: bold;
        }

        /* Couleur de fond au survol des liens */
        .navbar-nav .nav-link:hover,
        .navbar-nav .dropdown:hover .dropdown-toggle {
            background-color: #007bff;
            color: #fff;
        }

        /* Style des sous-menus */
        .dropdown-menu {
            background-color: #fff;
            border: 1px solid #007bff;
            border-radius: 4px;
            padding: 10px;
        }

        .dropdown-menu .dropdown-item {
            color: #000;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?uc=accueil">Conservatoire</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Élèves
                        </button>
                        <ul class="dropdown-menu animated fadeIn">
                            <li><a class="dropdown-item" href="index.php?uc=personne&action=liste">Afficher les élèves</a>
                            </li>
                            <li><a class="dropdown-item" href="index.php?uc=personne&action=ajout_form">Ajouter un élève</a>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Profs
                        </button>
                        <ul class="dropdown-menu animated fadeIn">
                            <li><a class="dropdown-item" href="index.php?uc=personne&action=listeprof">Afficher les
                                    profs</a></li>
                            <li><a class="dropdown-item" href="index.php?uc=personne&action=ajoutprof_form">Ajouter un
                                    prof</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Cours
                        </button>
                        <ul class="dropdown-menu animated fadeIn">
                            <li><a class="dropdown-item" href="index.php?uc=cours&action=liste">Nos cours</a></li>
                            <li><a class="dropdown-item" href="index.php?uc=cours&action=ajout_form">Ajouter un cours</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Planning
                        </button>
                        <ul class="dropdown-menu animated fadeIn">
                            <li><a class="dropdown-item" href="index.php?uc=planning&action=liste">Afficher le planning</a></li>
                            <li><a class="dropdown-item" href="index.php?uc=cours&action=ajout_form">Ajouter cours</a></li>
                        </ul>
                    </div>
                        <a class="btn btn-outline-primary" href="https://buy.stripe.com/cN2g1Kg6mdXaaFacMM">Me faire un DON</a>
                    <form class="form-inline" action="index.php?uc=logout" method="POST">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <span class="nav-link">Bonjour <?php echo $_SESSION['user_id']; ?></span>
                            </li>
                            <li class="nav-item">
                                <button type="submit" class="btn btn-danger">Déconnexion</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>
