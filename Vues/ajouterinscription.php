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
    <title>Ajouter Inscription</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
    <script>
        function updateFields(checkboxElement, idprof, numseance) {
            if (checkboxElement.checked) {
                var hiddenIdprof = document.createElement("input");
                hiddenIdprof.setAttribute("type", "hidden");
                hiddenIdprof.setAttribute("name", "idprof[]");
                hiddenIdprof.setAttribute("value", idprof);
                document.getElementById("form").appendChild(hiddenIdprof);

                var hiddenNumseance = document.createElement("input");
                hiddenNumseance.setAttribute("type", "hidden");
                hiddenNumseance.setAttribute("name", "numseance[]");
                hiddenNumseance.setAttribute("value", numseance);
                document.getElementById("form").appendChild(hiddenNumseance);
            } else {
                var hiddenIdprof = document.querySelector('input[name="idprof[]"][value="' + idprof + '"]');
                var hiddenNumseance = document.querySelector('input[name="numseance[]"][value="' + numseance + '"]');
                if (hiddenIdprof) hiddenIdprof.remove();
                if (hiddenNumseance) hiddenNumseance.remove();
            }
        }
    </script>
</head>

<body>
    <?php include("header/header.php") ?>

    <div class="container-fluid position-relative mt-3">
        <h2 class="position-absolute top-0 start-50 translate-middle">Ajouter une inscription</h2>
        <form action="index.php?uc=cours&action=ajouter" method="post" id="form">
            <div class="row mt-3">
                <div class="col">
                    <label class="form-label">Prof</label>
                    <?php foreach ($rows as $row): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkbox<?php echo $row["IDPROF"]; ?>"
                                   onchange="updateFields(this, '<?php echo $row["IDPROF"]; ?>', '<?php echo $row["NUMSEANCE"]; ?>')">
                            <label class="form-check-label" for="checkbox<?php echo $row["IDPROF"]; ?>">
                                <?php echo $row["IDPROF"]; ?> - <?php echo $row["NUMSEANCE"]; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Add fields for IDELEVE -->
            <div class="mb-3">
                <label for="ideleve" class="form-label">IDELEVE :</label>
                <input type="text" class="form-control" id="ideleve" name="ideleve" placeholder="IDELEVE" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Ajouter">
        </form>
    </div>
</body>
</html>
