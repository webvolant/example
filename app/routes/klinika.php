<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 30.03.15
 * Time: 12:38
 */



//клиники все
Route::get('clinics/all', array('as' => 'clinics/all',
    'uses' => 'KlinikaController@all'
));

//клиники по специализации.
Route::get('clinics/all/{spec}', array('as' => 'clinics/all',
    'uses' => 'KlinikaController@all'
))->where('spec', '[A-Za-z-0-9]+');

/*
//doctor одной специальности
Route::get('doctor/{link}', array('as' => 'doctor',
    'uses' => 'DoctorController@doctor'
))->where('link', '[A-Za-z-0-9]+');

*/

//clinic detail
Route::get('clinic/detail/{link}', array('as' => 'clinic/detail',
    'uses' => 'KlinikaController@detail'
    ))->where('link', '[A-Za-z-0-9]+');

/*

//search sort
Route::post('users/sort/price/desc', array('as' => 'users/sort/price/desc',
    function () {
        $users = Session::get('users');

        $users = $users->sortBy(function($user)
        {
            return $user->price;
        })->reverse();

        return View::make('front.doctor.list', array('users'=>$users));
    }));

//search sort
Route::post('users/sort/price/asc', array('as' => 'users/sort/price/asc',
    function () {
        $users = Session::get('users');

        $users = $users->sortBy(function($user)
        {
            return $user->price;
        });

        return View::make('front.doctor.list', array('users'=>$users));
    }));




