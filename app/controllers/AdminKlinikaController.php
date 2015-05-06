<?php

class AdminKlinikaController extends Controller {

    public function add()
    {
        //$config['center'] = '42.875186, 74.611545';
        //$config['zoom'] = 'auto';
        $config['places'] = TRUE;
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox2';
        $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        //$config['placesAutocompleteOnChange'] = 'alert(\'You selected a place\');';
        Gmaps::initialize($config);
        $map = Gmaps::create_map();

        $doctors = User::all()->sortBy('fio')->lists('fio', 'id');//->select('name', 'email')
        return View::make('admin.klinika.add', array('doctors'=>$doctors,'map'=>$map));
    }

    public function delete($id)
    {
        $k = Klinika::find($id);
        $k->delete();
        //$users = User::paginate(10);
        //return View::make('user::list',array('users'=>$users));
        return Redirect::route("klinika/index");
    }

    public function edit($id)
    {
        //$config['center'] = '42.875186, 74.611545';
        //$config['zoom'] = 'auto';
        $config['places'] = TRUE;
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox2';
        $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        //$config['placesAutocompleteOnChange'] = 'alert(\'You selected a place\');';
        Gmaps::initialize($config);
        $map = Gmaps::create_map();

        $doctors = User::getDoctors()->lists('fio', 'id');
        //var_dump($doctors);
        $kl = Klinika::find($id);
        $doctors_current = $kl->Users->toArray();
        $mas = [];
        foreach($doctors_current as $i)
            array_push($mas, $i['id']);

        //foreach($mas as $item){
            //var_dump($item);
        //}



        //CRM save - before data
        $json = json_encode($kl);
        $json = json_decode($json, true);
        $json['doctors'] = $mas;
        $j = json_encode($json, true);
        Session::put('j_before', $j);


        $parentList = \Test::getNestedList('name');

        return View::make('admin.klinika.edit',array(
            'user'=>$kl,
            'doctors'=>$doctors,
            'doctors_current'=>$mas,
            'map'=>$map,
            'parentList'=>$parentList
        ));
    }

    public function index()
    {
        $users = Klinika::all();
        return View::make('admin.klinika.list',array('users'=>$users));
    }


}