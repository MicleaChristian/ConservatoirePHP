<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/personne.class.php';

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
    <?php include("header/header.php"); ?>

    <div class="position-relative mt-5 mb-3">
        <h2 class="d-flex justify-content-center mt-5">Nos cours</h2>
    </div>
    <div class="container-fluid position-relative mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Professeur</th>
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
                    $professeur = Personne::getById($seance->getIDPROF());
                    echo "<td>" . $professeur->getNOM() . "</td>";
                    echo "<td>" . $seance->getTRANCHE() . "</td>";
                    echo "<td>" . $seance->getJOUR() . "</td>";
                    echo "<td>" . $seance->getNIVEAU() . "</td>";
                    echo "<td>" . $seance->getCAPACITE() . "</td>";
                    echo "<td><a href='index.php?uc=cours&action=supprimer&idseance=" . $seance->getNUMSEANCE() . "'><button type='button' class='btn btn-danger'>Supprimer</button></a></td>";
                    echo "<td><a href='index.php?uc=cours&action=editer_form&idseance=" . $seance->getNUMSEANCE() . "'><button type='button' class='btn btn-warning'>Modifier</button></a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>


