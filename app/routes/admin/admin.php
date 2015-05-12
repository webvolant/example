<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 30.03.15
 * Time: 12:26
 */






Route::post('admin/login', array('as' => 'admin/login',
    function(){
        $rules = array(
            'email' => array('required'),
            'pass' => array('required')
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->passes()) {
            $email = Input::get('email');
            $pass = Input::get('pass');
            $user = User::whereEmail($email)->first();
            //$results = DB::select('select * from clients where name = ? and password=?', array($name,$pass));
            if ($user)
                if (Hash::check($pass, $user->password)) {

                    Auth::login($user);

                    if (Auth::check('operator',$user->role)){
                        return Redirect::route('dashboard');
                    }
                    else{
                        return Redirect::route('admin/login');
                    }

                }
                else{
                    $errors['pass'] = "Пароль не подходит к емаил адресу.";
                    return Redirect::route('admin/login')->withInput()->withErrors($errors);;
                }
            else{
                $errors['email'] = "Вы не регистрировались с таким емаил адресом";
                return Redirect::route('admin/login')->withInput()->withErrors($errors);
        }
        }else{
            return Redirect::route('admin/login')->withInput()->withErrors($validation);
        }
    }
));

Route::get('admin/login', array('as' => 'admin/login',
    'uses' => 'AdminUserController@showLogin'));





Route::group(array('prefix' => 'admin', 'before' => 'operator'), function() {


    Route::get('dashboard', array(
        'as'=>'dashboard',
        'uses'=>'AdminController@dashboard'));


});


Route::group(array('prefix' => 'admin', 'before' => 'administrator'), function() {

    // OPERATOR
    Route::get('user/profile/{id}', array(
        'as'=>'user/profile',
        'uses'=>'AdminUserController@profile'
    ))->where('id', '[0-9]+');



    Route::get('user/index' , array(
        'as'=>'user/index',
        'uses'=>'AdminUserController@index'
    ));

    Route::get('user/add', array(
        'as'=>'user/add',
        'uses'=>'AdminUserController@add'
    ));

    Route::post('user/add', array(
        'as'=>'user/add',
        function(){
            $rules = array(
                'fio' => array('required'),
                'email' => array('required','unique:users,email'),
                'pass' => array('required','confirmed'),
                'pass_confirmation' => array('required'),
                 'phone' => array('required')
            );
            $validation = Validator::make(Input::all(), $rules);

            if ($validation->passes()){
                $user = new User;

                $user->password = Hash::make(Input::get('pass'));
                $user->email = Input::get('email');
                $user->phone = Input::get('phone');
                $user->fio = Input::get('fio');
                $user->role = 'operator';

                $user->save();
                return Redirect::route('user/index');
            }else{
                return Redirect::route('user/add')->withInput()->withErrors($validation);
            }
        }
    ));


    Route::get('user/edit/{id}', array(
        'as'=>'user/edit',
        'uses'=>'AdminUserController@edit'
    ));

    Route::post('user/edit/{id}', array(
        'as'=>'user/edit',
        function($id){

            $rules = array(
                'fio' => array('required'),
                'email' => array('required','unique:users,email'),
                'pass' => array('required','confirmed'),
                'pass_confirmation' => array('required'),
                'phone' => array('required')
            );
            $validation = Validator::make(Input::all(), $rules);

            if ($validation->passes()){
                $user = User::find($id);

                $user->password = Hash::make(Input::get('pass'));
                $user->email = Input::get('email');
                $user->phone = Input::get('phone');
                $user->fio = Input::get('fio');
                $user->role = 'operator';

                $user->save();
                return Redirect::route('user/index');
            }else{
                return Redirect::route('user/add')->withInput()->withErrors($validation);
            }
        }
    ))->where('id', '[0-9]+');




    Route::get('clean', array(
        'as'=>'clean',
        'uses'=>'AdminController@cleanCache'
    ));
});

//Удаление оператора только админу
Route::group(array('prefix' => 'admin', 'before' => 'administrator'), function() {

    Route::get('user/delete/{id}', array(
        'as'=>'user/delete',
        'uses'=>'AdminUserController@delete'
    ))->where('id', '[0-9]+');

});