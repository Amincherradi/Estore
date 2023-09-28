
<?php 
if(!isset($_SESSION)) 
{ 
    session_start();
}
require("conn.php");
if(isset($_GET['pc'])){
   $idprod=$_GET['pc'];
}
$req="select * from products JOIN category ON products.Product_Category=category.Id_category where products.Product_id=".$idprod;
$res=$conn->query($req);
$resobg=$res->fetch(PDO::FETCH_OBJ);
$nbp=$res->rowCount();

if($nbp>0){
  $prodqte=$prodsize=$prodsizeer=$prodqteer="";
  if(empty($_POST["qte"])) {
    $prodqteer = "*";
} else {
    $prodqte = $_POST["qte"];
}
?>
    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/bg/Checkout.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
          <div class="container">
            <br>
            <br>

            <div class="row">
              <div class="col-5 col-md-5 col-xs-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="assets/images/Products/<?php echo $resobg->Product_img1;?>" alt="First slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="assets/images/Products/<?php echo $resobg->Product_img2;?>" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="assets/images/Products/<?php echo $resobg->Product_img3;?>" alt="Third slide">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                <br><br>
              </div>
              
              <div class="col-5 col-md-5 col-xs-12">
                <div class="contact-form">
                  <form action="" method="post" id="contact">
                    <div class="form-group">
                      <p><h3><?php echo $resobg->Product_name;?></h3></p>
                    </div>
                    <div class="form-group">
                      <h3 style="color:#ED563B !important;"><em><?php echo $resobg->Product_Price;?></em><sup>DH</sup></h3>
                    </div>
                    <label>Size</label><br>
                    <select name="sizep" class="col-4">
                      <?php if($resobg->Title_category=="Accessories"){
                          echo '
                            <option value="Unique">Unique Size</option>
                          ';
                      }else if($resobg->Title_category=="Shoes"){
                          echo '
                          <option value="39">39</option>
                          <option value="40">40</option>
                          <option value="41">41</option>
                          <option value="42">42</option>
                        ';
                      }else{
                          echo '
                          <option value="S">S</option>
                          <option value="M">M</option>
                          <option value="L">L</option>
                          <option value="XL">XL</option>
                          ';
                      }
                        ?>
                        
                    </select>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <label>Quantity</label><span class="text-danger">&nbsp;*</span><br>
                        <input type="number" value="1" min="1" max="100" name="qte" class="col-4">
                      </div>
                    </div>
                    
                    <div class="main-button">
                        <button type="submit" name="addtocarte">Add to cart</button>
                        <?php 
                          if(isset($_POST["addtocarte"])){
                            
                            $image = $resobg->Product_img1;
                            $prodname = $resobg->Product_name;
                            $prodqte = $_POST['qte'];
                            $prodPrice=$resobg->Product_Price;
                            if (isset($_SESSION['open'])) {
                              // User is logged in
                          
                              // Check if the product already exists in the shopping cart for the logged-in user
                              $testp = "SELECT * FROM Shoppingcart WHERE ProductID = ".$idprod." AND CustomerID = ".$_SESSION['ID'];
                              $exshowcart = $conn->query($testp);
                              $exobg = $exshowcart->fetchAll(PDO::FETCH_OBJ);
                              $found = false;
                              foreach ($exobg as $val) {
                                  if ($val->ProductID == $idprod) {
                                      $found = true;
                                      $prodqte = $val->Quantity + 1;
                                      $priceT = $prodPrice * $prodqte;
                                      $cart = "UPDATE Shoppingcart SET Quantity = ".$prodqte." WHERE ProductID = ".$idprod." AND CustomerID = ".$_SESSION['ID'];
                                      $excart = $conn->exec($cart);
                          
                                      if ($excart) {
                                          echo '<img src="./assets/images/svg/shoppingbag.gif" style="width:8%;height:8%;"/>
                                          <script>
                                              setTimeout(function() {
                                                  window.location.replace("?p=Checkout");
                                              }, 1500);
                                          </script>';
                                      } else {
                                          echo '<div>
                                          <div class="error-message">Error</div>
                                          </div>';
                                      }
                                      break;
                                  }
                              }
                          
                              if (!$found) {
                                  $prodqte = $_POST['qte'];
                                  $cart = "INSERT INTO Shoppingcart (CustomerID, ProductID,`ProductImg`, ProductName, ProductPrice, Quantity) VALUES (".$_SESSION['ID'].", ".$idprod.",'".$image."','".$prodname."', ".$prodPrice.", ".$prodqte.")";
                                  $excart = $conn->exec($cart);
                          
                                  if ($excart) {
                                      try {
                                          echo '<img src="./assets/images/svg/shoppingbag.gif" style="width:8%;height:8%;"/>
                                          <script>
                                              setTimeout(function() {
                                                  window.location.replace("?p=Checkout");
                                              }, 1500);
                                          </script>';
                                      } catch (PDOException $e) {
                                          echo '<script>
                                          alert("'. $e->getMessage() .'");
                                          </script>';
                                      }
                                  }
                              } //sssssssssssssssssssssssssssssssssssssssssss
                            } else {
                              // Guest user
                              $ipAddress = gethostbyname(gethostname());
                          
                              // Check if the item already exists in the cart for the IP address
                              $checkCartItemQuery = "SELECT * FROM Shoppingcart WHERE IPCustomer = '".$ipAddress."' AND ProductID = ".$idprod;
                              $checkCartItemResult = $conn->query($checkCartItemQuery);
                              $existingCartItem = $checkCartItemResult->fetchAll(PDO::FETCH_OBJ);
                              $found = false;
                              foreach ($existingCartItem as $val) {
                                  if ($val->ProductID == $idprod) {
                                    $found = true;  
                                    $prodqte = $val->Quantity + 1;
                                    $cart = "UPDATE Shoppingcart SET Quantity = ".$prodqte." WHERE ProductID = ".$idprod." AND CustomerID is null";
                                    $excart = $conn->exec($cart);
                        
                                    if ($excart) {
                                        echo '<img src="./assets/images/svg/shoppingbag.gif" style="width:8%;height:8%;"/>
                                        <script>
                                            setTimeout(function() {
                                                window.location.replace("?p=Checkout");
                                            }, 1500);
                                        </script>';
                                    } else {
                                        echo '<div>
                                        <div class="error-message">Error</div>
                                        </div>';
                                    }
                                  }
                              }

                            if (!$found) {
                                $prodqte = $_POST['qte'];
                                $cart = "INSERT INTO Shoppingcart (CustomerID,IPCustomer, ProductID,`ProductImg`, ProductName, ProductPrice, Quantity) VALUES (null,'".$ipAddress."', ".$idprod.",'".$image."','".$prodname."', ".$prodPrice.", ".$prodqte.")";
                                $excart = $conn->exec($cart);
                        
                                if ($excart) {
                                    try {
                                        echo '<img src="./assets/images/svg/shoppingbag.gif" style="width:8%;height:8%;"/>
                                        <script>
                                            setTimeout(function() {
                                                window.location.replace("?p=Checkout");
                                            }, 1500);
                                        </script>';
                                    } catch (PDOException $e) {
                                        echo '<script>
                                        alert("'. $e->getMessage() .'");
                                        </script>';
                                    }
                                }
                            }

                          }
                        }
                        ?>
                    </div>
                  </form>
                </div>
                
                <br>
              </div>
            </div>
            
          </div>
          <div class="row">
              <div class="col-lg-10 offset-lg-1">
                <div class="tab">
                  <button class="tablinks"  onclick="openCity(event, 'Description')" id="Opened">Description</button>
                  <button class="tablinks" onclick="openCity(event, 'Reviews')" id="Rev">Reviews</button>
                  <button class="tablinks" onclick="openCity(event, 'addReviews')" id="addrev">Add Reviews</button>
                  
                </div><br>
                
              <!-- Tab content -->
                <div id="Description" class="tabcontent">
                <section class="section" style="margin-top: 0;background-color: rgba(240, 240, 240, 0.267);">
                      <div class="container-fluid">
                          <div class="row col-12">
                              <div class="col-2 col-md-2 col-xs-12">
                              </div>
                              <div class="col-lg-8 col-md-8 col-xs-12">
                                  <div class="contact-form section-bg" style="background-color: rgba(240, 240, 240, 0.267) !important;">
                                  <fieldset class="border p-2">
                                      <legend class="float-none w-auto"><h3 class="h3">Description</h3></legend>
                                      <div id="page">
                                        <div class="mt-4 text-justify float-left justify">
                                              <?php echo $resobg->Product_Disc;?>
                                        </div>
                                      </div>
                                  </fieldset>
                                  </div>
                              </div>
                          </div>
                      </div>
                </section>
                  
                </div>
                <script type="text/javascript">document.getElementById("Opened").dispatchEvent(new Event("click"));</script>
                <div id="Reviews" class="tabcontent">
                <section class="section" style="margin-top: 0;background-color: rgba(240, 240, 240, 0.267);">
                      <div class="container-fluid">
                          <div class="row col-12">
                              <div class="col-3 col-md-3 col-xs-12">
                                  <div>
                                    <img src="/images/signin-image.jpg" alt="">
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-4 col-xs-12">
                                  <div class="contact-form section-bg" style="background-color: rgba(240, 240, 240, 0.267) !important;">
                                    <fieldset class="">
                                        <legend class="float-none w-auto"><h3 class="h3">Reviews</h3></legend>
                                        <div class="col-md-12">
                                          <ul class="features-items">
                                          <?php 
                                          $reviews="SELECT * FROM `reviews` JOIN customers ON reviews.CustomerID=customers.CustomerID WHERE reviews.ProductID=".$idprod." LIMIT 3";
                                          $query=$conn->query($reviews);
                                          $nbrev=$query->rowCount();
                                            if($nbrev>0){
                                              $result=$query->fetchall(PDO::FETCH_OBJ);
                                              foreach($result as $key=>$val){
                                                  echo '
                                                    <li >
                                                      <div class="feature-item col-12" style="margin-bottom:15px;">
                                                          <div class="left-icon">
                                                              <img src="./assets/images/users/'.$val->Photo.'" alt="" style="width: 90px;aspect-ratio:2/2;object-fit:contain;">
                                                          </div>
                                                          <div class="right-content">
                                                              <h4>'.$val->FName.' '.$val->LName.' <small>'.$val->DateRev.'</small></h4>
                                                              <p class="col-8"><em>'.$val->Comment.'</em></p>
                                                          </div>
                                                      </div>
                                                    </li>';
                                              }
                                            }else{
                                              echo "No Comments in this product at this time!";
                                            }
                                            $query->closeCursor();
                                          ?>
                                              
                                          </ul>
                                      </div>
                                        <br><br>
                                    </fieldset>
                                  </div>
                              </div>
                          </div>
                      </div>
                </section>
                </div>

                <div id="addReviews" class="tabcontent">
                  <section class="section" id="contact-us" style="margin-top: 0;background-color: rgba(240, 240, 240, 0.267);">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-lg-3 col-md-3 col-xs-12">
                                  <div>
                                    <img src="/images/signin-image.jpg" alt="">
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-xs-12">
                                  <div class="contact-form section-bg" style="background-image: url(assets/images/contact-1-720x480.jpg)">
                                      <form id="comment" action="" method="post">
                                        <div class="row">
                                          <div class="col-md-6 col-sm-12">
                                            <fieldset>
                                              <input name="Namecom" type="text" id="name" placeholder="Your Name*" required="" value="<?php if(isset($_SESSION['open'])){ echo $_SESSION['FName']."".$_SESSION['LName'];}?>">
                                            </fieldset>
                                          </div>
                                          <div class="col-md-6 col-sm-12">
                                            <fieldset>
                                              <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email*" required="" value="<?php if(isset($_SESSION['open'])){ echo $_SESSION['Email'];}?>">
                                            </fieldset>
                                          </div>
                                          <div class="col-lg-12">
                                            <fieldset>
                                              <textarea name="comment" rows="6" id="message" placeholder="Message" required=""></textarea>
                                            </fieldset>
                                          </div>
                                          <div class="col-lg-12">
                                            <fieldset>
                                              <button type="submit" id="form-submit" class="main-button" name="sendreview">Add comment</button>
                                            </fieldset>
                                          </div>
                                        </div>
                                      </form>
                                      <?php 
                                            }
                                            $res->closeCursor();
                                              if(isset($_POST['sendreview'])){
                                                if(!isset($_SESSION['open'])){
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
                                                          toastr["warning"]("You Should Sign IN First!", "Connexion Required");
                                                          setTimeout(function() {
                                                              location.replace("Login.php");
                                                          }, 2500);
                                                        </script>';
                                                }else{
                                                      if(isset($_SESSION['CStatus']) && $_SESSION['CStatus']!="Activated"){
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
                                                                toastr["warning"]("Your Account has been Suspended!,Please Activate it", "Account Restriction");
                                                                setTimeout(function() {
                                                                    location.replace("?p=Settings");
                                                                }, 2500);
                                                              </script>';
                                                      }else{
                                                        if($_POST['comment']!="" && $_POST['Namecom']!="" && $_POST['email']!=""){
                                                          $CustomerID=$_SESSION['ID'];
                                                          $email=$_SESSION['Email'];
                                                          $Comment=$_POST['comment'];
                                                          $rev="INSERT INTO `reviews`(`CustomerID`, `EmailRev`,`Comment`, `DateRev`, `ProductID`) VALUES (".$CustomerID.",'".$email."','".$Comment."',now(),".$idprod.")";
                                                          $log="INSERT INTO `logs`(`CustomerID`, `CustomerEmail`, `Activity`, `DateTime`) VALUES (".$CustomerID.",'".$email."','Add Review on product id =".$idprod." Comment : ".$Comment."',now())";
                                                          
                                                          $execlog=$conn->exec($log);
                                                          $execrev=$conn->exec($rev);
                                                          if($execrev){
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
                                                                      toastr["success"]("Comment Sent!", "Review");
                                                                      setTimeout(function() {
                                                                        window.location.replace = "?p=product-details&pc='.$idprod.'";
                                                                        
                                                                    }, 2000);
                                                                    document.getElementById("Rev").click();
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
                                                                      toastr["error"]("Somthing Went Wrong!", "");
                                                                      setTimeout(function() {
                                                                        document.getElementById("addrev").click();
                                                                      }, 2000);
                                                                  </script>';
                                                          }
                                                          
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
                                                                    toastr["error"]("Write something in Comment section ...","Review");
                                                                    setTimeout(function() {
                                                                      document.getElementById("addrev").click();
                                                                    }, 2000);
                                                                </script>';
                                                        }
                                                      }
                                                  }
                                                  
                                                echo "<script>
                                                document.getElementById('Rev').click();</script>";
                                              }
                                            ?>
                                  </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-xs-12">
                                  <div>
                                    <img src="/images/signin-image.jpg" alt="">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </section>
                </div>
              </div>
            </div>
    </section>
    <?php
    $res->closeCursor();
    $conn=null;
    ?>