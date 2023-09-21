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
    <title>Admins</title>
</head>

<body>
    
    <h1>Available Product</h1>
    <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Name</th>
      <th scope="col">Profile</th>
      <th scope="col">Mail</th>
      <th scope="col">Mobile</th>
      <th scope="col">Update/Delete</th>
    </tr>
  </thead>
  <tbody>
 
    <?php 

    $values=getTableValues($conn,'adminusers');
  $counter=1;
    while($rows=$values->fetch_assoc()){
      echo '<tr>
      <th scope="row">'.$counter.'</th>
      <td>'.$rows['Name'].'</td>
      <td><img class="img img-thumbnail img-fluid" width="100px" src="../files/'.$rows['Profile'].'" alt="..."></td>
      <td>'.$rows['Email'].'</td>
      <td>'.$rows['Mobile'].'</td>
      <td>Crud</td>
    </tr>';
    $counter++;
    ?>
    <?php 
  
  } ?>
  </tbody>
</table>
<div class="messages">

</div>
<a class="btn btn-primary" href="addproduct.php">Add product</a>
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