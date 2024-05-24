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
<?php include("header/header.php") ?>
    <div class="position-relative mt-5 mb-3">
        <h2 class="d-flex justify-content-center mt-5">Les Professeurs</h2>
    </div>
    <div class="container-fluid position-relative mt-5">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col" class="d-none d-md-table-cell">Prénom</th>
                        <th scope="col" class="d-none d-sm-table-cell">Email</th>
                        <th scope="col" class="d-none d-lg-table-cell">Tel</th>
                        <th scope="col" class="d-none d-xl-table-cell">Adresse</th>
                        <th scope="col" class="d-none d-xl-table-cell">Instrument</th>
                        <th scope="col" class="d-none d-xl-table-cell">Salaire</th>
                        <?php if ($_SESSION['user_role'] == 'admin') : ?>
                        <th scope="col">Actions</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lesPersonnes as $personne) {
                        echo "<tr>";
                        echo "<td>" . $personne->getNOM() . "</td>";
                        echo "<td class='d-none d-md-table-cell'>" . $personne->getPRENOM() . "</td>";
                        echo "<td class='d-none d-sm-table-cell'>" . $personne->getMAIL() . "</td>";
                        echo "<td class='d-none d-lg-table-cell'>" . $personne->getTEL() . "</td>";
                        echo "<td class='d-none d-xl-table-cell'>" . $personne->getADRESSE() . "</td>";
                        echo "<td class='d-none d-xl-table-cell'>" . $personne->getINSTRUMENT() . "</td>";
                        echo "<td class='d-none d-xl-table-cell'>" . $personne->getSALAIRE() . "</td>";
                        if ($_SESSION['user_role'] == 'admin') :
                        echo "<td class='adminbutt'>";
                        echo "<a href='index.php?uc=personne&action=supprimerprof&id=". $personne->getID() ."' class='btn btn-danger btn-sm'>Supprimer</a>";
                        echo "<a href='index.php?uc=personne&action=editer_formprof&id=". $personne->getID() ."' class='btn btn-warning btn-sm'>Modifier</a>";
                        echo "</td>";
                        endif;
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
