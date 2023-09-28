<?php 

if(!isset($_SESSION['open'])){
    echo '<script>
        setTimeout(function() {
            location.replace("Login.php");
        }, 1000);
    </script>';
}else{
        require("conn.php");
      $custo="SELECT * FROM Customers where CustomerID=".$_SESSION['ID'];
      $exc=$conn->query($custo);
      
      $nbc=$exc->rowCount();
      if($nbc>0){
        $exobj=$exc->fetch(PDO::FETCH_OBJ);
        echo '
    <section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/bg/Checkout.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Easy <em>Checkout</em></h2>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <br>
            <br>
            <fieldset class="border p-2">
                    <legend class="float-none w-auto"><h1 class="h1">Shipping Informations</h1></legend>
            <div class="row">
                <div class="col-md-8">
                    <div class="contact-form">
                           <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                     <label>First Name:</label><span style="color:red;" id="err0"></span>
                                     <input type="text" id="ord0" value="'.$exobj->FName.'">
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                     <label>Last Name:</label> <span style="color:red;" id="err1"></span>
                                     <input type="text" id="ord1" name="" value="'.$exobj->LName.'">
                                </div>
                           </div>
                           <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                     <label>Email:</label> <span style="color:red;" id="err2"></span>
                                     <input type="text" id="ord2" name="" value="'.$exobj->Email.'">
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                     <label>Phone:</label> <span style="color:red;" id="err3"></span>
                                     <input type="text" id="ord3" name="" value="'.$exobj->Phone.'">
                                </div>
                           </div>
                           <div class="row">
                                <div class="col-lg-12">
                                     <label>Adress:</label> <span style="color:red;" id="err4"></span>
                                     <input type="text" id="ord4" name="" value="'.$exobj->Adress.'">
                                </div>
                           </div>
                           <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                     <label>City:</label> <span style="color:red;" id="err5"></span>
                                     <input type="text" id="ord5" name="" value="'.$exobj->City.'">
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                     <label>State:</label> <span style="color:red;" id="err6"></span>
                                     <select id="ord6" name="">
                                        <option value="" selected>-Chose State-</option>
                                        <option value="Tanger-Tetouan-Al-Hoceima">Tanger-Tétouan-Al Hoceïma</option>
                                        <option value="Oriental">Oriental Oujda</option>
                                        <option value="Fes-Meknes">Fès-Meknès</option>
                                        <option value="Rabat-Sale-Kenitra">Rabat-Salé-Kénitra</option>
                                        <option value="Beni-Mellal-Khenifra">Béni Mellal-Khénifra</option>
                                        <option value="Casablanca-Settat">Casablanca-Settat</option>
                                        <option value="Marrakech-Safi">Marrakech-Safi</option>
                                        <option value="Draa-Tafilalet">Drâa-Tafilalet</option>
                                        <option value="Souss-Massa">Souss-Massa</option>
                                        <option value="Guelmim-Oued-Noun">Guelmim-Oued Noun[A]</option>
                                        <option value="Laayoune-Sakia-El-Hamra">Laâyoune-Sakia El Hamra[A]</option>
                                        <option value="Dakhla-Oued-Ed-Dahab">Dakhla-Oued Ed-Dahab[A]</option>
                                    </select>
                                </div>
                           </div>
                           <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                     <label>Zip:</label> <span style="color:red;" id="err7"></span>
                                     <input type="text" id="ord7" name="" value="'.$exobj->ZipCode.'">
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                     <label>Country:</label> <span style="color:red;" id="err8"></span>
                                     <select id="ord8" name="">
                                          <option value="">-- Choose --</option>
                                          <option value="Morocco" selected>-- Morocco --</option>
                                          <option value="">-- Others --</option>
                                     </select>
                                </div>
                           </div>

                           <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                     <label>Payment method</label> <span style="color:red;" id="err9"></span>
                                     
                                     <select id="ord9" name="">
                                          <option value="" >-- Choose --</option>
                                          <option value="cash" selected>Cash</option>
                                     </select>
                                </div>
                            </div>  
                             
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-button">
                                        <div class="float-left">
                                            <a href="?p=checkout">Back</a>
                                        </div>

                                        <div class="float-right">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>

                    <br>
                </div>
                





                <div class="col-md-4">
                    <ul class="list-group list-group-no-border">
                      

                      <li class="list-group-item" style="margin:0 0 -1px">
                         <div class="row">
                            <div class="col-6">
                                <strong>Delivery Price</strong>
                            </div>

                            <div class="col-6">
                                <h5 class="text-right">30 DH</h5>
                            </div>
                         </div>
                      </li>

                      <li class="list-group-item" style="margin:0 0 -1px">
                         <div class="row">
                            <div class="col-6">
                                <strong>Discount</strong>
                            </div>

                            <div class="col-6">
                                <h5 class="text-right">00%</h5>
                            </div>
                         </div>
                      </li>

                      <li class="list-group-item" style="margin:0 0 -1px">
                         <div class="row">
                            <div class="col-6">
                                <h4><strong>Total</strong></h4>
                            </div>

                            <div class="col-6">
                                <h4 class="text-right">';
                                $price=0;
                                if(isset($_SESSION['open'])){
                                    require("conn.php");
                                  $c="SELECT sum(Quantity*ProductPrice) as TotalP FROM `shoppingcart` where CustomerID=".$_SESSION['ID'];
                                  $excart=$conn->query($c);
                                  $exobj=$excart->fetch(PDO::FETCH_OBJ);
                                  $price=$exobj->TotalP+30;
                                  echo $price;
                                }
                                echo ' DH</h4>
                            </div>
                         </div>
                      </li>
                    <li class="list-group-item" style="margin:0 0 -1px">
                            <button class="order"><span class="default">Complete Order</span><span class="success">Order Placed<svg viewbox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg></span>
                                <div class="box"></div>
                                <div class="truck">
                                    <div class="back"></div>
                                    <div class="front">
                                        <div class="window"></div>
                                    </div>
                                    <div class="light top"></div>
                                    <div class="light bottom"></div>
                                </div>
                                <div class="lines"></div>
                            </button>
                        </div>
                      </li>
                    </ul>

                    <br>
                </div>
                </fieldset>
            </div>
        </div>
    </section>
    ';
      }
    
}
    
    
    ?>
