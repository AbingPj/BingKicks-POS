<?php 

include 'db.php';

if(isset($_POST['remove'])){
 $id = $_POST['id'];
 $query="DELETE FROM orderkart WHERE id = '$id' ";
 mysqli_query($db,$query);
 header( "Location: POS.php" ); 
}

?>
