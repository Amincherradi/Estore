<?php require("conn.php");
$categ="select * from category where Status_category='Active'";
$res=$conn->query($categ);
?>
<div class="main-banner" id="top">
    <video autoplay muted loop id="bg-video" controlsList="nodownload">
        <source src="assets/images/bg/videos.mp4" type="video/mp4" />
    </video>
    <div class="video-overlay header-text">
        <div class="caption">
            <h6>Clothes Products</h6>
            <h2>Best <em>Store</em> in Morroco</h2>
            <div class="main-button" >
                <a href="Login.php" <?php if(isset($_SESSION['open'])){ echo 'hidden'; }?>>Login</a>
                <a href="Signup.php" <?php if(isset($_SESSION['open'])){ echo 'hidden'; }?> >Sign up</a>
            </div>
        </div>
    </div>
</div>
<section class="section" id="trainers">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3" >
                <div class="section-heading" style="margin-top:0;">
                    <center><img src="assets/images/line-dec.png" alt=""></center>
                    <p></p><h2><em>Categories</em></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 
             if($res){
                 $resobj=$res->fetchAll(PDO::FETCH_OBJ);
                 foreach($resobj as $cle=>$val){
                   
                    echo '
                    <div class="col-lg-4">
                        <div class="trainer-item">
                            <div class="image-thumb img">
                                <a href="?p=Products&ca='.$val->Title_category.'"><img src="assets/images/Category/'.$val->Image_category.'" alt=""></a>
                            </div>
                        </div>
                    </div>
                    '; 
                 }
                }else{
                    echo "invalide querry!!";
                }
            ?>
        </div>
        <br>
        <div class="main-button text-center">
            <a href="?p=allProducts">View our products</a>
        </div>
    </div>
</section>
<section class="section section-bg" id="call-to-action" style="background-image: url(assets/images/bg/sendmsg.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cta-content">
                    <h2>Send us a <em>message</em></h2>
                    <p></p>
                    <div class="main-button">
                        <a href="?p=contact">Contact us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $conn=null; ?>