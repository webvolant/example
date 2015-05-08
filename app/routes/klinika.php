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


Route::get('diagnostica/centers', array('as' => 'diagnostica/centers',
    'uses' => 'KlinikaController@centers'
));

Route::get('diagnostica/centers/{diag}/{area}', array('as' => 'diagnostica/centers',
    'uses' => 'KlinikaController@centers'
))->where('diag', '[A-Za-z-0-9]+')->where('area', '[A-Za-z-0-9]+');




