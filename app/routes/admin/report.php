<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 15.05.15
 * Time: 1:19
 */


Route::group(array('prefix' => 'admin', 'before' => 'operator'), function() {


  /*  Route::get('report/wait-orders' , array(
        'as'=>'report/wait-orders',
        'uses'=>'AdminReportController@wait'
    ));*/

    Route::get('report/orders' , array(
        'as'=>'report/orders',
        'uses'=>'AdminReportController@orders'
    ));

    Route::post('report/orders' , array(
        'as'=>'report/orders',
        'uses'=>'AdminReportController@orders'
    ));

    Route::get('report/events' , array(
        'as'=>'report/events',
        'uses'=>'AdminReportController@events'
    ));

    Route::post('report/events' , array(
        'as'=>'report/events',
        'uses'=>'AdminReportController@events'
    ));

});