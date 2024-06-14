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
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }

        .card {
            flex: 0 1 calc(33.333% - 1rem);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease;
            cursor: pointer;
            background-color: white;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            margin-bottom: 0.5rem;
        }

        .card-actions {
            display: flex;
            gap: 0.5rem;
        }

        .add-card {
            background-color: #007bff !important;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .add-card:hover {
            background-color: #0056b3 !important;
        }

        .add-card .card-body {
            padding: 2rem;
        }

        .add-card .card-title {
            font-size: 1.5rem;
        }

        @media (max-width: 767.98px) {
            .card {
                flex: 0 1 calc(100% - 1rem);
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
    <div class="position-relative mt-5 mb3">
        <h2 class="d-flex justify-content-center mt-5" id="tit_h">Vos Enfants</h2>
    </div>
<?php endif ?>
    <div class="container-fluid position-relative mt-3">
        <div class="card-container">
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

                echo "<div class='card' onclick=\"window.location.href='index.php?uc=personne&action=editer_form&id=" . $personne->ID . "'\">";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $personne->NOM . " " . $personne->PRENOM . "</h5>";
                echo "<p class='card-text'><strong>Email:</strong> " . $personne->MAIL . "</p>";
                echo "<p class='card-text'><strong>Tel:</strong> " . $personne->TEL . "</p>";
                echo "<p class='card-text'><strong>Niveau:</strong> " . $niveauStatus . "</p>";
                echo "<p class='card-text'><strong>Bourse:</strong> " . $bourseStatus . "</p>";
                echo "<div class='card-actions'>";
                echo "<a href='#' onclick=\"confirmDelete('index.php?uc=personne&action=supprimer&id=" . $personne->ID . "', '" . $personne->NOM . "', '" . $personne->PRENOM . "')\" class='btn btn-danger btn-sm'>Supprimer</a>";
                echo "<a href='index.php?uc=inscription&action=assign_form&eleve=" . $personne->ID . "' class='btn btn-primary btn-sm'>Inscrire</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
            <?php if ($_SESSION['user_role'] == 'parent') : ?>
                <div class="card add-card" onclick="window.location.href='index.php?uc=personne&action=ajout_form'">
                    <div class="card-body">
                        <h5 class="card-title">Ajouter un élève</h5>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</body>

</html>
