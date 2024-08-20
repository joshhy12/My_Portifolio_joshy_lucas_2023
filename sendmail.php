<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;

      

        $mail->SMTPAuth = true;
        $mail->Username = 'loadywiseman@gmail.com'; // Your Gmail address
        $mail->Password = 'wybt ksbt jtzk jxjv'; // Your Gmail password or app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Set the "From" address to be from your system 
        $mail->setFrom('no-reply@rocklightadventures.com', ' ROCKLIGHT-ADVENTURE-TOURS-SAFARI'); // Replace with your desired "From" email and name

        // Set "Reply-To" to the email address provided by the form submitter
        $mail->addReplyTo($email, $name);

        // Recipients
        $mail->addAddress('loadywiseman@gmail.com'); // Your Gmail address

       
        $mail->isHTML(true);
        $mail->Subject = 'ROCKLIGHT ADVENTURE TOURS & SAFARI';
        $mail->Body = "
            <div style='font-family: Arial, sans-serif; color: #333; line-height: 1.6;'>
                <div style='background-color: #f4f4f4; padding: 20px; border-radius: 10px;'>
                    <h2 style='color: #00466a; text-align: center;'>New Contact Form Submission</h2>
                    <hr style='border: 1px solid #ddd;'>
                    <p><strong style='color: #00466a;'>Name:</strong> {$name}</p>
                    <p><strong style='color: #00466a;'>Email:</strong> {$email}</p>
                    <p><strong style='color: #00466a;'>Message:</strong></p>
                    <div style='background-color: #fff; padding: 15px; border: 1px solid #ddd; border-radius: 5px;'>
                        <p>{$message}</p>
                    </div>
                    <hr style='border: 1px solid #ddd;'>
                    <p style='text-align: center; font-size: 12px; color: #777;'>This email was sent from the contact form on the ROCKLIGHT ADVENTURE TOURS & SAFARI website.</p>
                </div>
            </div>";
        $mail->AltBody = "Name: {$name}\nEmail: {$email}\nMessage: {$message}";
        

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Message has been sent successfully']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
}
?>
