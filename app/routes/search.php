<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 05.04.15
 * Time: 23:34
 */

Route::get('datatojson', array('as' => 'datatojson',
    function(){
        $doctors = User::whereRole('doctor')->whereStatus('1')->orderBy("pay_doctor",'desc')->get();
        $docs_array_temp = $doctors->toArray();
        $docs_array = array();
        foreach($docs_array_temp as $item){
            $object["label"] = $item["fio"];
            $object["category"] = "Доктора";
            $object["pay_doctor"] = $item["pay_doctor"];
            $object["plink"] = "/doctor/detail/".$item["link"];
            $docs_array[] = $object;
        }

        $clinics = Klinika::whereStatus('1')->get();
        $clinics_array_temp = $clinics->toArray();
        $clinics_array = array();
        foreach($clinics_array_temp as $kl){
            $object["label"] = $kl["name"];
            $object["category"] = "Клиники";
            $object["pay_doctor"] = 0;
            $object["plink"] = "/clinic/detail/".$kl["link"];
            $clinics_array[] = $object;
        }

        $specialities = Speciality::all();
        $specialities_array_temp = $specialities->toArray();
        $specialities_array = array();
        foreach($specialities_array_temp as $s){
            $object["label"] = $s["name"];
            $object["category"] = "Врач по специальности";
            $object["plink"] = "/doctor/doctors/".$s["id"];
            $object["pay_doctor"] = 0;
            $specialities_array[] = $object;
        }

        $specialisations = Speciality::all();
        $specialisations_array_temp = $specialisations->toArray();
        $specialisations_array = array();
        foreach($specialisations_array_temp as $s){
            $object["label"] = $s["specialisation"];
            $object["category"] = "Клиники по направлению";
            $object["plink"] = "/clinics/all/".$s["id"];
            $object["pay_doctor"] = 0;
            $specialisations_array[] = $object;
        }

        //var_dump($clinics);
        $json_merged = array_merge($specialities_array,$specialisations_array,$docs_array,$clinics_array);

        $json = json_encode($json_merged);
        $jsonFile = "data.json";
        $fh = fopen($jsonFile, 'w');
        fwrite($fh, $json);

        //echo json_encode($json);
    }));


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
            //$json_php = array(array("id" => "1", "label" => "Алышева", "link" => "/doctor/detail/alysheva-natal-ya-vladimirovna"), array("id" => "2", "label" => "Врач Борисов", "link" => "/borisov"));
            $json_clinics = array(array("id" => "1", "label" => "Клиника Экстрамед", "link" => "/doctor/detail/alysheva-natal-ya-vladimirovna"), array("id" => "2", "label" => "Клиника Юрфа", "link" => "/diagnostica/detail/kliniko-diagnosticheskaya-laboratoriya-yurfa"));
            //return json_encode($json);
            //$doctors = User::where('fio', 'LIKE', '%'.'Сер'.'%')->get();
        $doctors = User::where('fio', 'LIKE', '%'.Input::get('query').'%')->get();
        $docs_array = $doctors->toArray();
        foreach($docs_array as $item){
            $item["label"] = $item["fio"];
            $arr[] = $item;
        }
            //var_dump($doctors);
            $json = array_merge($arr,$json_clinics);
            echo json_encode($json);
            exit;
        //label добавить из за него точки
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



