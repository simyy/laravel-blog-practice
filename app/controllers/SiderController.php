<?php

class SiderController extends BaseController
{
    public function getAbout() {
        $about = DB::table("config")->select("content")->where("name","=","about")->first();
        return $about->content;
    }

    public function getCatalog() {
        $catalog = DB::table("article")->select("title")->orderBy('create_time', 'desc')->get();
        $n = count($catalog);

        $res = Array();
        if ($n > 5) {
            $catalog  = array_slice($catalog, 0, 5);
        }
        foreach ($catalog as $item) {
            Array_push($res, $item->title);
        }  

        return $res;
    }

}
