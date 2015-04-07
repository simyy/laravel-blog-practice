<?php
class ManageController extends BaseController
{
    public function index() {
        $r = LoginController::checkLogin();
        if ($r != NULL)
            return $r;
        $catalog = SiderController::getCatalog();
        $about = SiderController::getAbout();
        $r = $this->getTitles(); 
        $data = array(
            "about"=> $about,
            "catalog" => $catalog,
            "contents"=> $r[0],
            "next"=> $r[1],
        );
        return View::make('manage', $data);
    }

    public function getTitleList() {
        $page = (int)Input::get("page", '1');
        $num = (int)Input::get("num", '3');
        $r = $this->getTitles($page, $num); 
        $data = array(
            "contents"=> $r[0],
            "next"=> $r[1],
        );
        return json_encode($data, JSON_UNESCAPED_UNICODE);

    }

    private function getTitles($page=1, $num=3) {
        $res = DB::table("article")->orderBy('create_time', 'desc')->get();
        $n = count($res);
        if ($n > 0){
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
                $content = Array('id'=>$r->id, 'title'=>$r->title, 'time'=>$r->create_time);
                Array_push($contents, $content);
            }
            return Array($contents, $next);

        }
        else {
            return NULL;
        }
    }
} 
