<?php  
    if(!isset($_SESSION)) 
    { 
        session_start();
    }
    if(!isset($_SESSION['open'])){
        echo "<script>location.replace('?p=404.html')</script>";
    }
    require("conn.php");
    if(isset($_GET['idprod'])){
    $idprod=$_GET['idprod'];
    }
    $req="select * from products where Product_id=".$idprod;
    $res=$conn->query($req);
    $nbp=$res->rowCount();
    $prodqte =1;
    if($nbp>0){
        $resobg=$res->fetch(PDO::FETCH_OBJ);
        $image = $resobg->Product_img1;
        $prodname = $resobg->Product_name;
        $prodPrice=$resobg->Product_Price;
        if (isset($_SESSION['open'])) {
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
                        echo '
                        <script>
                            $("#cart").modal("show");
                        </script>';
                    } else {
                        echo '<div>
                        <div class="error-message">Error</div>
                        </div>';
                    }
                }
            }
        
            if (!$found) {
                $prodqte = 1;
                $cart = "INSERT INTO Shoppingcart (CustomerID, ProductID,`ProductImg`, ProductName, ProductPrice, Quantity) VALUES (".$_SESSION['ID'].", ".$idprod.",'".$image."','".$prodname."', ".$prodPrice.", ".$prodqte.")";
                $excart = $conn->exec($cart);
        
                if ($excart) {
                    try {
                        echo '
                        <script>
                            setTimeout(function() {
                                const scrollPosition = window.scrollY;
                                location.reload();
                                window.scrollTo(0, scrollPosition);
                            }, 1500);
                            $("#cart").modal("show");
                        </script>';
                    } catch (PDOException $e) {
                        echo '<script>
                        alert("'. $e->getMessage() .'");
                        </script>';
                    }
                }
            }
        }else{
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
                      echo '<
                      <script>
                          setTimeout(function() {
                            const scrollPosition = window.scrollY;
                            location.reload();
                            window.scrollTo(0, scrollPosition);
                          }, 1500);
                          $("#cart").modal("show");
                      </script>';
                  } else {
                      echo '<div>
                      <div class="error-message">Error</div>
                      </div>';
                  }
                }
            }

          if (!$found) {
              $prodqte = 1;
              $cart = "INSERT INTO Shoppingcart (CustomerID,IPCustomer, ProductID,`ProductImg`, ProductName, ProductPrice, Quantity) VALUES (null,'".$ipAddress."', ".$idprod.",'".$image."','".$prodname."', ".$prodPrice.", ".$prodqte.")";
              $excart = $conn->exec($cart);
      
              if ($excart) {
                  try {
                      echo '
                      <script>
                          setTimeout(function() {
                            const scrollPosition = window.scrollY;
                            location.reload();
                            window.scrollTo(0, scrollPosition);
                            
                          }, 1500);
                          $("#cart").modal("show");
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