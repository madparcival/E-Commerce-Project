<?php

$pathToStore="files/";

if($_SERVER['REQUEST_METHOD']=='POST'){

    if($_FILES['image']){
        $id=$_POST['id'];
        if(in_array($_FILES['image']['type'],array('image/jpeg','image/png','image/gif','image/jpg','image/webp'))){
        move_uploaded_file($_FILES['image']['tmp_name'],$pathToStore.$_FILES['image']['name']);

        header('content-type:text/json');
        $data=array("message"=>"Uploaded","status"=>"OK","data"=>$_FILES);
        echo json_encode($data,true);
        }
        else{
            header('content-type:text/json');
            $data=array("message"=>"File type Not Allowed","status"=>"error");
            echo json_encode($data,true);
        }

    }
}else{
    header('content-type:text/json');
    header("HTTP/1.1 403");
    $data=array("message"=>"Incorrect Method","status"=>"error");
    echo json_encode($data,true);
}