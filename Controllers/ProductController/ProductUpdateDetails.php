<?php 
//ProductUpdateDetailsAndImage.php
include '../../Controllers/DataBaseController/db.php';

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
 header("Location: ../../Pages/Product.php" ); 
}

if(isset($_POST['ChangeImage'])){
  $fileExt=strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
  $allowedExt=array("png","jpg","gif","jpeg"); 
  if(in_array($fileExt,$allowedExt)){
   $id= $_POST['product_id'];
   $img_name = $_FILES['file']['name'];
   move_uploaded_file($_FILES['file']['tmp_name'], "assets/img/" . $img_name);
   $query="UPDATE product SET img_name = '$img_name'  
   WHERE id = '$id' ";
   mysqli_query($db,$query);
   //echo "<meta http-equiv='refresh' content='0'>";
   header("Location:Product.php" ); 

 }
}



?>