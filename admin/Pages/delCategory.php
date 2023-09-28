<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    require("conn.php");
    $req="delete from category where Id_category=".$id;
    $execute=$conn->exec($req);
    $req2="ALTER TABLE category AUTO_INCREMENT = 1;";
    $exec=$conn->exec($req2);
    if($execute){
    echo "<script>location.replace('?p=categ')</script>";
    }else{
    echo "Enregistrement nest pas Supprimer";
    }
}
?>

