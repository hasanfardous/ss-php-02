<?php
require_once '../database.php';
$id = (int)trim($_GET['id']);

if ($id === 0) {
    header('Location: index.php');
}

$query = 'DELETE FROM users WHERE id=:id';
$stmt = $connection->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

header('Location: users.php');


