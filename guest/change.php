<?php
include_once('session.php');
include('check.php');
include_once('connection.php');	
if(isset($_POST['send'])){
	 $old_pass = SHA1($_POST['pass_old']);
	 $new_pass = SHA1($_POST['pass_new']);
	 $con_pass = SHA1($_POST['pass_conf']);

	 $pass = $_SESSION['username'];
	 $query = "select password from user where username = '$pass'";
	 $result = mysqli_query($myconnect,$query);
	 $rows = mysqli_fetch_assoc($result);
	if($rows['password'] != $old_pass ){
		echo "<div class='text-danger' style='position: absolute; top: 35%; left: 50%'>Incorrect old pasword</div>";
	}
	else{
		if ($new_pass == $con_pass) {
			$query2 = "update user set password = '$con_pass' where username = '$pass'";
			$result2 = mysqli_query($myconnect, $query2);
			
			echo "<div class='text-success' style='position: absolute; top: 35%; left: 50%'>Password changed</div>";
		}else{
			echo "<div class='text-danger' style='position: absolute; top: 35%; left: 50%'>Passwords does\'nt match'</div>";
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
        			<a class="nav-link" href="replace.php">Replace Phone</a>
      			</li>
      			<li class="nav-item dropdown">
        			<a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">View Phones</a>
      			
      			  <div class="dropdown-menu">
    				<a class="dropdown-item" href="view.php">Current Phones</a>
   					<a class="dropdown-item" href="old.php">Old Phones</a>
 				  </div>
				 </li>
      			<li class="nav-item">
        			<a class="nav-link active" href="change.php">Change Password</a>
      			</li>
     			 <li class="nav-item">
        			<a class="nav-link" href="logout.php">Logout</a>
      			</li>
    		</ul>
 		 </div>
 		</header>
	</div>
	<hr>
	<form class ='form' method="POST" action="change.php">
		<div class="add">
			<label><strong>OLD PASSWORD:</strong></label>
			<input type="password" name="pass_old" required placeholder="Enter old password" class="lab1">
			<br></br>
			<label><strong>NEW PASSWORD:</strong></label>
			<input type="password" name="pass_new" required placeholder="Enter new password" class="lab">
			<br></br>
			<label><strong>CONFIRM PASSWORD:</strong></label>
			<input type="password" name="pass_conf" required placeholder="Confirm new password" class="lab2">
			<br></br>
			<button class = 'button2 ml-auto' name='send'><strong>CHANGE</strong></button>
		</div>
	</form>
	<div class="py-3 bg-dark text-light f2">
		<h6 class="text-center">Mwauwasa &copy 2020</h6>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript" href="js/bootstrap.bundle.min.js"></script>
</body>
</html>