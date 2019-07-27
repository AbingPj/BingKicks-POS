<?php
include '../../Controllers/DataBaseController/db.php';
if(isset($_POST['submit'])){
  $fileExt=strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
  $allowedExt=array("png","jpg","gif","jpeg"); 
  if(in_array($fileExt,$allowedExt)){
   $name = $_POST['name'];
   $category = $_POST['category'];
   $supplier = $_POST['supplier'];
   $price = $_POST['price'];
   $img_name = $_FILES['file']['name'];
   move_uploaded_file($_FILES['file']['tmp_name'], "../../assets/img/" . $img_name);
   $query="INSERT INTO product(name, category, supplier, price, img_name) 
   VALUES ('$name', '$category', '$supplier', '$price', '$img_name' )";
   mysqli_query($db,$query);
   //echo "Uploaded Successfully";
   //echo "<meta http-equiv='refresh' content='0'>";
    header("Location: ../../Pages/Product.php" ); 
 
 }
}
?>