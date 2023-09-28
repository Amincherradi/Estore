<?php
    $Catname=$filecateg=$statusct=$edCatname=$edfilecateg=$edstatusct="";
    $Catnameer=$filecateger=$statuscter=$edCatnameer=$edfilecateger=$edstatuscter="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['Addcateg'])){
            if(empty($_POST["Catname"])) {
                $Catnameer = "Required!";
            } else {
                $Catname = $_POST["Catname"];
            }
            if(empty($_POST["statusct"])) {
                $statuscter = "Required!";
            } else {
                $statusct = $_POST["statusct"];
            }
            if(empty($_FILES['filecateg']['tmp_name'])){
                $filecateger="Required!";
            }
            else{
                $filecateg=$_FILES['filecateg']['tmp_name'];
            }
        }
        
    }
    require("conn.php");
    $categ="select * from category";
    $res=$conn->query($categ);
    $nbcat=$res->rowCount();
    $nbrpage=ceil($nbcat/NBCPP);
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
<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <h1>Categories</h1><h5><i class="text-success" style="font-size:30px;">■</i>Active <i class="text-danger" style="font-size:30px;">■</i>Inactive</h5>
    <br>
    <div class="row">
        <?php 
            if($res){
                $resobj=$res->fetchAll(PDO::FETCH_OBJ);
                foreach($resobj as $cle=>$val){
                    if($val->Status_category=="Active"){
                        echo 
                            '<div class="col-lg-3 col-md-6">
                                <div class="ibox bg-success color-white widget-stat">
                                    <div class="ibox-body">
                                        <img src="assets/img/Category/'.$val->Image_category.'" style="width: 100%;aspect-ratio:1/0;" alt="">
                                    </div>
                                </div>
                            </div>';
                    }else{
                        echo 
                            '<div class="col-lg-3 col-md-6">
                                <div class="ibox bg-danger color-white widget-stat">
                                    <div class="ibox-body">
                                        <img src="assets/img/Category/'.$val->Image_category.'" style="width: 100%;aspect-ratio:1/0;" alt="">
                                    </div>
                                </div>
                            </div>';
                    }
                }
            }else{
                echo "invalide querry!!";
            }
            $res->closeCursor();
        ?>
    </div>
    
    <div class="row">
        <div class="col-lg-7">
            <div class="ibox">
                <div class="ibox-head" >
                    <div class="ibox-title">Categories</div>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <script type="text/javascript">
                    
                        function Display(){
                            var myDiv = document.getElementById("editca2");
                            myDiv.classList.remove("collapse");
                            var myDiv2 = document.getElementById("editca");
                            myDiv2.classList.remove("collapse-mode");
                        }
                </script>
                <div class="ibox-body">
                    <?php 
                        $categ2="select * from category limit ".$poscateg.",".NBCPP;
                        $res2=$conn->query($categ2);
                        if($res2){
                            $resobj2=$res2->fetchAll(PDO::FETCH_OBJ);
                            echo'<table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="20px">Category ID</th>
                                        <th width="150px">Category Image</th>
                                        <th width="auto">Category Title</th>
                                        <th width="150px">Status</th>
                                        <th width=""></th>
                                    </tr></thead><tbody>';
                            foreach($resobj2 as $cle=>$val){
                                echo '<tr>
                                        <td>'.$val->Id_category.'</td>
                                        <td><img src="assets/img/Category/'.$val->Image_category.'" alt=""></td>
                                        <td>'.$val->Title_category.'</td>
                                        <td>';
                                            if($val->Status_category=="Active"){
                                                echo '<span class="badge badge-success">'.$val->Status_category.'</span>';
                                            }else{
                                                echo '<span class="badge badge-danger">'.$val->Status_category.'</span>';
                                            }
                                        echo '</td>
                                        <td>
                                            <a href="?p=EditCateg&id='.$val->Id_category.'"><i class="fa fa-pencil-square-o"></i></a>
                                            <a onClick="return confirm(\' Are you Sure !\');" href="?p=delCategory&id='.$val->Id_category.'"><i class="fa fa-trash"></i></a>
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
                            echo'<li class="page-item"><a class="page-link" href="?p=categ&n=1">&lt;&lt;</a></li>';
                                if($currentp==1){
                            echo'<li class="page-item disabled"><a class="page-link" href="#">&lt;</a></li>';}
                            else{
                                    echo'<li class="page-item"><a class="page-link" href="?p=categ&n='.$prevpage.'">&lt;</a></li>';
                            }
                            echo'<li class="page-item"><a class="page-link">--'.$currentp.'/'.$lastpage.'--</a></li>';
                            if($currentp==$lastpage){
                            echo'<li class="page-item disabled"><a class="page-link" href="#">&gt;</a></li>';}
                            else{
                                    echo'<li class="page-item"><a class="page-link" href="?p=categ&n='.$nextpage.'">&gt;</a></li>';
                            }
                            echo'<li class="page-item"><a class="page-link" href="?p=categ&n='.$lastpage.'">&gt;&gt;</a></li>';
                        ?>
                        </ul>
                    </div>
                </div>
                
            </div>
            
        </div>
        <div class="col-lg-5">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Add Category</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <div class="tab-pane" id="tab-2">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <label>Category Title</label><span class="font-16 text-danger">&nbsp;&nbsp;*<?php ?></span>
                                        <input class="form-control" name="Catname" type="text" placeholder="Category Name" value=""><br>
                                        <label>Category Image</label><span class="font-16 text-danger">&nbsp;&nbsp;*<?php ?></span>
                                        <input type="file" name="filecateg"  class="form-control col-lg-12" id="uploadImage" accept="image/png,image/jpeg,image/jpg,image/webp" value="" onchange="PreviewImage();"/>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-12 form-group">
                                        <img id="uploadPreview" src="assets/img/Category/alt.jpg" alt="Votre Profile" style="border: 1px solid black; width:auto;height: auto;">
                                        
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Status</label><span class="font-16 text-danger">&nbsp;&nbsp;*<?php ?></span>
                                    <select class="form-control" name="statusct">
                                        <option value="" selected>--Status--</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select><br>
                                    
                                    </div>
                                    <input type="submit" name="Addcateg" class="btn btn-primary" value="Add Category">
                            </form>
                            <?php
                                if(isset($_POST['Addcateg']) && $filecateg!="" && $Catname!="" && $statusct!=""){
                                    if(is_uploaded_file($filecateg)){
                                        if($_FILES['filecateg']['size']<=800000){
                                            $info=pathinfo($_FILES['filecateg']['name']);
                                            $extension=$info['extension'];//recuperation de l'extension du fichier
                                            $ext_auto=array('jpg','png','jpeg','webp'); //liste des extensions autorisées
                                            if(in_array($extension,$ext_auto))
                                            {   
                                                $filecateg=$_FILES['filecateg']['name'];
                                                require("conn.php");
                                                $insert="INSERT INTO `category`(`Image_category`, `Title_category`, `Status_category`) VALUES ('".$filecateg."','".$Catname."','".$statusct."');";
                                                $exec=$conn->exec($insert);
                                                if($exec){
                                                    move_uploaded_file($_FILES['filecateg']['tmp_name'],"assets/img/Category/".$_FILES['filecateg']['name']);
                                                    move_uploaded_file($_FILES['filecateg']['tmp_name'],"../../assets/images/Category".$_FILES['filecateg']['name']);
                                                    echo "<script>alert('Category Added!')</script>";
                                                    echo "<script>location.replace('?p=categ')</script>";
                                                }else{
                                                    echo "Querry invalide!";
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
                            ?>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
