<?php
require_once 'bootstrap.php';

if (!is_logged_in()) {
    notification('You have to login first.', 'danger');
    redirect('login');
}


if (!is_admin()) {
    notification('You are not authorized.', 'danger');
    redirect('dashboard');
}

$query = 'SELECT id, email, photo FROM users';
$stmt = $connection->query($query);
$stmt->execute();

$users = $stmt->fetchAll();

require_once 'partials/_header.php';
?>

<div class="container">
    <h2>Users List</h2>

    <?php require_once 'partials/_message.php'; ?>

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
                    <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                    <?php if ($_SESSION['id'] !== $user['id']): ?>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure?');">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'partials/_footer.php'; ?>

