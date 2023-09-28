<?php session_start(); 
if(isset($_SESSION['open'])){
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EStore | PFE</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="./assets/js/jquery-3.7.0.min.js"></script>
    <link href="./assets/css/toastr.css" rel="stylesheet"/>
    <link href="./assets/css/toastr.min.css" rel="stylesheet"/>
    <style rel="stylesheet">
        body{
            margin-top: 0!important;
        }
        body h3 a{
            text-decoration:none !important;
            font-size:20px;
            color:#ed563b;
        }
        .form-submit {
            background: #ed563b!important;
        }
        .form-submit:hover {
            background: #ec9a8b!important; 
        }
        
    </style>
</head>
<?php
$fname=$lname=$email=$pass=$repass="";
$fnameer=$lnameer=$emailer=$passer=$repasser="";
if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['signup'])){

        if(empty($_POST['fname'])){
            $fnameer="*";
        }
        else{
            $fname=$_POST['fname'];
        }
        // champ pwd
        if(empty($_POST['lname'])){
            $lnameer="*";
        }
        else{
            $lname=$_POST['lname'];
        }
        if(empty($_POST['email'])){
            $emailer="*";
        }
        else{
                $email=$_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailer = "Invalid email address";
            } else {
                $email=$_POST['email'];
            }

        }
        // champ pwd
        if(empty($_POST['pass'])){
            $passer="*";
        }
        else{
            $pass=$_POST['pass'];
        }
        if(empty($_POST['repass'])){
            $repasser="*";
        }
        else{
            $repass=$_POST['repass'];
        }
    }
}
?>
<body>
<script src="./assets/js/toastr.min.js"></script> 
    <div class="main">
        <center><h3><a href="index.php"><i class="fa fa-home"></i>Back Home</a></h3></center>
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" action="" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="fname" id="fname" placeholder="Your First Name"/><span style="color:red;"><?php echo $fnameer; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="lname" id="lname" placeholder="Your Last Name"/><span style="color:red;"><?php echo $lnameer; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/><span style="color:red;"><?php echo $emailer; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/><span style="color:red;"><?php echo $passer; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="repass" id="repass" placeholder="Repeat your password"/><span style="color:red;"><?php echo $repasser;?></span>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                        <?php 
                        if($_SERVER['REQUEST_METHOD']=="POST"){
                            if(isset($_POST['signup'])){
                                if($fname!="" && $lname!="" && $email!="" && $pass!=""){
                                    require("conn.php");
                                    $verf="SELECT * FROM customers WHERE Email = '".$email."'";
                                    $verfexec=$conn->query($verf);
                                    $result=$verfexec->fetch(PDO::FETCH_OBJ);
                                    $nbr=$verfexec->rowCount();
                                    if($nbr>0){
                                        echo "
                                            <script type='text/javascript'>
                                            toastr.options.positionClass = 'toast-top-center';
                                            toastr.error('Email Already Exists!!');
                                        </script>
                                        ";

                                    }else{
                                        
                                        if($pass==$repass){
                                            if(strlen($pass) >= 8 && strlen($repass) >= 8){
                                                $sign="INSERT INTO `customers`(`FName`, `LName`, `Email`, `Password`, `Photo`, `CStatus`, `DateCreate`, `DateUpdate`) VALUES ('".$fname."','".$lname."','".$email."',md5('".$pass."'),'default.webp','Suspended',now(),now())";
                                                $res=$conn->exec($sign);
                                                if($res){
                                                    //echo "<script>alert('Account Created')</script>";
                                                    echo '<script>
                                                
                                                    toastr.options = {
                                                        "positionClass": "toast-top-center",
                                                        "showDuration": "300",
                                                        "hideDuration": "1000",
                                                        "timeOut": "2500",
                                                        "extendedTimeOut": "1000",
                                                        "showEasing": "swing",
                                                        "hideEasing": "linear",
                                                        "showMethod": "fadeIn",
                                                        "hideMethod": "fadeOut"
                                                      }
                                                      toastr["success"]("Account Created!", "Greet!");
                                                      setTimeout(function() {
                                                         window.location.href = "login.php";
                                                        }, 2000);
                                                </script>';
                                                    
                                                    //echo "<script>location.replace('Login.php')</script>";
                                                }else{
                                                    echo "<script type='text/javascript'>
                                                        toastr.options.positionClass = 'toast-top-center';
                                                        toastr.error('Something is Wrong!!');
                                                    </script>";
                                                }
                                            }else{
                                                echo "
                                                    <script type='text/javascript'>
                                                    toastr.options.positionClass = 'toast-top-center';
                                                    toastr.error('Password should contain more than 8 characters!');
                                                </script>
                                                ";
                                            }
                                        }else {
                                            echo "
                                            <script type='text/javascript'>
                                            toastr.options.positionClass = 'toast-top-center';
                                            toastr.error('Password do not match!');
                                        </script>
                                        ";
                                        }
                                    }
                                    
                                    $conn=null;
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="Login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>
</html>