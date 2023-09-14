
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<?php
    include('../inc.php');
    include('../functions/func.php');
    
    if(isAdmin()){
        header('Location:index.php');
    }
    else{
    if(isset($_POST['Email']) && isset($_POST['Password'])){
        $mail=$_POST['Email'];
        $pass=$_POST['Password'];
        loginAdmin($conn,$mail,$pass);
    }
    
?>
<body>
    <form action="adminlogin.php" method="post">
    <div class="mb-3 p-1">
        <label for="mailInput" class="form-label">Mail</label>
        <input type="email" class="form-control" id="mailInput" name="Email" required>
    </div>
    <div class="mb-3 p-1">
        <label for="passwordInput" class="form-label">Password</label>
        <input type="password" class="form-control" id="passwordInput" name="Password" required>
    </div>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>    
</body>
</html>

<?php }?>

