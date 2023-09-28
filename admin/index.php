<?php
if(!isset($_SESSION)) 
{ 
    session_start();
}
if(!isset($_SESSION['open2'])){
	header("location:Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta Content-Type="text/html">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>EStore | Dashboard</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <link href="assets/css/editor.css" rel="stylesheet" />
    
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/summernote/dist/summernote.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css?v=1" rel="stylesheet" />
    <link href="assets/css/themes/orange-light.css?" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="./assets/css/pages/mailbox.css" rel="stylesheet" />
    <link href="./assets/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    

    <!-- PAGE LEVEL STYLES-->
    <script type="text/javascript">
              function PreviewImage() {
                  var oFReader = new FileReader();
                  oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
                  oFReader.onload = function (oFREvent) {
                      document.getElementById("uploadPreview").src = oFREvent.target.result;
                  };
              };
              function PreviewImage1() {
                  var oFReader = new FileReader();
                  oFReader.readAsDataURL(document.getElementById("uploadImage1").files[0]);
                  oFReader.onload = function (oFREvent) {
                      document.getElementById("uploadPreview1").src = oFREvent.target.result;
                  };
              };
              function PreviewImage2() {
                  var oFReader = new FileReader();
                  oFReader.readAsDataURL(document.getElementById("uploadImage2").files[0]);
                  oFReader.onload = function (oFREvent) {
                      document.getElementById("uploadPreview2").src = oFREvent.target.result;
                  };
              };
        </script>
        <style>
    .avatar-upload {
    position: relative;
    max-width: 205px;
    margin: 50px auto;
    }
    .avatar-upload .avatar-edit {
    position: absolute;
    right: 12px;
    z-index: 1;
    top: 10px;
    }
    .avatar-upload .avatar-edit input {
    display: none;
    }
    .avatar-upload .avatar-edit input + label {
    display: inline-block;
    width: 34px;
    height: 34px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #FFFFFF;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
    }
    .avatar-upload .avatar-edit input + label:hover {
    background: #f1f1f1;
    border-color: #d6d6d6;
    }
    .avatar-upload .avatar-edit input + label:after {
    content: "\f040";
    font-family: 'FontAwesome';
    color: #757575;
    position: absolute;
    top: 10px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
    }
    .avatar-upload .avatar-preview {
    width: 192px;
    height: 192px;
    position: relative;
    border-radius: 100%;
    border: 6px solid #F8F8F8;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }
    .avatar-upload .avatar-preview > div {
    width: 100%;
    height: 100%;
    border-radius: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    }

</style>
</head>

<body class="fixed-navbar">
<div class="page-wrapper">
    <?php include("inc_header.php");?>
    <?php include("inc_colleft.php");?>
    <div class="content-wrapper">
        <?php
            if(isset($_GET['p'])){
                $page=strtolower($_GET['p']);
            }
            else{
                $page="Home";
            }
            if(file_exists("Pages/".$page.".php")){
                include("Pages/".$page.".php");
            }
            else{
                include("Pages/error_404.html");
            }                       
        ?>  
   
<footer class="page-footer">
        <div class="font-13">2023 © <b>EStore - PFE</b> - All rights reserved.</div>
        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
    </footer>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    
    <!-- END PAGA BACKDROPS-->
    
    <!-- CORE PLUGINS-->
    <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="./assets/vendors/summernote/dist/summernote.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    
    <script src="assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>

    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#summernote').summernote();
            $('.note-popover').css({
                'display': 'none'
            });
            $('#orderstable').DataTable({
    language: {
        zeroRecords: "No Orders Found for Today!"
    }
});
        });
            $(document).on('click', 'a[id=Modorderrs]', function() {
                var ido = $(this).attr('orderid');
                $.ajax({
                    url:'ModOrders.php',
                    method:'GET',
                    data: {ido:ido},
                    success: function(data){
                        $("#Modifyorders").html(data);
                    }
                });
            });
            jQuery(document).ready(function($) {
                $("#UpdateOrder").click(function(){
                    var ido = $("#orderido").attr('ido');
                    var Status = $("#statusorder").val();
                    $.ajax({
                        url:'UpdateOrder.php',
                        method:'GET',
                        data:{
                            ido:ido,
                            Status:Status
                        },
                        success: function(data) {
                            var chaine = data.trim();
                            var tab = chaine.split(",");
                            if (tab[0].toLowerCase().trim() === "success") {
                                $('#OrderMod').modal('hide');
                                const scrollPosition = window.scrollY;
                                location.reload();
                                window.scrollTo(0, scrollPosition);
                            } else {
                                console.log("Success condition not matched");
                            }
                        }
                    });
                
            });
        });
    </script>
     </div>
</div>
<div class="modal fade" id="OrderMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modify Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="Modifyorders">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="UpdateOrder">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>

</html>
