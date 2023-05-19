<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
  <div class="position-absolute top-50 start-50 translate-middle">
    <h1>Login Page</h1>
    <?php if (isset($error_message)): ?>
      <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form action="index.php?uc=login" method="POST">
  <input type="hidden" name="uc" value="login">
  <input type="hidden" name="action" value="submit">
  <label for="id">Username:</label>
  <input type="text" name="id" id="id" required><br><br>
  <label for="password">Password:</label>
  <input type="password" name="password" id="password" required><br><br>
  <input type="submit" value="Login">
</form>
  </div>
  </body>
</html>
