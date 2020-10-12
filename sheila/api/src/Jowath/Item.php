<?php

namespace Jowath;


use Jowath\Helper\Database;
use Jowath\Helper\ImageHandler;

class Item
{

    const ITEM_TYPES = ['tent','chair','table','stemware_barware','cutlery','cups','plates','mobile_toilet'];
    const SHUFFLE_STRING = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * @param $params
     * @return array
     */
    public function addItem($params){

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

        //prepare image
        $image = $params['image'];

        //holds if image is set
        $is_image_set = $image !== "NULL";

        if($is_image_set){

            $image = base64_decode($image);

            if($image===FALSE){
                return APIHandler::formatResponse("FAILED","Could not decode student photo");
            }

            $file_path = APIHandler::getTempDirPath()."/image".rand(0,1000)."tmp";

            file_put_contents($file_path, $image);

            $image_data = getimagesize($file_path);

            //check file is of correct type
            if(!preg_match("/image/",$image_data['mime'])){
                unlink($file_path);
                return APIHandler::formatResponse("FAILED","The uploaded file is not an image");
            }

            //resize image to reduce size
            $width = $image_data[0];
            $height = $image_data[1];

            $ratio = $width/$height;
            $size_limit = 400;

            if($width > $height){
                $new_width = 400;
                $new_height = $new_width/$ratio;
            }else{
                $new_height = 400;
                $new_width = $new_height*$ratio;
            }

            if($width > $size_limit || $height > $size_limit){
                $image_resource = ImageHandler::resizeImage($file_path, $new_width, $new_height, $image_data['mime']);
            }else{
                $image_resource = ImageHandler::resizeImage($file_path, $width, $height, $image_data['mime']);
            }

            unlink($file_path);

            if(!$image_resource){
                return APIHandler::formatResponse("FAILED","Unable to resize image");
            }
        }

        $name = $params['name'];
        $type = $params['type'];
        $price = $params['price'];
        $description = $params['description'];
        $amount_in_stock = $params['amount_in_stock'];

        //check that $type is valid
        if(!in_array($type, self::ITEM_TYPES)){
            return APIHandler::formatResponse("FAILED","Invalid type: '$type'");
        }

        //verify that $price is float
        if(!is_float($price)){
            return APIHandler::formatResponse("FAILED","Price must be a float");
        }


        //prepare picture path
        $basename = "NULL";
        $destination = "NULL";


        if($is_image_set){

            //process file name and save image
            $basename = self::SHUFFLE_STRING;
            $basename = str_shuffle($basename);
            $basename = substr($basename, 0, 20);

            switch ($image_data['mime']) {
                case 'image/png':
                    $basename .= ".png";
                    $destination = APIHandler::getImagesDirPath()."/".$basename;
                    break;

                case 'image/jpeg':
                    $basename .= ".jpg";
                    $destination = APIHandler::getImagesDirPath()."/".$basename;
                    break;

                default:
                    break;
            }

        }


        try {
            //start transaction
            $this->db->startTransaction(__LINE__);

            //insert item
            $sql = "INSERT INTO item (item_name, item_type, item_price, item_description, image_filename, amount_in_stock) VALUES ('$name', '$type', '$price', NULLIF('$basename','NULL'), '$description', '$amount_in_stock')";

            $this->db->runQuery($sql, __LINE__, true);

            $this->db->commitTransaction(__LINE__);
        } catch (Exception\DatabaseException $e) {
            return APIHandler::formatResponse("FAILED","Database query error",$e->getMessage());
        }

        //save the image
        if($is_image_set){
            ImageHandler::saveImage($image_resource, $destination, $image_data['mime']);
        }

        return APIHandler::formatResponse("SUCCESS","Item added successfully");

    }

    /**
     * @param $params
     * @return array
     */
    public function getItems($params){

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

        $type = $params['type'];

        if($type !== 'all'){
            $sql = "SELECT * FROM item WHERE item_type = '$type'";
        }else{
            $sql = "SELECT * FROM item";
        }

        try {
            $result = $this->db->runQuery($sql, __LINE__);
        } catch (Exception\DatabaseException $e) {
            return APIHandler::formatResponse("FAILED","Database error",$e->getMessage());
        }

        $items = [];

        while ($row = mysqli_fetch_assoc($result)){

            $item["item_id"] = $row["item_id"];
            $item["item_name"] = $row["item_name"];
            $item["item_type"] = $row["item_type"];
            $item["item_price"] = $row["item_price"];
            $item["item_description"] = $row["item_description"];
            $item["amount_in_stock"] = $row["amount_in_stock"];
            $item['image'] = $row['image_filename'];

            $items[] = $item;
        }

        if(count($items) > 0){
            return APIHandler::formatResponse("SUCCESS","Success",$items);
        }else{
            return APIHandler::formatResponse("EMPTY","No items were found");
        }

    }

    //end of class
}