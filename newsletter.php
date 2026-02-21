<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    $to = "yourcompanyemail@example.com";  // CHANGE THIS
    $subject = "New AIR9 Strategic Update Request";
    $message = "New subscription request:\n\nEmail: " . $email;
    $headers = "From: noreply@yourdomain.com\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";

    // Save to file (optional but recommended)
    file_put_contents("subscribers.txt", $email . PHP_EOL, FILE_APPEND);

    if (mail($to, $subject, $message, $headers)) {
        header("Location: thankyou.html");
        exit();
    } else {
        echo "Something went wrong. Please try again.";
    }
}

?>
