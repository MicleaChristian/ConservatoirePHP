<?php
session_start();
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>

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

        body, input, button {
            font-family: perpetua;
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
            background-color: rgba(0, 0, 0, 0.5);
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
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 50px;
        }
        .login-container h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #FFF;
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
            transition: background-color 0.3s ease, transform 0.3s ease, color 0.3s ease;
            color: #FFF;
        }
        .login-container .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            color: #000;
            transform: translateY(-2px);
        }
        .form-label {
            color: #FFF;
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
            max-width: 50%;
            height: auto;
        }
        .signup-link {
            color: #FFF;
            text-align: center;
            display: block;
            margin-top: 20px;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .signup-link:hover {
            color: #80bdff;
        }
        .password-toggle-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        .password-toggle-btn {
            position: absolute;
            right: 10px;
            background: none;
            border: none;
            color: #000;
            cursor: pointer;
        }
        .license-link {
            color: #FFF;
            text-align: center;
            display: block;
            margin-top: 10px;
            font-size: 12px;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .license-link:hover {
            color: #80bdff;
        }
        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            color: #FFF;
            text-align: center;
            padding: 10px;
            z-index: 1000;
            display: none;
        }
        .cookie-banner .btn {
            margin-left: 10px;
        }
    </style>

</head>
<body>
    <div class="overlay"></div>
    <div class="content">
        <div class="login-container">
            <h1>Page de Connexion</h1>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
            <form action="index.php?uc=login" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Utilisateur:</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe:</label>
                    <div class="password-toggle-container">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <button type="button" class="password-toggle-btn" onclick="togglePassword()">👁️</button>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" value="Connexion" class="btn btn-primary">
                </div>
            </form>
            <div class="text-center">
                <a class="btn btn-outline-secondary" href="index.php?uc=passchange&action=upform" role="button">Changer de mot de passe</a>
            </div>
            <div class="text-center">
                <a href="index.php?uc=newuserform" class="signup-link">pas de compte?</a>
            </div>
            <div class="text-center">
                <a href="index.php?uc=license" class="license-link">CGU</a>
            </div>
        </div>
        <div class="image-container">
            <img src="http://localhost/ConservatoirePHP/img/logo.png" alt="Image Centrée">
        </div>
    </div>

    <!-- Bannière de Consentement de Cookies -->
    <div class="cookie-banner" id="cookieConsentBanner">
        Ce site utilise des cookies pour vous garantir la meilleure expérience sur notre site. En utilisant ce site, vous acceptez notre utilisation des cookies.
        <button class="btn btn-primary btn-sm" id="acceptCookies">Accepter</button>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleBtn = document.querySelector(".password-toggle-btn");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleBtn.textContent = "🙈";
            } else {
                passwordField.type = "password";
                toggleBtn.textContent = "👁️";
            }
        }

        // Afficher la bannière de consentement de cookies si les cookies ne sont pas acceptés
        document.addEventListener('DOMContentLoaded', function () {
            if (!localStorage.getItem('cookiesAccepted')) {
                document.getElementById('cookieConsentBanner').style.display = 'block';
            }
        });

        // Gérer l'acceptation des cookies
        document.getElementById('acceptCookies').addEventListener('click', function () {
            localStorage.setItem('cookiesAccepted', 'true');
            document.getElementById('cookieConsentBanner').style.display = 'none';
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
