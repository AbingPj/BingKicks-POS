<?php

include '../../Controllers/DataBaseController/db.php';
if(isset($_POST['submit'])){
 $name = $_POST['name'];
 $phone = $_POST['phone'];
 $query="INSERT INTO supplier(name, phone) 
   VALUES ('$name', '$phone')";
 mysqli_query($db,$query);
 header( "Location: ../../Pages/Supplier.php" ); 
}

?>

