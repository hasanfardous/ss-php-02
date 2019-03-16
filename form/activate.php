<?php
require_once 'bootstrap.php';

$token = $_GET['token'] ?? null;

if ($token === null || empty($token)) {
    redirect('index');
}

$query = 'SELECT id FROM users WHERE email_verification_token = :token';
$stmt = $connection->prepare($query);
$stmt->bindParam(':token', $token);
$stmt->execute();
$user = $stmt->fetch();

if ($stmt->rowCount() === 1) {
    $id = (int)$user['id'];
    $query = "UPDATE users SET email_verification_token = '', email_verified = 1 WHERE id = '$id'";
    $stmt = $connection->query($query);
    $stmt->execute();

    notification('Account activated. You can login now.');
    redirect('login');
}

notification('Invalid token.');
redirect('index');
