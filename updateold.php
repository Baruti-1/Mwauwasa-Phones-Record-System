<?php
include('session.php');
include('check.php');
include_once('connection.php');
if (isset($_POST['update'])) {
	$model = $_POST['name'];
	$imei1 = $_POST['imei1'];
	$imei2 = $_POST['imei2'];
	$route = $_POST['number'];
	// $mobile = $_POST['tel'];
	$zone = $_POST['zone'];
	$requirement = $_POST['requirement'];

	if($imei1 == $imei2){
		echo "<div class='text-danger' style='position: absolute; top: 35%; left: 50%'>Imei 1 and Imei 2 must be different</div>";
	}else{
		$qr1 = "UPDATE replacement SET route_r = '$route', phone_model_r = '$model', imei_r = '$imei1', imei2_r = '$imei2', zone_r = '$zone', requirements_r = '$requirement', replaced_date = Now()
		WHERE id = '" .$_SESSION['id']. "'";
		$rs1 = mysqli_query($myconnect, $qr1);
		if(!$rs1){
			echo mysqli_error($myconnect);
		}else{
			echo "<div class='text-success' style='position: absolute; top: 35%; left: 50%'>Phone updated</div>";
		}
	}

    $query = "SELECT * FROM replacement WHERE id = '" .$_SESSION['id']. "'";
    $result = mysqli_query($myconnect, $query);
    $rw = mysqli_fetch_assoc($result);
}else{
    $id = $_GET['id'];
    $_SESSION['id'] = $id;
    $qr2 = "SELECT * FROM replacement WHERE id = '$id'";
    $rs2 = mysqli_query($myconnect, $qr2);
    $rw = mysqli_fetch_assoc($rs2);
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="custom/style.css">
</head>
<body>
	<header>
	<div class="head">
			<h1 class='text'>MWAUWASA PHONES RECORD SYSTEM</h1>
			<img src="images/logo2.jpg" class="center2">
			<div class="card-header">
    		<ul class="nav nav-pills card-header-pills justify-content-end">
     			<li class="nav-item">
        			<a class="nav-link" href="add.php">Add Phone</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="adduser.php">Add User</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="replace.php">Replace Phone</a>
      			</li>
      			<li class="nav-item dropdown">
        			<a class="nav-link dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">View Phones</a>
      			
      			  <div class="dropdown-menu">
    				<a class="dropdown-item" href="view.php">Current Phones</a>
   					<a class="dropdown-item" href="old.php">Old Phones</a>
 				  </div>
 				</li>
 					 <li class="nav-item">
        			<a class="nav-link" href="report.php">Report</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="change.php">Change Password</a>
      			</li>
     			 <li class="nav-item">
        			<a class="nav-link" href="logout.php">Logout</a>
      			</li>
    		</ul>
 		 </div>
 		</div>
 	</header>
	<hr>
	<form class ='form' method="POST" action="updateold.php">
	<div class="break">
		<label><strong>PHONE MODEL:</strong></label>
		<input type="text" name="name" placeholder="infinix hot 8" class="maji3" value="<?php echo strtoupper($rw['phone_model_r']); ?>" required>
		<br></br>
		<label><strong>PHONE IMEI NO.1:</strong></label>
		<input type="number" min="1" name="imei1" placeholder="355023114887840
" class=""  value="<?php echo strtoupper($rw['imei_r']); ?>" required>
		<br></br>
		<label><strong>PHONE IMEI NO.2:</strong></label>
		<input type="number" min="1" name="imei2" placeholder="355023114887857
" class=""  value="<?php echo strtoupper($rw['imei2_r']); ?>" required>
		<br></br>
		<label><strong>ZONE:</strong></label>
		<input type="text" name="zone" placeholder="F" class="fit"  value="<?php echo strtoupper($rw['zone_r']); ?>" required maxlength="1">
	</div>
	<div class="break2">
		<label><strong>ROUTE NUMBER:</strong></label>
		<input type="number" min="1" name="number" placeholder="11" class="fit2" value="<?php echo strtoupper($rw['route_r']); ?>" required>
		<br></br>
<!-- 		<label><strong>MOBILE NUMBER:</strong></label>
		<input type="tel" name="tel" placeholder="255624243430
" class="" value="<?php echo strtoupper($rw['mobile_number_r']); ?>" required> -->
	<!-- 	<br></br> -->
		<label><strong>REQUIREMENT:</strong></label>
		<input type="text" name="requirement" value="<?php echo strtoupper($rw['requirements_r']); ?>" placeholder="F.COVER + PROTECTOR" class="fit3">
		<br>
		<button class = 'btn1 ml-auto mt-4' name='update'><strong>UPDATE</strong></button>
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