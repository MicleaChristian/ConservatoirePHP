<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservatoire</title>
    <style>
        body{
            background-color: #F8F6F4;
            min-height: 100vh;
        }

        .navbar{
            background-color: #D9D9D9;
        }
        @font-face {
            font-family: Tit;
            src: url(http://localhost/ConservatoirePHP/fonts/TitilliumWeb-Regular.ttf);
        }

        @font-face {
            font-family: Logo;
            src: url(http://localhost/ConservatoirePHP/fonts/MajorMonoDisplay-Regular.ttf);
        }

        /* Espacement entre les catégories */
        .navbar-nav .dropdown{
            margin-right: 10px;
        }
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
            background-color: rgba(248, 246, 244, 0.5);
            border-radius: 4px;
        }

        .dropdown-menu .dropdown-item {
            color: #000;
            Transition:1s;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: rgba(0,0,0, 0.5);
            color: #fff;
            Transition: 1s;
        }

        .bouton {
            transition: color 0.3s;
            font-family: Tit;
            background: none;
            color: black;
            border: none;
            margin: 0;
            padding: 0;
            display: inline-flex;
            align-items: center;
        }

        .bouton:hover {
            color: gray;
        }

        .boutondeco {
            transition: color 0.3s;
            font-family: Tit;
            background: none;
            color: black;
            border: none;
            margin: 0;
            padding: 0;
            display: inline-flex;
            align-items: center;
            padding-left: 10px;
            padding-right: 10px;
        }
        .deco:hover {
            background-color: red;
            Transition: 0.3s;
        }

        .deco {
            padding: 5px;
            border-radius: 10px;
            transition: 0.3s;
        }

        .navbar-nav {
            align-items: center;
            display: flex;
            
        }

        .navbar-nav .nav-item {
            display: flex;
            align-items: center;
        }

        #logo:hover{
            transform: scale(1.1);
            transition: 1s;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" id="logo" style="font-family: Logo; transition: 1s;" href="index.php?uc=accueil">ConservatoirE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <form class="form-inline" action="index.php?uc=logout" method="POST">
                        <ul class="navbar-nav">
                            <li class="nav-item" style="margin-right: 20px; font-family: Tit;">
                            </li>
                            <li class="nav-item deco">
                                <button type="submit" class="boutondeco">Déconnexion</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>
