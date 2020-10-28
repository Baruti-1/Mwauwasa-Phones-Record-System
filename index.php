<?php
include_once('session.php');
// connet database and web page;//
$connect = mysqli_connect("localhost", "root", "", "phone_records");
if(!$connect){
	echo "error";
}
// to take input from the form the web page//
	if(isset($_POST['send'])){
	 $username = $_POST['user'];
	 $password = SHA1($_POST['pass']);
	 
	 $query = "SELECT * FROM USER WHERE USERNAME = '$username' AND PASSWORD = '$password'";
	 $result = mysqli_query($connect, $query);
	 $rw = mysqli_fetch_assoc($result);
	 $row = mysqli_num_rows($result);
	 if($row == 1){
	 	$_SESSION['username'] = $username;
	 	if($rw['role'] == 'admin'){
			header("location: view.php");
	 	}else{
	 		header('location: guest/view.php');
	 	}	
	 }
	 else{
		echo "<div class='error text-danger'>Incorrect username/password</div>";
	 }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="custom/style.css">
	<style>
		p { 
			color:blue;
		}
	</style>
</head>
<body class="background">
	<div>
	<h1 class='text-center text2'>MWAUWASA PHONES RECORD SYSTEM</h1>
	</div>
	<hr>
	<form class='position' method="post" action="index.php">
		<img src="images/logo2.jpg" class="center">
		<br></br>
		<label class='maji2'><strong>USERNAME:</strong></label>
		<input type="text" name="user" required placeholder="Enter username">
		<br></br>
		<label class="ml"><strong>PASSWORD:</strong></label>
		<input type="password" name="pass" class="maji" required placeholder="Enter password">
		<br></br>
		<button class = 'button' name="send"><strong>LOGIN</strong></button>
	</form>
	<div class="py-3 bg-dark text-light f4">
		<h6 class="text-center">Mwauwasa &copy 2020</h6>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" href="js/bootstrap.bundle.min.js"></script>
</body>
</html>