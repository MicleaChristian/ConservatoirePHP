<?php
require_once 'Modeles/monPdo.php';

MonPdo::checkSessionAndRedirect();
?>
<!DOCTYPE html><html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservatoire</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/css.css">
</head>

<body>
<?php include("header/header.php") ?>
    <div class="position-relative mt-5 mb-3">
        <h2 class="d-flex justify-content-center mt-5" id="tit_h">Nos élèves</h2>
    </div>
    <div class="container-fluid position-relative mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="table_h" scope="col">Nom</th>
                    <th class="table_h" scope="col">Prénom</th>
                    <th class="table_h" scope="col">Email</th>
                    <th class="table_h" scope="col">Tel</th>
                    <th class="table_h" scope="col">Niveau</th>
                    <th class="table_h" scope="col">Bourse</th>
                    <th class="table_h" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>


                <?php
                foreach ($lesPersonnes as $personne) {
                    echo "<tr>";
                    echo "<td class='table_h'>" . $personne->getNOM() . "</td>";
                    echo "<td class='table_h'>" . $personne->getPRENOM() . "</td>";
                    echo "<td class='table_h'>" . $personne->getMAIL() . "</td>";
                    echo "<td class='table_h'>" . $personne->getTEL() . "</td>";
                    echo "<td class='table_h'>" . $personne->getNIVEAU() . "</td>";
                    echo "<td class='table_h'>" . $personne->getBOURSE() . "</td>";
                    echo "<td class='table_h'><a href='index.php?uc=personne&action=supprimer&id=". $personne->getID() ."' class='btn btn-danger'>Supprimer</a></td>";
                    echo "<td class='table_h'><a href='index.php?uc=personne&action=editer_form&id=". $personne->getID() ."' class='btn btn-warning'>Modifier</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>



</html>
