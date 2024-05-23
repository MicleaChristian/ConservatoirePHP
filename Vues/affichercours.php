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
    <style>
        .table-responsive {
            margin: 0;
        }

        .adminbutt {
            white-space: nowrap;
            width: 1%;
        }

        .adminbutt .btn {
            margin-right: 0.25rem;
        }

        @media (max-width: 767.98px) {
            .adminbutt {
                display: flex;
                flex-direction: column;
                width: auto;
            }

            .adminbutt .btn {
                width: 100%;
                margin-right: 0;
                margin-bottom: 0.25rem;
            }

            .adminbutt .btn:last-child {
                margin-bottom: 0;
            }
            .position-relative{
                flex: center;
            }
        }

    </style>
</head>

<body>
    <?php include("header/header.php"); ?>

        <h2 class="d-flex justify-content-center mt-5">Nos cours</h2>

    <div class="container-fluid position-relative mt-3">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Professeur</th>
                        <th scope="col" class="d-none d-md-table-cell">Tranche</th>
                        <th scope="col" class="d-none d-sm-table-cell">Jour</th>
                        <th scope="col" class="d-none d-lg-table-cell">Niveau</th>
                        <th scope="col" class="d-none d-xl-table-cell">Capacité</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lesSeances as $seance) {
                        echo "<tr>";
                        $professeur = Personne::getById($seance->getIDPROF());
                        echo "<td>" . $professeur->getNOM() . "</td>";
                        echo "<td class='d-none d-md-table-cell'>" . $seance->getTRANCHE() . "</td>";
                        echo "<td class='d-none d-sm-table-cell'>" . $seance->getJOUR() . "</td>";
                        echo "<td class='d-none d-lg-table-cell'>" . $seance->getNIVEAU() . "</td>";
                        echo "<td class='d-none d-xl-table-cell'>" . $seance->getCAPACITE() . "</td>";
                        echo "<td class='adminbutt'>";
                        echo "<a href='index.php?uc=cours&action=supprimer&idseance=" . $seance->getNUMSEANCE() . "'><button type='button' class='btn btn-danger btn-sm'>Supprimer</button></a>";
                        echo "<a href='index.php?uc=cours&action=editer_form&idseance=" . $seance->getNUMSEANCE() . "'><button type='button' class='btn btn-warning btn-sm'>Modifier</button></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
