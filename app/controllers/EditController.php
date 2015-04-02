<?php

class EditController extends BaseController
{
    public function index() {
        $r = LoginController::checkLogin();
        if ($r != NULL)
            return $r;
        $catalog = SiderController::getCatalog();
        $about = SiderController::getAbout();
        $tags = ArticleController::getAllTags();
        $data = array(
            "tags"=>$tags,
            "about"=> $about,
            "catalog" => $catalog,
        );
        return View::make("edit", $data);
    }

    public function newPost() {
        $title = Input::get('title');
        $content = Input::get('content'); 
        $tag = Input::get('tag');

        if(DB::table("article")->where("title", "=", $title)->first()) {
            $data = array(
                "status"=>303,
                "message"=>"标题重复，提交失败",
            );
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }

        DB::table("article")->insert(array(
            "title"=>$title,
            "content"=>$content,
            "author"=>Session::get("login", NULL),
        ));

        $r = DB::table("article")->where("title", "=", $title)->first();
        $articleid = $r->id;

        $tags = explode(";", $tag);
        foreach($tags as $tag) {
            $r = DB::table("tag")->where("name", "=", $tag)->first();
            if ($r == NULL) {
                DB::table("tag")->insert(array(
                    "name"=>$tag,
                ));
                $r = DB::table("tag")->where("name", "=", $tag)->first();
            }
            $id = $r->id;
            DB::table("article_tag")->insert(array(
                "articleid"=>$articleid,
                "tagid"=>$id,
            ));
        }

        $content = array(
            "status"=>200,
            "message"=>"ok",
            "articleid"=>$articleid,
        );
        return json_encode($content, JSON_UNESCAPED_UNICODE);
    }

}
