<!-- Code HTML pour le formulaire d'ajustement du planning -->
<!-- Utilisez les données du tableau $planning pour pré-remplir le formulaire -->

<!-- Exemple -->
<h2>Ajustez le planning</h2>
<form method="POST" action="index.php?uc=planning&action=ajuster">
    <label for="heure">Heure :</label>
    <input type="text" name="planning[heure]" id="heure">

    <label for="lundi">Lundi :</label>
    <input type="text" name="planning[lundi]" id="lundi">

    <label for="mardi">Mardi :</label>
    <input type="text" name="planning[mardi]" id="mardi">

    <label for="mercredi">Mercredi :</label>
    <input type="text" name="planning[mercredi]" id="mercredi">

    <label for="jeudi">Jeudi :</label>
    <input type="text" name="planning[jeudi]" id="jeudi">

    <label for="vendredi">Vendredi :</label>
    <input type="text" name="planning[vendredi]" id="vendredi">

    <button type="submit">Enregistrer</button>
</form>
