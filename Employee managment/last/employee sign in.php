<?php session_start(); ?>

<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Employees Sign In</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styling.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
		<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="well text-center">
				<div class="header">
					<div class="row">
						<div class="col-md-2">
							<a href="index.html">
								<img src="images/logo1.png" style="height: 130px; width: 130px; margin:auto">
							</a>
						</div>
						<div class="col-md-10">
							<ul>
							  <li><a href="index.php">Home</a></li>
							  <li><a href="employee sign up.php">Employee Sign Up</a></li>
							  <li><a href="employee sign in.php" class="active">Employee Login</a></li>
							  <li><a href="manager sign in.php">Manager Login</a></li>
							</ul>
						</div>
					</div>
					<hr>
					<div class="well text-center">
						<img src="images/logo1.png" style="height: 130px; width: 130px;">

						<h1>Employees Sign In</h1>
						<hr>
						<p>
						<?php 
							include("connect.php");
							if(isset($_POST['Sign-in'])) {
								$empNumber = test_input($_POST['empNumber']);
								$password = $_POST['password'];
								//echo "<br>";

								 $sql = "SELECT * FROM employee WHERE emp_number='$empNumber'";

								$result = mysqli_query($connection, $sql);
								$count = mysqli_num_rows($result);
								$row = mysqli_fetch_array($result);
								if($count ==1) {

									if(password_verify($password, $row["password"]))  
									 {  
										$_SESSION['firstname'] = $row['first_name'];
										$_SESSION['lastname'] = $row['last_name'];
										$_SESSION['employee_ID'] =  $row['emp_number'];
										$_SESSION['emp_number'] =  $row['emp_number'];
										$_SESSION['job_title'] = $row['job_title'];

										echo '<div class="alert alert-success" role="alert">Welcome You are Signed In Successfully</div>';
										echo '<META HTTP-EQUIV="Refresh" Content="2; URL=employee home page.php">'; 
									} else {
										echo '<div class="alert alert-danger" role="alert">Invalid Login. try Again</div>';
									}
								} else {
									echo '<div class="alert alert-danger" role="alert">Invalid Login. try Again</div>';
								}
							}	
						?>
						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Employee Number</label>
										<input type="text" class="form-control" name="empNumber" required>
									</div>
								</div>
								<div class="col-md-3"></div>
							</div>
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Password</label>
										<input type="password" class="form-control" name="password" pattern="[0-9]{3,15}" title="enter 3-15 digits Only" placeholder="enter 3-15 digits Only" required>
									</div>
								</div>
								<div class="col-md-3"></div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="submit" class="btn btn-primary" value="Sign In" name="Sign-in">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
                            <footer style="background-color: #549AD3; height:1cm">
	<p style="font-weight: bold; text-align: center; color: white;">© 2022 All Rights Reserved, EMH®</p>
	</footer>
			</div>	
		</div>
		<div class="col-md-2"></div>
		</div>  
	</div>
	  

  </body>
</html>