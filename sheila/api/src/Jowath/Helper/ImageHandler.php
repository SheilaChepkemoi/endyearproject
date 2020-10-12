<?php

namespace Jowath\Helper;


class ImageHandler
{

    public function __construct()
    {
    }

    /*
    * resize an image
    */
    public static function resizeImage($file, $w, $h, $image_type, $crop=FALSE) {

        list($width, $height) = getimagesize($file);

        $r = $width / $height;

        if ($crop) {

            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $new_width = $w;
            $new_height = $h;
        } else {

            if ($w/$h > $r) {
                $new_width = $h*$r;
                $new_height = $h;
            } else {
                $new_height = $w/$r;
                $new_width = $w;
            }
        }

        switch ($image_type) {
            case 'image/png':
                $src = imagecreatefrompng($file);
                break;
            case 'image/jpeg':
                $src = imagecreatefromjpeg($file);
                break;
            default:
                return false;
                break;
        }

        $dst = imagecreatetruecolor($new_width, $new_height);
        imagealphablending($dst,false);
        imagesavealpha($dst,true);
        imagealphablending($src,true);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        return $dst;

        //end of resizeImage function
    }

    /*
    * saves image
    */
    public static function saveImage($image, $filename, $image_type){

        switch ($image_type) {
            case 'image/png':
                $result = imagepng($image,$filename);
                break;

            case 'image/jpeg':
                $result = imagejpeg($image,$filename);
                break;

            default:
                return false;
                break;
        }

        return $result;
        //end of saveImage function
    }

    //end of class
}