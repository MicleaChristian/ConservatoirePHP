<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... -->
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
                var hiddenInputs = document.querySelectorAll('input[value="' + idprof + '"]');
                hiddenInputs.forEach(function(input) {
                    input.remove();
                });
            }
        }
    </script>
</head>

<body>
    <!-- ... -->
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
        <!-- Other fields here... -->
        <input type="submit" class="btn btn-primary" value="Ajouter">
    </form>
    <!-- ... -->
</body>
</html>