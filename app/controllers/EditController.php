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
        return var_dump($title);
    }

};
