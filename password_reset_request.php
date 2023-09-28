<?php
// Generate a unique token
$token = bin2hex(random_bytes(32));

// Store the token, user email, and expiration timestamp in the database
// (Assuming $db is your database connection)
$stmt = $db->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
$stmt->execute([$email, $token, date('Y-m-d H:i:s', strtotime('+1 hour'))]);

// Send an email to the user with a password reset link containing the token
// (You can use PHP's mail() function or a library like PHPMailer to send emails)
$resetLink = "https://example.com/reset_password.php?token=" . $token;
$mailBody = "Click the following link to reset your password: " . $resetLink;

// Send the email
// ...
?>