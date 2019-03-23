<?php
require_once 'bootstrap.php';

if (is_logged_in()) {
    redirect('dashboard');
}

require_once 'partials/_header.php';
?>

<form class="form-signin" action="register.php" method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 font-weight-normal">User Registration</h1>

    <?php require_once 'partials/_message.php'; ?>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required
           autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <label for="inputPhoto" class="sr-only">Photo</label>
    <input type="file" name="photo" id="inputPhoto" class="form-control" required>

    <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">
        Register
    </button>

    <hr/>

    <a href="forgot.php">Forgot password?</a>
    <a href="login.php">Login</a>
</form>

<?php require_once 'partials/_footer.php'; ?>


