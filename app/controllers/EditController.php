<?php

class EditController extends BaseController
{
    public function index() {
        $r = LoginController::checkLogin();
        if ($r != NULL)
            return $r;
        $id = Input::get("id", NULL);
        if($id != NULL) {
            $r = DB::table("article")->where("id", "=", $id)->first();
            $title = $r->title;
            $content = $r->content;
        }
        else {
            $title = NULL;
            $content = NULL;
        }
        $catalog = SiderController::getCatalog();
        $about = SiderController::getAbout();
        $tags = ArticleController::getAllTags();
        $data = array(
            "id"=>$id,
            "title"=>$title,
            "content"=>$content,
            "tags"=>$tags,
            "about"=> $about,
            "catalog" => $catalog,
        );
        return View::make("edit", $data);
    }

    public function newPost() {
        $id = Input::get('id');
        $title = Input::get('title');
        $content = Input::get('content'); 
        $tag = Input::get('tag');

        if ($id == NULL) {
            if(DB::table("article")->where("title", "=", $title)->first()) {
                $data = array(
                    "status"=>303,
                    "message"=>"标题重复，提交失败",
                );
                return json_encode($data, JSON_UNESCAPED_UNICODE);
            }
            $author = DB::table("user")->where("name","=",Session::get("login"))->first();
            DB::table("article")->insert(array(
                "title"=>$title,
                "content"=>$content,
                "author"=>$author->id,
            ));
        }
        else {
            DB::table("article")->where("id", "=", (int)$id)->update(array("title"=>$title, "content"=>$content)); 
        }

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
            $r = DB::table("article_tag")->whereRaw("articleid="+$articleid+"and tagid="+$id)->get();
            if ($r != NULL) {
                DB::table("article_tag")->insert(array(
                    "articleid"=>$articleid,
                    "tagid"=>$id,
                ));
            }
        }

        $content = array(
            "status"=>200,
            "message"=>"ok",
            "articleid"=>$articleid,
        );
        return json_encode($content, JSON_UNESCAPED_UNICODE);
    }

}
