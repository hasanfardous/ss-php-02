<?php
require_once 'bootstrap.php';

$id = (int)trim($_GET['id']);

if (!is_logged_in()) {
    notification('You have to login first.', 'danger');
    redirect('login');
}

if (!is_admin()) {
    notification('You are not authorized.', 'danger');
    redirect('dashboard');
}

if ($id === 0) {
    header('Location: index.php');
    exit();
}

if ($_SESSION['id'] === $id) {
  header('Location: dashboard.php');
  exit();
}

$query = 'DELETE FROM users WHERE id=:id';
$stmt = $connection->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

header('Location: users.php');


