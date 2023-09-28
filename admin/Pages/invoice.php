<?php 
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
    require('conn.php');
    if(isset($_GET['idord'])){
        $idord=$_GET['idord'];
    }
    if(isset($_GET['idc'])){
        $idc=$_GET['idc'];
    }
    $orders="SELECT *,orders.* FROM `ordersummary`
            JOIN products ON ordersummary.ProductID = products.Product_id
            JOIN Category ON Category.Id_category=products.Product_Category
            JOIN orders ON orders.OrderID = ordersummary.OrderID
            JOIN Customers ON orders.CustomerID = Customers.CustomerID
            JOIN invoices ON invoices.OrderID = orders.OrderID
            WHERE
                orders.CustomerID = ".$idc ." and Orders.OrderID=".$idord;
    $exec=$conn->query($orders);
    $nbord=$exec->rowCount();
    if($nbord>0){
        $resorder=$exec->fetch(PDO::FETCH_OBJ);
        
    
?>
<div class="page-heading">
                <h1 class="page-title">Invoice</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Invoice</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox invoice">
                    <div class="invoice-header">
                        <div class="row">
                            <div class="col-6">
                                <div class="invoice-logo">
                                    <img src="./assets/img/logos/Estore.jpg" height="65px" />
                                </div>
                                <div>
                                    <div class="m-b-5 font-bold">Invoice from</div>
                                    <div>Estore PFE</div>
                                    <ul class="list-unstyled m-t-10">
                                        <li class="m-b-5">
                                            <span class="font-strong">Email:</span> aminecherradi99@gmail.com</li>
                                        <li>
                                            <span class="font-strong">Phone:</span> 06 71 75 00 88</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <div class="clf" style="margin-bottom:30px;">
                                    <dl class="row pull-right" style="width:250px;"><dt class="col-sm-6">Invoice Date</dt>
                                        <dd class="col-sm-6"><?php echo $resorder->DateCreateInv; ?></dd><dt class="col-sm-6">Account No.</dt>
                                        <dd class="col-sm-6">№<?php echo $resorder->CustomerID; ?></dd>
                                    </dl>
                                </div>
                                <div>
                                    <div class="m-b-5 font-bold">Invoice To</div>
                                    <div><?php echo $resorder->FName." ".$resorder->LName; ?></div>
                                    <ul class="list-unstyled m-t-10">
                                        <li class="m-b-5"><?php echo $resorder->Adress; ?></li>
                                        <li class="m-b-5"><?php echo $resorder->Email; ?></li>
                                        <li><?php echo $resorder->Phone; ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped no-margin table-invoice">
                        <thead>
                            <tr>
                                <th>Item Description</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $orders2="SELECT *,orders.* FROM `ordersummary`
                                JOIN products ON ordersummary.ProductID = products.Product_id
                                JOIN Category ON Category.Id_category=products.Product_Category
                                JOIN orders ON orders.OrderID = ordersummary.OrderID
                                JOIN Customers ON orders.CustomerID = Customers.CustomerID
                                JOIN invoices ON invoices.OrderID = orders.OrderID
                                WHERE
                                    orders.CustomerID = ".$idc ." and Orders.OrderID=".$idord;
                        $exec2=$conn->query($orders2);
                        $nbord2=$exec2->rowCount();
                        if($nbord2>0){
                            $resorder2=$exec2->fetchAll(PDO::FETCH_OBJ);
                            foreach($resorder2 as $key=>$val){
                                        echo '
                                            <tr>
                                                <td>
                                                    <div><strong>'.$val->Title_category.'</strong></div><small>'.$val->Product_name.'</small></td>
                                            <td>'.$val->Quantity.'</td>
                                                <td>'.$val->Product_Price.'</td>
                                                <td>'.$val->Quantity*$val->Product_Price.'</td>
                                            </tr>
                                        ';
                                    }
                                
                            }
                        ?>
                        </tbody>
                    </table>
                    <table class="table no-border">
                        <thead>
                            <tr>
                                <th></th>
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                $totp="SELECT SUM(ordersummary.ProductPrice*ordersummary.Quantity)+30 as TotalPrice ,SUM(ordersummary.ProductPrice*ordersummary.Quantity) as SubTotal  FROM `ordersummary` 
                                    JOIN orders ON orders.OrderID = ordersummary.OrderID 
                                    WHERE orders.CustomerID = ".$idc ." and Orders.OrderID=".$idord;
                                    $tot=$conn->query($totp);
                                    $nbtot=$tot->rowCount();
                                    if($nbtot>0){
                                        $resinv=$tot->fetch(PDO::FETCH_OBJ);
                                        echo '
                                            <tr class="text-right">
                                                <td>Subtotal:</td>
                                                <td>'.$resinv->SubTotal.'</td>
                                            </tr>
                                            <tr class="text-right">
                                                <td>TAX Delivery:</td>
                                                <td>30 DH</td>
                                            </tr>
                                            <tr class="text-right">
                                                <td class="font-bold font-18">TOTAL:</td>
                                                <td class="font-bold font-18">'.$resinv->TotalPrice.'</td>
                                            </tr>
                                        ';
                                    }
                            
                        ?>
                            
                        </tbody>
                    </table>
                    <div class="text-right">
                        <button class="btn btn-info" type="button" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
                <style>
                    .invoice {
                        padding: 20px
                    }

                    .invoice-header {
                        margin-bottom: 50px
                    }

                    .invoice-logo {
                        margin-bottom: 50px;
                    }

                    .table-invoice tr td:last-child {
                        text-align: right;
                    }
                </style>
            </div>
            <!-- END PAGE CONTENT-->
<?php 
    }
    $conn=null; 
    
?>