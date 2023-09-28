<!-- START PAGE CONTENT-->
<?php require("conn.php");
$prod="select * from products";
$res=$conn->query($prod);
$nbp=$res->rowCount();
$nbrpage=ceil($nbp/NBCPP);
if(isset($_GET['n'])){
    $currentp=$_GET['n'];
}else{
    $currentp=1;
}
$nextpage=$currentp+1;
$prevpage=$currentp-1;
$lastpage=$nbrpage;
$poscateg=($currentp-1)*NBCPP;


?>
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-6">
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
        <div class="col-lg-3 col-md-6">
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
                        <div class="m-b-5">Current Active Products</div><i class="fa fa-dropbox widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
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
                        <div class="m-b-5">Current Inactive Products</div><i class="fa fa-dropbox widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Latest Produscts</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="ibox-body">
                <?php 
                        $categ2="select * from products join category on products.Product_Category=category.Id_category limit ".$poscateg.",".NBCPP;
                        $res2=$conn->query($categ2);
                        if($res2){
                            $resobj2=$res2->fetchAll(PDO::FETCH_OBJ);
                            echo'<table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th width="50px;">Size</th>
                                        <th>Gender</th>
                                        <th width="90px">Price</th>
                                        <th width="50px;">En Stock</th>
                                        <th>Image 1</th>
                                        <th>Image 2</th>
                                        <th>Image 3</th>
                                        <th>Status</th>
                                        <th width="120px;">Date Creation</th>
                                        <th width="120px;">Date Update</th>
                                        <th width="50px;"></th>
                                    </tr></thead><tbody>';
                            foreach($resobj2 as $cle=>$val){
                                    echo '<tr>
                                            <td>'.$val->Product_name.'</td>
                                            <td>'.$val->Title_category.'</td>
                                            <td>'.$val->Product_Size.'</td>
                                            <td>'.$val->PGender.'</td>
                                            <td>'.$val->Product_Price.' DH</td>
                                            <td>'.$val->Stock.'</td>
                                            <td><img src="./assets/img/Products/'.$val->Product_img1.'"  style="width: 100%;aspect-ratio:2/2;object-fit:contain;" /></td>
                                            <td><img src="./assets/img/Products/'.$val->Product_img2.'" style="width: 100%;aspect-ratio:2/2;object-fit:contain;" /></td>
                                            <td><img src="./assets/img/Products/'.$val->Product_img3.'" style="width: 100%;aspect-ratio:2/2;object-fit:contain;" /></td>
                                            <td>';
                                                if($val->Product_Status=="Active"){
                                                    echo '<span class="badge badge-success">'.$val->Product_Status.'</span>';
                                                }else{
                                                    echo '<span class="badge badge-danger">'.$val->Product_Status.'</span>';
                                                    
                                                }
                                    echo '</td>
                                            <td>'.$val->DateProdCreation.'</td>
                                            <td>'.$val->Date_Update.'</td>
                                            <td>
                                            <a href="?p=EditProd&id='.$val->Product_id.'"><i class="fa fa-pencil-square-o"></i></a>
                                            <a onClick="return confirm(\' Are you Sure !\');" href="?p=delProduct&id='.$val->Product_id.'"><i class="fa fa-trash"></i></a>
                                        </td>
                                        </tr>';
                                
                            }
                        }else{
                            echo "invalide querry!!";
                        }
                        $conn=NULL;
                        ?>
                        </tbody>
                    </table>
                    <div class="">
                        <ul class="pagination justify-content-center" style="margin-top: 10px;">
                        <?php
                            echo'<li class="page-item"><a class="page-link" href="?p=OvProducts&n=1">&lt;&lt;</a></li>';
                                if($currentp==1){
                            echo'<li class="page-item disabled"><a class="page-link" href="#">&lt;</a></li>';}
                            else{
                                    echo'<li class="page-item"><a class="page-link" href="?p=OvProducts&n='.$prevpage.'">&lt;</a></li>';
                            }
                            echo'<li class="page-item"><a class="page-link">--'.$currentp.'/'.$lastpage.'--</a></li>';
                            if($currentp==$lastpage){
                            echo'<li class="page-item disabled"><a class="page-link" href="#">&gt;</a></li>';}
                            else{
                                    echo'<li class="page-item"><a class="page-link" href="?p=OvProducts&n='.$nextpage.'">&gt;</a></li>';
                            }
                            echo'<li class="page-item"><a class="page-link" href="?p=OvProducts&n='.$lastpage.'">&gt;&gt;</a></li>';
                        ?>
                        </ul>
                    </div>  
                </div>
                
            </div>
            
        </div>
    </div>

    <div class="row">
        
    </div>
</div>
<!-- END PAGE CONTENT-->