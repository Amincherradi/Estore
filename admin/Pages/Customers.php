<?php
    require("conn.php");
    $Profile=$Phone=$Adress=$City=$Zipcode="";
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
    <h1 class="page-title">Customers</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Overview</li>
    </ol>
</div><br>
<div class="row fade-in-up">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">
                        <?php 
                        $req="select count(*) as TotalC from customers";
                        $sql=$conn->query($req);
                        if($sql){
                            $resobj=$sql->fetch(PDO::FETCH_OBJ);
                            echo   $resobj->TotalC;
                        }                
                        ?>
                    </h2>
                    <div class="m-b-5">All Customers</div><i class="fa fa-users widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">
                        <?php 
                            $req2="select count(*) as TotalC from customers where CStatus='Activated'";
                            $sql2=$conn->query($req2);
                            if($sql2){
                                $resobj=$sql2->fetch(PDO::FETCH_OBJ);
                                echo   $resobj->TotalC;
                            }                
                        ?>
                        </h2>
                        <div class="m-b-5">Current Active Customers</div><i class="fa fa-user-plus widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">
                        <?php 
                            $req3="select count(*) as TotalC from customers where CStatus='Suspended'";
                            $sql3=$conn->query($req3);
                            if($sql3){
                                $resobj=$sql3->fetch(PDO::FETCH_OBJ);
                                echo   $resobj->TotalC;
                            }               
                        ?>
                        </h2>
                        <div class="m-b-5">Suspended Customers</div><i class="fa fa-user-times widget-stat-icon"></i>
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
                        <div class="tab-pane fade show active">
                            <div class="row">
                                                
                                                
                            </div>
                            <h4 class="text-info m-b-20 m-t-20"><i class="fa fa-users"></i> Latest Customers</h4>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="50px;">Photo</th>
                                        <th>FName</th>
                                        <th>LName</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Adress</th>
                                        <th>City</th>
                                        <th>ZipCode</th>
                                        <th>Password</th>
                                        <th>Status</th>
                                        <th>DateCreate</th>
                                        <th>DateUpdate</th>
                                        <th width="90px;"></th>
                                    </tr>
                                </thead>
                                <tbody><!-- badge-default badge-warning--> 
                                    <?php
                                    $cust="select * from customers";
                                    $disp=$conn->query($cust);
                                    if($disp){
                                        $dispall=$disp->fetchall(PDO::FETCH_OBJ);
                                        $nbr=$disp->rowCount();
                                        if($nbr>0){
                                        foreach($dispall as $cle=>$val){
                                            echo '
                                            <tr> 
                                            <td><img src="./assets/img/customers/'.$val->Photo.'" alt="" style="width: 100%;aspect-ratio:2/2;object-fit:contain;border-radius:50%;"></td>
                                            <td>'.$val->FName.'</td>
                                            <td>'.$val->LName.'</td>
                                            <td>'.$val->Email.'</td>
                                            <td>'.$val->Phone.'</td>
                                            <td>'.$val->Adress.'</td>
                                            <td>'.$val->City.'</td>
                                            <td>'.$val->ZipCode.'</td>
                                            <td>'.$val->Password.'</td>
                                            <td>';
                                            if($val->CStatus=="Activated"){
                                                echo '<span class="badge badge-success">'.$val->CStatus.'</span>';
                                            }else{
                                                echo '<span class="badge badge-warning">'.$val->CStatus.'</span>';
                                            }
                                             echo '   
                                            </td>
                                            <td>'.$val->DateCreate.'</td>
                                            <td>'.$val->DateUpdate.'</td>
                                            <td>
                                                <a href="?p=DispCust&id='.$val->CustomerID.'"><i class="fa fa-eye"></i></a>
                                                <a href="?p=EditCusto&id='.$val->CustomerID.'"><i class="fa fa-pencil-square-o"></i></a>
                                                <a onClick="return confirm(\' Are you Sure !\');" href="?p=delCusto&id='.$val->CustomerID.'"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                            ';
                                        }
                                    }else{
                                        echo "<tr><td colspan='5' align='center'>No Customers Found!</td></tr>";
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