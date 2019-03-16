<?php
require_once 'bootstrap.php';

if (is_logged_in()) {
    redirect('dashboard');
}

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = 'SELECT id, email, password, role, email_verified FROM users WHERE email=:email';
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password']) === true) {
            if ((int)$user['email_verified'] === 0) {
                notification('Verify your email.', 'danger');
                redirect('login');
            }

            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            redirect('dashboard');
        } else {
            notification('Invalid credentials.', 'danger');
            redirect('login');
        }
    } else {
        notification('Invalid email.', 'danger');
        redirect('login');
    }
}
