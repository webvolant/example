<?php

class AdminSpecialityController extends Controller {

    public function add()
    {

        return View::make('admin.speciality.add');
    }

    public function profile($id)
    {
        $speciality = Speciality::find($id);
        return View::make('admin.speciality.profile',array('user'=>$speciality));
    }

    public function delete($id)
    {
        $user = Speciality::find($id);
        $user->delete();
        //$users = User::paginate(10);
        //return View::make('user::list',array('users'=>$users));
        return Redirect::route("speciality/index");
    }

    public function edit($id)
    {
        $speciality = Speciality::find($id);
        return View::make('admin.speciality.edit',array('user'=>$speciality));
    }

    public function index()
    {
        $speciality = Speciality::all();
        return View::make('admin.speciality.list',array('users'=>$speciality));
    }


}