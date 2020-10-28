<?php
include_once('session.php');
include('check.php');
include_once('connection.php');
if(isset($_POST['send'])){
	 $username = $_POST['user'];
	 $email = $_POST['email'];
	 $role = $_POST['role'];
	 $password = SHA1($_POST['pass']);
	
	$query2 = "SELECT username FROM user WHERE username = '$username'";
	$result = mysqli_query($myconnect,$query2);
	$rows = mysqli_num_rows($result);
	if($rows>= 1){
		echo "<div class='text-danger' style='position: absolute; top: 35%; left: 50%'>Use another user name</div>";
	}
	else{
		$query = "insert into user(username, email, role, password) values('$username', '$email', '$role', '$password')";
		$result = mysqli_query($myconnect,$query);
		if ($result) {
			echo "<div class='text-success' style='position: absolute; top: 35%; left: 50%'>User added</div>";
			// 7110eda4d09e062aa5e4a390b0a572ac0d2c0220
		}else{
			echo mysqli_error($myconnect);
		}

	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="custom/style.css">
</head>
<body>
	<div class="head">
		<header>
			<h1 class='text'>MWAUWASA PHONES RECORD SYSTEM</h1>
			<img src="images/logo2.jpg" class="center2">
		<div class="card-header">
    		<ul class="nav nav-pills card-header-pills justify-content-end">
     			<li class="nav-item">
        			<a class="nav-link" href="add.php">Add Phone</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link active" href="adduser.php">Add User</a>
      			</li>
      			<li class="nav-item dropdown">
        			<a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">View Phones</a>
      			
      			  <div class="dropdown-menu">
    				<a class="dropdown-item" href="view.php">Current Phones</a>
   					<a class="dropdown-item" href="old.php">Old Phones</a>
 				  </div>
				 </li>
				  <li class="nav-item">
        			<a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Report</a>
        			<div class="dropdown-menu">
    				<a class="dropdown-item" href="report.php">Current Phones</a>
   					<a class="dropdown-item" href="oldrpt.php">Old Phones</a>
 				  </div>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="change.php">Change Password</a>
      			</li>
     			 <li class="nav-item">
        			<a class="nav-link" href="logout.php">Logout</a>
      			</li>
    		</ul>
 		 </div>
 		</header>
	</div>
	<hr>
	<form class ='form' method="POST" action="adduser.php">
		<div class="add">
			<label><strong>USERNAME:</strong></label>
			<input type="text" name="user" required placeholder="Enter username">
			<br></br>
			<label><strong>E-MAIL:</strong></label>
			<input type="email" name="email" required placeholder="Enter email" class="mail">
			<br></br>
			<label><strong>ROLE:</strong></label>
			<select name="role" class="role" required>
				<option value="">--SELECT ROLE--</option>
				<option value="admin">ADMIN</option>
				<option value="guest">GUEST</option>
			</select>
			<br><br>
			<label><strong>PASSWORD:</strong></label>
			<input type="password" name="pass" required placeholder="Enter password">
			<br></br>
			<button class = 'btn3 ml-auto' name='send'><strong>Save</strong></button>
		</div>
	</form>
	<div class="py-3 bg-dark text-light f1">
		<h6 class="text-center">Mwauwasa &copy 2020</h6>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- <script type="text/javascript" href="js/bootstrap.bundle.min.js"></script> -->
	<script>
		$(document).ready(function(){
			$("#showToast").click(function(){
				$('.toast').toast('show');
			})
		})
	</script>
</body>
</html>