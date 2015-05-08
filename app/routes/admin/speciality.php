<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 01.04.15
 * Time: 13:40
 */


Route::group(array('prefix' => 'admin', 'before' => 'operator'), function() {

    Route::get('speciality/profile/{id}', array(
        'as'=>'speciality/profile',
        'uses'=>'AdminSpecialityController@profile'
    ))->where('id', '[0-9]+');



    Route::get('speciality/index' , array(
        'as'=>'speciality/index',
        'uses'=>'AdminSpecialityController@index'
    ));

    Route::get('speciality/add', array(
        'as'=>'speciality/add',
        'uses'=>'AdminSpecialityController@add'
    ));

    Route::post('speciality/add', array(
        'as'=>'speciality/add',
        function(){
            $rules = array(
                'name' => array('required','unique:specialities,name')
            );
            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){
                $spec = new Speciality();
                $spec->name = Input::get('name');
                $spec->specialisation = Input::get('specialisation');
                $spec->description = Input::get('description');
                $spec->description_specialisation = Input::get('description_specialisation');
                $spec->save();
                return Redirect::route('speciality/index');
            }
            else{

                return Redirect::route('speciality/add')->withInput()->withErrors($validation);
            }
        }
    ));


    Route::get('speciality/edit/{id}', array(
        'as'=>'speciality/edit',
        'uses'=>'AdminSpecialityController@edit'
    ));

    Route::post('speciality/edit/{id}', array(
        'as'=>'speciality/edit',
        function($id){
            $rules = array(
                //'name' => array('required','unique:specialities,name')
            );

            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){
                $spec = Speciality::find($id);

                $spec->name = Input::get('name');
                $spec->specialisation = Input::get('specialisation');
                $spec->description = Input::get('description');
                $spec->description_specialisation = Input::get('description_specialisation');
                $spec->save();
                return Redirect::route('speciality/index');
            }
            else{

                return Redirect::route('speciality/add')->withInput()->withErrors($validation);
            }
        }
    ))->where('id', '[0-9]+');

    Route::get('speciality/delete/{id}', array(
        'as'=>'speciality/delete',
        'uses'=>'AdminSpecialityController@delete'
    ))->where('id', '[0-9]+');

});