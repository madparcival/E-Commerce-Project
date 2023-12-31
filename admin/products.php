<?php
    include('../inc.php');
    include('../functions/func.php');
    
if(isAdmin()){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>

<body>
    
    <h1>Available Product</h1>
    <table class="table table-light table-hover table-responsive-l">
  <thead class="table-dark">
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Weight</th>
      <th scope="col">Price</th>
      <th scope="col">Stock Quantity</th>
      <th scope="col">Stock Status</th>
      <th scope="col">Description</th>
      <th scope="col">Update/Delete</th>
      <th scope="col">Last Modified By</th>
    </tr>
  </thead>
  <tbody>
 
    <?php 

    $values=getTableValues($conn,'products');
    $counter=1;
    while($rows=$values->fetch_assoc()){
      echo '<tr>
      <th scope="row">'.$counter.'</th>
      <td>'.$rows['Name'].'</td>
      <td><img class="img img-thumbnail img-fluid" width="100px" src="../files/'.$rows['imagepath'].'" alt="..."></td>
      <td>'.$rows['Weight'].' Gram</td>
      <td>₹'.$rows['Price'].'</td>
      <td>'.$rows['Stock'].'</td>
      <td id="Status">'.$rows['Stock_Status'].'</td>
      <td>'.$rows['Description'].'</td>
      <td><a class="btn btn-outline-warning" id="updateBtn" href="updateProduct.php?id='.$rows['id'].'">Change</a><a class="deleteBtn btn btn-outline-danger" id="'.$rows['id'].'">Delete</a></td>
      <td>'.$rows['last_modified'].'</td>
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
  let statusEle=document.querySelectorAll('#Status')
  for(ele of statusEle){
    if(ele.innerText=='in-stock'){
      ele.setAttribute('class','text-bg-success')
    }
    else{
      ele.setAttribute('class','text-bg-warning')
    }
  }
</script>

<script src="js/delete.js"></script>
</html>

<?php

}else {
  
  header('location:adminlogin.php'); 
   
 }
 ?>