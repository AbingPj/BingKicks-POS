<?php
include '../../Controllers/DataBaseController/db.php';

if(isset($_POST['change'])){
	$id = $_POST['admin_id'];
	$name = $_POST['name'];
	$UserName = $_POST['UserName'];
	$OldPassword=$_POST['OldPassword'];
	$Password = $_POST['Password'];

	$query="SELECT * FROM admin WHERE id='$id' and password='$OldPassword'";
	$result=mysqli_query($db,$query);
	$count=mysqli_num_rows($result);
	if($count==1){

			$query="UPDATE admin SET name = '$name' , username = '$UserName', password = '$Password' WHERE id = '$id' ";
	mysqli_query($db,$query);
	header( "Location: ../../Pages/Admin.php?msg1" ); 
	}
	else {
		header("Location: ../../Pages/Admin.php?msg2");
	}

}

?>