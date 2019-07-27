
<?php
session_start();
$numnum = 1;
if($_SESSION['AdminLog'] != $numnum){
header("Location: index.php");
}

include 'db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BingKicks Supplier</title>
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

			<div class="container " style="min-height: 580px;" >
				<div class="row">

					<div class="col-xs-5" style="background-color:;"> 
						

						<div class="col-xs-12  col-xs-offset-1" style="background-color:;">
							<h2>
								Supplier Management
							</h2>
						</div>


						<div class="col-xs-9  col-xs-offset-2" style="background-color:;">
							<form action="supplierinsert.php" method="post">
								<fieldset class="scheduler-border">
									<legend>Add Supplier</legend>
									<label>Supplier Company Name:</label>
									<input type="text" name="name" class = "form-control">
									<label>Phone:</label>
									<input type="number" name="phone" class = "form-control">
									<br>
									<input type="submit" name="submit" class = "btn btn-success">
								</fieldset>
							</form>
						</div>

						
					</div>








					<div class="col-xs-7" style="background-color: rgba(150, 150, 150, 0.3)">
						
						<br>
						<br>
						<h3>Suppliers</h3> 
						<div class="scrollable">           
							<table class="table table-hover table-bordered" style=" border-style: solid; border-width: medium; border-color:blue;">
								<thead>
									<tr>
										<th>Supplier Company Name</th>
										<th>Phone</th>
										<th></th>
									</tr>
								</thead>
								
								<tbody>


									<?php


									$query="SELECT * FROM supplier";
									$result=mysqli_query($db,$query);
									while($row = mysqli_fetch_array($result)){
										
										?>
										<form action="SupplierEditRemove.php" method="post">
											<input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
											<input type="hidden" name="name" value="<?php echo $row['name']; ?>"/>
											<input type="hidden" name="phone" value="<?php echo $row['phone']; ?>"/>
											<?php
											echo "<tr>";
											echo "<td>".$row['name']."</td>";
											echo "<td>".$row['phone']."</td>";
											echo "<td>";
											?> 
											
											<input type="submit" name="edit" value="edit"  class='btn btn-danger btn-xs'>
											<?php
											echo  " | ";
											?> 
											
											<input type="submit" name="remove" value="remove"  class='btn btn-danger btn-xs'>
											<?php
               					 			//echo "<button type='button' name='remove' class='btn btn-danger btn-xs'>remove</button>";
											echo "</td>";
											echo "</tr>";
											?>
										</form>
										<?php
									}
									?>


								</tbody>

							</table>
						</div>
					</div>

				</div><!-- CLOSE FOR ROW -->
			</div><!-- CLOSE FOR CONTAINER -->
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
