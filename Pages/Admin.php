
<?php
session_start();
$numnum = 1;
if($_SESSION['AdminLog'] != $numnum){
header("Location: ../index.php");
}

include '../Controllers/DataBaseController/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BingKicks Admin</title>
	<link rel="stylesheet"  href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet"  href="../assets/css/custom.css">
</head>
<body>


  <nav class="navbar my-color"><!-- navbar-fixed-top  -->

    <div class="container">

      <div class="navbar-header">
        <a class="navbar-brand" href="pos.php"> <font size=6>BingKicks</font>Point of Sale </a>
      </div>
      <ul class="nav navbar-nav">

        <li class="active">
          <a href="pos.php"><span class="glyphicon glyphicon-home"></span></a>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-th-list"></span>

            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="Product.php">Product</a></li>
              <li><a href="Supplier.php">Supplier</a></li>
              <li><a href="Admin.php">Admin Settings</a></li>
            </ul>

          </li>
          <li><a href="sales.php">SALES</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">

          <li><a href="../Controllers/DataBaseController/log-out.php">
            <?php 
            echo "".$_SESSION['Name']."  ";
            ?>
            <span class="glyphicon glyphicon-log-out"></span> Log-out</a></li>
          </ul>
        </div>
      </nav>




 <div class="container"  style="min-height: 580px; ">
        <div class="row">

          <div class="col-sm-6 col-sm-offset-3" style="background-color:;"> 
              

            <div class="col-xs-12-fluid" style="background-color:;">
              <h2>
              Admin Settings
              </h2>
            </div>
            <br>
            <br>
  

            <div class="col-xs-10-fluid  col-xs-offset-1" style="background-color:;">
              <form action="../Controllers/AdminController/AdminUpdate.php" method="post">
                <fieldset class="scheduler-border">
                  <legend>Admin Details: </legend>
                  <label>Name:</label> 
                  <input type="hidden" name="admin_id" class = "form-control" value="<?php echo "".$_SESSION['admin_id']; ?>" required>
                  <input type="text" name="name" class = "form-control" value="<?php echo "".$_SESSION['Name']; ?>" >
                  <br>
                  <label>UserName:</label>
                  <input type="text" name="UserName" class = "form-control" value="<?php echo "".$_SESSION['username']; ?>" required>
                   <label>Old Password</label>
                  <input type="password" name="OldPassword" class = "form-control" required>
                  <label>New Password</label>
                  <input type="password" name="Password" class = "form-control" required>
                  <br>
                  <?php 
                  if(isset($_GET['msg1'])){
                          $Message = "Successfully Changed";
                          $Message2 ="Back to Home";
                           echo "<font class='col-sm-offset-2'> $Message,....   <a href='pos.php'>$Message2 <a> </font><br>";
                         }
                   if(isset($_GET['msg2'])){
                          $Message = "Wrong Username or Old Password";
                           echo "<font class='col-sm-offset-3'> $Message </font>";
                         }


                  ?>
                  <br>
                  <input type="submit" name="change" value="change" class = "btn btn-success btn-lg pull-right">
                </fieldset>
               
              </form>
            </div>



          </div>

        </div>
      </div>










<br>
<br>
 <footer class="container-fluid my-color">
 
<center><p>
<br>
<br>
&copy;2017 BingKicks POS </p></center>

</footer>     
<script src="../assets/js/jquery-3.2.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>

