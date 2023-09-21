
<?php

$rmethod=$_SERVER['REQUEST_METHOD'];
if($rmethod=='POST'){

    echo file_get_contents("php://input");

}
else{
    echo 'bad method';
}
?>