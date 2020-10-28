<?php 
    include('session.php');
	include('check.php');
    include_once('connection.php');
    
    $zone = $_POST['zone'];
    $model = $_POST['model'];

    $query = "SELECT * FROM records WHERE phone_model LIKE '%$model%' AND zone LIKE '%$zone%'";
    $result = mysqli_query($myconnect, $query);
    $rw = mysqli_num_rows($result);   
?>

<table class="table table-hover">
    <h5 class="text-center" id="thd">AVAILABLE CURRENT PHONES <span class="badge badge-pill bg-success"><?php echo $rw ?></span></h5>
    <thead class="table-light">
        <th>PHONE MODEL</th>
        <th>IMEI 1</th>
        <th>IMEI 2</th>
        <th>ZONE</th>
        <th>ROUTE</th>
        <th>PHONE NUMBER</th>
        <th>REQUIREMENTS</th>
        <th>DATE</th>
        <th>
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
      </tr>
       <?php
             }
          }else{
              echo "<strong style='position: absolute; left: 48%; top: 50%'>No phone</strong>";
          }
       ?>		   
</table>