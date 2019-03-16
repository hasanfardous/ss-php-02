<?php
require_once 'bootstrap.php';

if (is_logged_in()) {
    redirect('dashboard');
}

if (isset($_POST['register'])) {
    if (!empty($_FILES['photo']['name'])) {
        $file = $_FILES['photo']['tmp_name'];
        $file_parts = explode('.', $_FILES['photo']['name']);
        $extension = end($file_parts);
        $filename = uniqid('photo_', true) . time() . '.' . $extension;
        $destination = '../uploads/photo/' . $filename;

        move_uploaded_file($file, $destination);
    }

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $password = password_hash($password, PASSWORD_BCRYPT);

        try {
            // WRITE SQL QUERY
            $query = 'INSERT INTO users (email, password, photo, email_verification_token) VALUES (:email, :password, :photo, :email_verification_token)';
            // PDO SQL EXECUTE
            $email_verification_token = sha1(time() . $email . $filename);
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':photo', $filename);
            $stmt->bindParam(':email_verification_token', $email_verification_token);
            $stmt->execute();
            $connection->lastInsertId();

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
                $mail->Subject = '[SSB02] Verify Your Account';
                $mail->Body = 'Dear user, please click the following link to activate your account:<br/>
<a href="http://ss-php-02.sumon/form/activate.php?token=' . $email_verification_token . '">http://ss-php-02.sumon/form/activate.php?token=' . $email_verification_token . '</a>
                ';
                $mail->send();
            } catch (Exception $e) {
                notification('Registration successful but mail not sent.');
                redirect('login');
            }

            notification('Registration successful.');
            redirect('login');
        } catch (Exception $e) {
            notification($e->getMessage(), 'danger');
            redirect('index');
        }
    } else {
        notification('Please provide all the required information', 'danger');
        redirect('index');
    }
}
