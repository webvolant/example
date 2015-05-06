<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 01.04.15
 * Time: 13:40
 */


Route::group(array('prefix' => 'admin', 'before' => 'operator'), function() {

    Route::get('status/index' , array(
        'as'=>'status/index',
        'uses'=>'AdminStatusController@index'
    ));

    Route::get('status/add', array(
        'as'=>'status/add',
        'uses'=>'AdminStatusController@add'
    ));

    Route::post('status/add', array(
        'as'=>'status/add',
        function(){
            $rules = array(
                //'name' => array('required','unique:specialities,name')
            );
            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){
                $status = new Status();
                $status->name = Input::get('name');
                $status->save();
                return Redirect::route('status/index');
            }
            else{

                return Redirect::route('status/add')->withInput()->withErrors($validation);
            }
        }
    ));


    Route::get('status/edit/{id}', array(
        'as'=>'status/edit',
        'uses'=>'AdminStatusController@edit'
    ));

    Route::post('status/edit/{id}', array(
        'as'=>'status/edit',
        function($id){
            $rules = array(
                //'name' => array('required','unique:specialities,name')
            );

            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){
                $status = Status::find($id);

                $status->name = Input::get('name');
                $status->save();
                return Redirect::route('status/index');
            }
            else{

                return Redirect::route('status/add')->withInput()->withErrors($validation);
            }
        }
    ))->where('id', '[0-9]+');

    Route::get('status/delete/{id}', array(
        'as'=>'status/delete',
        'uses'=>'AdminStatusController@delete'
    ))->where('id', '[0-9]+');

});