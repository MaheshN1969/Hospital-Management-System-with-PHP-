<?php 
    require('include/dbh-inc.php');
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
	integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	
	

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous">
    </script>
	
</head>
<style>
	#login-submit:hover
	{
		cursor:pointer;
	}
</style>
<body>
<div class="container" style="width:450px;margin-top:115px">
<div class="card">
<div class="card-body" style="background-color:#3386FF;color:#ffffff">
					<h3>Patient Login</h3>
				</div>
<div class="card-body">
	<form class="form-group" action="include/login-func.php" method="post">
		<label>Username:</label><br>
		<input type="text" name="username" class="form-control" placeholder="Enter Username"><br>
		<label>Password:</label><br>
		<input type="password" name="password" class="form-control" placeholder="Enter Password"><br>
		<div class="form-group">
		<div class="input_group">
		<input type="submit" name="login-submit" id="login-submit" class="btn btn-primary" value="Login">
		</div>
		</div>
	</form>
</div>
</div>
</div>

	<?php
		if(isset($_GET['dberror'])){
		  echo '<small class="error-text d-flex justify-content-center align-items-center" id="msg-txt" style="margin:1rem; color:red">*Invalid username or password</small>';
		}
	?>
	<p class="lead d-flex justify-content-center">
            Not, registered yet?
          </p>
          <a href="pat-reg.php" class="lead d-flex justify-content-center">Click Here</a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>