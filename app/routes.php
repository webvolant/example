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


            $sidebar_libraries = "<div class='col-xs-12 col-sm-12 col-md-2'>
                <div class='sidebar_item'>
                    <p><a href='{{ URL::route('library') }}'>Медицинская библиотека</a></p>
                    <p>
                        Полезные статьи о заболеваниях, современных методах лечения и диагностиках.
                    </p>
                </div>

                <div class='sidebar_item'>
                    <p><a href='{{ URL::route('library') }}'>Диагностические центры</a></p>
                    <p>
                        Вам нужно провести диагностику или обследование? Специализированный портал поможет подобрать диагностический центр рядом с домом.
                    </p>
                </div>

                <div class='sidebar_item'>
                    <p><a href='{{ URL::route('illness') }}'>Справочник заболеваний</a></p>
                    <p>
                        Медицинский справочник болезней от А до Я.
                    </p>
                </div>
            </div>";

            $view->with('sidebar_libraries', $sidebar_libraries);


            $view->with('specialisations', $specialisations); //массив специализаций
            $view->with('specialisations2', Speciality::all());



            //Test::getNestedList()




        });







foreach (File::allFiles(__DIR__ . '/routes') as $partial) {
    require_once $partial->getPathname();
}