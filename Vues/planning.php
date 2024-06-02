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
        .table td .class-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .table td .class-item {
            flex: 1;
            margin: 2px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f9fa;
        }
        @media (max-width: 768px) {
            .table-responsive {
                display: none !important;
            }
            .list-view {
                display: block !important;
            }
        }
        @media (min-width: 769px) {
            .table-responsive {
                display: block !important;
            }
            .list-view {
                display: none !important;
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
                        $seances = Seance::getAllByJourAndTranche($jour['id'], $heure['tranche']);
                        echo "<td";
                        if ($seances) {
                            echo " class='table-primary'><div class='class-container'>";
                            foreach ($seances as $seance) {
                                $prof = personne::getById($seance->getIDPROF());
                                $instrument = $prof->getINSTRUMENT();
                                echo "<div class='class-item'>";
                                echo "<strong>Prof: " . substr($prof->getPRENOM(), 0, 1) . ". " . $prof->getNOM() . "</strong><br>";
                                echo "Instrument: " . $instrument . "<br>";
                                echo "Capacité: " . $seance->getCAPACITE() . " élèves";
                                echo "</div>";
                            }
                            echo "</div>";
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
                $seances = Seance::getAllByJourAndTranche($jour['id'], $heure['tranche']);
                if ($seances) {
                    $hasSeance = true;
                    foreach ($seances as $seance) {
                        $prof = personne::getById($seance->getIDPROF());
                        $instrument = $prof->getINSTRUMENT();
                        echo "<div class='card mb-3'>";
                        echo "<div class='card-header'><strong>" . $heure['tranche'] . "</strong></div>";
                        echo "<div class='card-body'>";
                        echo "<p class='card-text'><strong>Prof: " . substr($prof->getPRENOM(), 0, 1) . ". " . $prof->getNOM() . "</strong></p>";
                        echo "<p class='card-text'>Instrument: " . $instrument . "</p>";
                        echo "<p class='card-text'>Capacité: " . $seance->getCAPACITE() . " élèves</p>";
                        echo "</div>";
                        echo "</div>";
                    }
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
