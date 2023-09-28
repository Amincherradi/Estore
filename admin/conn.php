<?php

require_once("config.php");

try{

    $con='mysql:host='.HOST.';dbname='.DB;

    $conn=new PDO($con,USER,PWD);

}catch(PDOException $exp){

    echo "Error :".$exp->getMessage();

    die();

}
?>