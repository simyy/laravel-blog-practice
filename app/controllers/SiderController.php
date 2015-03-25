<?php

class SiderController extends BaseController
{
    static function getAbout() {
        $about = DB::table("config")->select("content")->where("name","=","about")->first();
        return $about->content;
    }

    static function getCatalog() {
        $catalog = DB::table("article")->select("id","title")->orderBy('create_time', 'desc')->get();
        $n = count($catalog);

        $res = Array();
        if ($n > 5) {
            $catalog  = array_slice($catalog, 0, 5);
        }
    
        return $catalog;
    }

}
