<?php
    require("conn.php");
    if(isset($_GET['Pname'])){
        $Pname=$_GET['Pname'];
        $sql="select * from products where Product_Status='Active' and Product_name like '%".$Pname."%'";
        $query=$conn->query($sql);
        $nbp=$query->rowCount();
        $nbrpage=ceil($nbp/NBCPP3);
    if(isset($_GET['idp'])){
        $currentp=$_GET['idp'];
    }else{
        $currentp=1;
    }
    $nextpage=$currentp+1;
    $prevpage=$currentp-1;
    $lastpage=$nbrpage;
    $pospage=($currentp-1)*NBCPP3;
    if($nbp>0){
        $query->closeCursor();
        $sql="select * from products where Product_Status='Active' and Product_name like '%".$_GET['Pname']."%' limit ".$pospage.",".NBCPP3;
        $res2=$conn->query($sql);
        $sqlres=$res2->fetchAll(PDO::FETCH_OBJ);
        foreach( $sqlres as $key=>$val) {
            $ProductImg=$val->Product_img1;
            $ProductName=$val->Product_name;
            $ProductPrice=$val->Product_Price;
        echo '<ul class="cart-items list-unstyled">
            <li class="cart-item p-3">
                <div class="product-line-grid row">
                    <!--  product left content: image-->
                    <div class="product-line-grid-left col-md-2 col-4">
                        <span class="product-image media-middle">
                        <img src="./assets/images/products/'.$ProductImg.'" alt="" style="aspect-ratio: 3/4;width:100%;">
                        </span>
                    </div>
                    <!--  product left body: description -->
                    <div class="product-line-grid-body col-md-7 col-8">
                        
                        <div class="product-line-info">
                        <span class="value"><a href="?p=product-details&pc='.$val->Product_id.'">'.$ProductName.'</a></span>
                        </div>
                        <br>
                    </div>
                    <!--  product left body: description -->
                    <div class="product-line-grid-right product-line-actions col-md-3 col-12">
                        <div class="row">
                        <div class="col-4 hidden-md-up"></div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 price">
                                    <span class="product-price">
                                    <strong>
                                    '.$ProductPrice.'&nbsp;MAD
                                    </strong>
                                    </span>
                                </div>
                                <div class="col-12 qty">
                                    <div class="input-group bootstrap-touchspin">
                                        <a class="main-button" href="?p=product-details&pc='.$val->Product_id.'"> order</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <div class="cart-line-product-actions">
                            
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </li>
        
            ';
        }
    
    }else{
        echo " No product Found with this name!";
    }
    echo '
    <div class="">
        <ul class="pagination justify-content-center" style="margin-top: 10px;">';
        
            echo'<li class="page-item"><a class="page-link" href="#" idpage="1" idp="firstpage">&lt;&lt;</a></li>';
                if($currentp==1){
            echo'<li class="page-item disabled"><a class="page-link" href="#" idpage="'.$prevpage.'" idp="prevpage">&lt;</a></li>';}
            else{
                    echo'<li class="page-item"><a class="page-link" href="#" idpage="'.$prevpage.'" idp="prevpage">&lt;</a></li>';
            }
            echo'<li class="page-item"><a class="page-link">--'.$currentp.'/'.$lastpage.'--</a></li>';
            if($currentp==$lastpage){
            echo'<li class="page-item disabled"><a class="page-link" href="#" idpage="'.$nextpage.'" idp="nextpage">&gt;</a></li>';}
            else{
                    echo'<li class="page-item"><a class="page-link" href="#" idpage="'.$nextpage.'" idp="nextpage">&gt;</a></li>';
            }
            echo'<li class="page-item"><a class="page-link" href="#" idpage="'.$lastpage.'" idp="lastpage">&gt;&gt;</a></li>
        
        </ul>
    </div>  
';
$conn=null;
    }else{
        echo "not found";
    }
    
    
?>