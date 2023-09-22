<?php
include('inc.php');

    if(isset($_POST['Email']) && isset($_POST['Password'])){
        $mail=$_POST['Email'];
        $pass=$_POST['Password'];
        $mob=$_POST['Mobile'];
        $name=$_POST['Name'];
        $searchQuery="SELECT * FROM `customers` where Email='$mail';";
        $profilePath="files/profileimgs/";
        $targetfile="";
        if(isset($_FILES['Profile'])){
            $targetfile=$_FILES["Profile"]["name"];
            $profilePath="files/profileimgs/";
            if($_FILES['Profile']){
                if(in_array($_FILES['Profile']['type'],array('image/jpeg','image/png','image/gif','image/jpg','image/webp'))){
                    move_uploaded_file($_FILES['Profile']['tmp_name'],$profilePath.$targetfile);
                }
            }
        }
        $result=mysqli_query($conn,$searchQuery);
        if($result->num_rows == 0){
            $insertQuery="INSERT INTO `customers` (Name,Mobile,Email,Password,Profile) VALUES ('$name','$mob','$mail','$pass','$targetfile');";
            // mysqli_query($conn,$insertQuery)
            if(mysqli_query($conn,$insertQuery)){
                print_r($_FILES['Profile']);
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
    <style>
        .glass{
            background-repeat: no-repeat;
            background-image: url('files/pageimgs/ecommerce-2607114_1280.jpg');
            /* filter: brightness(50%); */
        }
        .myform{
            backdrop-filter: blur(4px);
            background-color: #f7f7f7b5;

        }
    </style>
</head>
<body>
    <div class="glass">
        <form class="myform w-25 m-auto p-1 border border-3 rounded-2" action="signup.php" method="post" enctype="multipart/form-data">
        <img class="mb-1 object-fit-cover rounded-circle" src="files/pageimgs/sign-up.jpg" alt="" width="100" height="100">
        <h1 class="h3 mb-2 fw-normal">User sign Up</h1>
        <div class="mb-1">
            <label for="nameInput" class="form-label">Name</label>
            <input type="text" class="form-control" id="nameInput" name="Name">
        </div>
        <div class="mb-1">
            <label for="profileInput" class="form-label">Profile</label>
            <input type="file" class="form-control" id="profileInput" name="Profile">
        </div>
        <div class="mb-1">
            <label for="mailInput" class="form-label">Mail</label>
            <input type="email" class="form-control" id="mailInput" name="Email" required>
        </div>
        <div class="mb-1">
            <label for="mobileInput" class="form-label">Mobile</label>
            <input type="text" class="form-control" id="mobileInput" name="Mobile">
        </div>
        <div class="mb-1">
            <label for="passwordInput" class="form-label">Password</label>
            <input type="password" minlength="8" class="form-control" id="passwordInput" name="Password" required>
        </div>
            <button class="btn btn-primary" type="submit">Sign-Up</button>
        </form>    
    </div>
</body>
</html>