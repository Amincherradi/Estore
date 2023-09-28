<?php
if(isset($_GET['id'])){
    require("conn.php");
    $req="delete from products where Product_id=".$_GET['id'];
    $execute=$conn->exec($req);
    $req2="ALTER TABLE products AUTO_INCREMENT = 1;";
    $exec=$conn->exec($req2);
    if($execute){
    echo "<script>location.replace('?p=OvProducts')</script>";
    }else{
    echo "Product non Deleted!";
    }
}
?>

