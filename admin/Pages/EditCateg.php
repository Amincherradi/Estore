<?php
    $Catname=$filecateg=$statusct=$edCatname=$edfilecateg=$edstatusct="";
    $Catnameer=$filecateger=$statuscter=$edCatnameer=$edfilecateger=$edstatuscter="";
    
    require("conn.php");
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }
    $categ="select * from category where Id_category=".$id;
    $res=$conn->query($categ);
    $resob=$res->fetch(PDO::FETCH_OBJ);
    $nbcat=$res->rowCount();
    $Catname=$resob->Title_category;
    $filecateg=$resob->Image_category;
    $statusct=$resob->Status_category;
?>
<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <h1>Categories</h1>
    <br>                    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Add Categories</div>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-body">
                    <div class="tab-pane" id="tab-2">
                        <?php 
                        if($nbcat>0){
                        ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-3 form-group">
                                        <label>Category Title</label><span class="font-16 text-danger">&nbsp;&nbsp;*<?php echo $edCatnameer;?></span>
                                        <input class="form-control" name="edCatname" type="text" placeholder="Category Name" value="<?php echo $Catname;?>"><br>
                                        <label>Category Image</label><span class="font-16 text-danger">&nbsp;&nbsp;*<?php echo $edfilecateger;?></span>
                                        <input type="file" name="edfilecateg"  class="form-control col-lg-12" id="uploadImage1" accept="image/png,image/jpeg,image/jpg,image/webp" value="<?php echo $filecateg;?>" onchange="PreviewImage1();"/>
                                        
                                    </div>
                                    <div class="col-sm-3 form-group">
                                    <label>Status</label><span class="font-16 text-danger">&nbsp;&nbsp;*<?php echo $edstatuscter;?></span>
                                    <select class="form-control" name="edstatusct">
                                        <option value="Active" <?php if(isset($statusct) && $statusct=="Active") echo 'selcted'?> >Active</option>
                                        <option value="Inactive" <?php if(isset($statusct) && $statusct=="Inactive") echo 'selected';?>>Inactive</option>
                                    </select><br><br>
                                    <input type="submit" name="Editcateg" class="btn btn-primary" value="Edit Category">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <img id="uploadPreview1" src="assets/img/Category/<?php echo $filecateg;?>" alt="Votre Profile"  style="border: 1px solid black; width:auto;height: auto;">
                                        
                                    </div>
                                </div>
                            </form>
                            <?php }
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
                                    if(isset($_POST['Editcateg'])){
                                        if(empty($_POST["edCatname"])) {
                                            $edCatnameer = "Required!";
                                        } else {
                                            $edCatname = $_POST["edCatname"];
                                        }
                                        if(empty($_POST["edstatusct"])) {
                                            $edstatuscter = "Required!";
                                        } else {
                                            $edstatusct = $_POST["edstatusct"];
                                        }
                                        if(empty($_FILES['edfilecateg']['tmp_name'])){
                                            $edfilecateger="Required!";
                                        }
                                        else{
                                            $edfilecateg=$_FILES['edfilecateg']['tmp_name'];
                                        }
                                    }
                                }
                                if(isset($_POST['Editcateg'])){
                                    if($edCatname!="" && $edstatusct!=""){
                                        require("conn.php");
                                        $insert="UPDATE `category` SET `Title_category`='".$edCatname."',`Status_category`='".$edstatusct."' WHERE Id_category=".$id;
                                        $exec=$conn->exec($insert);
                                        if($exec){
                                            echo "<script>alert('Category Updated!')</script>";
                                        }else{
                                            echo "Querry invalide!";
                                        }
                                        $conn=Null;
                                    }
                                    if($edfilecateg!=""){
                                        if(is_uploaded_file($edfilecateg)){
                                            if($_FILES['edfilecateg']['size']<=800000){
                                                $info=pathinfo($_FILES['edfilecateg']['name']);
                                                $extension=$info['extension'];//recuperation de l'extension du fichier
                                                $ext_auto=array('jpg','png','jpeg','webp'); //liste des extensions autorisées
                                                if(in_array($extension,$ext_auto))
                                                {   
                                                    
                                                        $edfilecateg=$_FILES['edfilecateg']['name'];
                                                        require("conn.php");
                                                        $insert="UPDATE `category` SET `Image_category`='".$edfilecateg."' WHERE Id_category=".$id;
                                                        $exec=$conn->exec($insert);
                                                        if($exec){
                                                            move_uploaded_file($_FILES['edfilecateg']['tmp_name'],"./assets/img/Category/".$_FILES['edfilecateg']['name']);
                                                            echo "<script>alert('Image Updated!')</script>";
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
                                    } echo "<script>location.replace('?p=categ')</script>";
                                }
                                $conn=Null;    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->
