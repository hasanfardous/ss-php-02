<?php
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    require_once '../database.php';
    $query = 'SELECT id, email, password FROM users WHERE email=:email';
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password']) === true) {
            $message = 'Login successful.';
        } else {
            $message = 'Invalid credentials.';
        }
    } else {
        $message = 'Invalid email.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Login Form</title>
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//getbootstrap.com/docs/4.3/examples/sign-in/signin.css">
</head>
<body class="text-center">

<?php if (isset($message)): ?>
    <div class="alert alert-success">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form class="form-signin" action="" method="post">
    <h1 class="h3 mb-3 font-weight-normal">User Login</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required
           autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

    <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>
</form>
</body>
</html>
