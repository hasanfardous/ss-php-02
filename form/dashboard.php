<?php
require_once 'bootstrap.php';

if (!is_logged_in()) {
    notification('You have to login first.', 'danger');
    redirect('login');
}

require_once 'partials/_header.php'
?>
<div class="container">
    <div class="alert alert-info">
        You have been logged in as, <?php echo $_SESSION['email']; ?>
    </div>

    <?php require_once 'partials/_message.php'; ?>

    <div>
        <p>
            <a href="edit_profile.php">Update Profile</a>
        </p>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <p>
                <a href="users.php">Users List</a>
            </p>
        <?php endif; ?>
        <p>
            <a href="logout.php">Logout</a>
        </p>
    </div>
</div>

<?php require_once 'partials/_footer.php'; ?>


