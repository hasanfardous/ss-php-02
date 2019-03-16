<?php

require_once 'vendor/autoload.php';
session_start();
$connection = db_connect();

$message = $_SESSION['message'] ?? null;
$type = $_SESSION['type'] ?? null;
