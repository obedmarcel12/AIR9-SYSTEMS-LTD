<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    function clean($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    $organization = clean($_POST['organization']);
    $country = clean($_POST['country']);
    $contact_person = clean($_POST['contact_person']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $inquiry_type = clean($_POST['inquiry_type']);
    $message = clean($_POST['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $to = "info@air9.com";   // CHANGE TO YOUR DOMAIN EMAIL
    $subject = "New Procurement Inquiry - AIR9";

    $body = "
    New Official Procurement Inquiry

    Organization: $organization
    Country: $country
    Contact Person: $contact_person
    Email: $email
    Inquiry Type: $inquiry_type

    Message:
    $message
    ";

    $headers = "From: info@air9.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Save to secure log file
    $log = "
    ---------------------------------------
    $body
    ---------------------------------------
    ";

    file_put_contents("procurement_log.txt", $log, FILE_APPEND);

    if (mail($to, $subject, $body, $headers)) {
        header("Location: pro-success.html");
        exit();
    } else {
        echo "Submission failed. Please try again.";
    }

}
?>
