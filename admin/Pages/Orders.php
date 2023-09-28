<?php
    require("conn.php");
?>
<div class="page-heading">
    <h1 class="page-title">Orders</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Overview</li>
    </ol>
</div><br>
<div class="row fade-in-up">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-primary color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">
                        <?php 
                        $req="select count(*) as TotalP from orders";
                        $sql=$conn->query($req);
                        if($sql){
                            $resobj=$sql->fetch(PDO::FETCH_OBJ);
                            echo   $resobj->TotalP;
                        }                
                        ?>
                    </h2>
                    <div class="m-b-5">All Orders</div><i class="ti-package widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
                <div class="ibox bg-secondary color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">
                        <?php 
                            $req2="select count(*) as TotalP from orders where Status='Pending'";
                            $sql2=$conn->query($req2);
                            if($sql2){
                                $resobj=$sql2->fetch(PDO::FETCH_OBJ);
                                echo   $resobj->TotalP;
                            }                
                        ?>
                        </h2>
                        <div class="m-b-5">Orders Pending</div><i class="fa fa-shopping-basket widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">
                        <?php 
                            $req3="select count(*) as TotalP from orders where Status='Shipped'";
                            $sql3=$conn->query($req3);
                            if($sql3){
                                $resobj=$sql3->fetch(PDO::FETCH_OBJ);
                                echo   $resobj->TotalP;
                            }               
                        ?>
                        </h2>
                        <div class="m-b-5">Shipped</div><i class="fa fa-truck widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">
                        <?php 
                            $req3="select count(*) as TotalP from orders where Status='Expired'";
                            $sql3=$conn->query($req3);
                            if($sql3){
                                $resobj=$sql3->fetch(PDO::FETCH_OBJ);
                                echo   $resobj->TotalP;
                            }               
                        ?>
                        </h2>
                        <div class="m-b-5">Expired</div><i class="fa fa-calendar-times-o widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
    </div>

<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-1">
                            <div class="row">
                                                
                                                
                            </div>
                            <h4 class="text-info m-b-20 m-t-20"><i class="fa fa-shopping-cart"></i> Orders</h4>
                            <div>
                                <?php
                                
                                $requete=" Select * from orders Join customers on customers.CustomerID=orders.CustomerID Join invoices on invoices.OrderID=orders.OrderID ";
                                $ex=$conn->query($requete);
                                $nbr=$ex->rowCount();
                                
                                ?>
                                <div class="col-12">
                                    <fieldset class="border p-2" style="display: flex;">
                                    <Legend class="float-none w-auto">Orders </Legend>
                                        <table class="table table-striped table-hover" id="orderstable">
                                            <thead>
                                                <tr>
                                                    <th width="250px">Transaction ID</th>
                                                    <th width="250px">Customer Name</th>
                                                    <th width="250px">Amount</th>
                                                    <th width="250px">Status</th>
                                                    <th width="250px">Date Order</th>
                                                    <th width="90px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php 
                                                if($nbr>0){
                                                        $orders=$ex->fetchAll(PDO::FETCH_OBJ);
                                                    foreach($orders as $key=>$val){
                                                        $OrderID=$val->OrderID;
                                                        $totp="SELECT SUM(ordersummary.ProductPrice*ordersummary.Quantity)+30 as TotalPrice FROM `ordersummary` 
                                                        JOIN orders ON orders.OrderID = ordersummary.OrderID 
                                                        WHERE orders.OrderID=".$OrderID." ORDER BY Orders.OrderDate";
                                                        $tot=$conn->query($totp);
                                                        $nbtot=$tot->rowCount();
                                                        if($nbtot>0){
                                                            $totprice=$tot->fetch(PDO::FETCH_OBJ);
                                                            echo  '                         
                                                            <tr>
                                                                <td>
                                                                    <a href="?p=invoice&idinv='.$val->InvoiceID.'&idord='.$val->OrderID.'&idc='.$val->CustomerID.'">'.$val->TransactionID.'</a>
                                                                </td>
                                                                <td>'.$val->FName.' '.$val->LName.'</td>
                                                                <td>'.$totprice->TotalPrice .' DH</td>
                                                                <td>';
                                                                if($val->Status=="Shipped"){
                                                                        echo '<span class="badge badge-success">'.$val->Status.'</span>';
                                                                }else if($val->Status=="Pending"){
                                                                    echo '<span class="badge badge-default">'.$val->Status.'</span>';
                                                                }else{
                                                                    echo '<span class="badge badge-danger">'.$val->Status.'</span>';
                                                                }
                                                                echo '</td>
                                                                <td>'.$val->DateCreate.'</td>
                                                                <td>
                                                                    <a href="#" data-toggle="modal" data-target="#OrderMod" id="Modorderrs" orderid="'.$val->OrderID.'"><i class="fa fa-pencil-square-o"></i></a>
                                                                    <a onClick="return confirm(\' Are you Sure !\');" href="#"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            </tr>';
                                                        }
                                                    }
                                                }
                                                ?> 
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div><?php ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .profile-social a {
            font-size: 16px;
            margin: 0 10px;
            color: #999;
        }
        .profile-social a:hover {
            color: #485b6f;
        }

                    .profile-stat-count {
                        font-size: 22px
                    }
                </style>
                <script>
                   
                </script>
</div>