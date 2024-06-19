<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Creation Success</title>
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
        .success-container {
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
        .success-container h1 {
            text-align: center;
            margin-bottom: 30px;
            font-family: perpetua;
            color: #FFD700;
        }
        .success-container p {
            text-align: center;
            color: #FFF;
            font-family: perpetua;
        }
        .success-container .btn-primary {
            background-color: #007bff;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .success-container .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
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
        <div class="success-container">
            <h1>Compte créé</h1>
            <p>Votre compte a bien été créé!</p>
            <div class="text-center">
                <a href="index.php?uc=login" class="btn btn-primary">Go to Login</a>
            </div>
        </div>
        <div class="image-container">
            <img src="http://localhost/ConservatoirePHP/img/logo.png" alt="Centered Image">
        </div>
    </div>
</body>
</html>
