<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 10.05.15
 * Time: 2:05
 */

Route::group(array('prefix' => 'admin', 'before' => 'operator'), function() {

    Route::get('client/index' , array(
        'as'=>'client/index',
        'uses'=>'AdminClientController@index'
    ));

    Route::get('client/add', array(
        'as'=>'client/add',
        'uses'=>'AdminClientController@add'
    ));

    Route::post('client/add', array(
        'as'=>'client/add',
        function(){
            $rules = array(
                'fio' => array('required'),
                //'email' => array('required','unique:users,email'),
                //'pass' => array('required','confirmed'),
                //'pass_confirmation' => array('required'),
                'phone' => array('required')
            );
            $validation = Validator::make(Input::all(), $rules);

            if ($validation->passes()){
                $user = new Client;

                //$user->password = Hash::make(Input::get('pass'));
                //$user->email = Input::get('email');
                $user->phone = Input::get('phone');
                $user->fio = Input::get('fio');
                //$user->role = 'operator';

                $user->save();
                return Redirect::route('client/index');
            }else{
                return Redirect::route('client/add')->withInput()->withErrors($validation);
            }
        }
    ));


    Route::get('client/edit/{id}', array(
        'as'=>'client/edit',
        'uses'=>'AdminClientController@edit'
    ));

    Route::post('client/edit/{id}', array(
        'as'=>'client/edit',
        function($id){

            $rules = array(
                'fio' => array('required'),
                //'email' => array('required','unique:users,email'),
                //'pass' => array('required','confirmed'),
                //'pass_confirmation' => array('required'),
                'phone' => array('required')
            );
            $validation = Validator::make(Input::all(), $rules);

            if ($validation->passes()){
                $user = Client::find($id);
                $json_before = json_encode($user);

                //$user->password = Hash::make(Input::get('pass'));
                //$user->email = Input::get('email');
                $user->phone = Input::get('phone');
                $user->fio = Input::get('fio');

                $user->save();

/*
                //$json_before = json_encode($klinika);
                $json = json_encode($user);
                $crm = new Crm;
                $crm->info_before = $json_before;
                $crm->info_after = $json;
                $crm->object_id = $id;
                $crm->object = "client";
                $crm->user_id = Auth::user()->id;
                $crm->save();
*/
                return Redirect::route('client/index');
            }else{
                return Redirect::route('client/add')->withInput()->withErrors($validation);
            }
        }
    ))->where('id', '[0-9]+');

});

//Удаление Доктора только админу
Route::group(array('prefix' => 'admin', 'before' => 'administrator'), function() {
    Route::get('client/delete/{id}', array(
        'as'=>'client/delete',
        'uses'=>'AdminClientController@delete'
    ))->where('id', '[0-9]+');

});