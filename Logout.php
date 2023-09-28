<?php

session_start();

unset($_SESSION['open']);

$conn=NULL;
header('location:index.php');

exit;

?>