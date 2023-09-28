<!-- START PAGE CONTENT-->
<?php
    require("conn.php");
?>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <a href="#neworders">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">
                            <?php 
                                $req="SELECT count(*) as TotalP from orders WHERE DATE(OrderDate) = CURDATE()";
                                $sql=$conn->query($req);
                                if($sql){
                                    $resobj=$sql->fetch(PDO::FETCH_OBJ);
                                    echo   $resobj->TotalP;
                                }                
                            ?>
                        </h2>
                        <div class="m-b-5">NEW ORDERS</div><i class="ti-shopping-cart widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6">
        <a href="?p=Orders">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">
                        <?php 
                            $req="SELECT count(*) as TotalP from orders";
                            $sql=$conn->query($req);
                            if($sql){
                                $resobj=$sql->fetch(PDO::FETCH_OBJ);
                                echo   $resobj->TotalP;
                            }                
                        ?>
                    </h2>
                    <div class="m-b-5">Total Orders</div><i class="ti-bar-chart widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                </div>
            </div> </a>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">
                        <?php 
                            $req="SELECT SUM(ProductPrice*Quantity) as TotalP from ordersummary";
                            $sql=$conn->query($req);
                            if($sql){
                                $resobj=$sql->fetch(PDO::FETCH_OBJ);
                                echo   $resobj->TotalP." DH";
                            }                
                        ?>
                    </h2>
                    <div class="m-b-5">TOTAL INCOME</div><i class="fa fa-money widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">
                        <?php 
                            $req="SELECT COUNT(*) as TotalC from Customers";
                            $sql=$conn->query($req);
                            if($sql){
                                $resobj=$sql->fetch(PDO::FETCH_OBJ);
                                echo   $resobj->TotalC;
                            }                
                        ?>
                    </h2>
                    <div class="m-b-5">CUSTUMERS</div><i class="ti-user widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Statistics</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <?php
                            $req = "SELECT products.Product_name, category.Title_category, MAX(s.TotalSold) AS MaxSold
                                    FROM products
                                    JOIN (
                                        SELECT ProductID, COUNT(*) AS TotalSold
                                        FROM ordersummary
                                        GROUP BY ProductID
                                    ) AS s ON products.Product_id = s.ProductID
                                    JOIN category ON products.Product_Category = category.Id_category
                                    GROUP BY category.Title_category";

                            $sql = $conn->query($req);

                            $dataPoints = array(); // Initialize the dataPoints array

                            if ($sql) {
                                while ($resobj = $sql->fetch(PDO::FETCH_OBJ)) {
                                    $dataPoints[] = array(
                                        "label" => $resobj->Title_category,
                                        "y" => $resobj->MaxSold
                                    );
                                }
                            }
                            ?>

                            <script>
                                window.onload = function () {
                                    var chart = new CanvasJS.Chart("chartContainer", {
                                        animationEnabled: true,
                                        exportEnabled: true,
                                        theme: "light2",
                                        title: {
                                            text: "Best-Selling Products by Category"
                                        },
                                        data: [{
                                            type: "column",
                                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                        }]
                                    });
                                    chart.render();
                                }
                            </script>

                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>

                            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                    </div>
            </div>
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Latest Orders</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                <?php
                                
                                $requete=" Select * from orders Join customers on customers.CustomerID=orders.CustomerID Join invoices on invoices.OrderID=orders.OrderID where DATE(OrderDate) = CURDATE()";
                                $ex=$conn->query($requete);
                                $nbr=$ex->rowCount();
                                
                                ?>
                                <div class="col-12">
                                    <fieldset class="border p-2" style="display: flex;" id="neworders">
                                    <Legend class="float-none w-auto">Today's Orders </Legend>
                                        <table class="table table-striped table-hover" id="orderstable">
                                            <thead>
                                                <tr>
                                                    <th width="250px">Transaction ID</th>
                                                    <th width="250px">Customer Name</th>
                                                    <th width="250px">Amount</th>
                                                    <th width="250px">Status</th>
                                                    <th width="250px">Date Order</th>
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
        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Best Sellers</div>
                </div>
                <div class="ibox-body">
                    <ul class="media-list media-list-divider m-0">
                        <?php 
                            $req="SELECT products.Product_name,products.Product_img1, category.Title_category, MAX(s.TotalSold) AS MaxSold
                                    FROM products
                                    JOIN (
                                        SELECT ProductID, COUNT(*) AS TotalSold
                                        FROM ordersummary
                                        GROUP BY ProductID
                                    ) AS s ON products.Product_id = s.ProductID
                                    JOIN category ON products.Product_Category = category.Id_category
                                    GROUP BY category.Title_category ORDER BY MaxSold DESC";
                                    $sql=$conn->query($req);
                                    $nbsells=$sql->rowCount();
                                    if($nbsells>0){
                                        $resobj=$sql->fetchAll(PDO::FETCH_OBJ);
                                        foreach($resobj as $key=>$val){
                                            echo'
                                                <li class="media">
                                                    <a class="media-img" href="javascript:;">
                                                        <img src="./assets/img/Products/'.$val->Product_img1.'" width="50px;" />
                                                    </a>
                                                    <div class="media-body">
                                                        <div class="media-heading">
                                                            <a href="javascript:;">'.$val->Product_name.'</a>
                                                            <span class="font-16 float-right">'.$val->MaxSold.'</span>
                                                        </div>
                                                        <div class="font-13">'.$val->Title_category.'</div>
                                                    </div>
                                                </li>
                                            ';
                                        }
                                        
                                    }                
                        ?>
                        
                    </ul>
                </div>
                <div class="ibox-footer text-center">
                    <a href="?p=OvProducts">View All Products</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
    </div>
</div>
<!-- END PAGE CONTENT-->