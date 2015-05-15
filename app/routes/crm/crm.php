<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 02.04.15
 * Time: 17:00
 */



Route::group(array('prefix' => 'admin', 'before' => 'operator'), function() {

    Route::get('crm/index' , array(
        'as'=>'crm/index',
        'uses'=>'AdminController@index'
    ));


    Route::get('crm/events' , array(
        'as'=>'crm/events',
        'uses'=>'AdminController@events'
    ));

    Route::get('crm/docs' , array(
        'as'=>'crm/docs',
        'uses'=>'AdminController@docs'
    ));

    Route::get('crm/kliniks' , array(
        'as'=>'crm/kliniks',
        'uses'=>'AdminController@kliniks'
    ));

    /*Route::get('crm/diags' , array(
        'as'=>'crm/diags',
        'uses'=>'AdminController@diags'
    ));*/

});