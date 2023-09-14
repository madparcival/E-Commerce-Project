<?php
    $host='localhost';
    $user='root';
    $pass='root';
    $database='hamazon';
    $conn= mysqli_connect($host,$user,$pass,$database);
    if(!$conn){
        echo 'error in connection';
    }
    

?>