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
        function confirmDelete(url, name, firstname, event) {
            event.stopPropagation(); // Stop the event from bubbling up to the card click event
            if (confirm(`Etes vous sur de vouloir supprimer ${name} ${firstname}?`)) {
                window.location.href = url;
            }
        }
    </script>
</head>

<body>
<?php include("header/header.php") ?>
    <div class="position-relative mt-5 mb-3">
        <h2 class="d-flex justify-content-center mt-5">Les Professeurs</h2>
    </div>
    <div class="container-fluid position-relative mt-3">
        <div class="card-container">
            <?php
            foreach ($lesPersonnes as $personne) {
                echo "<div class='card' onclick=\"window.location.href='index.php?uc=personne&action=editer_formprof&id=" . htmlspecialchars($personne->getID(), ENT_QUOTES, 'UTF-8') . "'\">";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($personne->getNOM(), ENT_QUOTES, 'UTF-8') . " " . htmlspecialchars($personne->getPRENOM(), ENT_QUOTES, 'UTF-8') . "</h5>";
                echo "<p class='card-text'><strong>Email:</strong> " . htmlspecialchars($personne->getMAIL(), ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p class='card-text'><strong>Tel:</strong> " . htmlspecialchars($personne->getTEL(), ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p class='card-text'><strong>Adresse:</strong> " . htmlspecialchars($personne->getADRESSE(), ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p class='card-text'><strong>Instrument:</strong> " . htmlspecialchars($personne->getINSTRUMENT(), ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p class='card-text'><strong>Salaire:</strong> " . htmlspecialchars($personne->getSALAIRE(), ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<div class='card-actions'>";
                echo "<a href='#' onclick=\"confirmDelete('index.php?uc=personne&action=supprimerprof&id=" . htmlspecialchars($personne->getID(), ENT_QUOTES, 'UTF-8') . "', '" . htmlspecialchars($personne->getNOM(), ENT_QUOTES, 'UTF-8') . "', '" . htmlspecialchars($personne->getPRENOM(), ENT_QUOTES, 'UTF-8') . "', event)\" class='btn btn-danger btn-sm'>Supprimer</a>";
                echo "<a href='index.php?uc=personne&action=editer_formprof&id=" . htmlspecialchars($personne->getID(), ENT_QUOTES, 'UTF-8') . "' class='btn btn-warning btn-sm'>Modifier</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
                <?php if ($_SESSION['user_role'] == 'admin') : ?>
            <div class="card add-card" onclick="window.location.href='index.php?uc=personne&action=ajout_formprof'">
                <div class="card-body">
                    <h5 class="card-title">Ajouter un professeur</h5>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
</body>

</html>
