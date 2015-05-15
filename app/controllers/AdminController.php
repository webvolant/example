<?php

class AdminController extends Controller {

    public function dashboard()
    {
        return View::make('admin');
    }

    public function index()
    {
        $users = Crm::all();
        return View::make('admin.crm.list',array('users'=>$users));
    }

    public function events()
    {
        $users = Crm::where('object','=','event')->get();
        return View::make('admin.crm.list',array('users'=>$users));
    }

    /*public function diag()
    {
        $users = Crm::where('object','=','klinika')->where('type','=','1')->get();
        return View::make('admin.crm.list',array('users'=>$users));
    }*/

    public function docs()
    {
        $users = Crm::where('object','=','doctor')->get();
        return View::make('admin.crm.list',array('users'=>$users));
    }

    public function kliniks()
    {
        $users = Crm::where('object','=','klinika')->get();
        return View::make('admin.crm.list',array('users'=>$users));
    }


    public function cleanCache(){
        Cache::flush();
    }


}