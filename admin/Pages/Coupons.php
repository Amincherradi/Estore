<?php
    require("conn.php");
    $CCode=$Discount=$Status="";
    $CCodeer=$Discounter=$Statuser="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['AddCoupon'])){
            if(empty($_POST["CouponC"])) {
                $CCodeer = "*";
            } else {
                $CCode = $_POST["CouponC"];
            }
            if(empty($_POST["Discount"])) {
                $Discounter = "*";
            } else {
                $Discount = $_POST["Discount"];
            }
            if(empty($_POST["status"])) {
                $Statuser = "*";
            } else {
                $Status = $_POST["status"];
            }
        }
    }
?>
<div class="page-heading">
    <h1 class="page-title"> Coupons & Promotions </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Overview</li>
    </ol>
</div><br>

<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active">
                            <div class="row">
                                                
                                                
                            </div>
                            <h4 class="text-info m-b-20 m-t-20"><i class="fa fa-bullhorn"></i> Coupons </h4>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Coupon Code</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Date Create</th>
                                        <th>Date Update</th>
                                    </tr>
                                </thead>
                                <tbody><!-- badge-default badge-warning--> 
                                    <?php
                                    $cust="select * from coupons";
                                    $disp=$conn->query($cust);
                                    if($disp){
                                        $dispall=$disp->fetchall(PDO::FETCH_OBJ);
                                        $nbr=$disp->rowCount();
                                        if($nbr>0){
                                            foreach($dispall as $cle=>$val){
                                                echo '
                                                <tr>
                                                <td>'.$val->CouponCode.'</td>
                                                <td>'.$val->Discount.'</td>
                                                <td>';
                                                if($val->Status=="Active"){
                                                    echo '<span class="badge badge-success">'.$val->Status.'</span>';
                                                }else{
                                                    echo '<span class="badge badge-warning">'.$val->Status.'</span>';
                                                }
                                                 echo '   
                                                </td>
                                                <td>'.$val->DateCreate.'</td>
                                                <td>'.$val->DateUpdate.'</td>
                                                <td>
                                                    <a href="?p=&id='.$val->CouponID.'"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a onClick="return confirm(\' Are you Sure !\');" href="?p=&id='.$val->CouponID.'"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                                ';
                                            }
                                        }else{
                                            echo "<tr><td colspan='5' align='center'>No Coupons Found!</td></tr>";
                                        }
                                        
                                    }   
                                    
                                    
                                    ?>  
                                </tbody>
                            </table>
                        </div>               
                    </div>
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active">
                            <div class="row">
                                                
                                                
                            </div>
                            <h4 class="text-info m-b-20 m-t-20"><i class="fa fa-bullhorn"></i> Promotions </h4>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Product Name</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Date Create</th>
                                        <th>Date Update</th>
                                    </tr>
                                </thead>
                                <tbody><!-- badge-default badge-warning--> 
                                    <?php
                                    $cust="select * from promotions join products on promotions.ProdPromo=Products.Product_id";
                                    $disp=$conn->query($cust);
                                    if($disp){
                                        $dispall=$disp->fetchall(PDO::FETCH_OBJ);
                                        $nbr=$disp->rowCount();
                                        if($nbr>0){
                                            foreach($dispall as $cle=>$val){
                                                echo '
                                                <tr>
                                                <td><img src="./assets/img/customers/'.$val->Product_img1.'" alt="" style="width: 100%;aspect-ratio:2/2;object-fit:contain;border-radius:50%;"></td>
                                                <td>'.$val->Product_name.'</td>
                                                <td>'.$val->Discount.'%</td>
                                                <td>';
                                                if($val->Status=="Active"){
                                                    echo '<span class="badge badge-success">'.$val->Status.'</span>';
                                                }else{
                                                    echo '<span class="badge badge-warning">'.$val->Status.'</span>';
                                                }
                                                 echo '   
                                                </td>
                                                <td>'.$val->DateCreate.'</td>
                                                <td>'.$val->DateUpdate.'</td>
                                                <td>
                                                    <a href="?p=&id='.$val->PromoID.'"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a onClick="return confirm(\' Are you Sure !\');" href="?p=&id='.$val->PromoID.'"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                                ';
                                            }
                                        }else{
                                            echo "<tr><td colspan='6' align='center'>No Promotions Found!</td></tr>";
                                        }
                                        
                                    }   
                                    
                                    
                                    ?>  
                                </tbody>
                            </table>
                        </div>               
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox ibox-success">
                <div class="ibox-head">
                    <div class="ibox-title">Add Coupons</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>Coupon Code</label><span class="font-16 text-danger">&nbsp;&nbsp;<?php echo $CCodeer; ?>
                                <input class="form-control" type="text" name="CouponC" placeholder="Coupon Code"><span class="font-16 text-danger">&nbsp;&nbsp;<?php 
                                if($CCodeer){
                                    echo '<div class="alert alert-warning alert-dismissable fade show" style="font-size:11px;"><button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>Warning!</strong> You should fill this field.</div>';
                                }
                                ?></span>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Discount</label><span class="font-16 text-danger">&nbsp;&nbsp;<?php echo $Discounter;?></span>
                                <input class="form-control" type="Number" min="10" step="5" max="50" name="Discount" placeholder="Discount"><span class="font-16 text-danger">&nbsp;&nbsp;<?php 
                                if($Discounter){
                                    echo '<div class="alert alert-warning alert-dismissable fade show" style="font-size:11px;"><button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>Warning!</strong> You should fill this field.</div>';
                                }
                                ?></span>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Status</label><span class="font-16 text-danger">&nbsp;&nbsp;<?php echo $Statuser;?></span>
                                <select class="form-control" name="status">
                                    <option value="" selected>--Status--</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select><span class="font-16 text-danger">&nbsp;&nbsp;<?php 
                                if($Statuser){
                                    echo '<div class="alert alert-warning alert-dismissable fade show" style="font-size:11px;"><button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>Warning!</strong> You should fill this field.</div>';
                                }
                                ?></span><br>
                            </div>
                        </div>
                        <div class="form-group">
                                <input type="submit" name="AddCoupon" class="btn btn-outline-success" value="Add Coupon">
                            </div>
                    </form>
                    <?php
                        if(isset($_POST['AddCoupon'])){
                            if($CCode!="" && $Discount!="" && $Status!=""){
                                $req="INSERT INTO `coupons`(`CouponCode`, `Discount`, `Status`, `DateCreate`, `DateUpdate`) VALUES ('".$CCode."',".$Discount.",'".$Status."',now(),now())";
                                $exec=$conn->exec($req);
                                if($exec){
                                    echo "<script>alert('Coupon Added!')</script>";
                                    echo "<script>location.replace('?p=Coupons')</script>";
                                }else{
                                    echo "";
                                }
                            }
                        }
                        
                    ?>
                </div>
            </div>
            <div class="ibox ibox-info">
                <div class="ibox-head">
                    <div class="ibox-title">Add Promotion</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Category</label><span class="font-16 text-danger">&nbsp;&nbsp;</span>
                                    <select class="form-control select2_demo_1" name="catg" onkeyup="">
                                        <option value="" selected>-- Category --</option>
                                        <optgroup label="MEN">
                                        <?php 
                                        $req2="select * from category where Status_category='Active'";
                                        $ex=$conn->query($req2);
                                        $ob=$ex->fetchAll(PDO::FETCH_OBJ);
                                        if($ob){
                                            foreach($ob as $key=>$val){
                                                echo '<option value="'.$val->Title_category.'">'.$val->Title_category.'</option>';
                                            }
                                            $gen="MEN";
                                        }
                                        ?>
                                            
                                        </optgroup>
                                        <optgroup label="WOMEN">
                                        <?php 
                                        $req2="select * from category where Status_category='Active'";
                                        $ex=$conn->query($req2);
                                        $ob=$ex->fetchAll(PDO::FETCH_OBJ);
                                        if($ob){
                                            foreach($ob as $key=>$val){
                                                echo '<option value="'.$val->Title_category.'">'.$val->Title_category.'</option>';
                                            }
                                            $gen="WOMEN";
                                        }
                                        ?>
                                        </optgroup>
                                    </select>
                            </div>
                            <div class="col-sm-12 form-group">
                            
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th width="150px">Product</th>
                                        <th>Product Name</th>
                                        <th width="100px">Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                
                                <tbody><!-- badge-default badge-warning--> 
                                    <?php
                                        $cust="select * from products join category on products.Product_Category=category.Id_category where products.PGender='".$gen."' and products.Product_Status='Active'";
                                        $disp=$conn->query($cust);
                                        if($disp){
                                            $dispall=$disp->fetchall(PDO::FETCH_OBJ);
                                            $nbr=$disp->rowCount();
                                            if($nbr>0){
                                                foreach($dispall as $cle=>$val){
                                                    echo '
                                                    <tr>
                                                    <td><input type="checkbox" name="checkprod" id=""></td>
                                                    <td><img src="./assets/img/products/'.$val->Product_img1.'" alt="" style="width: 100%;aspect-ratio:4/3;object-fit:contain;"></td>
                                                    <td>'.$val->Product_name.'</td>
                                                    <td>'.$val->Product_Price.' DH</td>
                                                    <td>';
                                                    if($val->Product_Status=="Active"){
                                                        echo '<span class="badge badge-success">'.$val->Product_Status.'</span>';
                                                    }else{
                                                        echo '<span class="badge badge-warning">'.$val->Product_Status.'</span>';
                                                    }
                                                     echo '   
                                                    </td>
                                                </tr>
                                                    ';
                                                }
                                            }else{
                                                echo "<tr><td colspan='3' align='center'>No Promotions Found!</td></tr>";
                                            }
                                            
                                        }   
                                    
                                    ?>  
                                </tbody>
                            </table>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Discount</label><span class="font-16 text-danger">&nbsp;&nbsp;<?php echo $Discounter;?></span>
                                <input class="form-control" type="Number" min="10" step="5" max="50" name="Discount" placeholder="Discount"><span class="font-16 text-danger">&nbsp;&nbsp;<?php 
                                if($Discounter){
                                    echo '<div class="alert alert-warning alert-dismissable fade show" style="font-size:11px;"><button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>Warning!</strong> You should fill this field.</div>';
                                }
                                ?></span>
                            
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="AddPromo" class="btn btn-outline-success" value="Add Promo">
                        </div>
                    </form>
                    <?php
                        if(isset($_POST['AddPromo'])){
                            if($CCode!="" && $Discount!="" && $Status!=""){
                                $req="INSERT INTO `coupons`(`CouponCode`, `Discount`, `Status`, `DateCreate`, `DateUpdate`) VALUES ('".$CCode."',".$Discount.",'".$Status."',now(),now())";
                                $exec=$conn->exec($req);
                                if($exec){
                                    echo "<script>alert('Coupon Added!')</script>";
                                    echo "<script>location.replace('?p=Coupons')</script>";
                                }else{
                                    echo "";
                                }
                            }
                        }
                        
                    ?>
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
                
</div>