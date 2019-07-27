<?php
	$db=mysqli_connect("localhost","root","","pos");
	
	if($db){
	}
	else{
		echo "ERROR connecting to DB " . mysqli_connect_error();
	}


?>