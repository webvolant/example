<?php

class AdminDoctorController extends Controller {

    public function add()
    {
        $config['places'] = TRUE;
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox2';
        $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        //$config['placesAutocompleteOnChange'] = 'alert(\'You selected a place\');';
        Gmaps::initialize($config);
        $map = Gmaps::create_map();

        $specialities = Speciality::all()->lists('name', 'id');//->select('name', 'email')
        return View::make('admin.doctor.add', array('specialities'=>$specialities,'map'=>$map));
    }

    public function profile($id)
    {
        $user = User::find($id);
        return View::make('admin.doctor.profile',array('user'=>$user));
    }

    public function delete($id)
    {
        $user = User::find($id);

        $user->Specialities()->detach();
        //$user->Orders();
        //var_dump($user->Specialities());
        //die();
        $user->delete();
        //$users = User::paginate(10);
        //return View::make('user::list',array('users'=>$users));
        return Redirect::route("doctor/index");
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

        $specialities = Speciality::all()->lists('name', 'id');
        $user = User::find($id);
        $specialities_current = $user->Specialities->toArray();
        $mas = [];
        foreach($specialities_current as $i)
            array_push($mas, $i['id']);

        //CRM save - before data
        $json = json_encode($user);
        $json = json_decode($json, true);
        $json['specialities'] = $mas;
        $j = json_encode($json, true);
        Session::put('j_before', $j);

        return View::make('admin.doctor.edit',array(
            'user'=>$user,
            'specialities'=>$specialities,
            'specialities_current'=>$mas,
            'map'=>$map,
        ));
    }

    public function index()
    {
        $users = new User();
        $users = $users->getDoctorsForAdmin();
        return View::make('admin.doctor.list',array('users'=>$users));
    }


}