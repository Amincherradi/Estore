<?php
        if(!isset($_SESSION)) 
        { 
            session_start();
        }
      require("conn.php");  
      if(isset($_GET['ido'])){
        if(isset($_GET['Status'])){
            $orderID=$_GET['ido'];
            $Status=$_GET['Status'];
            $requete="UPDATE `orders` SET `Status`='".$Status."' WHERE OrderID=".$orderID;
            $ex=$conn->exec($requete);
            if($ex){
                echo "Success , Order modified";
            }else{
                echo "Error , Modification Faild";
            }
        }else {
            echo "Error, Status";
        }  
        
      }else {
        echo "Error, ido";
    }  
      
      
        
?>  