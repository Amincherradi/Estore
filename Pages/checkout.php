<?php 
    require('conn.php');
    if (isset($_SESSION['open'])) {
        // User is logged in
        $dispcar = "SELECT * ,(Quantity*ProductPrice) as TotalP FROM Shoppingcart JOIN Products ON Shoppingcart.ProductID=Products.Product_ID WHERE Shoppingcart.CustomerID = ".$_SESSION['ID'];
        $excar = $conn->query($dispcar);
        $exob = $excar->fetchAll(PDO::FETCH_OBJ);
        $nbrc = $excar->rowCount();
    } else {
        // Guest/anonymous user
        $ipAddress = gethostbyname(gethostname());
        $dispcar = "SELECT *,(Quantity*ProductPrice) as TotalP  FROM Shoppingcart JOIN Products ON Shoppingcart.ProductID=Products.Product_ID WHERE Shoppingcart.CustomerID is null and Shoppingcart.IPCustomer = '".$ipAddress."'";
        $excar = $conn->query($dispcar);
        $exob = $excar->fetchAll(PDO::FETCH_OBJ);
        $nbrc = $excar->rowCount();
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
<section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/bg/Checkout.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <h2>Easy <em>Checkout</em></h2>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
</section><br>
<section class="section">
    <div class="container col-md-10">
        <div class="row">
            <div class="col-md-8">
                <div id="" class="" >
                <fieldset class="border p-2">
                    <legend class="float-none w-auto"><h1 class="h1">Shopping Cart</h1></legend>
                    <div id="page">
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
                                            
                                        </div>
                                    </li>
                                    <hr class="my-0 mx-8"><br>
                                ';
                            }
                                }else{
                                    echo "Your Shopping Cart is Empty!";
                                }
                                if(isset($_POST['reset'])) {
                                    echo "<script>alert('$CartID');</script>";
                                    
                                }      
                                ?>  
                                </ul>
                    </div>  <br>
                    <hr class="my-0 mx-8">
                    <div class="clearfix float-right">All : &nbsp;<a href="#" data-pc="delete"><i class="fa fa-remove"></i></a></div>
                </fieldset>
                    
                </div>
                <br>
                    <a href="?p=allproducts" class=""><i class="icon-angle-double-left mr-2"></i>Continue Shopping...</a>
            </div>

            <div class="col-md-4">
                <fieldset class="border p-2">
                <legend class="float-none w-auto"><h1 class="h1">Prices</h1></legend>
                <div class="contact-form">
                    <form action="" id="contact" method="post">
                        <div id="" class="">
                        <hr class="my-0 mx-8"><br>
                            <span class=""> Delivery Tax :</span>
                            <span class=""><strong> 30,00 &nbsp;MAD</strong></span>
                        </div><br>
                        <div class="">
                        <hr class="my-0 mx-8"><br>
                            <span class="">Total Price :</span>
                            <span class=""><strong><?php 
                                $price=0;
                                if(isset($_SESSION['open'])){
                                  $cartn="SELECT sum(Quantity*ProductPrice) AS Total FROM `shoppingcart` where CustomerID=".$_SESSION['ID']."";
                                  $excart=$conn->query($cartn);
                                  $exobj=$excart->fetch(PDO::FETCH_OBJ);
                                  $price=$exobj->Total+30;
                                  echo $price;
                                }else{
                                    $cartn="SELECT sum(Quantity*ProductPrice) AS Total FROM `shoppingcart` where CustomerID IS NULL";
                                    $excart=$conn->query($cartn);
                                    $exobj=$excart->fetch(PDO::FETCH_OBJ);
                                    $price=$exobj->Total+30;
                                  echo $price;
                                }
                            ?>&nbsp;MAD</strong></span>
                        </div><br>
                        <hr class="my-0 mx-8">
                        <div class="row">
                            <div class="col-12"><br>
                                <label class="col-12">Coupon : <span class="text-danger" style='font-size:15px;'><?php echo $couper;?></span></label>
                                
                                <div class="main-button">
                                    <input type="text" placeholder="ex:123456" name="coupon" class="col-6">
                                    <button type="submit" name="applycpn" style="width:130px;height:40px;padding: 0;">Apply Coupon</button> <!-- discounted_price = original_price - (original_price * discount / 100)-->
                                    
                                    <?php
                                    if(isset($_POST['applycpn'])&& $_POST['coupon']!=""){
                                        
                                        $req="select * from coupons where CouponCode='".$coup."'";
                                        $re=$conn->query($req);
                                        $nbcoup=$re->rowCount();
                                        if($nbcoup>0){
                                            $res=$re->fetch(PDO::FETCH_OBJ);
                                            if($res){
                                                $discount=$price-($price*$res->Discount/100);
                                                echo "Applied by ".$res->Discount."% !<br><br><span style='font-size:15px;'>Total Price : <del style='font-size:12px;'>".$price."</del> <strong style='color:#ED563B;'>".$discount." MAD</strong></span>";
                                            }else{

                                            }
                                        }else{
                                            echo "<span style='font-size:10px;color:red;'>Coupon not exist!</span>";
                                        }
                                    }else{
                                        
                                    }
                                  ?>
                                </div><br>
                                
                            </div>
                        </div>
                        <div class="main-button">
                            <button type="submit" name="order">Order</button>
                            <?php
                                if(isset($_POST['order'])){
                                    if (!isset($_SESSION['open'])) {
                                        echo '
                                        <script>
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
                                            toastr["warning"]("You Should Sign IN First!", "Connexion Required");
                                            setTimeout(function() {
                                                location.replace("Login.php");
                                            }, 2500);
                                        </script>';
                                    }else{
                                        if($nbrc>0){
                                            echo '<script>
                                                    location.replace("?p=order");
                                                </script>';
                                        }else{
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
                                                        toastr["warning"]("No Product Selected!", "Shopping Cart Empty");
                                                        setTimeout(function() {
                                                            location.replace("?p=checkout");
                                                        }, 2500);
                                                </script>';
                                        }
                                    } 
                                        
                                    
                                    
                                }
                            ?>
                        </div>
                    </form>
                </div>
                <br></fieldset>
            </div>
        </div>
    </div>
</section>
