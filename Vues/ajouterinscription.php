<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/cours.class.php';
require_once 'Modeles/personne.class.php';
require_once 'Modeles/inscription.class.php';

MonPdo::checkSessionAndRedirect();

$lesSeances = Seance::afficherTous();
$lesEleves = personne::affichereleve();

$assignedStudents = [];
foreach ($lesSeances as $seance) {
    $assignedStudents[$seance->getNUMSEANCE()] = Inscription::getAssignedStudentsByClass($seance->getNUMSEANCE());
}

$seancesForJS = array_map(function ($seance) {
    return [
        'NUMSEANCE' => $seance->getNUMSEANCE(),
        'IDPROF' => $seance->getIDPROF(),
        'TRANCHE' => $seance->getTRANCHE(),
        'JOUR' => $seance->getJOUR(),
        'NIVEAU' => $seance->getNIVEAU(),
        'CAPACITE' => $seance->getCAPACITE(),
    ];
}, $lesSeances);

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
        document.addEventListener("DOMContentLoaded", function() {
            const seances = <?php echo json_encode($seancesForJS, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
            const eleves = <?php echo json_encode($lesEleves, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
            const assignedStudents = <?php echo json_encode($assignedStudents, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

            console.log('Seances:', seances);
            console.log('Eleves:', eleves);
            console.log('Assigned Students:', assignedStudents);

            document.getElementById('numseance').addEventListener('change', function() {
                const selectedSeanceId = parseInt(this.value);
                console.log('Selected Seance ID:', selectedSeanceId);
                
                const selectedSeance = seances.find(seance => seance.NUMSEANCE === selectedSeanceId);
                const elevesContainer = document.getElementById('eleves-container');
                elevesContainer.innerHTML = '';

                console.log('Selected Seance:', selectedSeance);

                if (!selectedSeance) {
                    console.error('Selected seance not found!');
                    return;
                }

                const alreadyAssigned = assignedStudents[selectedSeanceId] || [];

                eleves.forEach(eleve => {
                    console.log('Processing Eleve:', eleve);
                    if (eleve.NIVEAU == selectedSeance.NIVEAU && !alreadyAssigned.includes(eleve.IDELEVE)) {
                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.name = 'ideleve[]';
                        checkbox.value = eleve.IDELEVE;
                        checkbox.id = `eleve-${eleve.IDELEVE}`;

                        const label = document.createElement('label');
                        label.htmlFor = `eleve-${eleve.IDELEVE}`;
                        label.textContent = `${eleve.NOM} ${eleve.PRENOM}`;

                        const div = document.createElement('div');
                        div.className = 'form-check';
                        div.appendChild(checkbox);
                        div.appendChild(label);

                        elevesContainer.appendChild(div);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <?php include("header/header.php") ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Ajouter une inscription</h2>
        <form action="index.php?uc=inscription&action=ajouter" method="post" id="form">
            <input type="hidden" name="csrf_token" value="<?php echo Inscription::generateCSRFToken(); ?>">
            <div class="mb-4">
                <label for="numseance" class="form-label">Séance :</label>
                <select class="form-select" id="numseance" name="numseance" required>
                    <option value="">Sélectionner une séance</option>
                    <?php foreach ($lesSeances as $seance): ?>
                        <option value="<?php echo $seance->getNUMSEANCE(); ?>">
                            <?php echo "Prof: " . $seance->getIDPROF() . " - Jour: " . $seance->getJOUR() . " - Tranche: " . $seance->getTRANCHE() . " - Niveau: " . $seance->getNIVEAU(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4" id="eleves-container">
                <!-- Pupils checkboxes will be dynamically added here -->
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
</body>
</html>
