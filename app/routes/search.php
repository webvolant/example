<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 05.04.15
 * Time: 23:34
 */


Route::get('ajaxsearch', array('as' => 'ajaxsearch',
    function(){
        //if (Request::ajax()) {
            /*$json_articles = [
                {
                    "id": "mysql-in-a-nutshell",
                    "value": "MySQL in a Nutshell",
                    "label": "<span class=\"hl_results\">MySQL</span> in a Nutshell"
                },
                {
                    "id": "how-to-use-php-improved-mysqli-extension-and-why-you-should",
                    "value": "How to Use PHP Improved MySQLi extension (and Why You Should)",
                    "label": "How to Use PHP Improved <span class=\"hl_results\">MySQL</span>i extension (and Why You Should)"
                },
                {
                    "id": "is-it-time-to-remove-mysql-in-favor-of-mariadb-in-production-servers",
                    "value": "Is it time to Remove MySQL in favor of MariaDB in Production Servers?",
                    "label": "Is it time to Remove <span class=\"hl_results\">MySQL</span> in favor of MariaDB in Production Servers?"
                }
            ];*/
            //$json = array('{"id"=>1,"name"=>"ivan","country"=>"Russia","office"=>["yandex","management"]}');
            $json = array(array("id" => "1", "label" => "Алышева", "link" => "/doctor/detail/alysheva-natal-ya-vladimirovna"), array("id" => "2", "label" => "Юрфа", "link" => "/diagnostica/detail/kliniko-diagnosticheskaya-laboratoriya-yurfa"));
            //return json_encode($json);
            echo json_encode($json);
            exit;
        //}
    }));

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

                /*$users = User::whereHas(
                    'specialities', function($q){
                        $q->where('speciality_id', Input::get('krit2'));
                    }
                )->paginate(Helper::getPagesCount());*/

                return Redirect::to('doctor/doctors/'.Input::get('krit2'));//View::make('front.doctor.list', array('users'=>$users));
            }

            if (Input::get('krit1')=='1'){
                //var_dump(Input::get('krit2'));
                //die();
                /*$users = User::whereHas(
                    'specialities', function($q){
                        $q->where('speciality_id', Input::get('krit2'));
                    }
                )->paginate(Helper::getPagesCount());*/

                return Redirect::to('clinics/all/'.Input::get('krit2'));//View::make('front.doctor.list', array('users'=>$users));


                //return View::make('front.doctor.list', array('users'=>$users));
            }

        } else{
            return Redirect::route('search')->withInput();//->withErrors($validation);
        }
    }));



