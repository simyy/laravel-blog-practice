<?php

class ArticleController extends BaseController {

    public function index() {
        $id = (int)Input::get("id", '1'); 
        $catalog = SiderController::getCatalog();
        $about = SiderController::getAbout();
        $data = array(
            "content" => $this->getArticle($id),
            "about" => $about,
            "catalog" => $catalog,
        );

        #return json_encode($data, JSON_UNESCAPED_UNICODE);
        return View::make('article', $data);
    }

    public function getArticle($id=NULL) {
        if ($id == NULL) {
            $res = DB::table("article")->orderBy('create_time', 'desc')->first(); 
        }
        else {
            $res = DB::table("article")->where("id", "=", $id)->orderBy('create_time', 'desc')->first(); 
        }
        $author = DB::table("user")->select('name')->whereRaw("id=$res->author")->first();

        $content = Array("title"=>$res->title, "author"=>$author->name, "content"=>$res->content, "tag"=>$this->getTags($res->id), "time"=>$res->create_time); 

        return $content;
    }

    static function getTags($articleid) {
        $tagids = DB::table("article_tag")->select("tagid")->whereRaw("articleid={$articleid}")->get();
        $tags = Array();
        foreach($tagids as $tagid) {
            $tag = DB::table("tag")->select("name")->whereRaw("id={$tagid->tagid}")->first(); 
            Array_push($tags, $tag->name);
        }

        return $tags;
    }

    static function getAllTags() {
        $r = DB::table("tag")->select("id", "name")->get();
        return $r;
    }

}
