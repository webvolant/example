<?php

class AdminOrderController extends Controller {

    public function add()
    {
        $doctors = User::getDoctors()->lists('fio','id');
        asort($doctors);
        $clients = Client::all()->lists('phone','id');
        asort($clients);
        $kliniks = Klinika::all()->lists('name','id');
        asort($kliniks);
        $diags = Test::all()->lists('name','id');
        asort($diags);
        $status = Status::all()->lists('name','id');
        return View::make('admin.order.add',array(
            'clients'=>$clients,
            'doctors'=>$doctors,
            'status'=>$status,
            'kliniks'=>$kliniks,
            'diags'=>$diags
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
        $user = Order::find($id);
        //$user->events()->delete();
        $user->delete();
        //Order::destroy($id);
        //$users = User::paginate(10);
        //return View::make('user::list',array('users'=>$users));
        return Redirect::route("order/index");
    }

    public function edit($id)
    {
        $doctors = User::getDoctors()->lists('fio','id');
        asort($doctors);
        $clients = Client::all()->lists('phone','id');
        asort($clients);
        $kliniks = Klinika::all()->lists('name','id');
        asort($kliniks);
        $diags = Test::all()->lists('name','id');
        asort($diags);
        $status = Status::all()->lists('name','id');

        $order = Order::find($id);

        $events = Eventer::where('order_id', '=', "$id")->take(30)->get(); //take(20)

        return View::make('admin.order.edit',array(
            'clients'=>$clients,
            'doctors'=>$doctors,
            'order'=>$order,
            'events'=>$events,
            'status'=>$status,
            'kliniks'=>$kliniks,
            'diags'=>$diags
        ));
    }

    public function index()
    {
        $speciality = Order::orderBy('id','desc')->take(700)->get();
        return View::make('admin.order.list',array('users'=>$speciality));
    }


}