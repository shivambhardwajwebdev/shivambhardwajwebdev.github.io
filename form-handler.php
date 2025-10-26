<?php

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- 1. Get and Sanitize Form Data ---
    
    // trim() removes whitespace from beginning/end
    // strip_tags() removes any HTML tags
    // htmlspecialchars() converts special characters to HTML entities to prevent XSS
    
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // --- 2. Validate Form Data ---
    
    // Check if any fields are empty or if email is invalid
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirect back to the contact page with an error status
        header("Location: contact.html?status=error");
        exit;
    }

    // --- 3. Set Up Email ---
    
    // ** EDIT THIS: Set the recipient email address **
    $to = "shiva.bhardwaj.mks@gmail.com";

    // Set the email subject
    $email_subject = "New Portfolio Message: $subject";

    // Build the email content
    $email_body = "You have received a new message from your portfolio contact form.\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";

    // Build the email headers
    // This tells the mail client who the email is from.
    // NOTE: Hostinger might require this "From" address to be an email you created in your cPanel.
    $headers = "From: noreply@yourdomain.com\n"; 
    $headers .= "Reply-To: $email\n";

    // --- 4. Send The Email ---
    
    // Use the built-in PHP mail() function
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Redirect back to the contact page with a success status
        header("Location: contact.html?status=success");
    } else {
        // Redirect back with a server error status
        header("Location: contact.html?status=server-error");
    }

} else {
    // --- 5. Handle Non-POST Requests ---
    
    // If someone tries to access this file directly, redirect them
    header("Location: contact.html");
}

?>