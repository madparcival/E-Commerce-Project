<?php
    include('../inc.php');
    include('../functions/func.php');
    
if(isAdmin() && $_SESSION['Name']=='root'){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
</head>

<body>
    
    <h1>Users</h1>
    <table class="table table-secondary table-striped table-hover table-bordered table-responsive-md">
  <thead class="table-dark">
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Name</th>
      <th scope="col">Profile</th>
      <th scope="col">Address</th>
      <th scope="col">Address</th>
      <th scope="col">State</th>
      <th scope="col">Mail</th>
      <th scope="col">Mobile</th>
      <th scope="col">Update</th>
    </tr>
  </thead>
  <tbody>
 
    <?php 

    $values=getTableValues($conn,'customers');
  $counter=1;
    while($rows=$values->fetch_assoc()){
      echo '<tr>
      <th scope="row">'.$counter.'</th>
      <td>'.$rows['Name'].'</td>
      <td><img class="img img-thumbnail img-fluid" width="100px" src="../files/profileimgs/'.$rows['Profile'].'" alt="..."></td>
      <td>'.$rows['Address'].'</td>
      <td>'.$rows['Address2'].'</td>
      <td>'.$rows['State'].'</td>

      <td>'.$rows['Email'].'</td>
      <td>'.$rows['Mobile'].'</td>
      <td><a href="updateUsers.php?id='.$rows['id'].'" class="btn btn-success">Update</a></td>
    </tr>';
    $counter++;
    ?>
    <?php 
  
  } ?>
  </tbody>
</table>
<div class="messages">

</div>
</body>
<script>
  
</script>

<script src="js/delete.js"></script>
</html>

<?php

}else {
  
  header('location:adminlogin.php'); 
   
 }
 ?>