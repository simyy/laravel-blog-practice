<?php

class IndexController extends BaseController 
{
    public function index() {
        $res = $this->getIndexArticle();
        $sider = new SiderController();
        $catalog = $sider->getCatalog();
        $about = $sider->getAbout();
        $data = array(
            "contents" => $res[0],
            "next" => $res[1],
            "about"=> $about,
            "catalog" => $catalog,
        );
        #return var_dump($contents);
        return View::make('index', $data);
    }

    public function getNextPageArticle() {
        $page = (int)Input::get("page", '1');
        $res = $this->getIndexArticle($page=$page);
        $data = array(
            "contents" => $res[0],
            "next" => $res[1],
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);
        
    }

    private function getIndexArticle($page=1, $num=2) {
        $res = DB::table("article")->orderBy('create_time', 'desc')->get();

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

            $contents = Array();
            foreach ($res as $r) {
                #return $r;
                $author = DB::table("user")->select('name')->whereRaw("id=$r->author")->first();
                #$sub_content = substr($r->content, 0, 300);
                $util = new UtilController();
                $sub_content = $util->cutstr($r->content, 300);
                $article = new ArticleController();
                $tags = $article->getTags($r->id);
                $content = Array('title'=>$r->title, 'content'=>$sub_content, 'tag'=>$tags, 'time'=>$r->create_time, 'author'=>$author->name);
                Array_push($contents, $content);
            }
            return Array($contents, $next);
        }
        else {
            return NULL;
        }
    }

} 
