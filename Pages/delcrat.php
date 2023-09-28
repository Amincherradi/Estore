
<?php
    require("conn.php");
    if(isset($_GET['idct'])){
    $id=$_GET['idct'];
    }
    $del="DELETE FROM `shoppingcart` WHERE CartID=".$id;
    $delcart=$conn->exec($del);
    if($delcart){
        $re="ALTER TABLE shoppingcart AUTO_INCREMENT = 1;";
        $rea=$conn->exec($re);
      echo "<script>location.replace('?p=checkout')</script>";
    }
    $conn=null;
?>