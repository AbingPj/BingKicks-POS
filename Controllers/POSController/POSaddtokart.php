
<?php
include '../../Controllers/DataBaseController/db.php';
if(isset($_POST['submit'])){
 $id = $_POST['id'];
 $query="CALL addToOrderKart2('$id')";
 mysqli_query($db,$query);
 header("Location: ../../Pages/POS.php" ); 
}
?>

