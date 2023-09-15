<?php

include('apiconn.php');
$r= $_SERVER['REQUEST_METHOD'];
if( $r =='POST'){

    header('Content-Type: text/json');
    if(file_get_contents('php://input')){
        
    $dataFromRequest=json_decode(file_get_contents('php://input'),true);
    $customer=$dataFromRequest['cid'];
    $productID=$dataFromRequest['pid'];
    $productRow=getRowFromTable($conn,$productID,'products');
    
    // $_SESSION[''];

    $insertQuery="INSERT INTO `carts` (CustomerID,ProductID,Amount,Status) VALUES ($customer,$productID,$productRow[Price],'in-cart');";
    // 

    if(mysqli_query($conn,$insertQuery)){
        $data=array("status"=>"success","message"=>"Added to cart");
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
    $data=array("status"=>"error","Request Method"=>$r,"message"=>"Bad Method");
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

