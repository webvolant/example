<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 30.03.15
 * Time: 12:26
 */

Route::group(array(), function() {

        Route::get('library' , array(
            'as'=>'library',
            'uses'=>'ArticleController@library'
        ));


        Route::get('library/specialisation/{link}', array(
            'as'=>'library/specialisation',
            'uses'=>'ArticleController@index'
        ))->where('link', '[A-Za-z-0-9]+');

        Route::get('library/article/{link}', array(
            'as'=>'library/article',
            'uses'=>'ArticleController@detail'
        ))->where('link', '[A-Za-z-0-9]+');



    Route::get('illness' , array(
        'as'=>'illness',
        'uses'=>'IllnessController@library'
    ));


    Route::get('illness/specialisation/{link}', array(
        'as'=>'illness/specialisation',
        'uses'=>'IllnessController@index'
    ))->where('link', '[0-9]+');

    Route::get('illness/detail/{link}', array(
        'as'=>'illness/detail',
        'uses'=>'IllnessController@detail'
    ))->where('link', '[A-Za-z-0-9]+');

});