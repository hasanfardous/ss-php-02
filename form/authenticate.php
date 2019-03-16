<?php
require_once 'bootstrap.php';

if (is_logged_in()) {
    redirect('dashboard');
}

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = 'SELECT id, email, password, role FROM users WHERE email=:email';
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password']) === true) {
            $message = 'Login successful.';
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            header('Location: dashboard.php');
        } else {
            $message = 'Invalid credentials.';
        }
    } else {
        $message = 'Invalid email.';
    }
}
