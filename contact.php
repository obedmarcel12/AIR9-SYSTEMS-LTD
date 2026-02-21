<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $email    = htmlspecialchars(trim($_POST['email']));
    $subject  = htmlspecialchars(trim($_POST['subject']));
    $message  = htmlspecialchars(trim($_POST['message']));

    $to = "info@air9systems.ng, s.olayinka@air9systems.ng";  // CHANGE to your receiving email
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "New Contact Form Message\n\n";
    $body .= "Full Name: $fullname\n";
    $body .= "Email: $email\n";
    $body .= "Subject: $subject\n\n";
    $body .= "Message:\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Message sent successfully!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Message failed to send. Please try again.'); window.location.href='contact.html';</script>";
    }
}
?>
