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
    <link href="style.css" rel="stylesheet">
</head>

<body>
<?php include("header/header.php");
?>
<!-- fait le calendrier avec toutes les données qui correspondent -->
<div class="container-fluid position-relative mt-3">
    <h2 class="position-absolute top-0 start-50 translate-middle">Planning</h2>
    <div class="row mt-3">
        <div class="col">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Heure</th>
                    <th scope="col">Lundi</th>
                    <th scope="col">Mardi</th>
                    <th scope="col">Mercredi</th>
                    <th scope="col">Jeudi</th>
                    <th scope="col">Vendredi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($heures as $heure): ?>
                    <tr>
                        <th scope="row"><?php echo $heure["tranche"]; ?></th>
                        <?php foreach ($jours as $jour): ?>
                            <td>
                                <?php
                                $cours = MonPdo::getInstance()->prepare("SELECT * FROM cours WHERE idjour = :idjour AND idheure = :idheure");
                                $cours->execute(array(
                                    "idjour" => $jour["idjour"],
                                    "idheure" => $heure["idheure"]
                                ));
                                $cours = $cours->fetch();
                                if ($cours) {
                                    $prof = MonPdo::getInstance()->prepare("SELECT * FROM prof WHERE idprof = :idprof");
                                    $prof->execute(array(
                                        "idprof" => $cours["idprof"]
                                    ));
                                    $prof = $prof->fetch();
                                    echo $prof["nom"];
                                }
                                ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>
