<?php

class AdminClientController extends Controller {

    public function add()
    {
        return View::make('admin.client.add');
    }

    public function delete($id)
    {
        $user = Client::find($id);
        $user->delete();
        return Redirect::route("client/index");
    }

    public function edit($id)
    {
        $user = Client::find($id);
        return View::make('admin.client.edit',array('user'=>$user));
    }

    public function index()
    {
        $operators = Client::getClients();
        return View::make('admin.client.list',array('users'=>$operators));
    }


}
