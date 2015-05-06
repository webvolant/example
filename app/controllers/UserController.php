<?php

class UserController extends Controller {

    //FRONT DOCTOR
    public function showLogin()
    {
        return View::make('front.user.login');
    }

    public function showReg()
    {
        return View::make('front.user.registration');
    }

    public function step2()
    {
        $flag_interes = Session::get('interes');
        return View::make('front.user.step2', array('flag_interes' => $flag_interes));
    }

    public function step3()
    {
        //$flag_interes = Session::get('interes');
        return View::make('front.user.step3');//, array('flag_interes' => $flag_interes));
    }
}
