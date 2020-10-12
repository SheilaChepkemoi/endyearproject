<?php

namespace Jowath;

use Exception;
use Jowath\Exception\DatabaseException;
use Jowath\Helper\Database;

class APIHandler
{

    const JSONRPC_FIELDS = ['jsonrpc','method','params','id'];

    private $requestID = NULL;

    private $db = NULL;

    /**
     * APIHandler constructor.
     */
    function __construct()
    {
        //load API classes and libraries
        $this->loadAPI();
    }

    /**
     * checks that the required jsonrpc specification fields are present
     * @param $request
     * @return bool
     */
    private function validateRequestBody($request){

        foreach (self::JSONRPC_FIELDS as $field) {

            if(!array_key_exists($field,$request)){
                return false;
            }
        }

        return true;
    }

    /**
     * loads the required libraries and API classes
     */
    private function loadAPI(){

        $dir_path =  __DIR__;
        $dir_path = str_replace("\\","/",$dir_path);

        //include the needed libraries
        //require_once self::getAPIRootPath().'libraries/Spreadsheet/vendor/autoload.php';

        //include all API classes
        require_once $dir_path."/APIHandler.php";
        require_once $dir_path."/Authenticator.php";
        require_once $dir_path."/Client.php";
        require_once $dir_path."/Item.php";

        require_once $dir_path."/Helper/Validator.php";
        require_once $dir_path."/Helper/Cipher.php";
        require_once $dir_path."/Helper/Database.php";

        require_once $dir_path."/Exception/APIHandlerException.php";
        require_once $dir_path."/Exception/DatabaseException.php";

    }

    /**
     * @param $request
     * @return mixed
     */
    public function makeAPICall($request){

        //decode request
        $json_data = json_decode($request,true);

        if($json_data === NULL){
            $this->respond(self::formatResponse("FAILED","Invalid JSON request",$request), $this->requestID);
        }

        //check if the request body is valid
        if(!$this->validateRequestBody($json_data)){
            $this->respond(self::formatResponse("FAILED","Invalid JSONRPC request body",$request), $this->requestID);
        }

        //set requestID
        $this->requestID = $json_data['id'];

        $method = $json_data['method'];
        $params = $json_data['params'];

        ## breakdown $method into class and function

        //check for the '.' separator
        $separator_position = strpos($method, '.');

        if($separator_position === false){
            $this->respond(self::formatResponse("FAILED","Method parameter must be of the format 'class.method'",$method), $this->requestID);
        }

        $class = substr($method,0,$separator_position);
        $function = substr($method,$separator_position+1);

        //check that class exists
        switch (true){
            case class_exists("Jowath\\".$class):
                $class = "Jowath\\".$class;

                //connect to the database
                $this->db = new Database();

                try {
                    $this->db->connect();
                } catch (DatabaseException $e) {
                    $this->respond(self::formatResponse("FAILED","Database connection failed",$e->getMessage()), $this->requestID);
                }

                $class = new $class($this->db);

                break;
            default:
                $this->respond(self::formatResponse("FAILED","API class '".$class."' not defined",NULL), $this->requestID);
                break;
        }

        //check that function exists
        if(method_exists($class,$function)){

            try{
                $this->respond($class->$function($params), $this->requestID);
            }catch (Exception $e){
                $this->respond(self::formatResponse("FAILED",$e->getMessage(),NULL), $this->requestID);
            }

        }else{
            $this->respond(self::formatResponse("FAILED","Class method '". $function . "' not found",NULL), $this->requestID);
        }

    }

    /**
     * formats and returns a response back to the client
     * @param $response
     * @param $requestID
     */
    private function respond($response, $requestID){

        if($this->db !== NULL){
            $this->db->disconnect();
        }

        $jsonrpc_response['jsonrpc'] = "2.0";
        $jsonrpc_response['result'] = $response;
        $jsonrpc_response['id'] = $requestID;

        header('Content-Type: application/json');
        echo json_encode($jsonrpc_response);

        die();

        //end of respond function
    }

    /**
     * returns root API
     */
    public static function getAPIRootPath(){
        $dir_path = dirname(__DIR__) . "/../";
        $dir_path = realpath($dir_path);
        return str_replace("\\","/",$dir_path);
    }

    /**
     * @return mixed
     */
    public static function getTempDirPath(){
        $dir_path = dirname(__DIR__) . "/../../temp";
        $dir_path = realpath($dir_path);
        return str_replace("\\","/",$dir_path);
    }

    /**
     * @return mixed
     */
    public static function getUploadsDirPath(){
        $dir_path = dirname(__DIR__) . "/../../uploads";
        $dir_path = realpath($dir_path);
        return str_replace("\\","/",$dir_path);
    }

    /**
     * @return mixed
     */
    public static function getImagesDirPath(){
        $dir_path = dirname(__DIR__) . "/../../images";
        $dir_path = realpath($dir_path);
        return str_replace("\\","/",$dir_path);
    }

    /**
     * formats a response to be passed to the respond function
     * @param $status
     * @param $responseMessage
     * @param $responseData
     * @return array
     */
    public static function formatResponse($status, $responseMessage, $responseData = NULL){

        return array(
            "status" => $status,
            "response_message" => $responseMessage,
            "response_data" => $responseData
        );

    }
    //end of class
}