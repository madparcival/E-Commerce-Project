<?php
include('inc.php');

    if(isset($_POST['Email']) && isset($_POST['Password'])){
        $mail=$_POST['Email'];
        $pass=$_POST['Password'];
        $mob=$_POST['Mobile'];
        $name=$_POST['Name'];
        $searchQuery="SELECT * FROM `customers` where Email='$mail';";

        $result=mysqli_query($conn,$searchQuery);
        if($result->num_rows == 0){
        $insertQuery="INSERT INTO `customers` (Name,Mobile,Email,Password) VALUES ('$name','$mob','$mail','$pass');";

        if(mysqli_query($conn,$insertQuery)){
            header('Location:userlogin.php');
        }
        else{
            echo 'Not inserted';
        }}
        else{
            echo 'Already Present';
        }


    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
</head>
<body>
    <form action="signup.php" method="post">
    <div class="mb-3 p-1">
        <label for="nameInput" class="form-label">Name</label>
        <input type="text" class="form-control" id="nameInput" name="Name">
    </div>
    <div class="mb-3 p-1">
        <label for="mailInput" class="form-label">Mail</label>
        <input type="email" class="form-control" id="mailInput" name="Email" required>
    </div>
    <div class="mb-3 p-1">
        <label for="mobileInput" class="form-label">Mobile</label>
        <input type="text" class="form-control" id="mobileInput" name="Mobile">
    </div>
    <div class="mb-3 p-1">
        <label for="passwordInput" class="form-label">Password</label>
        <input type="password" minlength="8" class="form-control" id="passwordInput" name="Password" required>
    </div>
        <button class="btn btn-primary" type="submit">Add</button>
    </form>    
</body>
</html>