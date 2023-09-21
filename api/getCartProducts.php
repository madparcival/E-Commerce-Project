<?php

include('apiconn.php');
$r= $_SERVER['REQUEST_METHOD'];
if( $r =='POST'){

    header('Content-Type: text/json');
    if(file_get_contents('php://input')){
        
    $dataFromRequest=json_decode(file_get_contents('php://input'),true);
    $customer=$dataFromRequest['cid'];
    
    $selectQuery="SELECT ProductID,products.Name,products.imagepath,Amount,Quantity FROM `carts`
    INNER JOIN products
    ON carts.ProductID=products.id
    WHERE CustomerID=$customer AND Status='in-cart';";
    
    $result=mysqli_query($conn,$selectQuery);
    
    if($result->num_rows>0){
        $rows=$result->fetch_all(MYSQLI_ASSOC);
        $data=array("status"=>"success","message"=>$rows);
        echo json_encode($data,true);
    }else{
        
        header("HTTP/1.1 404");
        $data=array("status"=>"error","message"=>'');
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
    $data=array("status"=>"error","Request Method"=>$r,"message"=>"Bad Method");
    echo json_encode($data,true);
}