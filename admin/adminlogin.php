
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
    <main class="form-signin w-25 m-auto pt-5">
        <form action="adminlogin.php" method="post">
            <img class="mb-4" src="../files/pageimgs/admin.png" alt="" height="57">
            <h1 class="h3 mb-3 fw-normal">Admin sign in</h1>

            <div class="form-floating">
            <input type="email" class="form-control" id="mailInput" name="Email" required placeholder="name@example.com">
            <label for="mailInput" class="form-label">Email address</label>
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
            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2023</p>
        </form>
    </main>   
</body>
</html>




<?php }?>

