<?php

require_once 'bootstrap.php';

$email = trim($_POST['email']);

$query = 'SELECT COUNT(id) as count FROM users WHERE email = :email';
$stmt = $connection->prepare($query);
$stmt->bindParam(':email', $email);
$stmt->execute();

$user = $stmt->fetch();

if ($user['count'] > 0) {
    $password_reset_token = sha1(uniqid() . time() . $email);
    $query = 'UPDATE users SET password_reset_token = :password_reset_token WHERE email = :email';
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':password_reset_token', $password_reset_token);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $subject = 'Password Reset';
    $body = 'Dear user, please click the following link to reset your password:<br/>
<a href="http://ss-php-02.sumon/form/reset.php?token=' . $password_reset_token . '">http://ss-php-02.sumon/form/reset.php?token=' . $password_reset_token . '</a>
                ';

    email($email, $subject, $body);

    notification('Please check your email to set a new password.');
    redirect('login');
}

notification('Email does not exist in our system.', 'danger');
redirect('login');

