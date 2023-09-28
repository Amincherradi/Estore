<?php 
if(!isset($_SESSION)) 
    { 
        session_start();
    }
require("conn.php");
if(isset($_GET['ca'])){
    $categ=$_GET['ca'];
    if(isset($_GET['pgen'])){
        $pgen=$_GET['pgen'];
        $prod="select * from products join category on products.Product_Category=category.Id_category where category.Title_category='".$categ."' and products.PGender='".$pgen."' and products.Product_Status='Active'";
    }else{
        $prod="select * from products join category on products.Product_Category=category.Id_category where category.Title_category='".$categ."' and products.Product_Status='Active'";
    }
}else{
    if(isset($_GET['pgen']) && $_GET['pgen']=="AM" ){
        $prod="select * from products where PGender='MEN'";
    }else if(isset($_GET['pgen']) && $_GET['pgen']=="AW" ){
        $prod="select * from products where PGender='Women'";
    }
}
if(isset($_SESSION['open'])){
    $cartn="SELECT COUNT(*) AS Cart FROM `shoppingcart` where CustomerID=".$_SESSION['ID'];
    $excart=$conn->query($cartn);
    $exobj=$excart->fetch(PDO::FETCH_OBJ);
}else{
    $ipAddress = gethostbyname(gethostname());
   
        $cartn="SELECT COUNT(*) AS Cart FROM `shoppingcart` where CustomerID IS NULL ";
        $excart=$conn->query($cartn);
        $exobj=$excart->fetch(PDO::FETCH_OBJ);
}
?>
<header class="header-area header-sticky">
        <div class="container col-11">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                            <a href="index.php" class="logo">EStore <em> PFE</em></a>
                        <ul class="nav">
                            <li><a href="?p=Home" class="active">Home</a></li>
                            
                            <li>
                                <a href="#" id="a" data-bs-toggle='modal' data-bs-target='#cart' class="cart-notif" data-cart="<?php echo $exobj->Cart; ?>">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>          
                                </a>
                            </li>
                            <li><a href="?p=contact">Contact</a></li> 
                            <li class="dropdown float-left">
                                <a href="Login.php" <?php if(isset($_SESSION['open'])){ echo 'hidden'; }?> > Login</a>
                                
                                <img style="aspect-ratio:2/2;" src="assets/images/users/<?php if(isset($_SESSION['open'])){ 
                                    $photo="select Photo from customers where CustomerID=".$_SESSION['ID'];
                                    $ex=$conn->query($photo);
                                    $nb=$ex->rowCount();
                                    if($nb>0){
                                        $ex2=$ex->fetch(PDO::FETCH_OBJ);
                                        if($ex2){
                                            echo $ex2->Photo;
                                        }
                                    }
                                    }?>" class="imgavatar" alt="User" <?php if(!isset($_SESSION['open'])){ echo 'hidden'; }?>  >
                                <div class="dropdown-content">
                                    <?php 
                                        if(isset($_SESSION['open']) && $_SESSION['open']=="ok"){ 
                                            echo '<a href="?p=Settings">Settings</a>
                                            <a href="Logout.php">Log out</a>';
                                        }
                                    ?>

                                </div>
                            </li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        
                    </nav>
                    
                </div>
                
            </div>
            
        </div>
        <script src="assets/js/jquery.toast.min.js"></script>
        <section class="section">
                        <ul id="manwo" >
                        <li class="dropdown-manwo ">
                                <a href="?p=Products&pgen=AM" class="dropbtn-manwo">MEN</a>
                                <div class="dropdown-content-manwo">
                                <?php 
                                    $categ="select * from category where Status_category='Active'";
                                    $exec1=$conn->query($categ);
                                    if($exec1){
                                        $res1=$exec1->fetchAll(PDO::FETCH_OBJ);
                                        foreach($res1 as $cle=>$val){
                                            echo '<a href="?p=Products&ca='.$val->Title_category.'&pgen=MEN"">'.$val->Title_category.'</a>';
                                        }
                                    }
                                    ?>
                                </div>
                            </li>
                            <li class="dropdown-manwo">
                                <a href="?p=Products&pgen=AW" class="dropbtn-manwo">WOMEN</a>
                                <div class="dropdown-content-manwo">
                                <?php 
                                    $categ="select * from category where Status_category='Active'";
                                    $exec1=$conn->query($categ);
                                    if($exec1){
                                        $res1=$exec1->fetchAll(PDO::FETCH_OBJ);
                                        foreach($res1 as $cle=>$val){
                                            echo '<a href="?p=Products&ca='.$val->Title_category.'&pgen=WOMEN">'.$val->Title_category.'</a>';
                                        }
                                    }
                                    ?>
                                </div>
                            </li>
                            <li class="dropdown-manwo right">
                                
                            </li>
                            
                            
                        </ul>
                        
                    </section>
                    <section class="section" style="margin-top:-51px;height: 10px !important;margin-left: 30%;">
                            <div class="row">
                                <div class="col-1">

                                </div>
                                
                                <div class="col-5">
                                <form action="" method="post">
                                    <div class="search-input">
                                        <a href="" target="_blank" hidden></a>
                                        <input type="text" placeholder="Type to search.." name="searchbar" id="searchid">
                                        <div class="boxsearch" id="searchdiv">
                                         
                                                
                                        </div>
                                        
                                    </div>
                                    </form>
                                </div>
                                <div class="" style="margin-left: 666px;
                                                    margin-top: -38px;
                                                    color: white;
                                                    font-size: 18px;
                                                    font-style: italic;
                                                    width: 50%;">
                                 <marquee class="marquee" behavior="" direction="">Welcome To my EStore PFE | Tshirts Exclusive Promotion By 50% Today</marquee>
                                </div>
                            </div>
                            
                        </section>
                        
</header>
<?php $conn=null; ?>