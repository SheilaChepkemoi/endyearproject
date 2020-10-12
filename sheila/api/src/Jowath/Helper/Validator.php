<?php

namespace Jowath\Helper;


class Validator
{
    private static $lastError;

    function __construct()
    {
    }

    /**
     * validates a date
     * @param $dateString
     * @param string $format
     * @param string $dateDelimiter
     * @return bool
     */
    public static function isDateValid($dateString, $format = "m-d-Y", $dateDelimiter = "/"){

        $splitDate = explode($dateDelimiter,$dateString);
        $splitFormat = explode("-",$format);

        //check if $splitFormat array is of correct size
        if(count($splitFormat) !== 3){
            self::$lastError = "Could not split format (".$format.")";
            return false;
        }

        //check if $splitDate array is of correct size
        if(count($splitDate) !== 3){
            self::$lastError = "Could not split date (".$dateString.")";
            return false;
        }

        //check if the required values are present in $splitFormat array
        if(!in_array('m',$splitFormat) || !in_array('d',$splitFormat) || !in_array('Y',$splitFormat)){
            self::$lastError = "Invalid format (".$format.")";
            return false;
        }

        //get the indexes of the above values
        $month = array_search('m',$splitFormat);
        $day = array_search('d',$splitFormat);
        $year = array_search('Y',$splitFormat);

        return checkdate($splitDate[$month],$splitDate[$day],$splitDate[$year]);
    }

    /**
     * returns true if date is future, including the current date by default
     * @param $dateString
     * @param string $format
     * @param string $dateDelimiter
     * @param bool $includeToday
     * @return bool
     */
    public static function isFutureDate($dateString, $format = "m-d-Y", $dateDelimiter = "/",$includeToday = true){

        $splitDate = explode($dateDelimiter,$dateString);
        $splitFormat = explode("-",$format);

        //check if $splitFormat array is of correct size
        if(count($splitFormat) !== 3){
            self::$lastError = "Invalid format (".$format.")";
            return false;
        }

        //check if $splitDate array is of correct size
        if(count($splitDate) !== 3){
            self::$lastError = "Invalid date (".$dateString.")";
            return false;
        }

        //check if the required values are present in $splitFormat array
        if(!in_array('m',$splitFormat) || !in_array('d',$splitFormat) || !in_array('Y',$splitFormat)){
            self::$lastError = "Invalid format (".$format.")";
            return false;
        }

        //get the indexes of the above values
        $month = array_search('m',$splitFormat);
        $day = array_search('d',$splitFormat);
        $year = array_search('Y',$splitFormat);

        $newSplitDateArray = [$splitDate[$month],$splitDate[$day],$splitDate[$year]];
        $newDateString = implode("/",$newSplitDateArray);

        try {
            $today = new \DateTime("today");
        } catch (\Exception $e) {
            self::$lastError = $e->getMessage();
        }

        if($includeToday){
            if(strtotime($newDateString) >= $today->getTimestamp()){
                return true;
            }else{
                return false;
            }
        }else{
            if(strtotime($newDateString) > $today->getTimestamp()){
                return true;
            }else{
                return false;
            }
        }

        //end of isFutureDate function
    }

    /**
     * checks if a phone number is valid
     * @param $phoneNumber
     * @return false|int
     */
    public static function isPhoneNumberValid($phoneNumber){
        return preg_match("/^7\\d{8}$/",$phoneNumber);
    }

    /**
     * checks if a national ID is valid
     * @param $nationalID
     * @return false|int
     */
    public static function isNationalIDValid($nationalID){
        return preg_match("/^\\d{8}$/",$nationalID);
    }

    /**
     * checks if an email is valid
     * @param $email
     * @return false|int
     */
    public static function isEmailValid($email){
        return preg_match("/^([\\w]+\\.?)+@([\\w]+\\.)+([\\w]+\\.?)+\\w$/",$email);
    }

    /**
     * @return mixed
     */
    public static function getLastError()
    {
        return self::$lastError;
    }

    //end of class
}