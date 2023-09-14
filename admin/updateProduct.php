<?php

include('../inc.php');
include('../functions/func.php');


if(isset($_POST['Product']) &&  isset($_POST['Price'])){
    $id=$_POST['id'];
    $filepath=$_FILES['image'];
    $productName=$_POST['Product'];
    $weight=$_POST['Weight'];
    $price=$_POST['Price'];
    $desc=$_POST['Description'];
    $updateQuery="UPDATE `products` SET Name='$productName' ,Weight=$weight,Price=$price,Description='$desc',imagepath='' WHERE id=$id";

    if(mysqli_query($conn,$updateQuery)){
        header('Location:products.php');
    }
}

    $values=getProductRow($conn,$_GET['id']);
    $rows=$values->fetch_assoc();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
<form action="updateProduct.php" method="post">
    <div class="mb-3 p-1">
        <label for="idInput" class="form-label">ID</label>
        <input type="text" class="form-control" id="idInput" name="id" value="<?php echo $rows['id'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="imageInput" class="form-label">Image</label>
        <input type="file" class="form-control" id="imageInput" name="image" value="<?php echo $rows['imagepath'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="nameInput" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="nameInput" name="Product" value="<?php echo $rows['Name'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="weightInput" class="form-label">Weight</label>
        <input type="number" class="form-control" id="weightInput" name="Weight" value="<?php echo $rows['Weight'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="priceInput" class="form-label">Price</label>
        <input type="number" class="form-control" id="placeInput" name="Price" value="<?php echo $rows['Price'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="descInput" class="form-label">Description</label>
        <input type="text" class="form-control" id="placeInput" name="Description" value="<?php echo $rows['Description'];?>">
    </div>
        <button class="btn btn-primary" type="submit">Update</button>
    </form> 
</body>
</html>