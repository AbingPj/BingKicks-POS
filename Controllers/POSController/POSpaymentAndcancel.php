<?php 
session_start();
                        

include '../../Controllers/DataBaseController/db.php';

if(isset($_POST['submitcash'])){
  $totals = $_SESSION['totals'];
  $admin_id = $_SESSION['admin_id'];
  $cash = $_POST['cash'];
  if($cash < $totals){
    header( "Location: ../../Pages/POS.php?msg3" ); 
  }else{
    


    $query="CALL addSales( $totals, $admin_id )";
    mysqli_query($db,$query);
    
    $query="CALL addtoProductSold()";
    mysqli_query($db,$query);

    $query="DELETE FROM orderkart";
    mysqli_query($db,$query);

    $query="ALTER TABLE orderkart AUTO_INCREMENT = 1";
    mysqli_query($db,$query);

    header( "Location: ../../Pages/POS.php"); 


  }

}
if(isset($_POST['submitcancel'])){
  $query="DELETE FROM orderkart";
  mysqli_query($db,$query);

  $query="ALTER TABLE orderkart AUTO_INCREMENT = 1";
  mysqli_query($db,$query);
  header( "Location: pos.php"); 

 //$query="Truncate table orderkart";
  //mysqli_query($db,$query);

}


?>