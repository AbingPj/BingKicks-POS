
<?php
include '../../Controllers/DataBaseController/db.php';
session_start();

if(isset($_POST['remove'])){
 $id = $_POST['id'];
 $query="DELETE FROM supplier WHERE id = '$id' ";
 mysqli_query($db,$query);
 header( "Location: ../../Pages/Supplier.php" ); 
}

if(isset($_POST['edit'])){
 $_SESSION['sup_id'] = $_POST['id'];
 $_SESSION['sup_name'] = $_POST['name'];
 $_SESSION['sup_phone'] = $_POST['phone'];
 header( "Location: ../../Pages/SupplierEdit.php" ); 
}




?>