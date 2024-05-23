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
    }
 
else {
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
                    echo "<td class='table_h'>" . $personne->NOM . "</td>";
                    echo "<td class='table_h'>" . $personne->PRENOM . "</td>";
                    echo "<td class='table_h'>" . $personne->MAIL . "</td>";
                    echo "<td class='table_h'>" . $personne->TEL . "</td>";
                    echo "<td class='table_h'>" . $personne->NIVEAU . "</td>";
                    echo "<td class='table_h'>" . $personne->BOURSE . "</td>";
                        echo "<td class='table_h'><a href='index.php?uc=personne&action=supprimer&id=". $personne->ID ."' class='btn btn-danger'>Supprimer</a></td>";
                        echo "<td class='table_h'><a href='index.php?uc=personne&action=editer_form&id=". $personne->ID ."' class='btn btn-warning'>Modifier</a></td>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="8" class="table_h">
                        <a href='index.php?uc=personne&action=ajout_form' class='btn btn-primary'>Ajouter un élève</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
