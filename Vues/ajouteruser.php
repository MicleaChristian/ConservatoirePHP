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
        @font-face {
            font-family: perpetua;
            src: url(http://localhost/ConservatoirePHP/fonts/PERTIBD.TTF);
        }

        body, input, button {
            font-family: perpetua; /* Apply the font to body, input, and button elements */
        }

        body {
            background: url(http://localhost/ConservatoirePHP/img/backlogin.jpg) no-repeat center center fixed;
            background-size: cover;
            height: 100vh; /* Ensure body takes the full height of the viewport */
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
        .form-container {
            width: 400px;
            height: 100%; /* Set to 100% to take the full height */
            padding: 40px;
            background-color: #013210;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 50px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #FFD700;
        }
        .form-container .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .form-container .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 8px rgba(128, 189, 255, 0.5);
        }
        .form-container .btn-primary {
            background-color: #007bff;
            border: none;
            width: 100%;
            max-height: 100vh;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .form-container .btn-primary:hover {
            background-color: #0056b3;
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
            transition: opacity 1s ease-in-out; /* Transition for fading */
        }
        .invalid {
            color: red;
        }
        .valid {
            color: green;
            opacity: 0; /* Initially hidden when valid */
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
        <div class="form-container">
            <h2>Create Account</h2>
            <form action="index.php?uc=newuser&action=ajouter" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <div class="password-toggle-container">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <button type="button" class="password-toggle-btn" onclick="togglePassword()">👁️</button>
                    </div>
                    <div class="password-indicator">
                        <span id="length" class="invalid">Longueur de 16 caractères</span>
                        <span id="lowercase" class="invalid">Au moins une lettre minuscule</span>
                        <span id="uppercase" class="invalid">Au moins une lettre majuscule</span>
                        <span id="number" class="invalid">Au moins un chiffre</span>
                        <span id="special" class="invalid">Au moins un caractère spécial</span>
                    </div>
                </div>
                <input type="hidden" id="role" name="role" value="parent">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Create Account</button>
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
                }, 1000); // Wait for 1 second before starting fade out
            } else {
                element.style.opacity = '1';
            }
        }

        document.getElementById('password').addEventListener('input', function() {
            var password = this.value;

            // Check password length
            handleValidation(document.getElementById('length'), password.length >= 16);

            // Check for lowercase letter
            handleValidation(document.getElementById('lowercase'), /[a-z]/.test(password));

            // Check for uppercase letter
            handleValidation(document.getElementById('uppercase'), /[A-Z]/.test(password));

            // Check for number
            handleValidation(document.getElementById('number'), /[0-9]/.test(password));

            // Check for special character
            handleValidation(document.getElementById('special'), /[^\w]/.test(password));
        });

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
