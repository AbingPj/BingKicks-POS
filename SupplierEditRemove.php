
<?php
include 'db.php';
session_start();

if(isset($_POST['remove'])){
 $id = $_POST['id'];
 $query="DELETE FROM supplier WHERE id = '$id' ";
 mysqli_query($db,$query);
 header( "Location: supplier.php" ); 
}

if(isset($_POST['edit'])){
 $_SESSION['sup_id'] = $_POST['id'];
 $_SESSION['sup_name'] = $_POST['name'];
 $_SESSION['sup_phone'] = $_POST['phone'];
 header( "Location: supplieredit.php" ); 
}




?>