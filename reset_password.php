<?php
// Check if the token is provided in the URL
if (!isset($_GET['token'])) {
    // Token is missing, handle the error accordingly
    // ...
}

// Retrieve the token from the URL
$token = $_GET['token'];

// Check if the token is valid and not expired
$stmt = $db->prepare("SELECT email, expires_at FROM password_resets WHERE token = ? AND expires_at > NOW()");
$stmt->execute([$token]);
$resetData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$resetData) {
    // Token is invalid or expired, handle the error accordingly
    // ...
}else{
    echo '
        <form action="" method="POST">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
            <button type="submit">Reset Password</button>
        </form>
    ';
}

// Check if the token and new password are provided
if (!isset($_POST['token']) || !isset($_POST['new_password'])) {
    // Token or new password is missing, handle the error accordingly
    // ...
}

// Retrieve the token and new password from the form
$token = $_POST['token'];
$newPassword = $_POST['new_password'];

// Verify the token and get the associated email
$stmt = $db->prepare("SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW()");
$stmt->execute([$token]);
$resetData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$resetData) {
    // Token is invalid or expired, handle the error accordingly
    // ...
}

$email = $resetData['email'];

// Hash the new password
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Update the user's password in the database
$stmt = $db->prepare("UPDATE users SET password = ? WHERE email = ?");
$stmt->execute([$hashedPassword, $email]);

// Password reset is successful, you can redirect the user to a login page or display a success message
// ...
?>