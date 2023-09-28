<?php
      require("conn.php");  
      if(isset($_GET['ido'])){
        $orderID=$_GET['ido'];
      }
      $requete=" Select * from orders Join customers on customers.CustomerID=orders.CustomerID Join invoices on invoices.OrderID=orders.OrderID where orders.OrderID=".$orderID;
      $ex=$conn->query($requete);
      $nbr=$ex->rowCount();
      if($nbr>0){
        $orders=$ex->fetch(PDO::FETCH_OBJ);
        
?>  
<form>
  <fieldset>
    <center><legend>ORDER #<?php echo $orders->TransactionID; ?> </legend></center>
    
    
    
    
    <div class="form-group">
      <a href="" ido="<?php echo $orderID;?>" id="orderido" hidden></a>
      <label for="selection">Status</label> <span class="text-danger" id="err"></span>
      <select class="form-control" id="statusorder">
          <option value="Shipped">Shipped</option>
          <option value="Pending">Pending</option>
          <option value="Expired">Expired</option>
      </select>
    </div>
  </fieldset>
</form>
<?php
      }
      $conn=null;
      
?>  