
<?php
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
    require("conn.php");
    if (isset($_SESSION['open'])) {
        $del="DELETE FROM `shoppingcart` WHERE CustomerID = ".$_SESSION['ID'];
        $delcart=$conn->exec($del);
        if($delcart){
            $re="ALTER TABLE shoppingcart AUTO_INCREMENT = 1;";
            $rea=$conn->exec($re);
        }
    } else {
        // Guest/anonymous user
        $ipAddress = gethostbyname(gethostname());
        $del="DELETE FROM `shoppingcart` WHERE Shoppingcart.CustomerID is null and Shoppingcart.IPCustomer = '".$ipAddress."'";
        $delcart=$conn->exec($del);
        if($delcart){
            $re="ALTER TABLE shoppingcart AUTO_INCREMENT = 1;";
            $rea=$conn->exec($re);
        }
    }
    
    $conn=null;
?>