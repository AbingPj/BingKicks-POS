<?php 

//POSupdate.php

include '../../Controllers/DataBaseController/db.php';
if(isset($_POST['update'])){
 $id = $_POST['id'];
 $qty = $_POST['quantity'];
 $query="CALL updateToOrderKart('$id', '$qty')";
 mysqli_query($db,$query);
 header("Location: ../../Pages/POS.php" ); 
}

?>