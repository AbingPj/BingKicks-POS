<?php 

//POSupdate.php

include 'db.php';
if(isset($_POST['update'])){
 $id = $_POST['id'];
 $qty = $_POST['quantity'];
 $query="CALL updateToOrderKart('$id', '$qty')";
 mysqli_query($db,$query);
 header("Location:pos.php" ); 
}

?>