<?php

if (!function_exists('db_connect')) {
    function db_connect()
    {
        $connection = null;

        try {
            $connection = new PDO('mysql:dbname=ss_php_02;host=127.0.0.1', 'root', '');
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Exception $e) {
        }

        return $connection;
    }
}

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        return isset($_SESSION['id'], $_SESSION['email'], $_SESSION['role']);
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        return $_SESSION['role'] === 'admin';
    }
}

if (!function_exists('redirect')) {
    function redirect($location = '/')
    {
        header('Location: ' . $location . '.php');
        exit();
    }
}

if (!function_exists('notification')) {
    function notification($message, $type = 'success')
    {
        $_SESSION['message'] = $message;
        $_SESSION['type'] = $type;
    }
}



