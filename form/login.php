<?php
session_start();

if (isset($_SESSION['id'], $_SESSION['email'], $_SESSION['role'])) {
    header('Location: dashboard.php');
    exit();
}

require_once 'partials/_header.php';
?>

<form class="form-signin" action="authenticate.php" method="post">
    <h1 class="h3 mb-3 font-weight-normal">User Login</h1>

    <?php require_once 'partials/_message.php'; ?>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required
           autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

    <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>

    <hr/>

    <a href="index.php">Register</a>
</form>

<?php require_once 'partials/_footer.php'; ?>
