<?php

include('inc.php');
include('functions/func.php');



if(isLoggedIn()){
    
  $selectQuery="SELECT * FROM customers WHERE id=$_SESSION[id]";
  $userData=mysqli_fetch_assoc($conn->query($selectQuery));

  $selectQuery="SELECT carts.id,products.name,products.price,products.weight,carts.Quantity FROM carts INNER JOIN products on carts.ProductID=products.id  WHERE CustomerID=$_SESSION[id] AND carts.Status='in-cart' AND products.Stock_Status='in-stock'";
  $result=$conn->query($selectQuery);
  
  

?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Check out</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="checkout.css" rel="stylesheet">
  </head>
  <body class="bg-body-tertiary">
    


    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4 rounded border border-3" src="files/pageimgs/ecommerce-2607114_1280.jpg" alt="" height="100">
      <h2>Checkout form</h2>
    </div>
<?php
if($result->num_rows !=0){
  ?>
    
    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
          <span class="badge bg-primary rounded-pill"></span>
        </h4>
        <ul class="list-group mb-3">
          <?php
              $total=0;
              while($row=$result->fetch_assoc()){
                $total+=$row['price']*$row['Quantity'];
          ?>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0"><?php echo $row['name']?></h6>
              <small class="text-body-secondary">₹<?php echo $row['price']?> x <?php echo $row['Quantity']?>Nos.</small>
            </div>
            <span class="text-body-secondary">₹<?php echo $row['price']*$row['Quantity'] ?></span>
          </li>
          <?php
              }
          ?>
          <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
            <div class="text-warning">
              <h6 class="my-0">Delivery Charges</h6>
              <small></small>
            </div>
            <span class="text-danger"><?php echo $charges=100?> </span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (INR)</span>
            <strong>₹<?php echo $total+$charges?></strong>
          </li>
        </ul>

        <!-- <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form> -->
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Billing address</h4>
        <!-- form start -->
        <form class="needs-validation" action="order.php" method="post" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" name="fname" class="form-control" id="firstName" placeholder="" value="<?php echo $userData['Name']?>" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>
            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" name="lname" class="form-control" id="lastName" placeholder="" value="<?php echo $userData['last_name']?>">
              <div class="invalid-feedback">
                Valid Last name is required.
              </div>
            </div>


            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-body-secondary">(Optional)</span></label>
              <input type="email" name="mailid" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $userData['Email']?>">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <input type="text" name="Address" class="form-control" id="address" value="<?php echo $userData['Address']?>" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Address 2 <span class="text-body-secondary">(Optional)</span></label>
              <input type="text" name="address2" class="form-control" id="address2" value="<?php echo $userData['Address2']?>" placeholder="Apartment or suite">
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Country</label>
              <select name="country" class="form-select" id="country" required>
                <option value="">Choose...</option>
                <option value="India">India</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <select name="state" class="form-select" id="state" required>
                <option value="">Choose...</option>
                <option value="KA">Karntaka</option>
                <option value="TN">Tamilnadu</option>
              </select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input name="postal" type="text" value="<?php echo $userData['Pincode']?>" class="form-control" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>

          <!-- <hr class="my-4"> -->

          <!-- <div class="form-check">
            <input type="checkbox" class="form-check-input" id="same-address">
            <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info">
            <label class="form-check-label" for="save-info">Save this information for next time</label>
          </div> -->

          <!-- <hr class="my-4"> -->

          <!-- <h4 class="mb-3">Payment</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="debit">Debit card</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
          </div> -->

          <!-- <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Name on card</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-body-secondary">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div> -->

          <!-- <hr class="my-4"> -->

          <button class="w-100 btn btn-primary btn-lg" name="Submit" type="submit">Place Order</button>
        </form>
        <!-- form end -->
        
      </div>
    </div>
  </main>

  <?php
  // ProductID,products.name,products.price,products.weight,carts.Quantity
  $selectQuery="SELECT carts.id as cart_id,products.id as pid,products.Name,products.price,products.Stock,carts.Quantity FROM carts INNER JOIN products on carts.ProductID=products.id  WHERE CustomerID=$_SESSION[id] AND carts.Status='in-cart' AND products.Stock_Status='in-stock'";
  
  $resultCopy=$conn->query($selectQuery);
  $data=$resultCopy->fetch_all(MYSQLI_ASSOC);
  $_SESSION['checkoutData']=$data;

            }
            else{
              echo '<h1>No Items to order</h1>
              <p>Only <b>In-stock</b> items will be added to order. Check Cart for <b>stock status</b></p>
              <p><a href="portal.php">click here</a> to go to Homepage</p>';
            }
  include('footer.php');
  
  ?>
</div>
  
  <script src="checkout.js"></script></body>
</html>

<?php
}else{
    header('Location:userlogin.php');
}
?>