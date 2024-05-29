<?php
require_once 'Modeles/monPdo.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Conservatoire</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
    <style>
        .form-container {
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include("header/header_accueil.php") ?>

    <div class="container mt-5 form-container">
        <h2>Create Account</h2>
        <form action="index.php?uc=newuser&action=ajouter" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <input type="hidden" id="role" name="role" value="parent">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Create Account</button>
            </div>
        </form>
    </div>
</body>

</html>
