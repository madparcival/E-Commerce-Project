<?php

include('apiconn.php');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Origin,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$requestType = $_SERVER['REQUEST_METHOD'];
if( $requestType =='POST'){

    header('Content-Type: text/json');
    if(file_get_contents('php://input')){
        
    $dataFromRequest=json_decode(file_get_contents('php://input'),true);
    $customer=$dataFromRequest['cid'];
    
    $selectQuery="SELECT Name,last_name FROM `customers` WHERE id=$customer";
    
    $result=mysqli_query($conn,$selectQuery);
    
    if($result->num_rows>0){
        $rows=$result->fetch_all(MYSQLI_ASSOC);
        $data=array("status"=>"success","message"=>$rows);
        echo json_encode($data,true);
    }else{
        
        header("HTTP/1.1 404");
        $data=array("status"=>"error","message"=>'No user');
        echo json_encode($data,true); 
    } 
    }
    else{
    header("HTTP/1.1 405");
    $data=array("status"=>"error","message"=>"Need data");
    echo json_encode($data,true);
    }
}else{
    // echo 'error';
    header("HTTP/1.1 405");
    $data=array("status"=>"error","Request Method"=>$requestType,"message"=>"Bad Method");
    echo json_encode($data,true);
}