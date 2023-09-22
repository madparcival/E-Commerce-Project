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
  <style>
    body{
      background:linear-gradient(90deg,#ff7171);
    }
    
    .card-img-overlay{
      height: 60%;
      border: white solid 2px;
      background-color: rgb(255, 255, 255,0.5);
      backdrop-filter: blur(4px);
    }
  </style>
</head>
<body>
  <h1>Admin Panel</h1>
  <img src="<?php
        $searchQuery="SELECT Profile FROM adminusers WHERE id=$_SESSION[admin];";
        $result=mysqli_query($conn,$searchQuery);
        if($result->num_rows>0){
          $ProfileArray=$result->fetch_assoc();
          echo $ProfileArray['Profile'];
        } 
      ?>" alt="">
  <p><a href="index.php?logout" class="btn btn-dark link-light link-offset-2">Logout</a></p>
  
<div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">
    <div class="card text-bg-light w-75">
    <img src="imgs/cart.jpg" class="card-img">
      <div class="card-img-overlay">
        <h5 class="card-title">Orders
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
           99+
          </span>
        </h5>
        <p><a class="btn btn-warning" href="#">Go to</a></p>  
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card text-bg-dark w-75">
      <img src="imgs/products.jpg" class="card-img" alt="...">
      <div class="card-img-overlay">
        <h5 class="card-title">Products</h5>
        <p><a class="btn btn-warning" href="products.php">Go to</a></p>
        </div>
    </div>
  </div>
  <!-- <div class="col">
    <div class="card text-bg-dark w-75">
      <img src="..." class="card-img" alt="...">
      <div class="card-img-overlay">
        <h5 class="card-title">Users/Customers</h5>
        <p><a class="btn btn-warning" href="#">Go to</a></p>
        </div>
    </div>
  </div> -->
  <?php
  if($_SESSION['Name']=='root'){
  
  ?>
  <div class="col">
    <div class="card text-bg-dark w-75">
      <img src="imgs/admin.jpg" class="card-img" alt="...">
      <div class="card-img-overlay">
        <h5 class="card-title text-dark">Admin Add/Revoke</h5>
        <p><a class="btn btn-warning" href="admins.php">Go to</a></p>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
</body>
</html>


<?php
}else {
  
 header('location:adminlogin.php'); 
  
}
?>