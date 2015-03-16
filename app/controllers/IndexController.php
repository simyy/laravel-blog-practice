<?php

class IndexController extends BaseController 
{
    public function index() {
        $contents = $this->getIndexArticle();
        return var_dump($contents);
        $data = array(
            "contents" => $contents,
        );
        return View::make('index', $data);
    }

    private function getIndexArticle($num=2) {
        $res = DB::table("article")->get();

        $n = count($res);
        if ($n > 0) {
            if ($n < $num) {
                $res = array_slice($res, 0, $n);
            }
            else {
                $res = array_slice($res, 0, $num);
            } 

            $contents = Array();
            foreach ($res as $r) {
                #return $r;
                $author = DB::table("user")->select('name')->whereRaw("id=$r->author")->first();
                $sub_content = substr($r->content, 0, 300);
                $tags = $this->getTags($r->id);
                $content = Array('title'=>$r->title, 'content'=>$sub_content, 'tag'=>$tags, 'time'=>$r->create_time, 'author'=>$author->name);
                Array_push($contents, $content);
            }
            return $contents;
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
} 
