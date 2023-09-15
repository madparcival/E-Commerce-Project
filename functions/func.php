<?php
function isAdmin(){
    $flag=false;
    if(isLoggedIn()){
        if(isset($_SESSION['admin'])){
            if($_SESSION['admin']==true){
                $flag=true;
            }
        }
    }
    return $flag;
}
    function isLoggedIn(){
        $flag=false;
        if(isset($_SESSION['loggedIn'])){
        if($_SESSION['loggedIn']==true){
            $flag=true;
        }
    }
    return $flag;
    }
    
    function getTableValues($conn,$table){ 
        $select_query="SELECT * FROM `$table`";
        $result=mysqli_query($conn,$select_query);
        return $result;
    }

    function loginUser($conn,$mail,$pass){
        $searchQuery="SELECT * FROM `customers` where Email='$mail';";
        $result=mysqli_query($conn,$searchQuery);
        

        if($result->num_rows != 0){
            $data=$result->fetch_assoc();
            if($data['Password']==$pass){
                $_SESSION['loggedIn']=true;
                $_SESSION['Name']=$data['Name'];
                $_SESSION['id']=$data['id'];
                header('Location:portal.php');
            }
            else{
                Print('Wrong Password! Try Again');
            }
        }
        else{
            // echo('')
            header('Location:signup.php');
        }

    }

    function loginAdmin($conn,$mail,$pass){
        $searchQuery="SELECT * FROM `adminusers` where Email='$mail';";
        $result=mysqli_query($conn,$searchQuery);
        

        if($result->num_rows != 0){

            $data=$result->fetch_assoc();
            if($data['Password']==$pass){
                $_SESSION['loggedIn']=true;
                $_SESSION['Name']=$data['Name'];
                $_SESSION['admin']=true;
                header('Location:index.php');
            }
            else{
                Print('Wrong Password! Try Again');
            }
        }
        else{
            echo('Contact Administrator');
            // header('Location:signup.php');
        }
    
    }
    function getProductRow($conn,$id){
        $select_query="Select * from products where id=$id";
        $result=mysqli_query($conn,$select_query);
        return $result;
    }

    
    

?>