<?php

include('../inc.php');
include('../functions/func.php');

if(isAdmin() && $_SESSION['Name']=='root'){


if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $firstName=$_POST['fname'];
    $lastName=$_POST['lname'];
    $mail=$_POST['mailid'];
    $mobile=$_POST['Mobile'];
    $address1=$_POST['address1'];
    $address2=$_POST['address2'];
    $state=$_POST['state'];
    $country=$_POST['country'];
    $pincode=$_POST['pincode'];
    // $modifier=$_SESSION['Name'];
    if(isset($_FILES['imageInput'])){
        $pathToImage=$_POST['imageInput'];
        if($_FILES['imageInput']){
            $pathToImage=$_FILES['imageInput']['name'];
            $pathToStore='../files/profileimgs/';
            if(in_array($_FILES['imageInput']['type'],array('image/jpeg','image/png','image/gif','image/jpg','image/webp'))){
                move_uploaded_file($_FILES['imageInput']['tmp_name'],$pathToStore.$pathToImage);
            }
            $updateQuery="UPDATE `customers` SET Profile='$pathToImage' WHERE id=$id";
            mysqli_query($conn,$updateQuery);
        }
    }

    $updateQuery="UPDATE `customers` SET Name='$firstName',last_name='$lastName',Mobile='$mobile',Email='$mail',Address='$address1',
    Address2='$address2',Country='$country',State='$state',Pincode='$pincode' WHERE id=$id;";
    // echo $updateQuery;

    try{
    mysqli_query($conn,$updateQuery);
        header('Location:allusers.php');
        // echo "<a href='products.php'>go to products</a>";
    }
    catch(Exception $e){
        echo $e->getMessage();
    }

    }

    $values=getTableValuesFromID($conn,'customers',$_GET['id']);
    $rows=$values;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
<form action="updateUsers.php" method="post" enctype="multipart/form-data">
    <div class="mb-3 p-1">
        <label for="idInput" class="form-label">ID</label>
        <input type="text" class="form-control" id="idInput" name="id" value="<?php echo $rows['id'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="imageInput" class="form-label">Image</label>
        <img src="../files/profileimgs/<?php echo $rows['Profile'];?>" style="height: 10rem;" id='productImage'>
        <input type="file" accept="image/*" class="form-control" id="imageInput" name="imageInput" value="<?php echo $rows['Profile'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="fnameInput" class="form-label">First Name</label>
        <input type="text" class="form-control" id="fnameInput" name="fname" value="<?php echo $rows['Name'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="lnameInput" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lnameInput" name="lname" value="<?php echo $rows['last_name'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="mailInput" class="form-label">Mail</label>
        <input type="mail" class="form-control" id="mailInput" name="mailid" value="<?php echo $rows['Email'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="mobileInput" class="form-label">Mobile</label>
        <input type="number" class="form-control" id="mobileInput" name="Mobile" value="<?php echo $rows['Mobile'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="addressInput" class="form-label">Address1</label>
        <input type="text" class="form-control" id="addressInput" name="address1" value="<?php echo $rows['Address'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="address2Input" class="form-label">Address2</label>
        <input type="text" class="form-control" id="address2Input" name="address2" value="<?php echo $rows['Address2'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="stateInput" class="form-label">State</label>
        <input type="text" class="form-control" id="stateInput" name="state" value="<?php echo $rows['State'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="countryInput" class="form-label">Country</label>
        <input type="text" class="form-control" id="countryInput" name="country" value="<?php echo $rows['Country'];?>">
    </div>
    <div class="mb-3 p-1">
        <label for="pincodeInput" class="form-label">Pincode</label>
        <input type="number" class="form-control" id="pincodeInput" name="pincode" value="<?php echo $rows['Pincode'];?>">
    </div>
        <button class="btn btn-primary" name="submit" type="submit">Update</button>
    </form> 
</body>
<script src="js/reflectUploadedFile.js"></script>
</html>

<?php

}else {
  
    header('location:adminlogin.php'); 
     
   }
