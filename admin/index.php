<?php
include('../inc.php');
include('../functions/func.php');

if(isAdmin()){
  if(isset($_GET['logout'])){
    session_destroy();
    header('location:adminlogin.php');
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
</head>
<body>
  <h1>Admin Panel</h1>
<div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">
    <div class="card">
    <img src="" class="card-img-top">
      <div class="card-body">
        <h5 class="card-title">Orders</h5>
        <p><a class="btn btn-dark" href="#">Go to</a></p>  
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Products</h5>
        <p><a class="btn btn-dark" href="products.php">Go to</a></p>
        <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Users/Customers</h5>
        <p><a class="btn btn-dark" href="#">Go to</a></p>
        <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p> -->
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Admin Add/Revoke</h5>
        <p><a class="btn btn-dark" href="#">Go to</a></p>
        <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
      </div>
    </div>
  </div>
</div>
</body>
</html>




<?php

 



}else {
  
 header('location:adminlogin.php'); 
  
}
?>