<?php

class EditController extends BaseController
{
    public function index() {
        $r = LoginController::checkLogin();
        if ($r != NULL)
            return $r;
        $tags = ArticleController::getAllTags();
        $data = array(
            "tags"=>$tags,
        );
        return View::make("edit", $data);
    }

    public function newPost() {
        $title = Input::get('title');
        $content = Input::get('content'); 
        $tag = Input::get('tag');
        return var_dump($title);
    }

};
