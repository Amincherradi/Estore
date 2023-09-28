<?php 
    if(isset($_SESSION['open'])){
        header("location:index.php");
    } 
    if(!isset($_SESSION)) 
    { 
        session_start();
    } 
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Estore">
    <meta name="author" content="Amine Cherradi">
    <title>EStore PFE</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/font-awesome.css">
    <link rel="stylesheet" href="./fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/Styleplus.css">
    <script src="./assets/js/jquery-3.7.0.min.js"></script>
    <link href="./assets/css/toastr.css" rel="stylesheet"/>
    <link href="./assets/css/toastr.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/dataTables.min.css">
    <style>

    </style>
    
    

    
    <script>
          function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
          }
    </script>
  
    </head>
    <body>
    <script src="./assets/js/toastr.min.js"></script> 
    <?php include("inc_header.php");?>
    <br><br><br><br><br>    
        <?php
            if(isset($_GET['p'])){
                $page=strtolower($_GET['p']);
            }
            else{
                $page="Home";
            }
            if(file_exists("Pages/".$page.".php")){
                include "Pages/".$page.".php";
            }
            else{
                include "Pages/404.html";
            }                       
        ?>   
  <?php include "inc_footer.php";?>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/jquery.counterup.min.js"></script>
<script src="./assets/js/mixitup.js"></script>
<script src="./assets/js/waypoints.min.js"></script>
<script src="./assets/js/scrollreveal.min.js"></script>
<script src="./assets/js/imgfix.min.js"></script>
<script src="./assets/js/custom.js"></script>
<script src="./assets/js/accordions.js"></script>
<script src="./assets/js/script.js"></script>
<script type="text/javascript" src="./assets/js/dataTables.min.js"></script>

<div class="modal fade right" id="cart">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Shopping Cart</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row" id="Shoppingcart">
          <!-- Your cart items here -->
        </div>
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <a class="btn btn-primary" id="btnajouteretd" href='?p=checkout'>Checkout</a>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="addedtocart">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Product Added &nbsp; <img src="./assets/images/svg/basket.gif" alt=""></h5>
              </div>
            </div>
        </div>
    </div> 
    

  </body>
</html>