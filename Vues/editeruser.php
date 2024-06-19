<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/user.class.php';

MonPdo::checkSessionAndRedirect();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user = users::getById($id);
if (!$user) {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les Informations - Conservatoire</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
    <style>
        .form-container {
            max-width: 800px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
<?php include("header/header.php") ?>

<div class="container mt-5 form-container">
    <h2>Modifier les informations de <?php echo htmlspecialchars($user->getUSERNAME(), ENT_QUOTES, 'UTF-8'); ?></h2>
    <form action="index.php?uc=user&action=editer" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user->getID(), ENT_QUOTES, 'UTF-8'); ?>">
        <div class="row mt-3">
            <div class="col">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user->getUSERNAME(), ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="col">
                <label for="role" class="form-label">Rôle</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="parent" <?php if ($user->getROLE() == 'parent') echo 'selected'; ?>>Parent</option>
                    <option value="admin" <?php if ($user->getROLE() == 'admin') echo 'selected'; ?>>Admin</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="index.php?uc=user&action=display" class="btn btn-secondary ms-3">Retour à la liste des utilisateurs</a>
        </div>
    </form>
</div>
</body>
</html>
