<?php
include("apiconn.php");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Origin,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$requestType = $_SERVER['REQUEST_METHOD'];


if( $requestType =='DELETE'){
    header('Content-Type: text/json');
    $dataFromRequest=json_decode(file_get_contents('php://input'),true);
    
    $selectQuery = "SELECT * FROM `products` WHERE id=$dataFromRequest[id];";
    $result=mysqli_query($conn,$selectQuery);
    $deleteQuery="DELETE FROM `products` WHERE id=$dataFromRequest[id];";
    if($result->num_rows == 1){
        $selectCartQuery = "SELECT * FROM `carts` WHERE ProductID=$dataFromRequest[id];";
        $cartresult=mysqli_query($conn,$selectCartQuery);
        if($cartresult->num_rows == 0){
            $row=$result->fetch_assoc();
            mysqli_query($conn,$deleteQuery);
            $data=array("status"=>"success","message"=>"Deleted","content"=>$row);
            echo json_encode($data,true);
        }else{
            header("HTTP/1.1 200");
            $data=array("status"=>"error","message"=>"Item in-cart, Can not be deleted");
            echo json_encode($data,true);

        }
    }else{
        header("HTTP/1.1 404 Not Found");
        $data=array("status"=>"error","message"=>"Not found");
        echo json_encode($data,true); 
    } 

}else{
    header("HTTP/1.1 403");
    $data=array("status"=>"error","Request Method"=>$requestType,"message"=>"Bad Method");
    echo json_encode($data,true);
}