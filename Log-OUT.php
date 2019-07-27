<?php 
session_start();
session_destroy();
echo "<center> <br> <br> <br>Logging out....</center>";
header( "refresh:2; url=Log-IN.php" ); 

?>