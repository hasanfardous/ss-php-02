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

if (!function_exists('email')) {
    function email($email, $subject, $body)
    {
        try {
            $mail = new \PHPMailer\PHPMailer\PHPMailer();
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'af2a20736cc551';                 // SMTP username
            $mail->Password = 'c617b024b04e5e';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 25;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('no-reply@ss-php-02.sumon', 'SSB PHP 02');
            $mail->addAddress($email);
            $mail->isHTML();                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
        } catch (Exception $e) {
        }
    }
}



