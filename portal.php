

<?php
include('inc.php');
include('functions/func.php');
if(isset($_GET['logout'])){
    session_destroy();
    header('location:userlogin.php');
}
if(isLoggedIn()){
  $searchQuery="SELECT Profile FROM customers WHERE id=$_SESSION[id];";
  $result=mysqli_query($conn,$searchQuery);
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamazon</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> 
    <script src="https://kit.fontawesome.com/d6f56984f1.js" crossorigin="anonymous"></script>
</head>
<body>
    
<!-- slide bar -->
<nav class="navbar navbar-dark bg-dark mb-3">
  <div class="container-fluid px-3">
    <a class="navbar-brand" href="#">Hamazon</a>
    
    <!-- off canvas -->
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="bi bi-search"></i></button>
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Search</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" id="searchBtn" placeholder="Search" aria-label="Search">
      </form>
      <div class="offcanvas-body" id="searchOutput">
        <p>Search the Hamazon</p>
      </div>
    </div>
    <h3 class="text-warning">Hello <?php echo $_SESSION['Name'];?></h3>
    <p><a href="portal.php?logout" class="btn btn-secondary link-light link-offset-2">Logout</a></p>
    <!-- add image source from user profile -->
    <img class="rounded-circle object-fit-contain" width="60" height="60" src="files/profileimgs/<?php
    if($result->num_rows>0){
      $ProfileArray=$result->fetch_assoc();
      echo $ProfileArray['Profile'];
    }  ?>" alt="...">
    <!-- navbar cart -->
    <button class="navbar-toggler" id="cartBtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="text-light"><i class="fa-solid fa-cart-shopping"></i></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Cart Items</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body" id="cartDiv">
        
        
      </div>
        <a class="btn btn-success border-1" href="checkout.php">Proceed to Checkout</a>
    </div>
  </div>
</nav>
<div class="profile text-end">

</div>

<div class="row row-cols-2 row-cols-md-3 g-4 mx-auto">
  
<?php 

$values=getTableValues($conn,'products'); 
while($arr=$values->fetch_assoc()){
  ?><div class="col">
  <div class="card h-100 bg-warning-subtle" style="width: 18rem;">
    <img src="files/<?php echo $arr['imagepath']?>" class="card-img-top mx-auto w-50" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?php echo $arr['Name'];?></h5>
      <p class="card-text"><?php echo $arr['Description'];?></p>
      <p class="card-text">₹ <?php echo $arr['Price']; ?></p>
      <?php 
      if($arr['Stock_Status']=='in-stock')
        echo '<p class="badge text-bg-success" >Stock Available</p>';
      else
        echo '<p class="badge text-bg-danger" >Stock Unvailable</p>';
      
      ?>
      <p>Quantity:</p><input class="card-text mb-1" type="number" max="<?php echo $arr['Stock']?>" value=1>
      <button id="<?php echo $arr['id']?>" class="addToCart btn btn-primary">Add to cart</button>
    </div>
  </div>
  </div>
  <?php
  }
  ?>
</div>

<!-- toast -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">Hamazon</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      
    </div>
  </div>
</div>

<?php
include('footer.php');
    ?>
</body>
<script>
  let userId=<?php echo $_SESSION['id'];?>
</script>
<script src="customerjs/searchProduct.js"></script>
<script src="customerjs/placeOrder.js"></script>
<script src="customerjs/addToCart.js"></script>
<script src="customerjs/getCartItems.js"></script>
<script src="customerjs/cartQuantity.js"></script>
<script src="customerjs/deleteCartProduct.js"></script>

</html>

<?php }else{
    header('location:userlogin.php');    

}
  ?>