<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-container .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="login-container">
                    <h1>Changement de mot de passe</h1>
                    <p>Entrez votre nom d'utilisateur pour modifier votre mot de passe:</p>
                    <?php if (isset($error_message)) : ?>
                        <p class="error-message"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <form action="Controleurs/passchange.php?action=idfound" method="POST">
                        <input type="hidden" name="uc" value="login">
                        <input type="hidden" name="action" value="submit">
                        <div class="mb-3">
                            <label for="id" class="form-label">Nom d'utilisateur:</label>
                            <input type="text" name="id" id="id" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <input type="submit" value="Confirmer" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>