<?php
if(isset($_GET['id'])){
    require("conn.php");
    $req0="DELETE FROM `logs` WHERE CustomerID=".$_GET['id'];
    $execute=$conn->exec($req0);
    $req2="ALTER TABLE logs AUTO_INCREMENT = 1;";
    $exec=$conn->exec($req2);
    $req1="DELETE FROM `reviews` WHERE CustomerID=".$_GET['id'];
    $execute=$conn->exec($req1);
    $req2="ALTER TABLE reviews AUTO_INCREMENT = 1;";
    $exec=$conn->exec($req2);
    $req="DELETE FROM customers where CustomerID=".$_GET['id'];
    $execute=$conn->exec($req);
    $req2="ALTER TABLE customers AUTO_INCREMENT = 1;";
    $exec=$conn->exec($req2);
    if($execute){
    echo "<script>location.replace('?p=Customers')</script>";
    }else{
    echo "Product non Deleted!";
    }
}
?>

