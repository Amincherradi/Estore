<?php 
    require('conn.php');
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
    if(isset($_SESSION['open'])){
        $dispcar="SELECT * ,(Quantity*ProductPrice) as TotalP FROM `shoppingcart` where CustomerID=".$_SESSION['ID'];
        $excar=$conn->query($dispcar);
        $exob=$excar->fetchAll(PDO::FETCH_OBJ);
        $nbrc=$excar->rowCount();
        
        
    }else{
        $ipAddress = gethostbyname(gethostname());
        $dispcar="SELECT * , (Quantity*ProductPrice) as TotalP FROM `shoppingcart` where CustomerID IS NULL and IPCustomer='".$ipAddress."'";
        $excar=$conn->query($dispcar);
        $exob=$excar->fetchAll(PDO::FETCH_OBJ);
        $nbrc=$excar->rowCount();
        
        
    }
    $coup=$couper="";
    if(isset($_POST['applycpn'])){
        if(empty($_POST['coupon'])){
            $couper="Please Fill out this field!";
        }else{
            $coup=$_POST['coupon'];
        }
    }
    
?>
<div id="page" style="padding: 20px;">
    <?php if($nbrc>0){ ?>
        <ul class="cart-items list-unstyled">
            <?php 
            foreach( $exob as $key=>$val) {
                $CartID=$val->CartID;
                $ProductImg=$val->ProductImg;
                $ProductName=$val->ProductName;
                $ProductPrice=$val->ProductPrice;
                $ProductQte=$val->Quantity;
                $total=$val->TotalP;
            echo '
            <li class="cart-item p-3">
                    <div class="product-line-grid row">
                        <!--  product left content: image-->
                        <div class="product-line-grid-left col-lg-2 col-4">
                            <span class="product-image media-middle">
                            <img src="./assets/images/products/'.$ProductImg.'" alt="" style="aspect-ratio: 1.3/2;width:100%;">
                            </span>
                        </div>
                        <!--  product left body: description -->
                        <div class="product-line-grid-body col-md-7 col-8">
                            <div class="product-line-info">
                            <a class="label" href="?p=product-details&pc='.$val->ProductID.'">'.$ProductName.'</a>
                            </div>
                            <div class="product-line-info">
                            <span class="value">'.$ProductPrice.'&nbsp;MAD</span>
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
                                        '.$total.'&nbsp;MAD
                                        </strong>
                                        </span>
                                    </div>
                                    <div class="col-12 qty">
                                        <div class="input-group bootstrap-touchspin">
                                            <span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
                                            <input class="js-cart-line-product-quantity form-control"  type="number" value="'.$ProductQte.'" name="qte" min="1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <div class="cart-line-product-actions">
                                <a href="?p=delcrat&idct='.$CartID.'"><i class="fa fa-remove"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </li>
                <hr class="my-0 mx-8"><br>
            ';
        }
            }else{
                echo "Your Shopping Cart is Empty!";
            }   
            ?>  
            </ul>
            <hr class="my-0 mx-8">
            <span class="">Delivery Tax:</span>
            <span class=""><strong>30,00 MAD</strong></span><br>
            <span class="center">Total Price:</span>
            <span class=""><strong><?php
                require("conn.php");
                $price=0;
                if(isset($_SESSION['open'])){
                    $cartn="SELECT sum(Quantity*ProductPrice) as TotalP FROM `shoppingcart` where CustomerID=".$_SESSION['ID'];
                    $excart=$conn->query($cartn);
                    $nbp=$excart->rowCount();
                    if($nbp>0){
                        $exobj=$excart->fetch(PDO::FETCH_OBJ);
                        $price=$exobj->TotalP+30;
                        echo $price;
                    }else{
                        echo $price+30;
                    }
                }else{
                    $ipAddress = gethostbyname(gethostname());
                    $cartn="SELECT sum(Quantity*ProductPrice) as TotalP FROM `shoppingcart` where CustomerID IS NULL and IPCustomer='".$ipAddress."'";
                    $excart=$conn->query($cartn);
                    $nbp=$excart->rowCount();
                    if($nbp>0){
                        $exobj=$excart->fetch(PDO::FETCH_OBJ);
                        $price=$exobj->TotalP+30;
                        echo $price;
                    }else{
                        echo $price+30;
                    }
                    
                }
                
            ?>&nbsp;MAD</strong></span>
</div>
<br>
        