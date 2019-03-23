<?php
require_once 'bootstrap.php';

$password = trim($_POST['password']);
$password = password_hash($password, PASSWORD_BCRYPT);
$id = (int)$_POST['id'];

$query = 'UPDATE users SET password = :password, password_reset_token = null WHERE id = :id';
$stmt = $connection->prepare($query);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

notification('Password set successfully.');
redirect('login');
