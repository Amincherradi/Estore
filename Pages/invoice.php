<br><br>
<?php 
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
    if(!isset($_SESSION['open'])){
        echo "<script>location.replace('?p=404.html')</script>";
    }
    require('conn.php');
    if(isset($_GET['idord'])){
        $idord=$_GET['idord'];
    }
    $orders="SELECT *,orders.* FROM `ordersummary`
            JOIN products ON ordersummary.ProductID = products.Product_id
            JOIN orders ON orders.OrderID = ordersummary.OrderID
            JOIN Customers ON orders.CustomerID = Customers.CustomerID
            JOIN invoices ON invoices.OrderID = orders.OrderID
            WHERE
                orders.CustomerID = ".$_SESSION['ID'] ." and Orders.OrderID=".$idord;
    $exec=$conn->query($orders);
    $nbord=$exec->rowCount();
    if($nbord>0){
        $resorder=$exec->fetch(PDO::FETCH_OBJ);
        
    
?>
<div class="container">
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <center><h4 class="float-end font-size-15"><?php echo "Order #".$resorder->TransactionID;?>&nbsp;<span class="badge bg-success font-size-12 ms-2"><?php echo $resorder->StatusInv;?></span></h4></center>
                        <div class="mb-4">
                           <h2 class="mb-1 text-muted">EStorePFE</h2>
                        </div>
                        <div class="text-muted">
                            <p class="mb-1">aminecherradi99@gmail.com</p>
                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> oudhemw@gmail.com</p>
                            <p><i class="uil uil-phone me-1"></i> 06 71 75 00 88</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Shipped To:</h5>
                                <h5 class="font-size-15 mb-2"><?php echo $resorder->FName." ".$resorder->LName ;?></h5>
                                <p class="mb-1"><?php echo $resorder->Adress.",",$resorder->City.",".$resorder->ZipCode;?></p>
                                <p class="mb-1"><?php echo $resorder->Email;?></p>
                                <p><?php echo $resorder->Phone;?></p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                <div>
                                    <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                    <p><?php echo "#".$resorder->InvoiceID;?></p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                    <p><?php echo $resorder->DateCreateInv;?></p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Order No:</h5>
                                    <p><?php echo "#".$resorder->TransactionID;?></p>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                    <div class="py-2">
                        <h5 class="font-size-15">Order Summary</h5>

                        <div class="table-responsive">
                        <ul class="cart-items list-unstyled">
                                <?php
                                $exec->closeCursor();
                                $orders="SELECT * FROM `ordersummary` 
                                            JOIN orders ON orders.OrderID = ordersummary.OrderID 
                                            JOIN products ON ordersummary.ProductID=products.Product_id
                                            WHERE orders.CustomerID=".$_SESSION['ID']." and Orders.OrderID=".$idord." ORDER BY Orders.OrderDate DESC";
                                    $exec=$conn->query($orders);
                                    $nbinv=$exec->rowCount();
                                    if($nbinv>0){
                                        $resinv=$exec->fetchAll(PDO::FETCH_OBJ);
                                        foreach($resinv as $key=>$val){
                                            $ProductName=$val->Product_name;
                                            $ProductPrice=$val->Product_Price;
                                            $ProductQte=$val->Quantity;
                                            $total=$ProductPrice*$ProductQte;
                                            echo '
                                            <li class="cart-item p-3">
                                                    <div class="product-line-grid row">
                                                        <!--  product left body: description -->
                                                        <div class="product-line-grid-body col-md-7 col-8">
                                                            <div class="product-line-info">
                                                            <a class="label" href="?p=product-details&pc='.$val->Product_id.'">'.$ProductName.'</a>
                                                            </div>
                                                            <div class="product-line-info">
                                                            <span class="value">'.$ProductPrice.'&nbsp;MAD</span>
                                                            </div>
                                                            <br>
                                                        </div>
                                                        <!--  product left body: description -->
                                                        <div class="product-line-grid-right product-line-actions col-md-3 col-12">
                                                            <div class="row">
                                                            <div class="col-4 hidden-md-up"></div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12 price">
                                                                        <span class="product-price">
                                                                        <strong>
                                                                        '.$total.'&nbsp;MAD
                                                                        </strong>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-12 qty">
                                                                        <div class="input-group bootstrap-touchspin">
                                                                            <span class="product-price">
                                                                                <strong>QTE : 
                                                                                '.$ProductQte.'&nbsp;
                                                                                </strong>
                                                                            </span>
                                                                            <span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </li>';
                                                
                                        }
                                    }     
                                     $totp="SELECT SUM(ordersummary.ProductPrice*ordersummary.Quantity)+30 as TotalPrice FROM `ordersummary` 
                                    JOIN orders ON orders.OrderID = ordersummary.OrderID 
                                    WHERE orders.CustomerID=".$_SESSION['ID']." and Orders.OrderID=".$idord." ORDER BY Orders.OrderDate DESC";
                                    $tot=$conn->query($totp);
                                    $nbtot=$tot->rowCount();
                                    if($nbtot>0){
                                        $resinv=$tot->fetch(PDO::FETCH_OBJ);
                                        echo '<hr class="my-0 mx-8"><br>
                                        <span class="product-price" style="float:right;margin-right:30px;">
                                            <strong>Total Price : 
                                            &nbsp;'.$resinv->TotalPrice.' MAD
                                            </strong>
                                        </span>';
                                    } 
                               
                            
                            ?>
                        </div><!-- end table responsive -->
                        <div class="d-print-none mt-4" style="float:right;">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                <a href="?p=Settings" class="btn btn-info me-1"></i>Go To Settings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
</div>
<?php 
        
    }
?>