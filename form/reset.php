<?php
require_once 'bootstrap.php';

$token = trim($_GET['token']);

$query = 'SELECT id FROM users WHERE password_reset_token = :token';
$stmt = $connection->prepare($query);
$stmt->bindParam(':token', $token);
$stmt->execute();
$user = $stmt->fetch();

if ($token === '' || $user === false) {
    notification('Invalid token.', 'danger');
    redirect('login');
}

require_once 'partials/_header.php';
?>

<form class="form-signin" action="resetpassword.php" method="post">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <h1 class="h3 mb-3 font-weight-normal">Set New Password</h1>

    <?php require_once 'partials/_message.php'; ?>

    <label for="inputEmail" class="sr-only">Password</label>
    <input type="password" name="password" id="inputEmail" class="form-control" placeholder="Password" required
           autofocus>
    <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Set Password</button>

    <hr/>

    <a href="login.php">Login</a>
    <a href="index.php">Register</a>
</form>

<?php require_once 'partials/_footer.php'; ?>
