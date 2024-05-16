<!DOCTYPE html>
<html>
<head>
    <title>Changement de mot de passe de <?php $_POST['id'] ?></title>
</head>
<body>
    <form action="password_validation.php" method="post">
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
