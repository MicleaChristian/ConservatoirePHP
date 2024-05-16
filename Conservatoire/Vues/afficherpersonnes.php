<?php
require_once 'Modeles/monPdo.php';

MonPdo::checkSessionAndRedirect();
?>
<!DOCTYPE html>
<html lang="en">

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
        <h2 class="d-flex justify-content-center mt-5">Nos élèves</h2>
    </div>
    <div class="container-fluid position-relative mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tel</th>
                    <th scope="col">Niveau</th>
                    <th scope="col">Bourse</th>
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
                    echo "<td>" . $personne->getNIVEAU() . "</td>";
                    echo "<td>" . $personne->getBOURSE() . "</td>";
                    echo "<td><a href='index.php?uc=personne&action=supprimer&id=". $personne->getID() ."' class='btn btn-danger'>Supprimer</a></td>";
                    echo "<td><a href='index.php?uc=personne&action=editer_form&id=". $personne->getID() ."' class='btn btn-warning'>Modifier</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>



</html>
