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


//clinic detail
Route::get('clinic/detail/{link}', array('as' => 'clinic/detail',
    'uses' => 'KlinikaController@detail'
    ))->where('link', '[A-Za-z-0-9]+');

Route::get('doc_angular', array('as' => 'doc_angular',
    'uses' => 'KlinikaController@doc_angular'
));

Route::get('/news/getNews', array('as' => '/news/getNews',
    'uses' => 'KlinikaController@getNews'
));







/*
Route::get('diagnostica/centers', array('as' => 'diagnostica/centers',
    'uses' => 'KlinikaController@centers'
));

Route::get('diagnostica/centers/{diag}', array('as' => 'diagnostica/centers',
    'uses' => 'KlinikaController@centers'
))->where('diag', '[A-Za-z-0-9]+');
*/

Route::get('diagnostica/centers/{diag?}/{area?}', array('as' => 'diagnostica/centers',
    'uses' => 'KlinikaController@centers'
))->where('diag', '[A-Za-z-0-9]+')->where('area', '[A-Za-z-0-9]+');

//diag detail
Route::get('diagnostica/detail/{link}', array('as' => 'diagnostica/detail',
    'uses' => 'KlinikaController@diagdetail'
))->where('link', '[A-Za-z-0-9]+');


