<?php
include("apiconn.php");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Origin,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$r= $_SERVER['REQUEST_METHOD'];


if( $r =='DELETE'){
    header('Content-Type: text/json');
    $dataFromRequest=json_decode(file_get_contents('php://input'),true);
    $selectQuery = "SELECT * FROM `products` WHERE id=$dataFromRequest[id];";
    $result=mysqli_query($conn,$selectQuery);
    $deleteQuery="DELETE FROM `products` WHERE id=$dataFromRequest[id];";
    if($result->num_rows ==1){
        $row=$result->fetch_assoc();
        mysqli_query($conn,$deleteQuery);
        $data=array("message"=>"Deleted","content"=>$row);
        echo json_encode($data,true);
    }else{
        header("HTTP/1.1 404 Not Found");
        $data=array("message"=>"Not found");
        echo json_encode($data,true); 
    } 

}else{
    header("HTTP/1.1 403");
    $data=array("Request Method"=>$r,"message"=>"Bad Method");
    echo json_encode($data,true);
}