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
</head>

<body>
<?php include("header/header.php") ?>
    <div style="display: flex; width: 100vw; justify-content: center;"> 
    <div style="width: 80vw; ">
    <?php
    $jours = array(
        1 => array("nom" => "Lundi", "id" => "lundi"),
        2 => array("nom" => "Mardi", "id" => "mardi"),
        3 => array("nom" => "Mercredi", "id" => "mercredi"),
        4 => array("nom" => "Jeudi", "id" => "jeudi"),
        5 => array("nom" => "Vendredi", "id" => "vendredi"),
        6 => array("nom" => "Samedi", "id" => "samedi"),
    );
    ?>


    <div class="position-relative mt-5 mb-3">
        <h2 class="d-flex justify-content-center mt-5">Planning</h2>
    </div>
    <div class="container-fluid position-relative mt-3">
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Heure</th>
                            <?php
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
                            echo "<th scope='row'>" . $heure['tranche'] . "</th>";
                            foreach ($jours as $jour) {
                                $seance = Seance::getByJourAndTranche($jour['id'], $heure['tranche']);
                                echo "<td";
                                if ($seance) {
                                    echo " class='table-primary'>";
                                    if ($seance) {
                                        $prof = personne::getById($seance->getIDPROF());
                                        echo "<div class='d-flex justify-content-center'><strong>Professeur: " . substr($prof->getPRENOM(), 0, 1) . ". " . $prof->getNOM() . "</strong></div>";

                                    }
                                    echo "<div class='d-flex justify-content-center'>Capacité: " . $seance->getCAPACITE() . " élèves</div>";
                                } else {
                                    echo "></td>";
                                }
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
   
</body>

</html>
