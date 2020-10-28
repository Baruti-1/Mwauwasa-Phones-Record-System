<?php 
    include('session.php');
	include('check.php');
    include_once('connection.php');
    
    $zone = $_POST['zone'];
    $model = $_POST['model'];

    $query = "SELECT * FROM replacement WHERE phone_model_r LIKE '%$model%' AND zone_r LIKE '%$zone%'";
    $result = mysqli_query($myconnect, $query);
    $rw = mysqli_num_rows($result);  
?>

<table class="table table-hover">
    <h5 class="text-center">AVAILABLE OLD PHONES <span class="badge bg-success"><?php echo $rw ?></span></h5>
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