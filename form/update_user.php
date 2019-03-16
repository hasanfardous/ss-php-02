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
    notification('User updated.');
    redirect('users');
}
