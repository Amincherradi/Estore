<?php  
function getIPAddress() {
    $ip = '';

    // Check for the client IP address from different server variables
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    // Remove any potential proxy headers from the IP address
    $ip = preg_replace('/\s*,\s*/', ',', $ip); // Remove spaces around commas
    $ip = explode(',', $ip); // Split multiple IPs if present
    $ip = trim($ip[0]); // Take the first IP address

    return $ip;
}

$ip = getIPAddress();
echo "<script>alert('".$ip."')</script>";
?> 