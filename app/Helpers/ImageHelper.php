<?php

namespace App\Helpers;

class ImageHelper
{
    public static $iptcHeaderArray = array
    (
        '2#005'=>'Title',
        '2#010'=>'PostalCode',
        '2#020'=>'Subcategories',
        '2#025'=>'Keywords',
        '2#055'=>'CreationDate',
        '2#080'=>'Email',
        '2#085'=>'Author',
        '2#090'=>'City',
        '2#095'=>'State',
        '2#101'=>'Country',
        '2#103'=>'Phone',
        '2#105'=>'Headline',
        '2#110'=>'Source',
        '2#115'=>'Website',
        '2#116'=>'Copyright',
        '2#120'=>'Caption',
        '2#122'=>'CaptionWriter'
    );
    public static function cropImage($image, $x, $y, $width, $height, $name, $savingDir){
        try {
            $what = getimagesize($image);
        } catch(\Exception $e) {
            dd($e);
        }

        $extension = "png";
        switch(strtolower($what['mime']))
        {
            case 'image/png':
                $src = imagecreatefrompng($image);
                break;
            case 'image/jpeg':
                $src = imagecreatefromjpeg($image);
                $extension = "jpeg";
                break;
            case 'image/gif':
                $src = imagecreatefromgif($image);
                $extension = "gif";
                break;
            default: die();
        };

        $croppedImage = imagecrop($src, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);
        $fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $name);
        $croppedImageName = $fileNameNoExtension.".".$extension;
        $destination = public_path($savingDir."/".$croppedImageName);
        imagejpeg($croppedImage, $destination);
        return $croppedImageName;
    }

    public static function iptc_make_tag($rec, $data, $value)
    {
        $length = strlen($value);
        $retval = chr(0x1C) . chr($rec) . chr($data);

        if($length < 0x8000)
        {
            $retval .= chr($length >> 8) .  chr($length & 0xFF);
        }
        else
        {
            $retval .= chr(0x80) .
                chr(0x04) .
                chr(($length >> 24) & 0xFF) .
                chr(($length >> 16) & 0xFF) .
                chr(($length >> 8) & 0xFF) .
                chr($length & 0xFF);
        }

        return $retval . $value;
    }
    public static function resize_image($file, $w, $h, $name, $destination, $keepRatio=true) {
        list($width, $height) = getimagesize($file);
        $what = getimagesize($file);

        $extension = "png";

        switch(strtolower($what['mime']))
        {
            case 'image/png':
                $src = imagecreatefrompng($file);
                break;
            case 'image/jpeg':
                $src = imagecreatefromjpeg($file);
                $extension = "jpeg";
                break;
            case 'image/gif':
                $src = imagecreatefromgif($file);
                $extension = "gif";
                break;
            default: die();
        };
        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
        $fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $name);
        $destination = public_path($destination."/".$fileNameNoExtension.".".$extension);
        imagejpeg($dst, $destination);
        return $fileNameNoExtension.".".$extension;
    }

    public static function read_metas($image) {
        $allMetas = [];
        $filteredMetas = [];
        try {
            $size = getimagesize($image, $info);
        } catch(\Exception $e) {
            $size = @getimagesize($image, $info);
        }

        if(is_array($size)) {
            $allMetas = array_merge($allMetas, $size);
        }
        if(is_array($info)) {
            $allMetas = array_merge($allMetas, $info);
        }

        if(isset($allMetas[0]) && isset($allMetas[1])) {
            $filteredMetas["Width"] = $allMetas[0];
            $filteredMetas["Height"] = $allMetas[1];
        }

        if(is_array($info) && isset($info['APP13'])) {
            $iptc = iptcparse($info["APP13"]);
            if(is_array($iptc)) {
                $allMetas = array_merge($iptc, $allMetas);
            }

        }
        try {
            $metas = exif_read_data($image);
            if(is_array($metas)) {
                $allMetas = array_merge($metas, $allMetas);
            }

        } catch (\Throwable $e) {
        }

        foreach (self::$iptcHeaderArray as $meta => $value) {
            if(isset($allMetas[$value])) {
                $filteredMetas[$value] = $allMetas[$value];
            } else if(isset($allMetas[$meta])){
                if($meta === "2#025") {
                    $keywords = $allMetas[$meta];
                    if(count($keywords) == 1) {
                        $keywords = $keywords[0];
                        if(is_string($keywords)) $keywords = explode(",", $keywords);
                    }
                    $filteredMetas[$value] = $keywords;
                } else {
                    $filteredMetas[$value] = $allMetas[$meta][0];
                }
            } else {
                $filteredMetas[$value] = "";
            }
        }
        $metas = self::convert_from_latin1_to_utf8_recursively($filteredMetas);
        return $metas;
    }

    public static function convert_from_latin1_to_utf8_recursively($dat)
    {
        if (is_string($dat)) {
            return utf8_encode($dat);
        } elseif (is_array($dat)) {
            $ret = [];
            foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);

            return $ret;
        } elseif (is_object($dat)) {
            foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);

            return $dat;
        } else {
            return $dat;
        }
    }

    public static function addMetaToImage($imagePath, $metas=[]) {
        $data = "";
        foreach($metas as $tag => $string)
        {
            $tag = array_search($tag, self::$iptcHeaderArray);
            if($tag) {
                $tag = substr($tag, 2);
                $data .= self::iptc_make_tag(2, $tag, $string);
            }
        }

        $content = iptcembed($data, $imagePath);

        $fp = fopen($imagePath, "wb");
        fwrite($fp, $content);
        fclose($fp);
    }
}
