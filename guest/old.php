<?php
	include('session.php');
	include('check.php');
	include_once('connection.php');
	// $query = "SELECT * FROM records
	// left JOIN replacement 
	// ON records.route = replacement.route_r order by route asc";

	$query = "SELECT * FROM replacement ORDER BY route_r ASC";
	$result = mysqli_query($myconnect, $query);
	$row = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Phones</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="custom/style.css">
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
        			<a class="nav-link active dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">View Phones</a>
      			
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
	<table class="table table-hover">
		<h5 class="text-center">OLD PHONES <span class="badge bg-success"><?php echo $row ?></span></h5>
		<thead class="table-light">
			<th>PHONE MODEL</th>
			<th>IMEI 1</th>
			<th>IMEI 2</th>
			<th>ZONE</th>
			<th>ROUTE</th>
			<th>REQUIREMENTS</th>
			<th>DATE</th>
		</thead>
		<?php
		  if($row > 0){
		  	while($row = mysqli_fetch_assoc($result)){
		?> 	
		<tr>
			<td><?php echo strtoupper($row['phone_model_r']); ?></td>
			<td><?php echo $row['imei_r']; ?></td>
			<td><?php echo $row['imei2_r']; ?></td>
			<td><?php echo strtoupper($row['zone_r']); ?></td>
			<td><?php echo strtoupper($row['route_r']); ?></td>
			<td><?php echo strtoupper($row['requirements_r']); ?></td>
			<td><?php echo $row['replaced_date']; ?></td>
			<td><a class="lnk" href="updateold.php?id=<?php echo $row['id']; ?>">UPDATE<i class="glyphicon glyphicon-edit"></i></a></td>
		</tr>
		 <?php
		  }
		}else{
			echo "<strong style='position: absolute; left: 48%; top: 45%'>No phone</strong>";
		}
		 ?>
	</table>
	<!-- <div class="py-3 bg-dark text-light f2">
		<h6 class="text-center">Mwauwasa &copy 2020</h6>
	</div> -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity
="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" href="js/bootstrap.bundle.min.js"></script>
</body>
</html>