<?php
    $Pname=$Pcategory=$Pdiscript=$Psize=$Pprice=$Prodstatus=$Pfile1=$Pfile2=$Pfile3=$Pstock=$Pgender="";
    $Pnameer=$Pcategoryer=$Pdiscripter=$Psizeer=$Ppriceer=$Prodstatuser=$Pfile1er=$Pfile2er=$Pfile3er=$Pstocker=$Pgenderer="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['Addprod'])){
            if(empty($_POST["Pname"])) {
                $Pnameer = "*";
            } else {
                $Pname = $_POST["Pname"];
            }

            if(empty($_POST["Pcategory"])) {
                $Pcategoryer = "*";
            } else {
                $Pcategory = $_POST["Pcategory"];
            }

            if(empty($_POST["Pdiscript"])) {
                $Pdiscripter = "*";
            } else {
                $Pdiscript = $_POST["Pdiscript"];
            }

            if(empty($_POST["Psize"])) {
                $Psizeer = "*";
            } else {
                $Psize = $_POST["Psize"];
            }

            if(empty($_POST["Pprice"])) {
                $Ppriceer = "*";
            } else {
                $Pprice = $_POST["Pprice"];
            }
            if(empty($_POST["Pgender"])) {
                $Pgenderer = "*";
            } else {
                $Pgender = $_POST["Pgender"];
            }
            if(empty($_POST["Pstock"])) {
                $Pstocker = "*";
            } else {
                $Pstock = $_POST["Pstock"];
            }
            if(empty($_POST["Prodstatus"])) {
                $Prodstatuser = "*";
            } else {
                $Prodstatus = $_POST["Prodstatus"];
            }

            if(empty($_FILES['Pfile1']['tmp_name'])){
                $Pfile1er="*";
            }
            else{
                $Pfile1=$_FILES['Pfile1']['tmp_name'];
            }

            if(empty($_FILES['Pfile2']['tmp_name'])){
                $Pfile2er="*";
            }
            else{
                $Pfile2=$_FILES['Pfile2']['tmp_name'];
            }

            if(empty($_FILES['Pfile3']['tmp_name'])){
                $Pfile3er="*";
            }
            else{
                $Pfile3=$_FILES['Pfile3']['tmp_name'];
            }
        }
    }
    
?>
<div class="page-content fade-in-up">
    
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Add Product</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                    <div class="tab-pane" id="tab-2">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Product Name</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pnameer;?></span>
                                    <input class="form-control" type="text" name="Pname" placeholder="Product Name">
                                </div>
                                <div class="col-sm-6 form-group">
                                <label>Category</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pcategoryer;?></span>
                                <select class="form-control" name="Pcategory">
                                    <option value="" selected>--Category--</option>
                                    <?php
                                        require("conn.php");
                                        $categ="select * from category";
                                        $res=$conn->query($categ);
                                        $resobj=$res->fetchAll(PDO::FETCH_OBJ);
                                        foreach($resobj as $cle=>$val){
                                            echo "<option value='".$val->Id_category."'>".$val->Title_category."</option>";
                                        }
                                        
                                    ?>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pdiscripter;?></span>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="15" name="Pdiscript"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 form-group">
                                    <label>Product Size</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Psizeer;?></span>
                                    <select class="form-control" name="Psize">
                                        <option value="" selected>--Size--</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="None">None</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Product Price</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Ppriceer;?></span>
                                    <div class="input-group">
                                        <div class="input-group-addon">DH</div>
                                        <input type="text" name="Pprice"  value="" class="form-control" placeholder="Price">
                                    </div>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <label>Gender</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pgenderer;?></span>
                                    <div class="input-group">
                                    <select class="form-control" name="Pgender">
                                        <option value="" selected>--Gender--</option>
                                        <option value="Women">Women</option>
                                        <option value="Men">Men</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Product Status</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Prodstatuser;?></span>
                                    <div class="input-group">
                                    <select class="form-control" name="Prodstatus">
                                        <option value="" selected>--Status--</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="col-sm-2 form-group">
                                    <label>Stock</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pstocker;?></span>
                                    <div class="input-group">
                                        <div class="input-group-addon ti-package"></div>
                                        <input type="text" name="Pstock"  value="" class="form-control" placeholder="Qte">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <h5>Image Product</h5>
                                    <hr>
                                    <ul class="media-list media-list-divider m-1">
                                        <li class="media">
                                            <img id="uploadPreview" src="assets/img/image.png" alt="Votre Profile" style="border: 1px solid black;margin-left:15px;object-fit: cover;" width="140px" height="80px">
                                            <div class="col-5 form-group">
                                                <div class="media-body">
                                                    <div class="media-heading">
                                                        <span class="font-16 float-right">
                                                            <input type="file" name="Pfile1" class="form-control" id="uploadImage" accept="image/png,image/jpeg,image/jpg,image/webp" value="" onchange="PreviewImage();"/>
                                                        </span>
                                                        <span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pfile1er;?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <img id="uploadPreview1" src="assets/img/image.png" alt="Votre Profile" style="border: 1px solid black;margin-left:15px;object-fit: cover;" width="140px" height="80px">
                                            <div class="col-5 form-group">
                                                <div class="media-body">
                                                    <div class="media-heading">
                                                        <span class="font-16 float-right">
                                                            <input type="file" name="Pfile2" class="form-control" id="uploadImage1" accept="image/png,image/jpeg,image/jpg,image/webp" value="" onchange="PreviewImage1();"/>
                                                        </span>
                                                        <span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pfile2er; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <img id="uploadPreview2" src="assets/img/image.png" alt="Votre Profile" style="border: 1px solid black;margin-left:15px;object-fit: cover;" width="140px" height="80px">
                                            <div class="col-5 form-group">
                                                <div class="media-body">
                                                    <div class="media-heading">
                                                        <span class="font-16 float-right">
                                                            <input type="file" name="Pfile3" class="form-control" id="uploadImage2" accept="image/png,image/jpeg,image/jpg,image/webp" value="" onchange="PreviewImage2();"/>
                                                        </span>
                                                        <span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pfile3er;?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="Addprod" class="btn btn-primary" value="Add Product">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
        <div class="col-lg-9 col-md-4">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">
                        <?php 
                        $req="select count(*) as TotalP from products";
                        $sql=$conn->query($req);
                        if($sql){
                            $resobj=$sql->fetch(PDO::FETCH_OBJ);
                            echo   $resobj->TotalP;
                        }                
                        ?>
                    </h2>
                    <div class="m-b-5">All Products</div><i class="ti-package widget-stat-icon"></i>
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
                        <div class="m-b-5">Current Products Active</div><i class="fa fa-dropbox widget-stat-icon"></i>
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
                        ?>
                        </h2>
                        <div class="m-b-5">Current Products Inactive</div><i class="fa fa-dropbox widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if(isset($_POST['Addprod'])){
                if($Pname!="" && $Pcategory!="" && $Pdiscript!="" && $Psize!="" && $Pprice!="" && $Pstock!="" && $Prodstatus!="" && $Pfile1!="" && $Pfile2!="" && $Pfile3!="" ){
                    if(is_uploaded_file($Pfile1) && is_uploaded_file($Pfile2) && is_uploaded_file($Pfile3)){
                        if($_FILES['Pfile1']['size']<=5*MB && $_FILES['Pfile2']['size']<=5*MB && $_FILES['Pfile3']['size']<=5*MB){// 
                            $info1=pathinfo($_FILES['Pfile1']['name']);
                            $extension1=$info1['extension'];
                            $info2=pathinfo($_FILES['Pfile2']['name']);
                            $extension2=$info2['extension'];
                            $info3=pathinfo($_FILES['Pfile3']['name']);
                            $extension3=$info3['extension'];
                            $ext_auto=array('jpg','png','jpeg','webp');
                            if(in_array($extension1,$ext_auto) && in_array($extension2,$ext_auto) && in_array($extension3,$ext_auto))
                            {    
                                
                                $Pfile1=$_FILES['Pfile1']['name'];
                                $Pfile2=$_FILES['Pfile2']['name'];
                                $Pfile3=$_FILES['Pfile3']['name'];
                                $insert="INSERT INTO `products`(`Product_name`, `Product_Category`, `Product_Disc`, `Product_Size`, `PGender`, `Product_Price`,`Stock`,`Product_img1`, `Product_img2`, `Product_img3`, `Product_Status`, `DateProdCreation`, `Date_Update`) VALUES ('".$Pname."',".$Pcategory.",'".$Pdiscript."','".$Psize."','".$Pgender."',".$Pprice.",".$Pstock.",'".$Pfile1."','".$Pfile2."','".$Pfile3."','".$Prodstatus."',now(),now());";
                                $exec=$conn->exec($insert);
                                if($exec){
                                    move_uploaded_file($_FILES['Pfile1']['tmp_name'],"./assets/img/Products/".$_FILES['Pfile1']['name']);
                                    move_uploaded_file($_FILES['Pfile2']['tmp_name'],"./assets/img/Products/".$_FILES['Pfile2']['name']);
                                    move_uploaded_file($_FILES['Pfile3']['tmp_name'],"./assets/img/Products/".$_FILES['Pfile3']['name']);
                                    echo "<script>alert('Product Added!')</script>";
                                    echo "<script>location.replace('?p=addProduct')</script>";
                                }else{
                                    echo "<script>alert('Error Product!')</script>";
                                }
                                $conn=Null;
                            }else{
                                echo "Extension invalide!";
                            }    
                        }else{
                            echo "<script>alert('Image Dimension too large! Try atleast 1000x1000')</script>";
                        }     
                    }else{
                        echo "Error Upload Image!";
                    }
                }
            }
            $conn=Null;
        ?>
    </div>

    <div class="row">
        <div class="col-lg-12">
            
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->