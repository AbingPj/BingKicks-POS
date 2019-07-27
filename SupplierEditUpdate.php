<?php
include 'db.php';

if(isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
    $query="UPDATE supplier SET name = '$name' , phone = '$phone' WHERE id = '$id'";
	mysqli_query($db,$query);
	header( "Location: Supplier.php" ); 
}

?>