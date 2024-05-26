<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/cours.class.php';
require_once 'Modeles/prof.class.php';
require_once 'Modeles/heure.class.php';
require_once 'Modeles/jour.class.php';
require_once 'Modeles/niveau.class.php';
require_once 'Modeles/instrument.class.php';
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
        .planning-container {
            max-width: 90%;
            margin: auto;
            margin-top: 50px;
        }
        .planning-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        @media (max-width: 768px) {
            .table-responsive {
                display: none;
            }
            .list-view {
                display: block;
            }
            .day-separator {
                border-bottom: 2px solid #dee2e6;
                margin-bottom: 1rem;
            }
        }
        @media (min-width: 769px) {
            .list-view {
                display: none;
            }
        }
    </style>
</head>

<body>
<?php include("header/header.php") ?>

<div class="container planning-container">
    <h2 class="planning-header">Planning</h2>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Heure</th>
                    <?php
                    $jours = array(
                        1 => array("nom" => "Lundi", "id" => "lundi"),
                        2 => array("nom" => "Mardi", "id" => "mardi"),
                        3 => array("nom" => "Mercredi", "id" => "mercredi"),
                        4 => array("nom" => "Jeudi", "id" => "jeudi"),
                        5 => array("nom" => "Vendredi", "id" => "vendredi"),
                        6 => array("nom" => "Samedi", "id" => "samedi"),
                    );

                    foreach ($jours as $jour) {
                        echo "<th scope='col'>" . $jour['nom'] . "</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $heures = Heure::getAll();
                foreach ($heures as $heure) {
                    echo "<tr>";
                    echo "<th scope='row' class='table-light'>" . $heure['tranche'] . "</th>";
                    foreach ($jours as $jour) {
                        $seance = Seance::getByJourAndTranche($jour['id'], $heure['tranche']);
                        echo "<td";
                        if ($seance) {
                            echo " class='table-primary'>";
                            $prof = personne::getById($seance->getIDPROF());
                            echo "<strong>Prof: " . substr($prof->getPRENOM(), 0, 1) . ". " . $prof->getNOM() . "</strong>";
                            echo "<br>Capacité: " . $seance->getCAPACITE() . " élèves";
                        } else {
                            echo " class='empty'></td>";
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <div class="list-view">
        <?php
        foreach ($jours as $jour) {
            echo "<h3>" . $jour['nom'] . "</h3>";
            $heures = Heure::getAll();
            $hasSeance = false;
            foreach ($heures as $heure) {
                $seance = Seance::getByJourAndTranche($jour['id'], $heure['tranche']);
                if ($seance) {
                    $hasSeance = true;
                    $prof = personne::getById($seance->getIDPROF());
                    echo "<div class='card mb-3'>";
                    echo "<div class='card-header'><strong>" . $heure['tranche'] . "</strong></div>";
                    echo "<div class='card-body'>";
                    echo "<p class='card-text'><strong>Prof: " . substr($prof->getPRENOM(), 0, 1) . ". " . $prof->getNOM() . "</strong></p>";
                    echo "<p class='card-text'>Capacité: " . $seance->getCAPACITE() . " élèves</p>";
                    echo "</div>";
                    echo "</div>";
                }
            }
            if (!$hasSeance) {
                echo "<p>Aucun cours</p>";
            }
            echo "<hr class='day-separator'>";
        }
        ?>
    </div>
</div>

</body>

</html>
