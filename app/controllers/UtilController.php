<?php

class UtilController extends BaseController {
    static function getAbout() {
        $about = DB::table("config")->select("content")->where("name","=","about")->first();
        return $about->content;
    }

    static function cutstr($sourcestr,$cutlength){
        $returnstr = '';
        $i = 0;
        $n = 0;
        $str_length = strlen($sourcestr);
        $mb_str_length = mb_strlen($sourcestr,'utf-8');
        while(($n < $cutlength) && ($i <= $str_length)){
            $temp_str = substr($sourcestr,$i,1);
            $ascnum = ord($temp_str);
            if($ascnum >= 224){
                $returnstr = $returnstr.substr($sourcestr,$i,3);
                $i = $i + 3;
                $n++;
            }
            elseif($ascnum >= 192){
                $returnstr = $returnstr.substr($sourcestr,$i,2);
                $i = $i + 2;
                $n++;
            }
            elseif(($ascnum >= 65) && ($ascnum <= 90)){
                $returnstr = $returnstr.substr($sourcestr,$i,1);
                $i = $i + 1;
                $n++;
            }
            else{
                $returnstr = $returnstr.substr($sourcestr,$i,1);
                $i = $i + 1;
                $n = $n + 0.5;
            }
        }
        if ($mb_str_length > $cutlength){
            $returnstr = $returnstr . "...";
        }
        return $returnstr; 
    }
} 

