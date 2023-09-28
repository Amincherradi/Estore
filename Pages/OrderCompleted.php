<?php 
  if(!isset($_SESSION['open'])){
    echo "<script>window.location.replace('login.php');</script>";             
  }else{
    
  
?>
<style>



.checkmark {
  display: block;
  width: 80px;
  height: 80px;
  margin: 0 auto;
  stroke-width: 2;
  stroke: #4caf50;
  fill: none;
  animation: draw-checkmark 0.3s ease-in-out forwards;
}

.checkmark-circle {
  animation: stroke-circle 0.3s ease-in-out forwards;
}

.checkmark-check {
  stroke-dashoffset: 24;
  stroke-dasharray: 48;
  animation: stroke-check 0.3s ease-in-out forwards;
}

@keyframes draw-checkmark {
  0% {
    stroke-dashoffset: 48;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

@keyframes stroke-circle {
  0% {
    stroke-dasharray: 0 100;
  }
  100% {
    stroke-dasharray: 100 100;
  }
}

@keyframes stroke-check {
  0% {
    stroke-dashoffset: 48;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

h1 {
  color: #333333;
  font-size: 24px;
  text-align: center;
  margin-top: 30px;
}

.order-details {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 4px;
  text-align: center;
  margin-top: 20px;
}

.confirmation-msg {
  font-size: 18px;
  margin-bottom: 30px;
}

.order-summary {
  text-align: left;
}

h2 {
  color: #333333;
  font-size: 20px;
  margin-bottom: 10px;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  margin-bottom: 5px;
}

strong {
  font-weight: bold;
}

.email-msg {
  margin-top: 30px;
  font-size: 16px;
  color: #888888;
}

  </style>
</head>

<body>
  <?php 
         
        require("conn.php");
        $orders="SELECT * FROM Orders 
        JOIN customers ON customers.CustomerID= orders.CustomerID
        JOIN invoices ON invoices.OrderID=Orders.OrderID
        WHERE orders.CustomerID=".$_SESSION['ID']." ORDER BY Orders.OrderDate DESC
        LIMIT 1";
        $exord=$conn->query($orders);
        $nbrc=$exord->rowCount();
        
    ?>
  
<div class="container">
    <br><br>
    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
      <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
      <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
    </svg>
    <h1>Order Confirmed</h1>
    
    <div class="order-details">
      <p class="confirmation-msg">Thank you for your order!</p>
      <div class="order-summary">
        <h2>Order Summary</h2>
        <?php if($nbrc>0){
          $exob=$exord->fetchAll(PDO::FETCH_OBJ);
          echo "<ul>";
          foreach($exob as $key=>$val){
            $OrderID=$val->OrderID;
            $totp="SELECT SUM(ordersummary.ProductPrice*ordersummary.Quantity)+30 as TotalPrice FROM `ordersummary` 
              JOIN orders ON orders.OrderID = ordersummary.OrderID 
              WHERE orders.CustomerID=".$_SESSION['ID']." and orders.OrderID=".$OrderID." ORDER BY Orders.OrderDate";
              $tot=$conn->query($totp);
              $nbtot=$tot->rowCount();
              if($nbtot>0){
                  $totprice=$tot->fetch(PDO::FETCH_OBJ);
                  echo '
                  <li><strong>Order ID:</strong>&nbsp;&nbsp;'. $val->TransactionID.'</li>
                  <li><strong>Order Date:</strong>&nbsp;&nbsp;'.$val->OrderDate.'</li>
                  <li><strong>Shipping Address:</strong>&nbsp;&nbsp;'.$val->Adress.'</li>
                  <li><strong>Total Amount:</strong>&nbsp;&nbsp;'.$totprice->TotalPrice.' DH</li>
                  <li><strong>You can See Your Invoice from </strong><a href="?p=invoice&idinv='.$val->InvoiceID.'&idord='.$val->OrderID.'">Here</a></li>

                ';
              }
          }
          echo "</ul>";
        }
      
      }
        ?>
        
      </div>
      <p class="email-msg">We will send you a confirmation email with the shipment tracking details shortly.</p>
    </div>
  </div>
</body>

</html>
