<?php
    $Pname=$Pcategory=$Pdiscript=$Psize=$Pprice=$Prodstatus=$Pfile1=$Pfile2=$Pfile3=$Pstock=$Pgender="";
    $Pnameer=$Pcategoryer=$Pdiscripter=$Psizeer=$Ppriceer=$Prodstatuser=$Pfile1er=$Pfile2er=$Pfile3er=$Pstocker=$Pgenderer="";
    require("conn.php");
    $id=$_GET['id'];
    $req="SELECT * FROM products JOIN category ON products.Product_Category=category.Id_category WHERE Product_id=".$id;
    $res=$conn->query($req);
    $resob=$res->fetch(PDO::FETCH_OBJ);
    $nb=$res->rowCount();
    $Pname1=$resob->Product_name;
    $Pcategory1=$resob->Product_Category;
    $Pcategoryname1=$resob->Title_category;
    $Pdiscript1=$resob->Product_Disc;
    $Psize1=$resob->Product_Size;
    $Pgender1=$resob->PGender;
    $Pprice1=$resob->Product_Price;
    $Pstock1=$resob->Stock;
    $Pfile11=$resob->Product_img1;
    $Pfile21=$resob->Product_img2;
    $Pfile31=$resob->Product_img3;
    $Prodstatus1=$resob->Product_Status;
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
                <?php 
                    
                if($nb>0){ 
                    
                    ?>
                    <div class="ibox-body">
                        <div class="tab-pane" id="tab-2">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>Product Name</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pnameer;?></span>
                                        <input class="form-control" type="text" name="Pname" placeholder="Product Name" value="<?php echo $Pname1;?>">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                    <label>Category</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pcategoryer;?></span>
                                    <select class="form-control" name="Pcategory">
                                        
                                        <?php
                                            $categ="select * from category";
                                            $res=$conn->query($categ);
                                            $resobj=$res->fetchAll(PDO::FETCH_OBJ);
                                            foreach($resobj as $cle=>$val){
                                                echo "<option value='".$val->Id_category."'";
                                                if($val->Id_category == $Pcategory1) {
                                                    echo " selected";
                                                }
                                                echo ">".$val->Title_category."</option>";
                                            }
                                            
                                        ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pdiscripter;?></span>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="15" name="Pdiscript"><?php echo $Pdiscript1;?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 form-group">
                                        <label>Product Size</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Psizeer;?></span>
                                        <select class="form-control" name="Psize">
                                            <option value="" selected>--Size--</option>
                                            <option value="S" <?php if(isset($Psize1) && $Psize1=="S") echo 'selected';?>>S</option>
                                            <option value="M" <?php if(isset($Psize1) && $Psize1=="M") echo 'selected';?>>M</option>
                                            <option value="L" <?php if(isset($Psize1) && $Psize1=="L") echo 'selected';?>>L</option>
                                            <option value="XL" <?php if(isset($Psize1) && $Psize1=="XL") echo 'selected';?>>XL</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                    <label>Gender</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pgenderer;?></span>
                                    <div class="input-group">
                                    <select class="form-control" name="Pgender">
                                        <option value="" selected>--Gender--</option>
                                        <option value="Women" <?php if(isset($Pgender1) && $Pgender1=="Women") echo 'selected';?>>Women</option>
                                        <option value="Men" <?php if(isset($Pgender1) && $Pgender1=="Men") echo 'selected';?>>Men</option>
                                    </select>
                                    </div>
                                </div>
                                    <div class="col-sm-3 form-group">
                                        <label>Product Price</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Ppriceer;?></span>
                                        <div class="input-group">
                                            <div class="input-group-addon">DH</div>
                                            <input type="text" name="Pprice"  value="<?php echo $Pprice1;?>" class="form-control" placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>Product Status</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Prodstatuser;?></span>
                                        <div class="input-group">
                                        <select class="form-control" name="Prodstatus">
                                            <option value="" selected>--Status--</option>
                                            <option value="Active" <?php if(isset($Prodstatus1) && $Prodstatus1=="Active") echo 'selected';?>>Active</option>
                                            <option value="Inactive" <?php if(isset($Prodstatus1) && $Prodstatus1=="Inactive") echo 'selected';?>>Inactive</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label>Stock</label><span class="font-10 text-danger">&nbsp;&nbsp;<?php echo $Pstocker;?></span>
                                        <div class="input-group">
                                            <div class="input-group-addon ti-package"></div>
                                            <input type="text" name="Pstock"  value="<?php echo $Pstock1;?>" class="form-control" placeholder="Qte">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 form-group">
                                        <h5>Image Product</h5>
                                        <hr>
                                        <ul class="media-list media-list-divider m-1">
                                            <li class="media">
                                                <img id="uploadPreview" src="assets/img/Products/<?php echo $Pfile11;?>" alt="Votre Profile" style="border: 1px solid black;margin-left:15px;object-fit: cover;" width="140px" height="80px">
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
                                                <img id="uploadPreview1" src="assets/img/Products/<?php echo $Pfile21;?>" alt="Votre Profile" style="border: 1px solid black;margin-left:15px;object-fit: cover;" width="140px" height="80px">
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
                                                <img id="uploadPreview2" src="assets/img/Products/<?php echo $Pfile31;?>" alt="Votre Profile" style="border: 1px solid black;margin-left:15px;object-fit: cover;" width="140px" height="80px">
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
                                    <input type="submit" name="EditProd" class="btn btn-primary" value="Edit Product">
                                </div>
                            </form>
                            <?php
                            
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if(isset($_POST['EditProd'])){
                                    if(empty($_POST["Pname"])) {
                                        $Pnameer = "Required!";
                                    } else {
                                        $Pname = $_POST["Pname"];
                                    }
                        
                                    if(empty($_POST["Pcategory"])) {
                                        $Pcategoryer = "Required!";
                                    } else {
                                        $Pcategory = $_POST["Pcategory"];
                                    }
                        
                                    if(empty($_POST["Pdiscript"])) {
                                        $Pdiscripter = "Required!";
                                    } else {
                                        $Pdiscript = $_POST["Pdiscript"];
                                    }
                        
                                    if(empty($_POST["Psize"])) {
                                        $Psizeer = "Required!";
                                    } else {
                                        $Psize = $_POST["Psize"];
                                    }
                                    if(empty($_POST["Pgender"])) {
                                        $Pgenderer = "*";
                                    } else {
                                        $Pgender = $_POST["Pgender"];
                                    }
                                    if(empty($_POST["Pprice"])) {
                                        $Ppriceer = "Required!";
                                    } else {
                                        $Pprice = $_POST["Pprice"];
                                    }
                                    if(empty($_POST["Pstock"])) {
                                        $Pstocker = "Required!";
                                    } else {
                                        $Pstock = $_POST["Pstock"];
                                    }
                                    if(empty($_POST["Prodstatus"])) {
                                        $Prodstatuser = "Required!";
                                    } else {
                                        $Prodstatus = $_POST["Prodstatus"];
                                    }
                                    if(empty($_FILES['Pfile1']['tmp_name'])){
                                        $Pfile1er="Required!";
                                    }
                                    else{
                                        $Pfile1=$_FILES['Pfile1']['tmp_name'];
                                    }
                        
                                    if(empty($_FILES['Pfile2']['tmp_name'])){
                                        $Pfile2er="Required!";
                                    }
                                    else{
                                        $Pfile2=$_FILES['Pfile2']['tmp_name'];
                                    }
                        
                                    if(empty($_FILES['Pfile3']['tmp_name'])){
                                        $Pfile3er="Required!";
                                    }
                                    else{
                                        $Pfile3=$_FILES['Pfile3']['tmp_name'];
                                    }
                                }
                            }
                            if(isset($_POST['EditProd'])){
                                if($Pname!="" && $Pcategory!="" && $Pdiscript!="" && $Psize!="" && $Pgender!="" && $Pprice!="" && $Pstock!=""){
                                    
                                        require("conn.php");
                                        $up2="UPDATE `products` SET `Product_name`='".$Pname."',`Product_Category`=".$Pcategory.",`Product_Disc`='".$Pdiscript."',`Product_Size`='".$Psize."',`PGender`='".$Pgender."',`Product_Price`=".$Pprice.",`Stock`=".$Pstock.",`Date_Update`=now() WHERE `Product_id`=".$id;
                                        $exec2=$conn->exec($up2);
                                        if($exec2){
                                            echo "<script>alert('Product Updated!')</script>";
                                            
                                        }else{
                                            echo "Querry invalide!";
                                        }
                                        $conn=Null;
                                    
                                }
                                if($Prodstatus!=""){
                                    require("conn.php");
                                        $up3="UPDATE `products` SET `Product_Status`='".$Prodstatus."',`Date_Update`=now() WHERE `Product_id`=".$id;
                                        $exec3=$conn->exec($up3);
                                        if($exec3){
                                            echo "Activated";
                                            
                                        }else{
                                            echo "Querry invalide!";
                                        }
                                        $conn=Null;
                                }
                                if($Pfile1!=""){
                                    if(is_uploaded_file($Pfile1)){
                                        if($_FILES['Pfile1']['size']<=5*MB){// 
                                            $info1=pathinfo($_FILES['Pfile1']['name']);
                                            $extension1=$info1['extension'];
                                            $ext_auto=array('jpg','png','jpeg','webp');
                                            if(in_array($extension1,$ext_auto))
                                            {    
                                                require("conn.php");
                                                $Pfile1=$_FILES['Pfile1']['name'];
                                                $img1="UPDATE `products` SET `Product_img1`='".$Pfile1."',`Date_Update`=now() WHERE `Product_id`=".$id;
                                                $ex=$conn->exec($img1);
                                                if($ex){
                                                    move_uploaded_file($_FILES['Pfile1']['tmp_name'],"./assets/img/Products/".$_FILES['Pfile1']['name']);
                                                    
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
                                if($Pfile2!=""){
                                    if(is_uploaded_file($Pfile2)){
                                        if($_FILES['Pfile2']['size']<=5*MB){// 
                                            $info2=pathinfo($_FILES['Pfile2']['name']);
                                            $extension2=$info2['extension'];
                                            $ext_auto=array('jpg','png','jpeg','webp');
                                            if(in_array($extension2,$ext_auto))
                                            {    
                                                require("conn.php");
                                                $Pfile2=$_FILES['Pfile2']['name'];
                                                $img2="UPDATE `products` SET `Product_img2`='".$Pfile2."',`Date_Update`=now() WHERE `Product_id`=".$id;
                                                $ex2=$conn->exec($img2);
                                                if($ex2){
                                                    move_uploaded_file($_FILES['Pfile2']['tmp_name'],"./assets/img/Products/".$_FILES['Pfile2']['name']);
                                                    echo "<script>alert('Image 2 Updated!')</script>";
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
                                
                                if($Pfile3!=""){    
                                    if(is_uploaded_file($Pfile3)){
                                            if($_FILES['Pfile3']['size']<=5*MB){// 
                                                $info3=pathinfo($_FILES['Pfile3']['name']);
                                                $extension3=$info3['extension'];
                                                $ext_auto=array('jpg','png','jpeg','webp');
                                                if(in_array($extension3,$ext_auto))
                                                {    
                                                    require("conn.php");
                                                    $Pfile3=$_FILES['Pfile3']['name'];
                                                    $img3="UPDATE `products` SET `Product_img3`='".$Pfile3."',`Date_Update`=now() WHERE `Product_id`=".$id;
                                                    $ex3=$conn->exec($img3);
                                                    if($ex3){
                                                        move_uploaded_file($_FILES['Pfile3']['tmp_name'],"./assets/img/Products/".$_FILES['Pfile3']['name']);
                                                        echo "<script>alert('Image 3 Updated!')</script>";
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
                                }echo "<script>location.replace('?p=OvProducts')</script>";
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        
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
                            $conn=null;             
                        ?>
                        </h2>
                        <div class="m-b-5">Current Products Inactive</div><i class="fa fa-dropbox widget-stat-icon"></i>
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