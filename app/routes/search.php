<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 05.04.15
 * Time: 23:34
 */

//search load
Route::get('search', array('as' => 'search',
    function(){}));

//search
Route::post('search', array('as' => 'search',
    function () {
        $rules = array(
            'krit1' => array('required'),
            //'krit2' => array('required')
        );
        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes()) {
            if (Input::get('krit1')=='0'){

                $users = User::whereHas(
                    'specialities', function($q){
                        $q->where('speciality_id', Input::get('krit2'));
                    }
                )->paginate(1);

                return Redirect::to('doctor/doctors/'.Input::get('krit2'));//View::make('front.doctor.list', array('users'=>$users));
            }

            if (Input::get('krit1')=='1'){



                //return View::make('front.doctor.list', array('users'=>$users));
            }

        } else{
            return Redirect::route('search')->withInput();//->withErrors($validation);
        }
    }));



