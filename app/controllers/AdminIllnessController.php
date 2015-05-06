<?php

class AdminIllnessController extends Controller {

    public function add()
    {
        $specialities = Speciality::all()->lists('specialisation', 'id');//->select('name', 'email')
        return View::make('admin.illness.add', array('specialities'=>$specialities));
    }

    public function delete($id)
    {
        $user = Illness::find($id);
        $user->delete();
        //$users = User::paginate(10);
        //return View::make('user::list',array('users'=>$users));
        return Redirect::route("illness/index");
    }

    public function edit($id)
    {
        $specialities = Speciality::all()->lists('specialisation', 'id');
        $user = Illness::find($id);

        //CRM save - before data
        $json = json_encode($user);
        $json = json_decode($json, true);
        //$json['specialities'] = $mas;
        $j = json_encode($json, true);
        Session::put('j_before', $j);

        return View::make('admin.illness.edit',array(
            'user'=>$user,
            'specialities'=>$specialities,
            //'specialities_current'=>$mas,
            //'map'=>$map,
        ));
    }

    public function index()
    {
        $users = new Illness();
        $users = $users->all();
        return View::make('admin.illness.list',array('users'=>$users));
    }


}