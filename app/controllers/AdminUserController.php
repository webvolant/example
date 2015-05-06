<?php

class AdminUserController extends Controller {

    public function showLogin()
    {
        return View::make('admin.login');
    }


    //add OPERATOR
    public function add()
    {
        return View::make('admin.user.add');
    }

    public function profile($id)
    {
        $user = User::find($id);
        return View::make('admin.user.profile',array('user'=>$user));
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return Redirect::route("user/index");
    }

    public function edit($id)
    {
        $user = User::find($id);
        return View::make('admin.user.edit',array('user'=>$user));
    }

    public function index()
    {
        $users = new User();
        $operators = $users->getOperators();
        return View::make('admin.user.list',array('users'=>$operators));
    }


}
