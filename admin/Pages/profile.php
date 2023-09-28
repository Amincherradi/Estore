<?php
    require("conn.php");
    $Profile="";
    $Profileer="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['upprofile'])){
            if(empty($_FILES['UProfile']['tmp_name'])){
                $Profileer="Required!";
            }
            else{
                $Profile=$_FILES['UProfile']['tmp_name'];
            }
        }
    }
?>
<div class="page-heading">
                <h1 class="page-title">Profile</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Profile</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="ibox">
                            <div class="ibox-body text-center">
                                <div class="m-t-15">
                                                    
                                    <center>
                                        <div class="container">
                                            <div class="avatar-upload">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <div class="avatar-edit">
                                                    <input type="file" name="UProfile"  class="form-control col-lg-12" id="uploadImage1" accept="image/png,image/jpeg,image/jpg,image/webp" value="" onchange="PreviewImage1();"/>
                                  
                                                       <label for="uploadImage1"></label>
                                                    </div>
                                                    <div class="avatar-preview">
                                                        <div id="imagePreview" >
                                                            <img id="uploadPreview1" style="border-radius: 50%; height: 181px;width: 190px;" src="assets/img/users/<?php echo $_SESSION['UserImg'];?>" alt="" >
                                                        </div><span class="text text-danger"><?php echo $Profileer;?></span>
                                                    </div><br><input type="submit" name="upprofile" class="btn btn-primary" value="Update Photo">
                                                </form>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                                <?php
                                if($_SERVER["REQUEST_METHOD"] == "POST"){
                                    if(isset($_POST['upprofile'])){
                                        if($Profile!=""){
                                            if(is_uploaded_file($Profile)){
                                                if($_FILES['UProfile']['size']<=MB){
                                                    $info=pathinfo($_FILES['UProfile']['name']);
                                                    $extension=$info['extension'];//recuperation de l'extension du fichier
                                                    $ext_auto=array('jpg','png','jpeg','webp'); //liste des extensions autorisées
                                                    if(in_array($extension,$ext_auto)){   
                                                        $Profile=$_FILES['UProfile']['name'];
                                                        if(isset($_SESSION['IdUser'])){
                                                            $id=$_SESSION['IdUser'];
                                                        }
                                                        $sql="UPDATE `admin` SET `UserImg`='".$Profile."' WHERE ID=".$id;
                                                        $exec=$conn->exec($sql);
                                                        if($exec){
                                                            move_uploaded_file($_FILES['UProfile']['tmp_name'],"./assets/img/users/".$_FILES['UProfile']['name']);
                                                            echo "updated!";
                                                            echo "<script>alert('You Need To Re Login!')</script>";
                                                        }else{
                                                            echo "Error";
                                                        }
                                                        $conn=Null;
                                                    }else{
                                                        echo "Extension invalide!";
                                                    }    
                                                }else{
                                                    echo "File so Heavy!";
                                                }     
                                            }else{
                                                echo "Error Upload Image!";
                                            }
                                        }
                                    }
                                }
                                
                                ?>
                                <h5 class="font-strong m-b-10 m-t-10"><?php echo $_SESSION['Fname'];?>&nbsp;&nbsp;<?php echo $_SESSION['Lname'];?></h5>
                                <div class="m-b-20 text-muted">Web Developer</div>
                                <div class="profile-social m-b-20">
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </div>
                                
                            </div>
                        </div>
                        <div class="ibox">
                            <div class="ibox-body">
                                <div class="row text-center m-b-20">
                                    <div class="col-4">
                                        <div class="font-24 profile-stat-count">T</div>
                                        <div class="text-muted">T</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="font-24 profile-stat-count">$780</div>
                                        <div class="text-muted">Sales</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="font-24 profile-stat-count">T</div>
                                        <div class="text-muted">T</div>
                                    </div>
                                </div>
                                <p class="text-center">p</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="ibox">
                            <div class="ibox-body">
                                <ul class="nav nav-tabs tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab-1" data-toggle="tab"><i class="ti-bar-chart"></i> Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-2" data-toggle="tab"><i class="ti-settings"></i> Settings</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-3" data-toggle="tab"><i class="ti-announcement"></i> Feeds</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab-1">
                                        <div class="row">
                                            <div class="col-md-6" style="border-right: 1px solid #eee;">
                                                <h5 class="text-info m-b-20 m-t-10"><i class="fa fa-bar-chart"></i> Month Statistics</h5>
                                                <div class="h2 m-0">$12,400<sup>.60</sup></div>
                                                <div><small>Month income</small></div>
                                                <div class="m-t-20 m-b-20">
                                                    <h5 class="text-info m-b-20 m-t-10"><i class="fa fa-users"></i> Month Customers</h5>
                                                    <div class="h2 m-0">12</div>
                                                    <div><small>Month Customers</small></div>
                                                </div>
                                            
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="text-info m-b-20 m-t-10"><i class="fa fa-comment"></i> Latest Comments</h5>
                                                <ul class="media-list media-list-divider m-0">
                                                    <li class="media">
                                                        <a class="media-img" href="javascript:;">
                                                            <img class="img-circle" src="./assets/img/users/avatar5.png" width="40" />
                                                        </a>
                                                        <div class="media-body">
                                                            <div class="media-heading">Name <small class="float-right text-muted">12:05</small></div>
                                                            <div class="font-13">Test 1</div>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <a class="media-img" href="javascript:;">
                                                            <img class="img-circle" src="./assets/img/users/avatar5.png" width="40" />
                                                        </a>
                                                        <div class="media-body">
                                                            <div class="media-heading">Name <small class="float-right text-muted">12:05</small></div>
                                                            <div class="font-13">Test 1</div>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <a class="media-img" href="javascript:;">
                                                            <img class="img-circle" src="./assets/img/users/avatar5.png" width="40" />
                                                        </a>
                                                        <div class="media-body">
                                                            <div class="media-heading">Name <small class="float-right text-muted">12:05</small></div>
                                                            <div class="font-13">Test 1</div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h4 class="text-info m-b-20 m-t-20"><i class="fa fa-shopping-basket"></i> Latest Orders</h4>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th width="91px">Date</th>
                                </tr>
                            </thead>
                            <tbody>                                
                            <tr>
                                <td>
                                    <a href="?p=invoice">1</a>
                                </td>
                                <td>Amine</td>
                                <td>$50.00</td>
                                <td>
                                    <span class="badge badge-success">Shipped</span>
                                </td>
                                <td>1/08/2023</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="invoice.html">2</a>
                                </td>
                                <td>Marwa</td>
                                <td>$50.00</td>
                                <td>
                                    <span class="badge badge-default">Pending</span>
                                </td>
                                <td>1/08/2023</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="invoice.html">3</a>
                                </td>
                                <td>Yahya</td>
                                <td>$87.60</td>
                                <td>
                                    <span class="badge badge-warning">Expired</span>
                                </td>
                                <td>1/08/2023</td>
                            </tr>
                            </tbody>
                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab-2">
                                        <form action="javascript:void(0)">
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>First Name</label>
                                                    <input class="form-control" type="text" placeholder="<?php echo $_SESSION['Fname'];?>">
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label>Last Name</label>
                                                    <input class="form-control" type="text" placeholder="<?php echo $_SESSION['Lname'];?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" type="text" placeholder="<?php echo $_SESSION['Email'];?>">
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" type="password" placeholder="Password">
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label>Confirm Password</label>
                                                    <input class="form-control" type="password" placeholder="Conf.Password">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="ui-checkbox">
                                                    <input type="checkbox">
                                                    <span class="input-span"></span>Remamber me</label>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-default" type="button">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="tab-3">
                                        <h5 class="text-info m-b-20 m-t-20"><i class="fa fa-bullhorn"></i> Logs</h5>
                                        <ul class="media-list media-list-divider m-0">
                                            <li class="media">
                                                <div class="media-img"><i class="ti-user font-18 text-muted"></i></div>
                                                <div class="media-body">
                                                    <div class="media-heading">New customer <small class="float-right text-muted">12:05</small></div>
                                                    <div class="font-13">Lorem Ipsum is simply dummy text.</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-img"><i class="ti-info-alt font-18 text-muted"></i></div>
                                                <div class="media-body">
                                                    <div class="media-heading text-warning">Server Warning <small class="float-right text-muted">12:05</small></div>
                                                    <div class="font-13">Lorem Ipsum is simply dummy text.</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-img"><i class="ti-announcement font-18 text-muted"></i></div>
                                                <div class="media-body">
                                                    <div class="media-heading">7 new feedback <small class="float-right text-muted">Today</small></div>
                                                    <div class="font-13">Lorem Ipsum is simply dummy text.</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-img"><i class="ti-check font-18 text-muted"></i></div>
                                                <div class="media-body">
                                                    <div class="media-heading text-success">Issue fixed <small class="float-right text-muted">12:05</small></div>
                                                    <div class="font-13">Lorem Ipsum is simply dummy text.</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-img"><i class="ti-shopping-cart font-18 text-muted"></i></div>
                                                <div class="media-body">
                                                    <div class="media-heading">7 New orders <small class="float-right text-muted">12:05</small></div>
                                                    <div class="font-13">Lorem Ipsum is simply dummy text.</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-img"><i class="ti-reload font-18 text-muted"></i></div>
                                                <div class="media-body">
                                                    <div class="media-heading text-danger">Server warning <small class="float-right text-muted">12:05</small></div>
                                                    <div class="font-13">Lorem Ipsum is simply dummy text.</div>
                                                </div>
                                            </li>
                                        </ul>
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