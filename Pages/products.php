<?php require("conn.php");
if(isset($_GET['ca'])){
    $categ=$_GET['ca'];
    if(isset($_GET['pgen'])){
        $pgen=$_GET['pgen'];
        $prod="select * from products join category on products.Product_Category=category.Id_category where category.Title_category='".$categ."' and products.PGender='".$pgen."' and products.Product_Status='Active'";
    }else{
        $prod="select * from products join category on products.Product_Category=category.Id_category where category.Title_category='".$categ."' and products.Product_Status='Active'";
    }
}else{
    if(isset($_GET['pgen']) && $_GET['pgen']=="AM" ){
        $prod="select * from products where PGender='MEN' and Product_Status='Active'";
    }else if(isset($_GET['pgen']) && $_GET['pgen']=="AW" ){
        $prod="select * from products where PGender='Women' and Product_Status='Active'";
    }
}
$res=$conn->query($prod);
$nbp=$res->rowCount();
$nbrpage=ceil($nbp/NBCPP);
if(isset($_GET['pi'])){
    $currentp=$_GET['pi'];
}else{
    $currentp=1;
}
$nextpage=$currentp+1;
$prevpage=$currentp-1;
$lastpage=$nbrpage;
$pospage=($currentp-1)*NBCPP;
?>
    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/bg/products.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2><em>Products</em> </h2>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section" id="trainers">
        <div class="container col-9">
            <br>
            <br>
            <div class="row">
            <div class='col-lg-4'>
                
            </div>
            </div>
            <br>
            <br>
            <div class="row">
                <?php  
                if(isset($_GET['ca'])){
                    $categ=$_GET['ca'];
                    if(isset($_GET['pgen'])){
                        $pgen=$_GET['pgen'];
                        $prod2="select * from products join category on products.Product_Category=category.Id_category where category.Title_category='".$categ."' and products.PGender='".$pgen."' and products.Product_Status='Active' limit ".$pospage.",".NBCPP;
                    }else{
                        $prod2="select * from products join category on products.Product_Category=category.Id_category where category.Title_category='".$categ."' and products.Product_Status='Active' limit ".$pospage.",".NBCPP;
                    }
                }else{
                    if(isset($_GET['pgen']) && $_GET['pgen']=="AM" ){
                        $prod2="select * from products join category on products.Product_Category=category.Id_category where products.PGender='MEN' and products.Product_Status='Active' limit ".$pospage.",".NBCPP;
                    }else if(isset($_GET['pgen']) && $_GET['pgen']=="AW" ){
                        $prod2="select * from products join category on products.Product_Category=category.Id_category where products.PGender='Women' and products.Product_Status='Active' limit ".$pospage.",".NBCPP;
                    }
                }
                $res2=$conn->query($prod2);
                $resob2=$res2->fetchAll(PDO::FETCH_OBJ);
                if($resob2){
                    foreach($resob2 as $cle=>$val){
                        echo '
                        <div class="col-md-3">
                        <div class="wsk-cp-product">
                          <div class="wsk-cp-img">
                          <a href="?p=product-details&pc='.$val->Product_id.'"><img src="assets/images/Products/'.$val->Product_img1.'" alt="Product" class="img-responsive" /></a>
                          </div>
                          <div class="wsk-cp-text">
                            <div class="category">
                              <span>'.$val->Title_category.'</span>
                            </div>
                            <div class="title-product">
                              <p>'.$val->Product_name.'</p>
                            </div>
                            <div class="card-footer">
                              <div class="wcf-left"><span class="price">'.$val->Product_Price.' DH</span></div>
                              <div class="wcf-right"><a href="#" class="buy-btn" idp="'.$val->Product_id.'" data-pc="addcart" data-bs-toggle="modal" data-bs-target="#addedtocart"><i class="fa fa-cart-plus"></i></a></div>
                            </div>
                          </div>
                        </div>
                      </div>
                        ';
                       /*  echo "<div class='col-sm-3'>
                        <div class='trainer-item'>
                            <div class='image-thumb'>
                                <a href='?p=product-details&pc=".$val->Product_id."'><img src='assets/images/Products/".$val->Product_img1."' alt='' class='img' style='aspect-ratio:1/0;'></a>
                            </div>
                            <div class='down-content'>
                                <span>
                                    <sup>DH</sup>".$val->Product_Price."
                                </span>

                                    <h4>".$val->Product_name."</h4>

                                    <a href='?p=product-details'><p>More+</p></a>
                                <ul class='social-icons'>
                                    <li>
                                    <a href='?p=product-details&pc=".$val->Product_id."' class='btn btn-primary btn-sm' style='color: white;'>Order</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>";  */
                   
                }
                }
                
                 ?>
            </div>
            
            <br>
                
            <div class="">
                <ul class="pagination justify-content-center" style="margin-top: 10px;">
                <?php
                if(isset($_GET['AM'])){
                    echo'<li class="page-item"><a class="page-link" href="?p=Products&pgen=AM&pi=1">&lt;&lt;</a></li>';
                }else{
                    echo'<li class="page-item"><a class="page-link" href="?p=Products&pgen=AW&pi=1">&lt;&lt;</a></li>';
                }
                    
                        if($currentp==1){
                    echo'<li class="page-item disabled"><a class="page-link" href="#">&lt;</a></li>';}
                    else{
                        if(isset($_GET['AM'])){
                            echo'<li class="page-item"><a class="page-link" href="?p=Products&pgen=AM&pi='.$prevpage.'">&lt;</a></li>';
                        }else{
                            echo'<li class="page-item"><a class="page-link" href="?p=Products&pgen=AW&pi='.$prevpage.'">&lt;</a></li>';
                        }
                            
                    }
                    
                    
                    
                    
                    if($currentp==$lastpage){
                    echo'<li class="page-item disabled"><a class="page-link" href="#">&gt;</a></li>';}
                    else{   
                        if(isset($_GET['AM'])){
                            echo'<li class="page-item"><a class="page-link" href="?p=Products&pgen=AM&pi='.$nextpage.'">&gt;</a></li>';
                        }else{
                            echo'<li class="page-item"><a class="page-link" href="?p=Products&pgen=AW&pi='.$nextpage.'">&gt;</a></li>';
                        }
                           
                    }
                
                    if(isset($_GET['AM'])){
                        echo'<li class="page-item"><a class="page-link" href="?p=Products&pgen=AM&pi='.$lastpage.'">&gt;&gt;</a></li>';
                    }else{
                        echo'<li class="page-item"><a class="page-link" href="?p=Products&pgen=AW&pi='.$lastpage.'">&gt;&gt;</a></li>';
                    }
                ?>
                </ul>
            </div>
        </div>
    </section>
   