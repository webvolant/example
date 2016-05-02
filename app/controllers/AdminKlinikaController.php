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
        $config['places'] = TRUE;
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox2';
        $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        Gmaps::initialize($config);
        $map = Gmaps::create_map();

        $doctors = User::getDoctors()->lists('fio', 'id');
        $kl = Klinika::find($id);
        $doctors_current = $kl->Users->toArray();
        $mas = [];
        foreach($doctors_current as $i)
            array_push($mas, $i['id']);

        //CRM save - before data
        $json = json_encode($kl);
        $json = json_decode($json, true);
        $json['doctors'] = $mas;
        $j = json_encode($json, true);
        Session::put('j_before', $j);

        $parentList = \Test::getNestedList('name', $key = 'id', $seperator = '---');
        //$mas = json_encode($parentList);
        //foreach($mas as $key=>$i) //$key = null, $seperator = ' '
        //var_dump($mas);
        //var_dump($mas);

        //getNestedList('name');
        $json_list = "[";
        foreach($parentList as $key=>$i)
            $json_list .= "{'".$key."':'".$i."'},";
        $json_list .="]";



        //var_dump($json22);


        //asort($parentList);

        $tests = Klinika::getTestsForKlinik($kl);

        $images = Klinika::getImages($kl);

        return View::make('admin.klinika.edit',array(
            'user'=>$kl,
            'doctors'=>$doctors,
            'doctors_current'=>$mas,
            'map'=>$map,
            'parentList'=>$json_list,
            'tests'=>$tests,
            'images'=>$images
        ));
    }

    public function index()
    {
        $users = Klinika::all();
        return View::make('admin.klinika.list',array('users'=>$users));
    }


}