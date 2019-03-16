<?php
require_once '../database.php';
$id = (int)trim($_GET['id']);

session_start();

if (!isset($_SESSION['id'], $_SESSION['email'], $_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit();
}

if ($id === 0) {
    header('Location: index.php');
}

$query = 'SELECT email, photo FROM users WHERE id=:id';
$stmt = $connection->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch();

require_once 'partials/_header.php';
?>

<form class="form-signin" action="update_user.php" method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 font-weight-normal">User Update</h1>

    <?php require_once 'partials/_message.php'; ?>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" value="<?php echo $user['email']; ?>" name="email" id="inputEmail" class="form-control" required
           autofocus>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control">

    <label for="inputPhoto" class="sr-only">Photo</label>
    <input type="file" name="photo" id="inputPhoto" class="form-control">
    <img src="../uploads/photo/<?php echo $user['photo']; ?>" alt="Photo" width="100">

    <button class="btn btn-lg btn-primary btn-block" name="update" type="submit">Update</button>
</form>

<?php require_once 'partials/_footer.php'; ?>
