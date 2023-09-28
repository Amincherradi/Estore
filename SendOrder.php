<?php  
if(!isset($_SESSION)) 
{ 
    session_start();
} 
if(!isset($_SESSION['open'])){
    echo "<script>location.replace('login.php')</script>";
}
$conn=null;
require("conn.php");
    
if(isset($_SESSION['open'])){
    if(isset($_POST['cash'])){
        $sql = "SELECT *, sum(Quantity*ProductPrice) AS Total FROM `shoppingcart` WHERE CustomerID = ".$_SESSION['ID'];
        $result = $conn->query($sql);
        $nbrc = $result->rowCount();

        if ($nbrc > 0) {
            
            function random_strings($length)
            {
                $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                return substr(str_shuffle($str), 0, $length);
            }

            $transID = random_strings(10);
            
            $ordersSql = "INSERT INTO Orders ( `TransactionID`,CustomerID,`Status`, OrderDate)
            VALUES ('".$transID."',".$_SESSION['ID'].",'Pending',now())";
            $ordersum= $conn->exec($ordersSql);
            if($ordersum){
               
                $price = 0;
                $sql1 = "SELECT * FROM Orders WHERE CustomerID = ".$_SESSION['ID']." ORDER BY OrderDate DESC LIMIT 1";
                $result1 = $conn->query($sql1);
                $nbrords = $result1->rowCount();
                if($nbrords>0){
                    $row = $result1->fetch(PDO::FETCH_OBJ);
                    $OrderID=$row->OrderID;
                    $orderSql = "INSERT INTO OrderSummary (OrderID, ProductID, Quantity, ProductPrice)
                    SELECT ".$OrderID.", ProductID, Quantity , ProductPrice
                    FROM ShoppingCart
                    WHERE CustomerID = ".$_SESSION['ID'];
                    $orderResult = $conn->exec($orderSql);
        
                    if($orderResult !== false) {
                        $orderid="UPDATE ShoppingCart SET OrderID = ".$OrderID." WHERE CustomerID=".$_SESSION['ID'];
                        $ord = $conn->exec($orderid);
                        if($ord){
                            $invoice="INSERT INTO `invoices`(`OrderID`, `StatusInv`, `DateCreateInv`) VALUES (".$OrderID.",'Paid',now())";
                            $execinv=$conn->exec($invoice);
                            if($execinv){
                                $log="INSERT INTO `logs`(`CustomerID`, `CustomerEmail`, `Activity`, `DateTime`) VALUES (".$_SESSION['ID'].",'".$_SESSION['Email']."','Order Products TransactionID=".$transID." Order Number : ".$OrderID."',now())";
                                $execlog=$conn->exec($log);
                                $deleteCartSql = "DELETE FROM `shoppingcart` WHERE CustomerID = ".$_SESSION['ID'];
                                $deleteCartResult = $conn->exec($deleteCartSql);
                                $alterCartSql = "ALTER TABLE shoppingcart AUTO_INCREMENT = 1";
                                $conn->exec($alterCartSql);
                                echo "Success, Order Complete with Success";
                            }else {
                                echo "Error, Invoice not created.";
                            }  
                            
                        } else {
                            echo "Error, deleting shopping cart items.";
                        }  
                    }
                }
                
            }  
        } else {
             echo "Error,inserting products!";
        }

            $conn = null;
        }
}else{
    echo "<script>location.replace('login.php')</script>";
}


?>