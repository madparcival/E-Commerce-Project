<?php

include('apiconn.php');
$r= $_SERVER['REQUEST_METHOD'];
if( $r =='POST'){

    header('Content-Type: text/json');
    if(file_get_contents('php://input')){
        $dataFromRequest=json_decode(file_get_contents('php://input'),true);
        $updateQuery="UPDATE carts SET Quantity=$dataFromRequest[quantity] WHERE CustomerID=$dataFromRequest[cid] AND ProductID=$dataFromRequest[pid] AND Status='in-cart';";

        if($conn->query($updateQuery)){
            $data=array("status"=>"success","message"=> 'Updated');
            echo json_encode($data,true);
        }else{
            $data=array("status"=>"error","message"=>mysqli_error($conn));
            echo json_encode($data,true); 
        }
    }else{
        header("HTTP/1.1 405");
        $data=array("status"=>"error","message"=>"No input found");
        echo json_encode($data,true);    
    }
}else{
    header("HTTP/1.1 405");
    $data=array("status"=>"error","Request Method"=>$r,"message"=>"Bad Method");
    echo json_encode($data,true);
}