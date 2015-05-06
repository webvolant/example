<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 30.03.15
 * Time: 12:38
 */














//
Route::get('logout', array(
    'as'=>'logout',
    function(){
        Auth::logout();
        return Redirect::to('/');
    }));

Route::get('login', array('as' => 'login',
    'uses' => 'UserController@showLogin'));

Route::post('login', array('as' => 'login',
    function () {
        $rules = array(
            'email' => array('required'),
            //'email'    => array('required', 'email', 'unique:users,email'),
            'pass' => array('required', 'min:6')
        );
        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes()) {
            $email = Input::get('email');
            $pass = Input::get('pass');
            $user = User::whereEmail($email)->first();
            //print_r($user);
            //die();
            //$results = DB::select('select * from clients where name = ? and password=?', array($name,$pass));
            if ($user)
                if (Hash::check($pass, $user->password)) {
                    Auth::login($user);
                    // Пароль подходит...
                    return Redirect::to('/');
                }
                else{
                    $errors = "Не верный пароль";
                    return Redirect::route('admin/login')->withInput()->withErrors($errors);;
                }
            else{
                $errors = "Вы не регистрировались с таким емаил адресом";
                return Redirect::route('admin/login')->withInput()->withErrors($errors);
            }
        } else{
            return Redirect::route('login')->withInput()->withErrors($validation);
        }
    }));




//step1 reg
Route::post('registration', array('as' => 'registration',
    function () {
        $rules = array(
            'fio' => array('required'),
            'phone' => array('required')
        );
        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes()) {
            $fio = Input::get('fio');
            $phone = Input::get('phone');
            $interes = Input::get('interes');


            Session::put('fio', $fio);
            Session::put('phone', $phone);
            Session::put('interes', $interes);

            return Redirect::route('registration/step2');
        } else{
            return Redirect::route('registration')->withInput()->withErrors($validation);
        }
    }));

Route::get('registration', array('as' => 'registration',
    'uses' => 'UserController@showReg'));

//step2 reg
Route::post('registration/step2', array('as' => 'registration/step2',
    function () {
        $rules = array(
            'email' => array('required'),
            'dogovor' => array('required'),
        );
        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes()) {
            $doma = Input::get('doma');
            if (!isset($doma)){
                $doma = 0;
            }
            $klinika = Input::get('klinika');
            $email = Input::get('email');
            $dogovor = Input::get('dogovor');

            /*Session::put('doma', $doma);
            Session::put('klinika', $klinika);
            Session::put('email', $email);
            Session::put('dogovor', $dogovor);*/

            $user = new User();
            $user->doma = $doma;
            $user->klinika_name = $klinika;
            $user->email = $email;
            $user->dogovor = $dogovor;

            $user->fio = Session::get('fio');
            $user->phone = Session::get('phone');

            $user->role = "doctor";
            $user->password = Hash::make('qwerty');//Input::get('pass'));
            $user->status = 0;
            //echo '<pre>';
            //print_r($user);
            //echo '</pre>';

            //Mail::pretend();

            //var_dump($user);
            $user->save();

            return Redirect::route('registration/step3')->withInput();
        } else{
            return Redirect::route('registration/step2')->withInput()->withErrors($validation);
        }
    }));

Route::get('registration/step2', array('as' => 'registration/step2',
    'uses' => 'UserController@step2'));

//step3 register
Route::get('registration/step3', array('as' => 'registration/step3',
    'uses' => 'UserController@step3'));




//doctor все и поиск ссылается сюда
Route::get('doctor/doctors', array('as' => 'doctor/doctors',
    'uses' => 'DoctorController@doctors'
));

//doctor одной специальности
Route::get('doctor/doctors/{spec}', array('as' => 'doctor/doctors',
    'uses' => 'DoctorController@doctors'
))->where('spec', '[A-Za-z-0-9]+');


//doctor detail
Route::get('doctor/detail/{link}', array('as' => 'doctor/detail',
    'uses' => 'DoctorController@detail'
    ))->where('link', '[A-Za-z-0-9]+');

