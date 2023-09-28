<?php require("conn.php");
$prod="select * from products where Product_Status='Active'";
$res=$conn->query($prod);
$nbp=$res->rowCount();
$nbrpage=ceil($nbp/NBCPP2);
if(isset($_GET['n'])){
    $currentp=$_GET['n'];
}else{
    $currentp=1;
}
$nextpage=$currentp+1;
$prevpage=$currentp-1;
$lastpage=$nbrpage;
$posprod=($currentp-1)*NBCPP2;
?>
    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/bg/products.jpg)">
        <div class="container">
            <div class="row">
            <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <h2><em>Products</em></h2>
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
            <?php  
                $prod2="select * from products join category on products.Product_Category=category.Id_category where products.Product_Status='Active'  limit ".$posprod.",".NBCPP2;
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
                }
                }
                 ?>
            </div>
            
            <br>
                
            <div class="">
                        <ul class="pagination justify-content-center" style="margin-top: 10px;">
                        <?php
                            echo'<li class="page-item"><a class="page-link" href="?p=allProducts&n=1">&lt;&lt;</a></li>';
                                if($currentp==1){
                            echo'<li class="page-item disabled"><a class="page-link" href="#">&lt;</a></li>';}
                            else{
                                    echo'<li class="page-item"><a class="page-link" href="?p=allProducts&n='.$prevpage.'">&lt;</a></li>';
                            }
                            echo'<li class="page-item"><a class="page-link">--'.$currentp.'/'.$lastpage.'--</a></li>';
                            if($currentp==$lastpage){
                            echo'<li class="page-item disabled"><a class="page-link" href="#">&gt;</a></li>';}
                            else{
                                    echo'<li class="page-item"><a class="page-link" href="?p=allProducts&n='.$nextpage.'">&gt;</a></li>';
                            }
                            echo'<li class="page-item"><a class="page-link" href="?p=allProducts&n='.$lastpage.'">&gt;&gt;</a></li>';
                        ?>
                        </ul>
                    </div>  
        </div>
    </section>
   
    <?php $conn=null; ?>