<?php 
    if(!isset($_SESSION)) 
    { 
        session_start();
    } 
if(isset($_SESSION['open'])){
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="./assets/js/jquery-3.7.0.min.js"></script>
    <link href="./assets/css/toastr.css" rel="stylesheet"/>
    <link href="./assets/css/toastr.min.css" rel="stylesheet"/>
    
    
    <style rel="stylesheet">
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
$email=$pass="";
$emailer=$passer="";
if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['signin'])){

        if(empty($_POST['email'])){
            $emailer="Field Required*";
        }
        else{
            $email=$_POST['email'];
        }
        // champ pwd
        if(empty($_POST['pass'])){
            $passer="Field Required*";
        }
        else{
            $pass=$_POST['pass'];
        }
    }
}
?>
 
<body>
<script src="./assets/js/toastr.min.js"></script> 
    <br><br><br>
    <div class="main fade">
         <!-- Sing in  Form -->
         <section class="sign-in">
            <div class="container"><br>
            <center><h3><a href="index.php"><i class="fa fa-home"></i>Back Home</a></h3></center>
                <div class="signin-content">
                    
                    <div class="signin-image">
                        <img src="images/signin-image.jpg" alt="sing up image">
                        <a href="Signup.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign In</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="Email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email" id="Email" placeholder="Your Email"/><span style="color:red;"><?php echo $emailer; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/><span style="color:red;"><?php echo $passer; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <?php
                            if(isset($_POST['signin']) && $email!="" && $pass!=""){
                                require("conn.php");
                                $req="select * from customers where Email='".$email."'";
                                $res=$conn->query($req);
                                $nb=$res->rowCount();
                                if($nb>0){
                                    $resobj=$res->fetch(PDO::FETCH_OBJ);
                                        $passcrypt=md5($pass);
                                        if($passcrypt== $resobj->Password){
                                            $ipAddress = gethostbyname(gethostname());
                                            $sign="INSERT INTO `usersip`(`IP`,`CustomerID`, `Date`) VALUES ('".$ipAddress."',".$resobj->CustomerID.",now())";
                                            $res=$conn->exec($sign);
                                            $_SESSION['open']="ok";
                                            $_SESSION['ID']=$resobj->CustomerID;
                                            $_SESSION['FName']=$resobj->FName;
                                            $_SESSION['LName']=$resobj->LName;
                                            $_SESSION['Email']=$resobj->Email;
                                            $_SESSION['Phone']=$resobj->Phone;
                                            $_SESSION['Adress']=$resobj->Adress;
                                            $_SESSION['City']=$resobj->City;
                                            $_SESSION['ZipCode']=$resobj->ZipCode;
                                            $_SESSION['Password']=$resobj->Password;
                                            $_SESSION['CStatus']=$resobj->CStatus;
                                            $_SESSION['Photo']=$resobj->Photo;
                                            $_SESSION['Status']=$resobj->CStatus;
                                            $req2="select * from usersip where CustomerID=".$resobj->CustomerID;
                                            $res2=$conn->query($req2);
                                            $resobj2=$res2->fetch(PDO::FETCH_OBJ);
                                            $_SESSION['IPID']=$resobj2->CustomerID;
                                            $_SESSION['IP']=$resobj2->ip;
                                            $req3="select * from Shoppingcart where CustomerID IS NULL and IPCustomer='".$_SESSION['IP']."'";
                                            $res3=$conn->query($req3);
                                            $resobj3=$res3->fetchAll(PDO::FETCH_OBJ);
                                            $nbcart=$res3->rowCount();
                                            if($nbcart>0){
                                                $cart = "UPDATE Shoppingcart SET CustomerID = ".$_SESSION['ID']." WHERE CustomerID IS NULL and IPCustomer='".$_SESSION['IP']."'";
                                                $excart = $conn->exec($cart);
                                    
                                                if ($excart) {
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
                                                    toastr["success"]("Welcome To EStore", "Connected!");
                                                    setTimeout(function() {
                                                        window.location.replace("?p=Checkout");
                                                    }, 1500);
                                                    </script>';
                                                } else {
                                                    echo '<div>
                                                    <div class="error-message">Error</div>
                                                    </div>';
                                                }
                                            }else{
                                                //$ipAddress = $_SERVER['REMOTE_ADDR'];
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
                                                toastr["success"]("Welcome To EStore", "Connected!");
                                                </script>';
                                                echo "<script>


                                                    // Create a progress bar element
                                                    var progressBar = document.createElement('div');
                                                    progressBar.style.width = '0%';
                                                    progressBar.style.height = '4px';
                                                    progressBar.style.backgroundColor = '#ED563B';
                                                    progressBar.style.position = 'fixed';
                                                    progressBar.style.top = '0';
                                                    progressBar.style.left = '0';
                                                    progressBar.style.transition = 'width 2s';

                                                    // Append the progress bar to the document body
                                                    document.body.appendChild(progressBar);

                                                    // Animate the progress bar
                                                    var progress = 0;
                                                    var intervalId = setInterval(function() {
                                                        progress += 1;
                                                        progressBar.style.width = progress + '%';
                                                        if (progress >= 100) {
                                                            clearInterval(intervalId);
                                                            setTimeout(function() {
                                                                window.location.href = 'index.php';
                                                            }, 1000);
                                                        }
                                                    }, 20);
                                                </script>";
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
                                                  toastr["error"]("Email or Password is Incorrect", "Connexion Warning");
                                            </script>';
                                            }

                                        
                                    
                                    
                                }
                                else{
                                    echo "<script type='text/javascript'>
                                            toastr.options.positionClass = 'toast-top-center';
                                            toastr.error('Email or Password is Incorrect');
                                        </script>";
                                }
                                $conn=null;
                        }
                        
                        ?>
                        
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="./assets/js/script.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>