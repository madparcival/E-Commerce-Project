<?php

include('../inc.php');
include('../functions/func.php');

if(isset($_POST['Product']) &&  isset($_POST['Price'])){
    $productName=$_POST['Product'];
    $weight=$_POST['Weight'];
    $price=$_POST['Price'];
    $desc=$_POST['Description'];
    $stockQuantity=$_POST['stockQuantity'];
    $stockStatus='out-of-stock';
    if(isset($_POST['stockStatus'])){
        $stockStatus='in-stock';
    }
    $pathToStore='../files/';
    $pathToImage=$_FILES['image']['name'];
    if($_FILES['image']){
        if(in_array($_FILES['image']['type'],array('image/*'))){
            move_uploaded_file($_FILES['image']['tmp_name'],$pathToStore.$pathToImage);
        }
    }
    $insertQuery="INSERT INTO `products` (Name,Weight,Price,Stock,Stock_Status,Description,imagepath) values ('$productName',$weight,$price,$stockQuantity,'$stockStatus','$desc','$pathToImage')";

    if(mysqli_query($conn,$insertQuery)){
        header('Location:products.php');
    }
}
if(isAdmin()){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
<form action="addProduct.php" method="post" enctype="multipart/form-data">
    <div class="mb-3 p-1">
        <label for="nameInput" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="nameInput" name="Product" required>
    </div>
    <div class="mb-3 p-1">
        <label for="imageInput" class="form-label">Product Image</label>
        <img src="" class="border mb-4" style="height: 10rem;" id="productImage">
        <input type="file" accept="image/*" class="form-control" id="imageInput" name="image">
    </div>
    <div class="mb-3 p-1">
        <label for="weightInput" class="form-label">Weight</label>
        <input type="number" class="form-control" id="ageInput" name="Weight">
    </div>
    <div class="mb-3 p-1">
        <label for="priceInput" class="form-label">Price</label>
        <input type="number" class="form-control" id="placeInput" name="Price" required>
    </div>
    <div class="mb-3 p-1">
        <label for="descInput" class="form-label">Description</label>
        <input type="text" class="form-control" id="placeInput" name="Description">
    </div>
    <div class="mb-3 p-1">
        <label for="stockInput" class="form-label">Stock</label>
        <input type="number" class="form-control" id="stockInput" name="stockQuantity">
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" name="stockStatus" type="checkbox" role="switch" id="flexSwitchCheckDefault">
        <label class="form-check-label" for="flexSwitchCheckDefault">In Stock</label>
    </div>
        <button class="btn btn-primary" type="submit">Add</button>
    </form> 
</body>

<script src="js/reflectUploadedFile.js"></script>

</html>

<?php

}else {
  
    header('location:adminlogin.php'); 
     
   }

?>