<?php
if(!isset($_SESSION)) 
{ 
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>EStore | Admin</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="./assets/css/pages/auth-light.css" rel="stylesheet" />
</head>

<body class="bg-silver-300">
<?php
$Username=$Usernameerr=$Password=$Passworderr="";
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['Login'])){
        if(empty($_POST['Username'])){
            $Passworderr="*";
        }
        else{
            $Username=$_POST['Username'];
        }
        // champ pwd
        if(empty($_POST['Password'])){
            $Passworderr="*";
        }
        else{
            $Password=$_POST['Password'];
        }
    }
	if(!isset($_SESSION)) { 
        session_start();
    }
	
}
?>
    <div class="content">
        <div class="brand">
            <a class="link" href="index.html">Admin Panel</a>
        </div>
        <form id="login-form" action="" method="post">
            <h2 class="login-title">Log in</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-user"></i></div>
                    <input class="form-control" type="text" name="Username" placeholder="Username" required>
                </div>
                <span style="color:red;"><?php echo $Usernameerr; ?></span>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="Password" placeholder="Password" required>
                </div><span style="color:red;"><?php echo $Passworderr; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Login" name="Login" class="btn btn-info btn-block">
            </div>
        </form>
        <?php
            if(isset($_POST['Login']) && $Username!="" && $Password!=""){
                require("conn.php");
                $req="select * from admin where Username='".$Username."' and Password ='".$Password."'";
                $res=$conn->query($req);
                $nb=$res->rowCount();
                if($nb>0){
                    $resobj=$res->fetch(PDO::FETCH_OBJ);
                    $_SESSION['open2']="Connected";
                    $_SESSION['IdUser']=$resobj->ID;
                    $_SESSION['Fname']=$resobj->FName;
                    $_SESSION['Lname']=$resobj->LName;
                    $_SESSION['Username']=$resobj->Username;
                    $_SESSION['Email']=$resobj->Email;
                    if($resobj->UserImg==""){
                        $_SESSION['UserImg']="default.png";
                    }else{
                        $_SESSION['UserImg']=$resobj->UserImg;
                    }
                    
                    $res->closeCursor();
                    header("location:index.php");	
                }
                else{
                    echo "Admin not found";
                }
            }
        ?>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>

</html>