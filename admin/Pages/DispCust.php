<?php
    $CStatus="";
    require("conn.php");
    $id=$_GET['id'];
    $req="SELECT * FROM customers where CustomerID =".$id;
    $res=$conn->query($req);
    $resob=$res->fetch(PDO::FETCH_OBJ);
    $nb=$res->rowCount();
    $Status=$resob->CStatus;
?>

<div class="page-content fade-in-up">
<div class="page-heading">
                <h1 class="page-title">Profile</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Profile</li>
                </ol>
            </div><br>
            <?php 
                    
                if($nb>0){ 
                    
                    ?>
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Customer : <span class="<?php if($Status=="Activated"){echo 'badge badge-success';}else{echo 'badge badge-warning';} ?>"><?php echo $Status;?></span></div>
                    
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                
                    <div class="ibox-body">
                        <div class="tab-pane" id="tab-2">
                            <div>
                                <div class="">
                                    <form action="" method="POST">
                                        <fieldset class="border p-2 col-12" style="display: flex;">
                                        <Legend class="">Personal Information</Legend>
                                            <div >
                                                <img src="./assets/img/customers/<?php echo $resob->Photo;?>" alt="" style="width: 250px;aspect-ratio:2/2;object-fit:contain;" >
                                            </div>
                                            
                                            <div class="" style="margin-left:90px;">
                                                <b><label class="" for="">Full Name : </label></b> <?php echo $resob->FName ." ".$resob->LName;?><br>
                                                <b><label for="">Email : </label></b> <?php echo $resob->Email;?><br>
                                                <b><label for="">Phone : </label></b> <?php echo $resob->Phone;?><br>
                                                <b><label for="">Adress : </label></b> <?php echo $resob->Adress;?><br>
                                                <b><label for="">Phone : </label></b> <?php echo $resob->Phone;?><br>
                                                <b><label for="">City : </label></b> <?php echo $resob->City;?><br>
                                                <b><label for="">State : </label></b> <?php echo $resob->State;?><br>
                                                <b><label for="">Zipe Code : </label></b> <?php echo $resob->ZipCode;?><br><br>
                                                <input type="submit" name="validate" value="<?php if(isset($Status) && $Status=="Activated") {echo 'Suspend';}else{echo 'Activate';}?>" class="<?php if(isset($Status) && $Status=="Activated") {echo 'btn btn-warning';}else{echo 'btn btn-success';}?>" style="height: 35px;margin-top:-4px;">
                                            </div>
                                        </fieldset>
                                    </form>
                                    <?php 
                                    if(isset($_POST['validate'])){
                                        //echo '<script>alert("Hamiiiiiiiid");</script>';
                                        switch ($Status){
                                            case 'Activated':
                                                $act="update customers set CStatus='Suspended' where CustomerID =".$id;
                                                $exec=$conn->exec($act);
                                                if($exec){
                                                    echo '<script>alert("Suspended");</script>';
                                                    echo "<script>location.replace('?p=DispCust&id=".$id."')</script>"; 
                                                }else{
                                                    echo "Querry invalide";
                                                }
                                                break;
                                            case 'Suspended':
                                                $act2="update customers set CStatus='Activated' where CustomerID =".$id;
                                                $exec2=$conn->exec($act2);
                                                if($exec2){
                                                    echo '<script>alert("Activated");</script>';
                                                    echo "<script>location.replace('?p=DispCust&id=".$id."')</script>";
                                                }else{
                                                    echo "Querry invalide";
                                                }
                                                break;
                                        }
                                        
                                    }
                                    
                                    ?>
                                </div>
                            </div>
                            <br>
                            
                            
                        </div>
                    </div>
                    <div class="ibox-body">
                        <div class="tab-pane" id="tab-2">
                            <div>
                                <?php 
                                $requete=" Select * from orders Join customers on customers.CustomerID=orders.CustomerID Join invoices on invoices.OrderID=orders.OrderID WHERE customers.CustomerID=".$id;
                                $ex=$conn->query($requete);
                                $nbr=$ex->rowCount();
                                
                                ?>
                                <div class="">
                                    <fieldset class="border p-2" style="display: flex;">
                                    <Legend class="float-none w-auto">Orders </Legend>
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th width="150px">Date Order</th>
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
                                                        WHERE orders.CustomerID=".$id." and orders.OrderID=".$OrderID." ORDER BY Orders.OrderDate";
                                                        $tot=$conn->query($totp);
                                                        $nbtot=$tot->rowCount();
                                                        if($nbtot>0){
                                                            $totprice=$tot->fetch(PDO::FETCH_OBJ);
                                                            echo  '                         
                                                            <tr>
                                                                <td>
                                                                    <a href="?p=invoice">'.$val->TransactionID.'</a>
                                                                </td>
                                                                <td>'.$totprice->TotalPrice .' DH</td>
                                                                <td>';
                                                                if($val->Status=="Shipped"){
                                                                        echo '<span class="badge badge-success">'.$val->Status.'</span>';
                                                                }else{
                                                                    echo '<span class="badge badge-default">'.$val->Status.'</span>';
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
                            <br>
                            
                            
                        </div>
                    </div>
                    <div class="ibox-body">
                        <div class="tab-pane" id="tab-2">
                            <div>
                                <?php 
                                $rev=" Select * from reviews Join customers ON customers.CustomerID =reviews.CustomerID JOIN products ON reviews.ProductID=products.Product_id WHERE customers.CustomerID=".$id." limit 5";
                                $ex2=$conn->query($rev);
                                $nbrev=$ex2->rowCount();
                                
                                ?>
                                <div class="">
                                    <fieldset class="border p-2" style="display: flex;">
                                    <Legend class="float-none w-auto">Reviews </Legend>
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="129px">Product Image</th>
                                                    <th>Product</th>
                                                    <th>Comment</th>
                                                    <th width="129px">Date Comment</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                <?php 
                                                if($nbrev>0){
                                                        $comment=$ex2->fetchAll(PDO::FETCH_OBJ);
                                                    foreach($comment as $key=>$val){
                                                        echo  '                         
                                                        <tr>
                                                            <td><img src="./assets/img/Products/'.$val->Product_img1.'"  style="width: 100%;aspect-ratio:2/2;object-fit:contain;" /></td>
                                                            <td>'.$val->Product_name .'</td>
                                                            <td>'.$val->Comment .'</td>
                                                            <td>'.$val->DateRev.'</td>
                                                        </tr>';
                                                    }
                                                }
                                                ?> 
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div><?php ?>
                            </div>
                            <br>
                            
                            
                        </div>
                    </div>
                    
            </div>
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Customer Log</div>
                    
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                        <div class="tab-pane" id="tab-2"> 
                            <div>
                                <?php 
                                $log="SELECT * FROM `logs` join customers on customers.CustomerID=logs.CustomerID WHERE customers.CustomerID=".$id." limit 10";
                                $ex3=$conn->query($log);
                                $nblog=$ex3->rowCount();
                                ?>
                                <div class="">
                                    <fieldset class="border p-2" style="display: flex;">
                                        <Legend class="float-none w-auto">Logs </Legend>
                                        <ul class="media-list media-list-divider m-0 col-12">
                                                <?php 
                                                    if($nblog>0){
                                                        $logs=$ex3->fetchAll(PDO::FETCH_OBJ);
                                                        foreach($logs as $key=>$val){
                                                            echo '<li class="media">
                                                                <div class="media-img"><i class="ti-check font-18 text-muted"></i></div>
                                                                <div class="media-body">
                                                                    <div class="media-heading text-success"> '.$val->FName.' '.$val->LName.' <small class="float-right text-muted">'.$val->DateTime.'</small></div>
                                                                    <div class="font-13"><b>Email :</b> '.$val->CustomerEmail.'| <b>Activity :</b> '.$val->Activity.'</div>
                                                                </div>
                                                            </li>';
                                                        }
                                                    }else{
                                                        echo 'No Log Registred!';
                                                    }
                                                ?>
                                        </ul>
                                        
                                    </fieldset>
                                </div><?php ?>
                            </div>
                            <br>
                        </div>
                    </div>
            </div>
        </div>
        <?php }  ?>
        <div class="col-md-4">
            <div class="col-lg-9 col-md-4">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">
                            <?php 
                            require("conn.php");
                            $req="select count(*) as TotalP from products";
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
            <div class="col-lg-9 col-md-4">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">
                        <?php 
                            $req2="select count(*) as TotalP from products where Product_Status='Active'";
                            $sql2=$conn->query($req2);
                            if($sql2){
                                $resobj=$sql2->fetch(PDO::FETCH_OBJ);
                                echo   $resobj->TotalP;
                            }                
                        ?>
                        </h2>
                        <div class="m-b-5">Shipped Orders</div><i class="fa fa-cart-arrow-down widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-4">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">
                        <?php 
                            $req3="select count(*) as TotalP from products where Product_Status='inactive'";
                            $sql3=$conn->query($req3);
                            if($sql3){
                                $resobj=$sql3->fetch(PDO::FETCH_OBJ);
                                echo   $resobj->TotalP;
                            }  
                            $conn=null;             
                        ?>
                        </h2>
                        <div class="m-b-5">Canceled Orders</div><i class="fa fa-ban widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->