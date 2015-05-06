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
                $user->name = Input::get('name');
                $user->link = Helper::alias(Input::get('name'));
                $user->status = Input::get('status')[0];
                $user->description = Input::get('description');
                $user->operator_id = Auth::user()->id;
                $user->speciality_id = Input::get('specialities')[0];

                $user->save();

                //$select_specialities = Input::get('specialities');
                //$user->Specialities()->sync($select_specialities);

                //CRM save - after data
                $json = json_encode($user);
                $json = json_decode($json, true);
                //$json['specialities'] = $select_specialities;
                $j = json_encode($json, true);

                //$string =  serialize( $user->toArray() ) ;
                //$string =  serialize( $user->toArray() ) ;
                //$string = serialize( $select_specialities ) ;

                //before in Controller
                $j_before = Session::get('j_before');

                $crm = new Crm;
                $crm->info_before = $j_before;
                $crm->info_after = $j;
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
                        $user->name = Input::get('name');
                        $user->link = Helper::alias(Input::get('name'));
                        $user->status = Input::get('status')[0];
                        $user->description = Input::get('description');
                        $user->operator_id = Auth::user()->id;
                        $user->speciality_id = Input::get('specialities')[0];

                        $user->save();

                        //$select_specialities = Input::get('specialities');
                        //$user->Specialities()->sync($select_specialities);

                        //CRM save - after data
                        $json = json_encode($user);
                        $json = json_decode($json, true);
                        //$json['specialities'] = $select_specialities;
                        $j = json_encode($json, true);

                        //$string =  serialize( $user->toArray() ) ;
                        //$string =  serialize( $user->toArray() ) ;
                        //$string = serialize( $select_specialities ) ;

                        //before in Controller
                        $j_before = Session::get('j_before');

                        $crm = new Crm;
                        $crm->info_before = $j_before;
                        $crm->info_after = $j;
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