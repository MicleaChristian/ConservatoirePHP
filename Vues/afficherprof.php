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
                        <?php if ($_SESSION['user_role'] == 'admin') : ?>
                        <th scope="col" class="d-none d-lg-table-cell">Tel</th>
                        <th scope="col" class="d-none d-xl-table-cell">Adresse</th>
                        <?php endif ?>
                        <th scope="col" class="d-none d-xl-table-cell">Instrument</th>
                        <?php if ($_SESSION['user_role'] == 'admin') : ?>
                        <th scope="col" class="d-none d-xl-table-cell">Salaire</th>
                        <th scope="col">Actions</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lesPersonnes as $personne) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($personne->getNOM(), ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($personne->getPRENOM(), ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td class='d-none d-sm-table-cell'>" . htmlspecialchars($personne->getMAIL(), ENT_QUOTES, 'UTF-8') . "</td>";
                        if ($_SESSION['user_role'] == 'admin') :
                        echo "<td class='d-none d-lg-table-cell'>" . htmlspecialchars($personne->getTEL(), ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td class='d-none d-xl-table-cell'>" . htmlspecialchars($personne->getADRESSE(), ENT_QUOTES, 'UTF-8') . "</td>";
                        endif;
                        echo "<td class='d-none d-xl-table-cell'>" . htmlspecialchars($personne->getINSTRUMENT(), ENT_QUOTES, 'UTF-8') . "</td>";
                        if ($_SESSION['user_role'] == 'admin') :
                        echo "<td class='d-none d-xl-table-cell'>" . htmlspecialchars($personne->getSALAIRE(), ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td class='adminbutt'>";
                        echo "<a href='index.php?uc=personne&action=supprimerprof&id=". htmlspecialchars($personne->getID(), ENT_QUOTES, 'UTF-8') ."' class='btn btn-danger btn-sm'>Supprimer</a>";
                        echo "<a href='index.php?uc=personne&action=editer_formprof&id=". htmlspecialchars($personne->getID(), ENT_QUOTES, 'UTF-8') ."' class='btn btn-warning btn-sm'>Modifier</a>";
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
