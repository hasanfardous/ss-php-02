<?php
require_once '../database.php';

$query = 'SELECT id, email, photo FROM users';
$stmt = $connection->query($query);
$stmt->execute();

$users = $stmt->fetchAll();
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

<div class="container">
    <h2>Users List</h2>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <td>ID</td>
            <td>Email</td>
            <td>Photo</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <img src="../uploads/photo/<?php echo $user['photo']; ?>" alt="Photo" width="100">
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                    <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>

