

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
</head>
<body>
    
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Hamazon</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>
<h1>Hello <?php echo $_SESSION['Name'];?></h1>
<p><a href="portal.php?logout" class="btn btn-dark link-light link-offset-2">Logout</a></p>
<div class="row row-cols-1 row-cols-md-3 g-4">
  
<?php 
while($arr=$values->fetch_assoc()){
echo '<div class="col">
<div class="card h-100" style="width: 18rem;">
  <img src="files/'.$arr['imagepath'].'" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">'.$arr['Name'].'</h5>
    <p class="card-text">'.$arr['Description'].'</p>
    <p class="card-text">₹'.$arr['Price'].'</p>
    <a href="addtocart.php?id='.$arr['id'].'" class="btn btn-primary">Add to cart</a>
  </div>
</div>
</div>';
  
  }?>
</div>
    
</body>
</html>

<?php }else{
    header('location:userlogin.php');    

}
    ?>