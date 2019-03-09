<?php
require_once '../database.php';
$id = (int)trim($_GET['id']);

if ($id === 0) {
    header('Location: index.php');
}

if (isset($_POST['update'])) {
    if (!empty($_FILES['photo']['name'])) {
        $file = $_FILES['photo']['tmp_name'];
        $file_parts = explode('.', $_FILES['photo']['name']);
        $extension = end($file_parts);
        $filename = uniqid('photo_', true) . time() . '.' . $extension;
        $destination = '../uploads/photo/' . $filename;

        move_uploaded_file($file, $destination);

        $query = 'UPDATE users SET photo=:photo WHERE id=:id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':photo', $filename);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    if (!empty($_POST['email'])) {
        $email = trim($_POST['email']);

        $query = 'UPDATE users SET email=:email WHERE id=:id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    if (!empty($_POST['password'])) {
        $password = trim($_POST['password']);
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = 'UPDATE users SET password=:password WHERE id=:id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':email', $password);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    $message = 'User updated.';
}

$query = 'SELECT email, photo FROM users WHERE id=:id';
$stmt = $connection->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP User Form</title>
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

<form class="form-signin" action="" method="post" enctype="multipart/form-data">
    <h1 class="h3 mb-3 font-weight-normal">User Update</h1>
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
</body>
</html>
