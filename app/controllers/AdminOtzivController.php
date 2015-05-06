<?php

class AdminOtzivController extends Controller {

    public function add()
    {
        $doctors = User::getDoctors()->lists('fio','id');
        asort($doctors);
        $clients = Client::all()->lists('phone','id');
        asort($clients);
        return View::make('admin.review.add',array(
            'clients'=>$clients,
            'doctors'=>$doctors,
        ));
    }



/*
    public function profile($id)
    {
        $speciality = Order::find($id);
        return View::make('admin.order.profile',array('user'=>$speciality));
    }
*/

    public function delete($id)
    {
        $user = Otziv::find($id);
        $user->delete();
        //$users = User::paginate(10);
        //return View::make('user::list',array('users'=>$users));
        return Redirect::route("review/index");
    }

    public function edit($id)
    {
        ///$doctors = User::getDoctors()->lists('fio','id');
        //asort($doctors);
        //$clients = Client::all()->lists('phone','id');
       // asort($clients);

        $otziv = Otziv::find($id);

        //$status = Status::all()->lists('name','id');

        //$events = Eventer::where('order_id', '=', "$id")->take(10)->get(); //take(20)

        return View::make('admin.review.edit',array(
            'otziv'=>$otziv,
            //'doctors'=>$doctors,
            //'order'=>$order,
            //'events'=>$events,
            //'status'=>$status,
        ));
    }

    public function index()
    {
        $otziv = Otziv::all();
        return View::make('admin.review.list',array('users'=>$otziv));
    }


}