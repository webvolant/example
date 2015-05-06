<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/test', function(){





    //$config['center'] = '';
    $config['zoom'] = 'auto';
    $config['places'] = TRUE;
    $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
    $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
    $config['placesAutocompleteOnChange'] = 'alert(\'You selected a place\');';
    Gmaps::initialize($config);

    $marker = array();
    $marker['position'] = 'Moscow';
    Gmaps::add_marker($marker);
    $map = Gmaps::create_map();

    //$map = Gmaps::create_map();

    //$this->load->view('view_file', $data);

    echo "<html><head><script type='text/javascript'>var centreGot = false;</script>".$map['js']."</head><body>".$map['html']."<input type='text' id='myPlaceTextBox' /></body></html>";
});

Route::get('/im', function()
{
    $kl = Klinika::find(1);
    var_dump($kl);
    $kl->Tests()->sync(array(4,5));
});

Route::get('/', array('as' => '/',
    'uses' => 'HomeController@showHome'));

View::composer(array('front','front.doctor.list','front.klinika.list','front.article.library','front.article.list','front.illness.library','front.illness.list'), function($view)
{
    $view->with('orders', 0);
    $view->with('docs', User::getDoctorsCount());
    $view->with('ot', 0);

    $search_mas = [0=>"По специальности",1=>"По специализации",2=>"По исследованию",3=>"По заболеванию"];



    $specialities = Speciality::all()->lists('name', 'id');
    asort($specialities);
    /*var_dump($specialities);
    die();
    $specialities = $specialities->sortBy(function($specialities)
    {
        return $specialities->name;
    });*/

    $specialisations = Speciality::all()->lists('specialisation', 'id');

    $view->with('search1', $search_mas); //массив критериев поиска
    $view->with('specialities', $specialities); //массив специальностей


    $temp = [];
    foreach ( $specialisations as $key => $sp)
            array_push($temp, $sp);

    $unic = array_unique($temp);




    $view->with('specialisations', $unic); //массив специализаций
    $view->with('specialisations2', Speciality::all());
});


foreach (File::allFiles(__DIR__ . '/routes') as $partial) {
    require_once $partial->getPathname();
}