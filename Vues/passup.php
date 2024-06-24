<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changement de mot de passe de <?php echo htmlspecialchars($_POST['username']); ?></title>
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
            height: 100vh;
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
            height: 100%;
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
            transition: background-color 0.3s ease, transform 0.3s ease, color 0.3s ease;
            color: #FFF;
        }
        .login-container .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            color: #000;
            transform: translateY(-2px);
        }
        .form-label {
            color: #FFD700;
        }
        .password-indicator {
            font-size: 0.9em;
            margin-top: 5px;
            color: #FFD700;
        }
        .password-indicator span {
            display: block;
            margin-bottom: 5px;
            transition: opacity 1s ease-in-out;
        }
        .invalid {
            color: red;
        }
        .valid {
            color: green;
            opacity: 0;
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
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="content">
        <div class="login-container">
            <h1>Changement de mot de passe</h1>
            <?php if (isset($error_message)) : ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form action="index.php?uc=passchange&action=updatepassword" method="post">
                <div class="mb-3">
                    <label for="password" class="form-label">Nouveau mot de passe:</label>
                    <div class="password-toggle-container">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <button type="button" class="password-toggle-btn" onclick="togglePassword()">👁️</button>
                    </div>
                    <div class="password-indicator">
                        <span id="length" class="invalid">Longueur de 12 caractères</span>
                        <span id="lowercase" class="invalid">Au moins une lettre minuscule</span>
                        <span id="uppercase" class="invalid">Au moins une lettre majuscule</span>
                        <span id="number" class="invalid">Au moins un chiffre</span>
                        <span id="special" class="invalid">Au moins un caractère spécial</span>
                        <span id="match" class="invalid">Les mots de passe doivent correspondre</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirmer le mot de passe:</label>
                        <input type="password" name="confirm-password" id="confirm-password" class="form-control" required>

                </div>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user->getID()); ?>">
                <div class="text-center">
                    <input type="submit" value="Changer le mot de passe" class="btn btn-primary" id="submit-btn" disabled>
                </div>
            </form>
        </div>
        <div class="image-container">
            <img src="http://localhost/ConservatoirePHP/img/logo.png" alt="Centered Image">
        </div>
    </div>
    <script>
        function handleValidation(element, isValid) {
            element.classList.toggle('valid', isValid);
            element.classList.toggle('invalid', !isValid);
            if (isValid) {
                setTimeout(function() {
                    element.style.opacity = '0';
                }, 1000);
            } else {
                element.style.opacity = '1';
            }
        }

        document.getElementById('password').addEventListener('input', validatePasswords);
        document.getElementById('confirm-password').addEventListener('input', validatePasswords);

        function validatePasswords() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm-password').value;

            handleValidation(document.getElementById('length'), password.length >= 12);
            handleValidation(document.getElementById('lowercase'), /[a-z]/.test(password));
            handleValidation(document.getElementById('uppercase'), /[A-Z]/.test(password));
            handleValidation(document.getElementById('number'), /[0-9]/.test(password));
            handleValidation(document.getElementById('special'), /[^\w]/.test(password));
            var passwordsMatch = password === confirmPassword;
            handleValidation(document.getElementById('match'), passwordsMatch);
            document.getElementById('submit-btn').disabled = !passwordsMatch || password.length < 12 || !/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/[0-9]/.test(password) || !/[^\w]/.test(password);
        }

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
    </script>
</body>
</html>
