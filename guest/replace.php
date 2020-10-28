<?php
include_once('session.php');
include('check.php');
include_once('connection.php');
if (isset($_POST['ADD'])) {
	$model = $_POST['name'];
	$imei1 = $_POST['imei1'];
	$imei2 = $_POST['imei2'];
	$route = $_POST['number'];
	$zone = $_POST['zone'];
	$requirement = $_POST['requirement'];

// 	if($imei1 != $imei2){
// 		$query = "INSERT INTO replacement(route_r, phone_model_r, imei1_r, imei2_r, zone_r, requirements_r, replaced_date) VALUES('$route', '$model', '$imei1' ,'$imei2', '$zone', '$requirement', Now())";
// 		$result = mysqli_query($myconnect, $query);
// 		if($result){
// 			echo "<div class='text-success' style='position: absolute; top: 35%; left: 50%'>Phone replaced</div>";
// 		}else{
// 			echo "<div class='text-danger' style='position: absolute; top: 35%; left: 50%'>Change zone or route</div>";
// 		}
		
// 	}else{
// 		echo "<div class='text-danger' style='position: absolute; top: 35%; left: 50%'>Imei 1 and Imei 2 must be different</div>";
// 	}
// }

	if($imei1 != $imei2){
		$query1 = "SELECT * FROM records WHERE route = '$route' AND zone = '$zone'";
		$result1 = mysqli_query($myconnect, $query1);
		$row1 = mysqli_fetch_assoc($result1);
		$rw1 = mysqli_num_rows($result1);
		$rt = $row1['route'];
		$md = $row1['phone_model'];
		$im1 = $row1['imei'];
		$im2 = $row1['imei2'];
		$zn = $row1['zone'];
		$rq = $row1['requirements'];

		if($rw1 == 0){
			$query = "INSERT INTO replacement(route_r, phone_model_r, imei_r, imei2_r, zone_r, requirements_r, replaced_date) VALUES('$route', '$model', '$imei1' ,'$imei2', '$zone', '$requirement', Now())";
			$result = mysqli_query($myconnect, $query);
		if($result){
			echo "<div class='text-success' style='position: absolute; top: 35%; left: 50%'>Phone replaced</div>";
 		}else{
 			echo "<div class='text-danger' style='position: absolute; top: 35%; left: 50%'>Change zone or route</div>" .mysqli_error($myconnect);
 		}
		}else{
			$query = "INSERT INTO replacement(route_r, phone_model_r, imei_r, imei2_r, zone_r, requirements_r, replaced_date) VALUES('$rt', '$md', '$im1', '$im2', '$zn', '$rq', Now())";
			$result = mysqli_query($myconnect, $query);
		if(!$result){
			echo mysqli_error($myconnect);
		}else{
			$query2 = "UPDATE records SET route = '$route', phone_model = '$model', imei = '$imei1', imei2 = '$imei2', zone = '$zone', requirements = '$requirement', added_date = Now() WHERE route = '$route' AND zone = '$zone'";
			$result2 = mysqli_query($myconnect, $query2);
			if($result2){
				echo "<div class='text-success' style='position: absolute; top: 35%; left: 50%'>Phone replaced</div>";
			}else{
				echo mysqli_error($myconnect);
			}
		}
		}
	}else{
		echo "<div class='text-danger' style='position: absolute; top: 35%; left: 50%'>Imei 1 and Imei 2 must be different</div>";
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
        			<a class="nav-link active" href="replace.php">Replace Phone</a>
      			</li>
      			<li class="nav-item dropdown">
        			<a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">View Phones</a>
      			
      			  <div class="dropdown-menu">
    				<a class="dropdown-item" href="view.php">Current Phones</a>
   					<a class="dropdown-item" href="old.php">Old Phones</a>
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
	<form class ='form' method="POST" action="replace.php">
	<div class="break">
		<label><strong>PHONE MODEL:</strong></label>
		<input type="text" name="name" placeholder="infinix hot 8" class="maji3" required>
		<br></br>
		<label><strong>PHONE IMEI NO.1:</strong></label>
		<input type="number" min="1" name="imei1" placeholder="355023114887840
" class="" required>
		<br></br>
		<label><strong>PHONE IMEI NO.2:</strong></label>
		<input type="number" min="1" name="imei2" placeholder="355023114887857
" class="" required>
		<br></br>
	</div>
	<div class="break2">
		<label><strong>ROUTE NUMBER:</strong></label>
		<input type="number" min="1" name="number" placeholder="11" class="fit2" required>
		<br></br>
		<label><strong>ZONE:</strong></label>
		<input type="text" name="zone" placeholder="F" class="fit" required maxlength="1">
		<br></br>
		<label><strong>REQUIREMENT:</strong></label>
		<input type="text" name="requirement" placeholder="F.COVER + PROTECTOR" class="fit3">
		<br>
		<button class = 'btn2 mt-1 mr-5 mt-3' name='ADD'><strong>REPLACE</strong></button>
	</div>
	</form>
	<div class="py-3 bg-dark text-light f3">
		<h6 class="text-center">Mwauwasa &copy 2020</h6>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" href="js/bootstrap.bundle.min.js"></script>
</body>
</html>