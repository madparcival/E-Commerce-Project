

<?php
include('inc.php');
include('functions/func.php');
if(isset($_GET['logout'])){
    session_destroy();
    header('location:userlogin.php');
}
if(isLoggedIn()){
    $values=getTableValues($conn,'products'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamazon</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> 
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
    <!-- navbar cart -->
    <button class="navbar-toggler" id="cartBtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Cart Items</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body" id="cartDiv">
        
        
      </div>
    </div>
  </div>
</nav>
<div class="profile text-end">

</div>
<div class="row row-cols-2 row-cols-md-3 g-4 mx-auto">
  
<?php 
while($arr=$values->fetch_assoc()){
  echo '<div class="col">
  <div class="card h-100 bg-warning-subtle" style="width: 18rem;">
    <img src="files/'.$arr['imagepath'].'" class="card-img-top mx-auto w-50" alt="...">
    <div class="card-body">
      <h5 class="card-title">'.$arr['Name'].'</h5>
      <p class="card-text">'.$arr['Description'].'</p>
      <p class="card-text">₹'.$arr['Price'].'</p>
      <p class="card-text text-primary-emphasis" >'.$arr['Stock_Status'].'</p>
      <button id="'.$arr['id'].'" class="addToCart btn btn-primary">Add to cart</button>
    </div>
  </div>
  </div>';
  
  }?>
</div>
    
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