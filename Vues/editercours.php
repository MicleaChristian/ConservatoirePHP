<!-- fait moi la version editer -->
<form action="index.php?uc=cours&action=editer" method="post">
    <input type="hidden" name="idseance" value="<?php echo $seance->getIDSEANCE(); ?>">
    <div class="form-group">
        <label for="idprof">Professeur</label>
        <select class="form-control" name="idprof" id="idprof">
            <?php
            foreach ($profs as $prof) {
                if ($prof->getIDPROF() == $seance->getIDPROF()) {
                    echo "<option value='" . $prof->getIDPROF() . "' selected>" . $prof->getNOM() . "</option>";
                } else {
                    echo "<option value='" . $prof->getIDPROF() . "'>" . $prof->getNOM() . "</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tranche">Tranche horaire</label>
        <select class="form-control" name="tranche" id="tranche">
            <?php
            foreach ($heures as $heure) {
                if ($heure->getTRANCHE() == $seance->getTRANCHE()) {
                    echo "<option value='" . $heure->getTRANCHE() . "' selected>" . $heure->getTRANCHE() . "</option>";
                } else {
                    echo "<option value='" . $heure->getTRANCHE() . "'>" . $heure->getTRANCHE() . "</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="jour">Jour</label>
        <select class="form-control" name="jour" id="jour">
            <?php
            foreach ($jours as $jour) {
                if ($jour->getJOUR() == $seance->getJOUR()) {
                    echo "<option value='" . $jour->getJOUR() . "' selected>" . $jour->getJOUR() . "</option>";
                } else {
                    echo "<option value='" . $jour->getJOUR() . "'>" . $jour->getJOUR() . "</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="niveau">Niveau</label>
