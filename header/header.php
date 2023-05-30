<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?uc=accueil">Conservatoire</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="index.php?uc=accueil">Accueil</a>
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
                        <li><a class="dropdown-item" href="index.php?uc=planning&action=ajout_form">Ajuster planning</a></li>
                    </ul>
                </div>
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
