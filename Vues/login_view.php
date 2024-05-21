<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    @font-face {
        font-family: perpetua;
        src: url(http://localhost/ConservatoirePHP/fonts/PERTIBD.TTF);
    }

    body {
        background: url(http://localhost/ConservatoirePHP/img/backlogin.jpg) no-repeat center center fixed;
        background-size: cover;
        max-height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
    .overlay {
        position: absolute;
        backdrop-filter: blur(5px);
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 1;
    }
    .content {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        height: 100%;
        width: 100%;
    }
    .login-container {
        width: 400px;
        height: 100vh;
        padding: 40px;
        background-color: #013210;
        backdrop-filter: blur(10px);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-left: 50px;
        font-family: perpetua;
    }
    .login-container h1 {
        text-align: center;
        margin-bottom: 30px;
        font-family: perpetua;
        color: #FFD700;
    }
    .login-container .error-message {
        color: red;
        text-align: center;
        margin-bottom: 10px;
    }
    .login-container .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
        padding: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .login-container .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 8px rgba(128, 189, 255, 0.5);
    }
    .login-container .btn-primary {
        background-color: #007bff;
        border: none;
        width: 100%;
        max-height: 100vh;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .login-container .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    .login-container .btn-outline-secondary {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .login-container .btn-outline-secondary:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
    }
    .form-label {
        color: #FFD700;
        font-family: perpetua;
    }
    .image-container {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: auto;
        margin-right: 50px;
    }
    .image-container img {
        max-width: 80%;
        height: auto;
    }
</style>

</head>
<body>
    <div class="overlay"></div>
    <div class="content">
        <div class="login-container">
            <h1>Page de Connexion</h1>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form action="index.php?uc=login" method="POST">
                <input type="hidden" name="uc" value="login">
                <input type="hidden" name="action" value="submit">
                <div class="mb-3">
                    <label for="username" class="form-label">Utilisateur:</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="text-center">
                    <input type="submit" value="Connexion" class="btn btn-primary">
                </div>
            </form>
            <div class="text-center">
                <a class="btn btn-outline-secondary" href="index.php?uc=passchange&action=upform" role="button">Changer de mot de passe</a>
            </div>
        </div>
        <div class="image-container">
            <img src="http://localhost/ConservatoirePHP/img/logo.png" alt="Centered Image">
        </div>
    </div>
</body>
</html>
