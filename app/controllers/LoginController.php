<?php

class LoginController extends BaseController {
    public function index()
    {
        return View::make('login');
    }

    public function login()
    {
        $name = Input::get('user');
        $passwd = Input::get('passwd');

        $res = $this->checkUser($name, $passwd);

        if ($res) {
            return "success";
        }
        else {
            return "failure";
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
}
