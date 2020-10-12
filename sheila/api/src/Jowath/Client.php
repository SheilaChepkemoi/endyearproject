<?php

namespace Jowath;

use Jowath\Exception\DatabaseException;
use Jowath\Helper\Cipher;
use Jowath\Helper\Database;
use Jowath\Helper\Validator;

class Client
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * @param $params
     * @return array
     */
    public function register($params){

        //error checking
        //trim
        foreach ($params as $key => $param){
            if(is_string($param)){
                $params[$key] = trim($param);
            }
        }

        //strip tags
        foreach ($params as $key => $param){
            if(is_string($param)){
                $params[$key] = strip_tags($param);
            }
        }

        //check for empty values
        foreach ($params as $key => $param){

            if(!is_string($param)){
                continue;
            }

            if(empty($param)){
                return APIHandler::formatResponse("FAILED","Server received an empty value",$key);
            }
        }

        //escape data
        foreach ($params as $key => $param){
            if(is_string($param)){
                $params[$key] = mysqli_real_escape_string($this->db->getCxn(), $param);
            }
        }

        $client_name = $params['name'];
        $email = $params['email'];
        $phone_number = $params['phone_number'];
        $password = $params['password'];

        //check if email is valid
        if(!Validator::isEmailValid($email)){
            return APIHandler::formatResponse("FAILED","Invalid email",$email);
        }

        //check if phone number is valid
        if(!Validator::isPhoneNumberValid($phone_number)){
            return APIHandler::formatResponse("FAILED","Invalid phone number, use the format '711XXXXXX'",$phone_number);
        }

        //check if client name exists
        $sql = "SELECT * FROM client WHERE client_name = '$client_name'";

        try {
            $result = $this->db->runQuery($sql, __LINE__);
        } catch (DatabaseException $e) {
            return APIHandler::formatResponse("FAILED","Database error occurred",$e->getMessage());
        }

        if(mysqli_num_rows($result) > 0){
            return APIHandler::formatResponse("FAILED","Another client exists with the name '$client_name'",NULL);
        }

        //check if phone number exists
        $sql = "SELECT * FROM client WHERE phone_number = '$phone_number'";

        try {
            $result = $this->db->runQuery($sql, __LINE__);
        } catch (DatabaseException $e) {
            return APIHandler::formatResponse("FAILED","Database error occurred",$e->getMessage());
        }

        if(mysqli_num_rows($result) > 0){
            return APIHandler::formatResponse("FAILED","Another client exists with the phone number '$phone_number'",NULL);
        }

        //check if email exist
        $sql = "SELECT * FROM client WHERE email_address = '$email'";

        try {
            $result = $this->db->runQuery($sql, __LINE__);
        } catch (DatabaseException $e) {
            return APIHandler::formatResponse("FAILED","Database error occurred",$e->getMessage());
        }

        if(mysqli_num_rows($result) > 0){
            return APIHandler::formatResponse("FAILED","Another client exists with the email '$email'",NULL);
        }

        //encrypt password
        if(strlen($password) > 20){
            return APIHandler::formatResponse("FAILED","The password cannot be more than 20 characters",NULL);
        }

        $cipher = new Cipher();
        $password = $cipher->encryptAES($password);

        //insert the data
        $sql = "INSERT INTO client (client_name, phone_number, email_address, password) VALUES ('$client_name','$phone_number','$email','$password')";

        try {
            $this->db->runQuery($sql, __LINE__);
        } catch (DatabaseException $e) {
            return APIHandler::formatResponse("FAILED","Database error occurred",$e->getMessage());
        }

        return APIHandler::formatResponse("SUCCESS","Client registered successfully",NULL);

    }

    //end of class
}