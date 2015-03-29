<?php

class LoginController extends BaseController {
    public function index()
    {
        return View::make('login');
    }

    public function login($route="/")
    {
        $name = Input::get('user');
        $passwd = Input::get('passwd');

        $res = $this->checkUser($name, $passwd);

        if ($res) {
            Session::put("login", "1");
            return Redirect::to($route);
        }
        else {
            return Redirect::to('login');
        }
    }

    private function checkUser($name, $passwd) {
        #$res = DB::table("user")->whereRaw("`name`='{$name}' and passwd=PASSWORD('{$passwd}')")->get();
        $res = DB::table("user")->whereRaw("`name`='{$name}' and `passwd`=PASSWORD('{$passwd}')")->get();

        if (count($res) > 0) {
            return $res[0];
        }
        else {
            return NULL;    
        }
    }

    static function checkLogin() {
        $login = Session::get('login', NULL);
        if ($login == NULL)
            return View::make('login'); 
        return NULL;
    }

    public function unLogin() {
        Session::flush();
        return Redirect::to('/');
    }
}
