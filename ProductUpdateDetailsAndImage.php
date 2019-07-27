<?php 
//ProductUpdateDetails.php
include 'db.php';

if(isset($_POST['UpdateDetails'])){
 $id= $_POST['product_id'];
 $name = $_POST['name'];
 $category = $_POST['category'];
 $supplier = $_POST['supplier'];
 $price = $_POST['price'];
 $query="UPDATE product SET name = '$name' , category = '$category', supplier = '$supplier', price = '$price'  
 WHERE id = '$id' ";
 mysqli_query($db,$query);
 //echo "<meta http-equiv='refresh' content='0'>";
 header("Location:Product.php" ); 
}


?>