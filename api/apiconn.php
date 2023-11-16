<?php
    $data = json_decode(file_get_contents("../etc/cred.json"),true);
    $conn= mysqli_connect($data["host"],$data["user"],$data["password"],$data["db"]);
    if(!$conn){
        echo 'error in connection';
    }
    

?>