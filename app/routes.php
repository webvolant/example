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

});

Route::get('/', array('as' => '/',
    'uses' => 'HomeController@showHome'));

View::composer(array('front',
    'front.doctor.list',
    'front.klinika.list',
    'front.klinika.diaglist',
    'front.article.library',
    'front.article.list',
    'front.illness.library',
    'front.illness.list'),
    function($view)
        {
            $view->with('orders', 0);
            $view->with('docs', User::getDoctorsCount());
            $view->with('ot', 0);

            $search_mas = [0=>"По специальности",1=>"По специализации",2=>"По исследованию",3=>"По заболеванию"];



            $specialities = Speciality::all()->lists('name', 'id');
            asort($specialities);

            $specialisations = Speciality::all()->lists('specialisation', 'id');
            asort($specialisations);

            $view->with('search1', $search_mas); //массив критериев поиска
            $view->with('specialities', $specialities); //массив специальностей

        /*
            $temp = [];
            foreach ( $specialisations as $key => $sp)
                    array_push($temp, $sp);

            $unic = array_unique($temp);
        */



            $view->with('specialisations', $specialisations); //массив специализаций
            $view->with('specialisations2', Speciality::all());



            //Test::getNestedList()




        });







foreach (File::allFiles(__DIR__ . '/routes') as $partial) {
    require_once $partial->getPathname();
}