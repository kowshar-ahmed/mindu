<?php
// Include PHPMailer classes manually
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name     = isset($_POST["name"]) ? trim($_POST["name"]) : "";
    $email    = isset($_POST["email"]) ? filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL) : "";
    $subject  = isset($_POST["subject"]) ? trim($_POST["subject"]) : "";
    $checkbox = isset($_POST["checkbox"]) ? trim($_POST["checkbox"]) : "";
    $message  = isset($_POST["message"]) ? trim($_POST["message"]) : "";

    // Validation
    if ( empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Recipient
    $recipient = "mdsalim400@gmail.com";

    // HTML email content
    $email_content = "
    <html>
    <head>
        <title>New Contact Form</title>
    </head>
    <body style='font-family: Arial, sans-serif;'>
        <h2 style='color:#333;'>New Contact Request</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Subject:</strong> {$subject}</p>
        <p><strong>Checkbox:</strong> {$checkbox}</p>
        <p><strong>Message:</strong><br>".nl2br($message)."</p>
        <hr>
        <p style='font-size:12px;color:#999;'>This email was sent from Aqlova Kindaid HTML template.</p>
    </body>
    </html>
    ";

    // PHPMailer setup
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'admin@aqlova.com'; // Hostinger email
        $mail->Password   = '@Theme515105sk!@';   // Email password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 465; // TLS port

        //Recipients
        $mail->setFrom('admin@aqlova.com', 'ThemePure Contact');
        $mail->addAddress($recipient); // Admin inbox
        $mail->addReplyTo($email, $name); // User reply

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New contact from $name - $subject";
        $mail->Body    = $email_content;
        $mail->AltBody = strip_tags($email_content);

        $mail->send();

        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } catch (Exception $e) {
        http_response_code(500);
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
