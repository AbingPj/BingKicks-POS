<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log-in AbingProducts</title>
	<link rel="stylesheet"  href="assets/css/bootstrap.min.css">
	<link rel="stylesheet"  href="assets/css/custom.css">
</head>
<body>

	<div class="container-fluid my-color">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-2">
				<FONT size=6>BingKicks</FONT>Point of Sale
			</div>
		</div>
	</div>


	<br>
	<br>
	<br>


	<div class="row">
		<div class="col-xs-4 col-xs-offset-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<center><h4>Welcome Back Admin!</h4></center>
					
				</div>
				<div class="panel-body">
					<form action"" method="post" class ="form-horizontal">
						<div class="form-group">
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
									<br><input type="text" name="username" class="form-control" placeholder="Username">
									<br><input type="password" name="password" class="form-control" placeholder="Password">
								</div>
							</div>
							<br>

							<div class="col-sm-10 col-sm-offset-3">
								<div class="row">
									<?php
									echo "&nbsp;&nbsp;&nbsp;&nbsp;";
									include 'Controllers/DataBaseController/db.php';
									if(isset($_POST['submit'])){
										$myusername=$_POST['username']; 
										$mypassword=$_POST['password']; 

										$query="SELECT * FROM admin WHERE username='$myusername' and password='$mypassword'";
										$result=mysqli_query($db,$query);

										$count=mysqli_num_rows($result);
										if($count==1){

											while($row = mysqli_fetch_array($result)){
												$_SESSION['admin_id'] = $row['id'];
												$_SESSION['username'] = $row['UserName'];
												$_SESSION['Name'] = $row['Name'];
											}
											$_SESSION['AdminLog'] = 1;
											header("location:pages/pos.php");
										}
										else {
											echo "Wrong Username or Password";
										}
									}
									?>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-10 col-sm-offset-4">
									<br>
									<input type="submit" name='submit' value="Log-in" class="btn btn-success">
									<input type="button" name='cancel' value="cancel" class="btn btn-danger">
									<br>
								</div>
							</div>

						</div>
					</form>
				</div>	
			</div>
		</div>
	</div>
	<center>
		&copy;2017 BingKicks POS
	</center>




	<script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>









</html>