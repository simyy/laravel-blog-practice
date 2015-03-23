<?php

class IndexController extends BaseController 
{
    public function index() {
        $res = $this->getIndexArticle();
        $about = $this->getAbout();
        $catalog = $this->getCatalog();
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
        $res = DB::table("article")->get();

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
                $sub_content = $this->cutstr($r->content, 300);
                $tags = $this->getTags($r->id);
                $content = Array('title'=>$r->title, 'content'=>$sub_content, 'tag'=>$tags, 'time'=>$r->create_time, 'author'=>$author->name);
                Array_push($contents, $content);
            }
            return Array($contents, $next);
        }
        else {
            return NULL;
        }
    }

    public function getTags($articleid) {
        $tagids = DB::table("article_tag")->select("tagid")->whereRaw("articleid={$articleid}")->get();
        $tags = Array();
        foreach($tagids as $tagid) {
            $tag = DB::table("tag")->select("name")->whereRaw("id={$tagid->tagid}")->first(); 
            Array_push($tags, $tag->name);
        }

        return $tags;
    }

    public function getAbout() {
        $about = DB::table("config")->select("content")->where("name","=","about")->first();
        return $about->content;
    }

    public function getCatalog() {
        $catalog = DB::table("article")->select("title")->orderBy('create_time', 'desc')->get();
        $n = count($catalog);

        $res = Array();
        if ($n > 20) {
            $catalog  = array_slice($catalog, 0, 5);
        }
        foreach ($catalog as $item) {
            Array_push($res, $item->title);
        }  

        return $res;
    }

    public function cutstr($sourcestr,$cutlength){
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
