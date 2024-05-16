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
</head>

<body>
<?php include("header/header.php") ?>

    <div class="container-fluid position-relative mt-3">
        <h2 class="position-absolute top-0 start-50 translate-middle">Ajouter une personne</h2>
        <form action="index.php?uc=personne&action=ajouterprof" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">mail :</label>
                <input type="mail" class="form-control" id="mail" name="mail" placeholder="Mail" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Téléphone :</label>
                <input type="text" class="form-control" id="tel" name="tel" placeholder="Tel" required>
            </div>

            <div class="mb-3">
                <label for="adress" class="form-label">Adresse :</label>
                <input type="text" class="form-control" id="adress" name="adress" placeholder="Adresse" required>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="libelle" class="form-label">Instrument</label>
                    <select class="form-control" id="libelle" name="libelle">
                        <?php foreach ($instruments as $instrument): ?>
                            <option value="<?php echo $instrument["libelle"]; ?>">
                                <?php echo $instrument["libelle"]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="salaire" class="form-label">Salaire :</label>
                <input type="number" class="form-control" id="salaire" name="salaire" placeholder="Salaire" required>
            </div>

            <input type="submit" class="btn btn-primary" value="Ajouterprof">
        </form>
    </div>
</body>

</html>