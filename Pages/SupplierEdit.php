
<?php
session_start();
$numnum = 1;
if($_SESSION['AdminLog'] != $numnum){
header("Location: index.php");
}

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

          <li><a href="Log-OUT.php">
            <?php 
            echo "".$_SESSION['Name']."  ";
            ?>
            <span class="glyphicon glyphicon-log-out"></span> Log-out</a></li>
          </ul>
        </div>
      </nav>


      <div class="container"  style="min-height: 580px; background-color:; ">
        <div class="row">

          <div class="col-sm-6 col-sm-offset-3" style="background-color:;"> 
              

            <div class="col-xs-12-fluid" style="background-color:;">
              <h2>
              Update Supplier
              </h2>
            </div>
            <br>
            <br>
  

            <div class="col-xs-10-fluid  col-xs-offset-1" style="background-color:;">
              <form action="SupplierEditUpdate.php" method="post">
                <fieldset class="scheduler-border">
                  <legend>Supplier:</legend>
                  <label>New Supplier Company Name:</label>
                  <input type="hidden" name="id" class = "form-control" value="<?php echo "".$_SESSION['sup_id']; ?>" required>
                  <input type="text" name="name" class = "form-control" value="<?php echo "".$_SESSION['sup_name']; ?>" required>
                  <label>new Phone No.:</label>
                  <input type="text" name="phone" class = "form-control" value="<?php echo "".$_SESSION['sup_phone']; ?>" >
                  <br>
                  <br>
                  <input type="submit" name="update" value="update" class = "btn btn-success btn-lg pull-right">
                </fieldset>
              </form>
            </div>



          </div>

        </div>
      </div>























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