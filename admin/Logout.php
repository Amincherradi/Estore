<?php

session_start();

unset($_SESSION['open2']);
$conn=NULL;
header('location:index.php');

exit;

?>