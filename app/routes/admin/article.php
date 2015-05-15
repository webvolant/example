<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 30.03.15
 * Time: 12:26
 */

Route::group(array('prefix' => 'admin', 'before' => 'operator'), function() {




    Route::get('illness/index' , array(
        'as'=>'illness/index',
        'uses'=>'AdminIllnessController@index'
    ));

    Route::get('illness/add', array(
        'as'=>'illness/add',
        'uses'=>'AdminIllnessController@add'
    ));

    Route::post('illness/add', array(
        'as'=>'illness/add',
        function(){
            $rules = array(
                'specialities' => array('required')
            );


            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){

                $user = new Illness();
                $user->name = Input::get('name');
                $user->link = Helper::alias(Input::get('name'));
                $user->status = Input::get('status');
                $user->description = Input::get('description');
                $user->operator_id = Auth::user()->id;
                $user->speciality_id = Input::get('specialities');

                $user->save();

                return Redirect::route('illness/index');
            }
            else{

                return Redirect::route('illness/add')->withInput()->withErrors($validation);
            }
        }
    ));


    Route::get('illness/edit/{id}', array(
        'as'=>'illness/edit',
        'uses'=>'AdminIllnessController@edit'
    ));

    Route::post('illness/edit/{id}', array(
        'as'=>'illness/edit',
        function($id){
            $rules = array(
                'specialities' => array('required')
            );
            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){
                $user = Illness::find($id);
                $json_before = json_encode($user);

                $user->name = Input::get('name');
                $user->link = Helper::alias(Input::get('name'));
                $user->status = Input::get('status')[0];
                $user->description = Input::get('description');
                $user->operator_id = Auth::user()->id;
                $user->speciality_id = Input::get('specialities')[0];

                $user->save();

                //$json_before = json_encode($user);
                $json = json_encode($user);
                $crm = new Crm;
                $crm->info_before = $json_before;
                $crm->info_after = $json;
                $crm->object_id = $id;
                $crm->object = "illness";
                $crm->user_id = Auth::user()->id;
                $crm->save();

                return Redirect::route('illness/index');
            }
            else{
                return Redirect::route('illness/edit', array('id'=>$id))->withInput()->withErrors($validation);
            }

        }
    ))->where('id', '[0-9]+');

    Route::get('illness/delete/{id}', array(
        'as'=>'illness/delete',
        'uses'=>'AdminIllnessController@delete'
    ))->where('id', '[0-9]+');


















        Route::get('article/index' , array(
            'as'=>'article/index',
            'uses'=>'AdminArticleController@index'
        ));

        Route::get('article/add', array(
            'as'=>'article/add',
            'uses'=>'AdminArticleController@add'
        ));

        Route::post('article/add', array(
            'as'=>'article/add',
            function(){
                $rules = array(
                    'specialities' => array('required')
                );


                $validation = Validator::make(Input::all(), $rules);
                if ($validation->passes()){

                    $user = new Article;
                    $user->name = Input::get('name');
                    $user->link = Helper::alias(Input::get('name'));
                    $user->status = Input::get('status');
                    $user->description = Input::get('description');
                    $user->operator_id = Auth::user()->id;
                    $user->speciality_id = Input::get('specialities');

                    $user->save();

                    return Redirect::route('article/index');
                    }
                    else{

                        return Redirect::route('article/add')->withInput()->withErrors($validation);
                    }
            }
        ));


        Route::get('article/edit/{id}', array(
            'as'=>'article/edit',
            'uses'=>'AdminArticleController@edit'
        ));

        Route::post('article/edit/{id}', array(
            'as'=>'article/edit',
            function($id){
                $rules = array(
                    'specialities' => array('required')
                );
                $validation = Validator::make(Input::all(), $rules);
                    if ($validation->passes()){
                    $user = Article::find($id);
                        $json_before = json_encode($user);

                        $user->name = Input::get('name');
                        $user->link = Helper::alias(Input::get('name'));
                        $user->status = Input::get('status')[0];
                        $user->description = Input::get('description');
                        $user->operator_id = Auth::user()->id;
                        $user->speciality_id = Input::get('specialities')[0];

                        $user->save();

                        //$json_before = json_encode($user);
                        $json = json_encode($user);
                        $crm = new Crm;
                        $crm->info_before = $json_before;
                        $crm->info_after = $json;
                        $crm->object_id = $id;
                        $crm->object = "article";
                        $crm->user_id = Auth::user()->id;
                        $crm->save();

                    return Redirect::route('article/index');
                }
                else{
                    return Redirect::route('article/edit', array('id'=>$id))->withInput()->withErrors($validation);
                }

            }
        ))->where('id', '[0-9]+');

        Route::get('article/delete/{id}', array(
            'as'=>'article/delete',
            'uses'=>'AdminArticleController@delete'
        ))->where('id', '[0-9]+');

});