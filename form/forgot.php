<?php
require_once 'bootstrap.php';

if (is_logged_in()) {
    redirect('dashboard');
}

require_once 'partials/_header.php';
?>

<form class="form-signin" action="emailresetlink.php" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Forgot Password?</h1>

    <?php require_once 'partials/_message.php'; ?>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required
           autofocus>
    <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Submit</button>

    <hr/>

    <a href="login.php">Login</a>
    <a href="index.php">Register</a>
</form>

<?php require_once 'partials/_footer.php'; ?>
