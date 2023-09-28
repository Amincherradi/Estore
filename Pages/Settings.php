
<?php 
if(!isset($_SESSION)) 
{ 
    session_start();
} 
if(!isset($_SESSION['open'])){
    echo "<script>location.replace('?p=404.html')</script>";
}
?>
<?php
    $FNameer=$LNameer=$Emailer=$Phoneer=$Adresser=$Cityer=$ZipCodeer=$Pfileer=$Stateer="";
    $FName=$LName=$Email=$Phone=$Adress=$City=$ZipCode=$Pfile=$State="";
    $upoldpwd=$uppdw=$upcpdw="";
    $upoldpwder=$uppdwer=$upcpdwer="";
    if(isset($_SESSION['ID'])){
        $idc=$_SESSION['ID'];
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit'])){

            if($_POST['submit']=="Update"){
                if(empty($_POST["FName"])) {
                    $FNameer = "First Name Required!";
                } else {
                    $FName = $_POST["FName"];
                }

                if(empty($_POST["LName"])) {
                    $LNameer = "Last Name Required!";
                } else {
                    $LName = $_POST["LName"];
                }

                if (empty($_POST["Email"])) {
                    $Emailer = "Email Required!";
                } else {
                    $Email = $_POST["Email"];
                }
                if (empty($_POST["Phone"])) {
                    $Phoneer = "Phone Required!";
                } else {
                    $Phone = $_POST["Phone"];
                }
                if (empty($_POST["Adress"])) {
                    $Adresser = "Adress Required!";
                } else {
                    $Adress = $_POST["Adress"];
                }
                if (empty($_POST["Adress"])) {
                    $Adresser = "Adress Required!";
                } else {
                    $Adress = $_POST["Adress"];
                }
                if (empty($_POST["City"])) {
                    $Cityer = "City Required!";
                } else {
                    $City = $_POST["City"];
                }
                if (empty($_POST["ZipCode"])) {
                    $ZipCodeer = "ZipCode Required!";
                } else {
                    $ZipCode = $_POST["ZipCode"];
                }

            }else 
            
            if($_POST['submit']=="Update Photo"){

                if(empty($_FILES['Pfile']['tmp_name'])){
                    $Pfileer="Required!";
                }
                else{
                    $Pfile=$_FILES['Pfile']['tmp_name'];
                }
            }
        }
        if(isset($_POST['uppassword'])){

            if (empty($_POST["upoldpwd"])) {
                $upoldpwder = "Field Required!";
            } else {
                $upoldpwd = $_POST["upoldpwd"];
            }
            if (empty($_POST["uppdw"])) {
                $uppdwer = "Field Required!";
            } else {
                $uppdw = $_POST["uppdw"];
            }
            if (empty($_POST["upcpdw"])) {
                $upcpdwer = "Field Required!";
            } else {
                $upcpdw = $_POST["upcpdw"];
            }
        }

    }
    $CustomerID=$_SESSION['ID'];
    $email=$_SESSION['Email'];
    require("conn.php");
    $cust="select * from customers where CustomerID=".$idc;
    $disp=$conn->query($cust);
    $nb=$disp->rowCount();
    if($nb>0){
        $resobj=$disp->fetch(PDO::FETCH_OBJ);
    
    ?>
<br><br>
<section class="section" id="trainers">
        <div class="container col-10">
            <div class="row">
                <div class='col-lg-12'>
                    <div class="page-heading">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html"><i class="la la-home font-20"></i></a>
                            </li>
                            <li class="breadcrumb-item">Profile</li>
                        </ol>
                    </div>
                    <div class="page-content fade-in-up">
                        <div class="row">
                            <div class="col-12">
                                <div class="ibox">
                                    <div class="ibox-body">
                                        
                                        <ul class="nav nav-tabs tabs-line">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#tab-1" id="Overview" data-toggle="tab"><i class="fa fa-eye"></i> Overview</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#tab-2" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> My Orders </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#tab-3" id="settings" data-toggle="tab"><i class="fa fa-cogs"></i> Settings / <i class="fa fa-map-marker"></i> Billing</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#tab-4" id="Security" data-toggle="tab"><i class="fa fa-lock"></i> Security</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tab-1">
                                                <div class="row">
                                                    <div class="col-md-3" style="border-right: 1px solid #eee;"><br>
                                                        <div class="avatar-upload">
                                                                <div class="avatar-edit">
                                                                    <div class="avatar-preview">
                                                                        <div id="imagePreview" >
                                                                            <img id="uploadPreview1" style="border-radius: 50%; height: 181px;width: 178px;margin-top:0 !important;" src="assets/images/users/<?php echo $resobj->Photo;?>" alt="" >
                                                                        </div><span class="text text-danger"></span>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5"><br>
                                                        <center>
                                                        <span style="color:red;">
                                                            <?php 
                                                                if($resobj->Phone=="" && $resobj->Adress=="" && $resobj->City=="" && $resobj->ZipCode==""){
                                                                    echo "** You should update your profile **";
                                                                }
                                                            ?>
                                                        </span>
                                                        </center><br>
                                                        <ul class="media-list media-list-divider m-0">
                                                            <li class="media">
                                                                <div class="media-body">
                                                                    <label class="media-heading">Full Name :</label>
                                                                </div>
                                                                <div class="media-body">
                                                                    <?php echo $resobj->FName." ".$resobj->LName;?>
                                                                </div>
                                                            </li>
                                                            <li class="media">
                                                                <div class="media-body">
                                                                    <label  class="media-heading">Email :</label>
                                                                </div>
                                                                <div class="media-body">
                                                                    <?php echo $resobj->Email;?>
                                                                </div>
                                                            </li>
                                                            <li class="media">
                                                                <div class="media-body">
                                                                    <label class="media-heading">Phone :</label>
                                                                </div>
                                                                <div class="media-body">
                                                                    <?php echo $resobj->Phone;?>
                                                                </div>
                                                            </li>
                                                            <li class="media">
                                                                <div class="media-body">
                                                                    <label class="media-heading">Adress :</label>
                                                                </div>
                                                                <div class="media-body">
                                                                    <?php echo $resobj->Adress;?>
                                                                </div>
                                                            </li>
                                                            <li class="media">
                                                                <div class="media-body">
                                                                    <label class="media-heading">City :</label>
                                                                </div>
                                                                <div class="media-body">
                                                                    <?php echo $resobj->City;?>
                                                                </div>
                                                            </li>
                                                            <li class="media">
                                                                <div class="media-body">
                                                                    <label class="media-heading">ZipCode :</label>
                                                                </div>
                                                                <div class="media-body">
                                                                    <?php echo $resobj->ZipCode;?>
                                                                </div>
                                                            </li>
                                                            <li class="media">
                                                                <div class="media-body">
                                                                    <label  class="media-heading">Account :</label>
                                                                </div>
                                                                <div class="media-body">
                                                                    <?php 
                                                                    if($resobj->CStatus=="Activated"){
                                                                        echo '<span class="badge " style="background-color:green !important;">'.$resobj->CStatus.'</span>';
                                                                    }else{
                                                                        echo '<span class="badge " style="background-color:#ffba00 !important;">'.$resobj->CStatus.'</span>';
                                                                    }
                                                                    ?>
                                                                    
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div><br><br>
                                                <h4 class="text-info m-b-20 m-t-20"><i class="fa fa-cart-arrow-down"></i> Latest Orders</h4><br>
                                                <table class="table align-middle mb-0 bg-white" id="orderstable">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th>Transaction ID</th>
                                                            <th>Status</th>
                                                            <th>Date Order</th>
                                                        </tr>
                                                    </thead>
                                                    <?php 
                                                        $orders="SELECT * FROM orders WHERE orders.CustomerID=".$_SESSION['ID'];
                                                        $exec=$conn->query($orders);
                                                        $nbord=$exec->rowCount();
                                                        if($nbord>0){
                                                            $resorder=$exec->fetchAll(PDO::FETCH_OBJ);
                                                            echo "<tbody>";
                                                            foreach($resorder as $key=>$val){
                                                                echo '
                                                                <tr>
                                                                    <td>
                                                                        <a href="?p=invoice&idord='.$val->OrderID.'">'.$val->TransactionID.'</a>
                                                                    </td>
                                                                    <td>';
                                                                    if($val->Status=="Shipped"){
                                                                        echo '<span class="badge " style="background-color:green !important;">'.$val->Status.'</span>';
                                                                    }else if($val->Status=="Pending"){
                                                                        echo '<span class="badge success">'.$val->Status.'</span>';
                                                                    }else{
                                                                        echo '<span class="badge " style="background-color:red !important;">'.$val->Status.'</span>';
                                                                    }
                                                                    echo '</td>
                                                                    <td>'.$val->OrderDate.'</td>
                                                                </tr>
                                                                ';
                                                            }
                                                            echo "</tbody>";
                                                        }
                                                    ?>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="tab-2"><br>
                                                <h4 class="text-info m-b-20 m-t-20"><i class="fa fa-cart-arrow-down"></i> My Orders</h4><br>
                                                <table class="table align-middle mb-0 bg-white" id="orderstable">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th>Transaction ID</th>
                                                            <th>Status</th>
                                                            <th>Date Order</th>
                                                        </tr>
                                                    </thead>
                                                    <?php 
                                                        $orders="SELECT * FROM orders WHERE orders.CustomerID=".$_SESSION['ID'];
                                                        $exec=$conn->query($orders);
                                                        $nbord=$exec->rowCount();
                                                        if($nbord>0){
                                                            $resorder=$exec->fetchAll(PDO::FETCH_OBJ);
                                                            echo "<tbody>";
                                                            foreach($resorder as $key=>$val){
                                                                echo '
                                                                <tr>
                                                                    <td>
                                                                        <a href="?p=invoice&idord='.$val->OrderID.'">'.$val->TransactionID.'</a>
                                                                    </td>
                                                                    <td>';
                                                                    if($val->Status=="Shipped"){
                                                                        echo '<span class="badge " style="background-color:green !important;">'.$val->Status.'</span>';
                                                                    }else if($val->Status=="Pending"){
                                                                        echo '<span class="badge success">'.$val->Status.'</span>';
                                                                    }else{
                                                                        echo '<span class="badge " style="background-color:red !important;">'.$val->Status.'</span>';
                                                                    }
                                                                    echo '</td>
                                                                    <td>'.$val->OrderDate.'</td>
                                                                </tr>
                                                                ';
                                                            }
                                                            echo "</tbody>";
                                                        }
                                                    ?>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="tab-3"><br>
                                                <h5 class="text-info m-b-20 m-t-20"><i class="fa fa-cogs"></i> Settings </h5><br>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                <center>
                                                    <div class="container">
                                                        <script type="text/javascript">
                                                            function PreviewImage() {
                                                                var oFReader = new FileReader();
                                                                oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
                                                                oFReader.onload = function (oFREvent) {
                                                                    document.getElementById("uploadPreview").src = oFREvent.target.result;
                                                                };
                                                            };
                                                            
                                                        </script>
                                                        <div class="avatar-upload">
                                                                <div class="avatar-edit">
                                                                <input type="file" name="Pfile"  class="form-control col-lg-12" id="uploadImage" accept="image/png,image/jpeg,image/jpg,image/webp" value="" onchange="PreviewImage();"/>
                                            
                                                                <label for="uploadImage"></label>
                                                                </div>
                                                                <div class="avatar-preview">
                                                                    <div id="imagePreview" >
                                                                        <img id="uploadPreview" style="border-radius: 50%; height: 181px;width: 178px;" src="assets/images/users/<?php echo $resobj->Photo;;?>" alt="" >
                                                                    </div><span class="text text-danger"><?php echo $Pfileer;?></span>
                                                                </div><br><input type="submit" name="submit" id="Settings" class="btn btn-primary" value="Update Photo">
                                                            
                                                            <?php 
                                                }// hadi dyal dyal ligne 76
                                                                if(isset($_POST['submit']) && $_POST['submit']=="Update Photo"){
                                                                    if($Pfile!=""){    
                                                                        if(is_uploaded_file($Pfile)){
                                                                                if($_FILES['Pfile']['size']<=5*MB){// 
                                                                                    $info3=pathinfo($_FILES['Pfile']['name']);
                                                                                    $extension3=$info3['extension'];
                                                                                    $ext_auto=array('jpg','PNG','jpeg','webp','png');
                                                                                    if(in_array($extension3,$ext_auto))
                                                                                    {    
                                                                                        
                                                                                        require("conn.php");
                                                                                        $Pfile=$_FILES['Pfile']['name'];
                                                                                        $img="UPDATE `customers` SET `Photo`='".$Pfile."',`DateUpdate`=now() WHERE `CustomerID`=".$idc;
                                                                                        $ex=$conn->exec($img);
                                                                                        $log="INSERT INTO `logs`(`CustomerID`, `CustomerEmail`, `Activity`, `DateTime`) VALUES (".$CustomerID.",'".$email."','Updated Image',now())";
                                                                                        $execlog=$conn->exec($log);
                                                                                        if($ex){
                                                                                            move_uploaded_file($_FILES['Pfile']['tmp_name'],"./assets/images/users/".$_FILES['Pfile']['name']);
                                                                                            move_uploaded_file($_FILES['Pfile']['tmp_name'],"./admin/assets/img/customers/".$_FILES['Pfile']['name']);
                                                                                            
                                                                                            echo "<script>
                                                                                            toastr.options.positionClass = 'toast-top-center';
                                                                                            toastr.success('Image Updated!', { fadeAway: 1000 });
                                                                                            setTimeout(function() {
                                                                                                document.getElementById('settings').click();
                                                                                            }, 2000);
                                                                                            
                                                                                        </script>";
                                                                                        }else{
                                                                                            echo "<script type='text/javascript'>
                                                                                                    toastr.options.positionClass = 'toast-top-center';
                                                                                                    toastr.error('Error Update!', { fadeAway: 1000 });
                                                                                                    setTimeout(function() {
                                                                                                        document.getElementById('settings').click();
                                                                                                    }, 2000);
                                                                                            </script>";
                                                                                        }
                                                                                        $conn=Null;
                                                                                    }else{
                                                                                        echo "<script type='text/javascript'>
                                                                                                    toastr.options.positionClass = 'toast-top-center';
                                                                                                    toastr.error('Extension invalide!', { fadeAway: 1000 });
                                                                                            </script>";
                                                                                    }    
                                                                                }else{
                                                                                    echo "<script type='text/javascript'>
                                                                                        toastr.options.positionClass = 'toast-top-center';
                                                                                        toastr.error('Image Dimension too large! Try atleast 1000x1000', { fadeAway: 1000 });
                                                                                    </script>";
                                                                                }     
                                                                            }else{
                                                                                echo "<script type='text/javascript'>
                                                                                        toastr.options.positionClass = 'toast-top-center';
                                                                                        toastr.error('Error Upload Image!', { fadeAway: 1000 });
                                                                                        
                                                                                        document.getElementById('settings').click();
                                                                                    </script>";
                                                                            }
                                                                    }
                                                                    
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </center><br><br>
                                                    <h5 class="text-info m-b-20 m-t-20"><i class="fa fa-address-card-o"></i> Personal Info</h5><br>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>First Name</label>
                                                            <input class="form-control" name="FName" type="text" value="<?php echo $resobj->FName;?>" placeholder="<?php echo $resobj->FName;?>"><span class="text-danger"><?php echo $FNameer;?></span>
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>Last Name</label>
                                                            <input class="form-control" name="LName" type="text" value="<?php echo $resobj->LName;?>" placeholder="<?php echo $resobj->LName;?>"><span class="text-danger"><?php echo $LNameer;?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>Email</label>
                                                            <input class="form-control" name="Email" type="Email" value="<?php echo $resobj->Email;?>" placeholder="<?php echo $resobj->Email;?>"><span class="text-danger"><?php echo $Emailer;?></span>
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>Phone</label>
                                                            <input class="form-control" name="Phone" type="text" value="<?php echo $resobj->Phone;?>" placeholder="<?php echo $resobj->Phone;?>"><span class="text-danger"><?php echo $Phoneer;?></span>
                                                        </div>
                                                    </div><br>
                                                    <h5 class="text-info m-b-20 m-t-20"><i class="fas fa-Shipping-Fast"></i> Billing</h5><br>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>Adress</label>
                                                            <input class="form-control" name="Adress" type="text" value="<?php echo $resobj->Adress;?>" placeholder="<?php echo $resobj->Adress;?>"><span class="text-danger"><?php echo $Adresser;?></span>
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>Adress</label>
                                                            <input class="form-control" name="State" type="text" value="<?php echo $resobj->State;?>" placeholder="<?php echo $resobj->State;?>"><span class="text-danger"><?php echo $Stateer;?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 form-group">
                                                            <label>City</label>
                                                            <input class="form-control" name="City" type="text" value="<?php echo $resobj->City;?>" placeholder="<?php echo $resobj->City;?>"><span class="text-danger"><?php echo $Cityer;?></span>
                                                        </div>
                                                        <div class="col-sm-6 form-group">
                                                            <label>Zip Code</label>
                                                            <input class="form-control" name="ZipCode" type="text" value="<?php echo $resobj->ZipCode;?>" placeholder="<?php echo $resobj->ZipCode;?>"><span class="text-danger"><?php echo $ZipCodeer;?></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <input type="submit" name="submit" id="Settings" class="btn btn-primary" value="Update">
                                                    </div>
                                                    
                                                </form>
                                                <?php 
                                                    if(isset($_POST['submit']) && $_POST['submit']=="Update"){
                                                        if($FName!='' && $LName!='' && $Email!='' && $Phone!='' && $Adress!='' && $City!='' && $ZipCode!=''){
                                                            require("conn.php");
                                                            $Pfile=$_FILES['Pfile']['name'];
                                                            $cust="UPDATE `customers` SET `FName`='".$FName."',`LName`='".$LName."',`Email`='".$Email."',`Phone`='".$Phone."',`Adress`='".$Adress."',`City`='".$City."',`ZipCode`='".$ZipCode."',CStatus='Activated',`DateUpdate`=now() WHERE `CustomerID`=".$idc;
                                                            $ex2=$conn->exec($cust);
                                                            $log="INSERT INTO `logs`(`CustomerID`, `CustomerEmail`, `Activity`, `DateTime`) VALUES (".$CustomerID.",'".$email."','Updated Profil Settings',now())";
                                                            $execlog=$conn->exec($log);
                                                            if($ex2){
                                                                echo "<script type='text/javascript'>
                                                                toastr.options.positionClass = 'toast-top-center';
                                                                toastr.success('You are all Set!', { fadeAway: 1000 });
                                                                setTimeout(function() {
                                                                    document.getElementById('Overview').click();
                                                                }, 2000);
                                                                
                                                            </script>";
                                                            }else{
                                                                echo "<script type='text/javascript'>
                                                                                            toastr.options.positionClass = 'toast-top-center';
                                                                                            toastr.error('Error Update!', { fadeAway: 1000 });
                                                                                        </script>";
                                                                echo "<script>document.getElementById('settings').click();</script>";
                                                            }
                                                            $conn=Null;
                                                            echo "<script>document.getElementById('settings').click();</script>";
                                                        }else {
                                                            echo "<script type='text/javascript'>
                                                                toastr.options.positionClass = 'toast-top-center';
                                                                toastr.warning('You Should fill The Required Fields', { fadeAway: 1000 });
                                                                setTimeout(function() {
                                                                    document.getElementById('Overview').click();
                                                                }, 2000);
                                                                
                                                            </script>";
                                                        }
                                                       
                                                    }
                                                    
                                                ?>
                                            </div>
                                            <div class="tab-pane fade" id="tab-4"><br>
                                                <h5 class="text-info m-b-20 m-t-20"><i class="fa fa-lock"></i> Security</h5><br>
                                                <form action="" method="post">
                                                    <div class="row col-5">
                                                        <div class="col-sm-9 form-group">
                                                            <label>Old.Password</label>
                                                            <input class="form-control" name="upoldpwd" type="password" placeholder="Password">
                                                        </div>
                                                        <div class="col-sm-9 form-group">
                                                            <label>Password</label>
                                                            <input class="form-control" name="uppdw" type="password" placeholder="Password">
                                                        </div>
                                                        <div class="col-sm-9 form-group">
                                                            <label>Confirm Password</label>
                                                            <input class="form-control" name="upcpdw" type="password" placeholder="Conf.Password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <input type="submit" name="uppassword" class="btn btn-primary" value="Update Password">
                                                    </div>
                                                </form>
                                                <?php 
                                                    if(isset($_POST['uppassword'])){
                                                        if($upoldpwd!="" && $uppdw!="" && $upcpdw!=""){
                                                            $passcrypt=md5($upoldpwd);
                                                            if($passcrypt==$resobj->Password){
                                                                if($uppdw==$upcpdw){
                                                                    require("conn.php");
                                                                    $uppass="UPDATE `customers` SET `Password`=md5('".$upcpdw."'),`DateUpdate`=now() WHERE CustomerID=".$idc;
                                                                    $ex3=$conn->exec($uppass);
                                                                    $log="INSERT INTO `logs`(`CustomerID`, `CustomerEmail`, `Activity`, `DateTime`) VALUES (".$CustomerID.",'".$email."','Password Updated from ($upoldpwd) to ($upcpdw) ',now())";
                                                                    $execlog=$conn->exec($log);
                                                                    if($ex3){
                                                                        echo '<script> 
                                                                                  
                                                                                toastr.options = {
                                                                                    "closeButton": false,
                                                                                    "debug": false,
                                                                                    "newestOnTop": false,
                                                                                    "progressBar": true,
                                                                                    "positionClass": "toast-top-center",
                                                                                    "preventDuplicates": false,
                                                                                    "onclick": null,
                                                                                    "showDuration": "300",
                                                                                    "hideDuration": "1000",
                                                                                    "timeOut": "2500",
                                                                                    "extendedTimeOut": "1000",
                                                                                    "showEasing": "swing",
                                                                                    "hideEasing": "linear",
                                                                                    "showMethod": "fadeIn",
                                                                                    "hideMethod": "fadeOut"
                                                                                }
                                                                                toastr["success"]("Password Updated!", "Account :");
                                                                                setTimeout(function() {
                                                                                    window.location.replace("?p=Settings");
                                                                                }, 1500);
                                                                                </script>';
                                                                    }else{
                                                                        echo '<script>      
                                                                                document.addEventListener("DOMContentLoaded", function() {
                                                                                    toastr.options = {
                                                                                        "closeButton": false,
                                                                                        "debug": false,
                                                                                        "newestOnTop": false,
                                                                                        "progressBar": true,
                                                                                        "positionClass": "toast-top-center",
                                                                                        "preventDuplicates": false,
                                                                                        "onclick": null,
                                                                                        "showDuration": "300",
                                                                                        "hideDuration": "1000",
                                                                                        "timeOut": "2500",
                                                                                        "extendedTimeOut": "1000",
                                                                                        "showEasing": "swing",
                                                                                        "hideEasing": "linear",
                                                                                        "showMethod": "fadeIn",
                                                                                        "hideMethod": "fadeOut"
                                                                                    };
                                                                                    toastr["error"]("Error Update!", "Account :");
                                                                                    document.getElementById("Security").click();
                                                                                });     
                                                                            </script>';
                                                                        
                                                                    }
                                                                }else{
                                                                    echo '<script>  
                                                                            document.addEventListener("DOMContentLoaded", function() {
                                                                                toastr.options = {
                                                                                    "closeButton": false,
                                                                                    "debug": false,
                                                                                    "newestOnTop": false,
                                                                                    "progressBar": true,
                                                                                    "positionClass": "toast-top-center",
                                                                                    "preventDuplicates": false,
                                                                                    "onclick": null,
                                                                                    "showDuration": "300",
                                                                                    "hideDuration": "1000",
                                                                                    "timeOut": "2500",
                                                                                    "extendedTimeOut": "1000",
                                                                                    "showEasing": "swing",
                                                                                    "hideEasing": "linear",
                                                                                    "showMethod": "fadeIn",
                                                                                    "hideMethod": "fadeOut"
                                                                                };
                                                                                toastr["error"]("Password Not Match!", "Account :");
                                                                                document.getElementById("Security").click();
                                                                            });         
                                                                        </script>';
                                                                }
                                                            }else{
                                                                echo '<script>           
                                                                document.addEventListener("DOMContentLoaded", function() {
                                                                    toastr.options = {
                                                                        "closeButton": false,
                                                                        "debug": false,
                                                                        "newestOnTop": false,
                                                                        "progressBar": true,
                                                                        "positionClass": "toast-top-center",
                                                                        "preventDuplicates": false,
                                                                        "onclick": null,
                                                                        "showDuration": "300",
                                                                        "hideDuration": "1000",
                                                                        "timeOut": "2500",
                                                                        "extendedTimeOut": "1000",
                                                                        "showEasing": "swing",
                                                                        "hideEasing": "linear",
                                                                        "showMethod": "fadeIn",
                                                                        "hideMethod": "fadeOut"
                                                                    };
                                                                    toastr.error("Old Password Incorrect!", "Account :");
                                                                    document.getElementById("Security").click();
                                                                  });
                                                                                </script>';
                                                            }
                                                            $conn=Null;
                                                        }
                                                        echo "<script>document.getElementById('Security').click();</script>";
                                                    }
                                                ?>
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
                        
                    </div>
                </div>
            </div>
        </div>
    </section>