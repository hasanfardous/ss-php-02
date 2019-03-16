<?php
require_once '../database.php';
$id = (int)trim($_GET['id']);

session_start();

if (!isset($_SESSION['id'], $_SESSION['email'], $_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit();
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


