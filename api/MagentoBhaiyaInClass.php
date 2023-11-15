<?php

class CustomerAPI{
    private $conn;
    private $_code=200;
    private $data=array("status"=>"Success","message"=>"");
    private $message='';
    private $input_data='';
    const MESSAGEFORCODE=array(
        200=>'Success',
        204=>'No Content',
        400=>'Bad Request',
        404=>'Not Found'
    );

    function __construct()
    {
        include('apiconn.php');
        $this->conn=$conn;
        header('Content-Type: text/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Origin,Access-Control-Allow-Methods,Authorization,X-Requested-With');
        $this->get_input_data();
        $this->get_user_from_id();

    }
    private function get_input_data(){
        if(file_get_contents('php://input')){
            $data_from_body=json_decode(file_get_contents('php://input'),true);
            $this->input_data=$data_from_body;
        }
        else{
            $this->_code=404;
            $this->message='need input data';
            $this->input_data=false;
        }
    }
    private function get_user_from_id(){
        
        if($this->checkMethod('POST')){
            if($this->input_data){
                $selectQuery="SELECT * FROM customers WHERE id=".$this->input_data['cid'];
                $result=$this->conn->query($selectQuery);
                if($result->num_rows==1){
                    $this->message=$result->fetch_assoc();
                }
                else{
                    $this->_code=404;
                    $this->message='No User found';
                }
            }
        }
        else{
            $this->_code=400;
            $this->message='incorrect method';
        }
    }

    private function checkMethod($method){
        $methodFlag=false;
        if($method){
            if($_SERVER['REQUEST_METHOD']==$method) {
                return $methodFlag=true;
            }
        }
        return $methodFlag;
    }

    private function set_header(){
        header("HTTP/1.1 ".$this->_code);
        include('statusAndMessage.php');
        $this->data['status']=self::MESSAGEFORCODE[$this->_code];
    }

    function __destruct()
    {
        $this->set_header();
        $this->data['message']=$this->message;
        echo json_encode($this->data,true);
    }
}

$r=new CustomerAPI();