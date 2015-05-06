<?php

class AdminStatusController extends Controller {

    public function add()
    {

        return View::make('admin.status.add');
    }

    public function delete($id)
    {
        $user = Status::find($id);
        $user->delete();
        //$users = User::paginate(10);
        //return View::make('user::list',array('users'=>$users));
        return Redirect::route("status/index");
    }

    public function edit($id)
    {
        $speciality = Status::find($id);
        return View::make('admin.status.edit',array('user'=>$speciality));
    }

    public function index()
    {
        $speciality = Status::all();
        return View::make('admin.status.list',array('users'=>$speciality));
    }


}