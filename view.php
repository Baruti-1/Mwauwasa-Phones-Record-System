<?php
	include('session.php');
	include('check.php');
	include_once('connection.php');
	// $query = "SELECT * FROM records
	// left JOIN replacement 
	// ON records.route = replacement.route_r order by route asc";

	if(isset($_POST['search'])){
		$search = $_POST['search'];

		$query = "SELECT * FROM records WHERE mobile_number LIKE '%$search%'";
		$result = mysqli_query($myconnect, $query);

		$qr = "SELECT COUNT(route) FROM records";
		$rt = mysqli_query($myconnect, $qr);
		$rw = mysqli_num_rows($result);
	}else{
		$query = "SELECT * FROM records ORDER BY zone ASC";
		$result = mysqli_query($myconnect, $query);

		$qr = "SELECT COUNT(route) FROM records";
		$rt = mysqli_query($myconnect, $qr);
		$rw = mysqli_num_rows($result);
	}
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
			<form action="view.php" method="POST" class="form-inline justify-content-end mb-3">
				<input type="number" min="1" name="search" id="find" placeholder="Enter phone number start with 255" class="form-control" required>
				<button class="btn btn-default mr-1" id="search">Search</button>
			</form>
		<div class="card-header">
    		<ul class="nav nav-pills card-header-pills justify-content-end">
     			<li class="nav-item">
        			<a class="nav-link" href="add.php">Add Phone</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="adduser.php">Add User</a>
      			</li>
      			<li class="nav-item dropdown">
        			<a class="nav-link active dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">View Phones</a>
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
	
	<table class="table table-hover">
		<h5 class="text-center">CURRENT PHONES <span class="badge bg-success"><?php echo $rw ?></span></h5>
		<thead class="table-light">
			<th>PHONE MODEL</th>
			<th>IMEI 1</th>
			<th>IMEI 2</th>
			<th>ZONE</th>
			<th>ROUTE</th>
			<th>PHONE NUMBER</th>
			<th>REQUIREMENTS</th>
			<th>DATE</th>
		</thead>
		<?php
		  if($rw > 0){
		    while($row = mysqli_fetch_assoc($result)){
		?> 	
		<tr>
			<td><?php echo strtoupper($row['phone_model']); ?></td>
			<td><?php echo $row['imei']; ?></td>
			<td><?php echo $row['imei2']; ?></td>
			<td><?php echo strtoupper($row['zone']); ?></td>
			<td><?php echo strtoupper($row['route']); ?></td>
			<td><?php echo $row['mobile_number']; ?></td>
			<td><?php echo strtoupper($row['requirements']); ?></td>
			<td><?php echo strtoupper($row['added_date']); ?></td>
			<td><a class="lnk" href="updatecurrent.php?id=<?php echo $row['id']; ?>">UPDATE<i class="glyphicon glyphicon-edit"></i></a></td>
			<td><a class="lnk" href="replace.php?id=<?php echo $row['id']; ?>">REPLACE<i class="glyphicon glyphicon-edit"></i></a></td>
		</tr>
		 <?php
		 	  }
			}else{
				echo "<strong style='position: absolute; left: 48%; top: 51%'>No phone found</strong>";
			}
		 ?>
	</table>
	<!-- <div class="py-3 bg-dark text-light f2">
		<h6 class="text-center">Mwauwasa &copy 2020</h6>
	</div> -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" href="js/bootstrap.bundle.min.js"></script>
</body>
</html>