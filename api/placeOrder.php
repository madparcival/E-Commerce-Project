<?php

include('apiconn.php');
$requestType = $_SERVER['REQUEST_METHOD'];
if( $requestType =='POST'){

    header('Content-Type: text/json');
    if(file_get_contents('php://input')){
        
    $dataFromRequest=json_decode(file_get_contents('php://input'),true);
    $customer=$dataFromRequest['cid'];
    $productID=$dataFromRequest['pid'];
    $row=getRowFromTable($conn,$productID,'products');
    

    $insertQuery="INSERT INTO `orders` (CustomerID,ProductID,Price,Status) VALUES ($customer,$productID,$row[id],'pending');";
    // mysqli_query($conn,$insertQuery)

    if(true){
        $data=array("status"=>"success","message"=>"Inserted");
        echo json_encode($data,true);
    }else{
        $data=array("status"=>"error","message"=>mysqli_error($conn));
        echo json_encode($data,true); 
    } 
    }
    else{
        header("HTTP/1.1 405");
    $data=array("status"=>"error","message"=>"No data");
    echo json_encode($data,true);
    }
}else{
    header("HTTP/1.1 405");
    $data=array("status"=>"error","Request Method"=>$requestType,"message"=>"Bad Method");
    echo json_encode($data,true);
}



function getRowFromTable($conn,$id,$table){
    $selectQuery="SELECT * FROM $table WHERE id=$id";
    $result=mysqli_query($conn,$selectQuery);
    if($result->num_rows==1){
        return $result->fetch_assoc();
    }
    else{
        return false;
    }
}

