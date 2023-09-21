<?php
include('../inc.php');
include('../functions/func.php');

if(isAdmin() && $_SESSION['Name']=='root'){
  if(isset($_GET['logout'])){
    session_destroy();
    header('location:adminlogin.php');
  }
  if(isset($_POST['Email']) && isset($_POST['Password'])){
    $mail=$_POST['Email'];
    $pass=$_POST['Password'];
    $mob=$_POST['Mobile'];
    $name=$_POST['Name'];
    $searchQuery="SELECT * FROM `adminusers` where Email='$mail';";
    $profilePath="files/profileimgs/";
    $targetfile=$_FILES["Profile"]["name"];
    if($_FILES['Profile']){
        if(in_array($_FILES['Profile']['type'],array('image/*'))){
            move_uploaded_file($_FILES['Profile']['name'],$profilePath.$targetfile);
        }
    }

    $result=mysqli_query($conn,$searchQuery);
    if($result->num_rows == 0){
        $insertQuery="INSERT INTO `adminusers` (Name,Mobile,Email,Password,Profile) VALUES ('$name','$mob','$mail','$pass','$targetfile');";

    if(mysqli_query($conn,$insertQuery)){
        header('Location:index.php');
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
    <title>Add Admin</title>
</head>
<body>
<main class="form-signin w-25 m-auto pt-5 text-align-center">
    <form action="addAdmin.php" method="post">
        <img class="mb-4 rounded-circle" src="files/pageimgs/user-login.png" alt="" height="57">
        <h1 class="h3 mb-3 fw-normal">Add Admin</h1>

        <div class="form-floating">
            <input type="email" class="form-control" id="mailInput" name="Email" required placeholder="name@example.com">
            <label for="mailInput" class="form-label">Email address</label>
        </div>
        <div class="form-floating">
            <input type="file" class="form-control" id="profileInput" name="Profile">
            <label for="profileInput" class="form-label">Profile</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="nameInput" name="Name" placeholder="Name">
            <label for="nameInput" class="form-label">Name</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="mobileInput" name="Mobile" placeholder="Mobile">
            <label for="mobileInput" class="form-label">Mobile Number</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="passwordInput" placeholder="Password" name="Password" required>
            <label for="passwordInput" class="form-label">Password</label>
        </div>

        <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            Remember me
        </label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Add user</button>
        <p class="mt-5 mb-3 text-body-secondary">&copy; 2023</p>
    </form>
    </main>
</body>
</html>

<?php
}else {
  
 header('location:adminlogin.php'); 
  
}
?>