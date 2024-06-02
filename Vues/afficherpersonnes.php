<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/personne.class.php';

MonPdo::checkSessionAndRedirect();
$userRole = MonPdo::getUserRole($_SESSION['user_id']);
$lesPersonnes = [];

if ($userRole == 'parent') {
    $parentId = $_SESSION['user_id'];
    $pdo = MonPdo::getInstance();
    $stmt = $pdo->prepare('SELECT * FROM personne INNER JOIN eleve ON ID = IDELEVE WHERE PARENT_ID = :parentId');
    $stmt->execute(['parentId' => $parentId]);
    $lesPersonnes = $stmt->fetchAll(PDO::FETCH_OBJ);
} elseif ($userRole == 'admin') {
    // Fetch all eleves for admin role
    $pdo = MonPdo::getInstance();
    $stmt = $pdo->prepare('SELECT * FROM personne INNER JOIN eleve ON ID = IDELEVE');
    $stmt->execute();
    $lesPersonnes = $stmt->fetchAll(PDO::FETCH_OBJ);
}
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

            .position-relative {
                flex: center;
            }
        }
    </style>
    <script>
        function confirmDelete(url, name, firstname) {
            if (confirm(`Etes vous sur de vouloir supprimer ${name} ${firstname}?`)) {
                window.location.href = url;
            }
        }
    </script>
</head>

<body>
<?php include("header/header.php") ?>
<?php if ($_SESSION['user_role'] == 'admin') : ?>
    <div class="position-relative mt-5 mb-3">
        <h2 class="d-flex justify-content-center mt-5" id="tit_h">Nos élèves</h2>
    </div>
<?php elseif ($_SESSION['user_role'] == 'parent') : ?>
    <div class="position-relative mt-5 mb-3">
        <h2 class="d-flex justify-content-center mt-5" id="tit_h">Vos Enfants</h2>
    </div>
<?php endif ?>
    <div class="container-fluid position-relative mt-3">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="table_h" scope="col">Nom</th>
                        <th class="table_h d-none d-md-table-cell" scope="col">Prénom</th>
                        <th class="table_h d-none d-sm-table-cell" scope="col">Email</th>
                        <th class="table_h d-none d-lg-table-cell" scope="col">Tel</th>
                        <th class="table_h d-none d-xl-table-cell" scope="col">Niveau</th>
                        <th class="table_h d-none d-xl-table-cell" scope="col">Bourse</th>
                        <th class="table_h" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lesPersonnes as $personne) {
                        $bourseStatus = $personne->BOURSE == 1 ? 'payée' : 'impayée';
                        $niveauStatus = '';
                        switch ($personne->NIVEAU) {
                            case 1:
                                $niveauStatus = 'Débutant';
                                break;
                            case 2:
                                $niveauStatus = 'Moyen';
                                break;
                            case 3:
                                $niveauStatus = 'Avancé';
                                break;
                        }

                        echo "<tr>";
                        echo "<td class='table_h'>" . $personne->NOM . "</td>";
                        echo "<td class='table_h d-none d-md-table-cell'>" . $personne->PRENOM . "</td>";
                        echo "<td class='table_h d-none d-sm-table-cell'>" . $personne->MAIL . "</td>";
                        echo "<td class='table_h d-none d-lg-table-cell'>" . $personne->TEL . "</td>";
                        echo "<td class='table_h d-none d-xl-table-cell'>" . $niveauStatus . "</td>";
                        echo "<td class='table_h d-none d-xl-table-cell'>" . $bourseStatus . "</td>";
                        echo "<td class='adminbutt'>";
                        echo "<a href='#' onclick=\"confirmDelete('index.php?uc=personne&action=supprimer&id=" . $personne->ID . "', '" . $personne->NOM . "', '" . $personne->PRENOM . "')\" class='btn btn-danger btn-sm'>Supprimer</a>";
                        echo "<a href='index.php?uc=personne&action=editer_form&id=" . $personne->ID . "' class='btn btn-warning btn-sm'>Modifier</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                        <?php if ($_SESSION['user_role'] == 'parent') : ?>
                    <tr>
                        <td colspan="7" class="adminbutt">
                            <a href='index.php?uc=personne&action=ajout_form' class='btn btn-primary btn-sm'>Ajouter un élève</a>
                        </td>
                    </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
