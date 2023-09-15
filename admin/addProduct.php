<?php

include('../inc.php');
include('../functions/func.php');

if(isset($_POST['Product']) &&  isset($_POST['Price'])){
    $productName=$_POST['Product'];
    $weight=$_POST['Weight'];
    $price=$_POST['Price'];
    $desc=$_POST['Description'];
    $pathToStore='../files/';
    if($_FILES['image']){
        $pathToImage=$_FILES['image']['name'];
        if(in_array($_FILES['image']['type'],array('image/jpeg','image/png','image/gif','image/jpg','image/webp'))){
            move_uploaded_file($_FILES['image']['tmp_name'],$pathToStore.$pathToImage);
            $insertQuery="INSERT INTO `products` (Name,Weight,Price,Description,imagepath) values ('$productName',$weight,$price,'$desc','$pathToImage')";

            if(mysqli_query($conn,$insertQuery)){
                header('Location:products.php');
            }
        }
    }
    
}

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
        <button class="btn btn-primary" type="submit">Add</button>
    </form> 
</body>

<script src="js/reflectUploadedFile.js"></script>

</html>