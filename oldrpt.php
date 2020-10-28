<?php
	include('session.php');
	include('check.php');
	include_once('connection.php');
	// $query = "SELECT * FROM records
	// left JOIN replacement 
	// ON records.route = replacement.route_r order by route asc";

    if(isset($_POST['filter'])){
        $zone = $_POST['zone'];
        $model = $_POST['model'];

        $query = "SELECT * FROM replacement WHERE phone_model_r LIKE '%$model%' AND zone_r LIKE '%$zone%'";
        $result = mysqli_query($myconnect, $query);
        $rw = mysqli_num_rows($result);
    }else{
        $query = "SELECT * FROM replacement WHERE phone_model_r LIKE '%cat%' AND zone_r LIKE '%G%'";
        $result = mysqli_query($myconnect, $query);
    
        $qr = "SELECT COUNT(route_r) FROM replacement";
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
		<div class="card-header">
    		<ul class="nav nav-pills card-header-pills justify-content-end">
     			<li class="nav-item">
        			<a class="nav-link" href="add.php">Add Phone</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="adduser.php">Add User</a>
      			</li>
      			<li class="nav-item dropdown">
        			<a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">View Phones</a>
      			  <div class="dropdown-menu">
    				<a class="dropdown-item" href="view.php">Current Phones</a>
   					<a class="dropdown-item" href="old.php">Old Phones</a>
 				  </div>
                 </li>
                 <li class="nav-item">
        			<a class="nav-link active dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Report</a>
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

        <form action="used.php" method="POST" class="mt-1 form-inline text-center d-flex justify-content-end">
				<select name="zone" class="zone mr-2 form-control" id="zone">
                    <option value="G" class="zn">ZONE G</option>
					<option value="A" class="zn">ZONE A</option>
                    <option value="E" class="zn">ZONE E</option>
                    <option value="F" class="zn">ZONE F</option>
                </select>
				<select name="model" class="mr-2 form-control" id="model">
					<option value="CAT">CAT</option>
					<option value="INFINIX">INFINIX</option>
					<option value="SAMSUNG">SAMSUNG</option>
				</select>
				<button class="btn btn-secondary mr-2" id="filter" name="filter">FILTER</button>
		</form>
			
	<table class="table table-hover" id="init">
		<h5 class="text-center" id="thd">AVAILABLE OLD PHONES <span class="badge bg-success"><?php echo $rw ?></span></h5>
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
		  if($rw > 0){
		    while($row = mysqli_fetch_assoc($result)){
		?> 
		<div id="contents"></div>	
		<tr>
			<td><?php echo strtoupper($row['phone_model_r']); ?></td>
			<td><?php echo $row['imei_r']; ?></td>
			<td><?php echo $row['imei2_r']; ?></td>
			<td><?php echo strtoupper($row['zone_r']); ?></td>
			<td><?php echo strtoupper($row['route_r']); ?></td>
            <td><?php echo strtoupper($row['requirements_r']); ?></td>
            <td><?php echo strtoupper($row['replaced_date']); ?></td>
		</tr>
		 <?php
		 	  }
			}else{
				echo "<strong style='position: absolute; left: 48%; top: 55%'>No phone</strong>";
			}
		 ?>
	</table>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" href="js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	window.addEventListener('load', function(){
		document.getElementById('filter').addEventListener('click', function(e){
			e.preventDefault();
		
			let zone = $('#zone').val();
			let model = $('#model').val();

			$('#contents').load('used.php', { 
				zone: zone,
				model: model
			});
			const hd = document.getElementById('init');
			hd.classList.add('d-none');

			const thd = document.getElementById('thd');
			thd.classList.add('d-none');
		});
	});
</script>
</body>
</html>