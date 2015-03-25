<?php

class CatalogController extends BaseController {

    public function index() {
        $res = $this->getCatalog();
        $catalog = SiderController::getCatalog();
        $about = SiderController::getAbout();
        $data = array(
            "contents" => $res[0],
            "next" => $res[1],
            "about"=> $about,
            "catalog" => $catalog,
        );
        return View::make("catalog", $data);
    }

    public function getCatalog($page=1, $num=10) {
        $res = DB::table("article")->select("id", "title",  "create_time")->orderBy('create_time', 'desc')->get();
        $n = count($res);
        if ($n > 0) { 
            if ($n <= ($num * $page)) {
                $res = array_slice($res, $num*($page-1), $n);
            }
            else {
                $res = array_slice($res, $num*($page-1), $num);
            }

            if ($n > ($num * $page)) 
                $next = $page + 1;
            else
                $next = 0;

            $result = Array();
            foreach ($res as $r) {
                $tags = ArticleController::getTags($r->id);
                array_push($result, Array("id"=>$r->id,"title"=>$r->title,"time"=>$r->create_time,"tag"=>$tags));
            }

            return Array($result, $next);
        }
        return NULL; 
    }

}
