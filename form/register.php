<?php
require_once 'bootstrap.php';

if (is_logged_in()) {
    redirect('dashboard');
}

if (isset($_POST['register'])) {
    if (!empty($_FILES['photo']['name'])) {
        $file = $_FILES['photo']['tmp_name'];
        $file_parts = explode('.', $_FILES['photo']['name']);
        $extension = end($file_parts);
        $filename = uniqid('photo_', true) . time() . '.' . $extension;
        $destination = '../uploads/photo/' . $filename;

        move_uploaded_file($file, $destination);
    }

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $password = password_hash($password, PASSWORD_BCRYPT);

        try {
            // WRITE SQL QUERY
            $query = 'INSERT INTO users (email, password, photo) VALUES (:email, :password, :photo)';
            // PDO SQL EXECUTE
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':photo', $filename);
            $stmt->execute();
            $connection->lastInsertId();

            notification('Registration successful.');
            redirect('login');
        } catch (Exception $e) {
            notification($e->getMessage(), 'danger');
            redirect('index');
        }
    } else {
        notification('Please provide all the required information', 'danger');
        redirect('index');
    }
}
