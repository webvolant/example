<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 30.03.15
 * Time: 12:26
 */

Route::group(array('prefix' => 'admin', 'before' => 'operator'), function() {

        Route::get('doctor/profile/{id}', array(
            'as'=>'doctor/profile',
            'uses'=>'AdminDoctorController@profile'
        ))->where('id', '[0-9]+');



        Route::get('doctor/index' , array(
            'as'=>'doctor/index',
            'uses'=>'AdminDoctorController@index'
        ));

        Route::get('doctor/add', array(
            'as'=>'doctor/add',
            'uses'=>'AdminDoctorController@add'
        ));

        Route::post('doctor/add', array(
            'as'=>'doctor/add',
            function(){
                $rules = array(
                    'fio' => array('required'),
                    'email' => array('required','unique:users,email'),
                    'rating' => array('required','numeric'),
                    'price' => array('required','numeric'),
                    'experience' => array('required','numeric'),
                    //'pass' => array('required','confirmed'),
                    //'pass_confirmation' => array('required'),
                    'phone' => array('required'),
                    'specialities' => array('required')
                );


                $validation = Validator::make(Input::all(), $rules);
                if ($validation->passes()){

                        $user = new User;
                        $user->role = 'doctor';
                        $user->link = Helper::alias(Input::get('fio'));
                        //$m = Helper::alias(Input::get('fio'));
                        //var_dump($m);
                        $user->status = Input::get('status')[0];

                        $doma = Input::get('doma');
                        if (!isset($doma)) $doma = 0;
                        $user->doma = $doma;

                        $det_doctor = Input::get('det_doctor');
                        if (!isset($det_doctor)) $det_doctor = 0;
                        $user->det_doctor = $det_doctor;

                        $viesd_na_dom = Input::get('viesd_na_dom');
                        if (!isset($viesd_na_dom)) $viesd_na_dom = 0;
                        $user->viesd_na_dom = $viesd_na_dom;

                        $user->password = Hash::make(Input::get('pass'));
                        $user->email = Input::get('email');
                        $user->phone = Input::get('phone');
                        $user->klinika_name = Input::get('klinika_name');
                        $user->fio = Input::get('fio');


                        $user->experience = Input::get('experience');
                        $user->rang = Input::get('rang');
                        $user->price = Input::get('price');
                        $user->price_include = Input::get('price_include');
                        $user->grafik = Input::get('grafik');

                        $user->profil = Input::get('profil');
                        $user->description = Input::get('description');
                        $user->education = Input::get('education');
                        $user->qualif = Input::get('qualif');

                        //var_dump(Input::all());
                    //die();

                        $user->rating = Input::get('rating');

                        $user->save();

                        if (Input::hasFile('logo')) {
                            $dir = '/uploads/doctors'.date('/Y/'.$user->id.'/');
                            $filename = 'logo'.'.jpg';
                            //var_dump($dir);
                            //die();

                            $image = Input::file('logo');
                            $image->move(public_path().$dir, $filename);
                            $img = Image::make(public_path().$dir.$filename);
                            $img->resize(140, 180);
                            $img->insert(public_path().'/template_image/watermark.png');
                            $img->save(public_path().$dir.'thumb_'.$filename);
                            $user->logo = $dir.'thumb_'.$filename;
                            $user->save();
                        }

                        $select_specialities = Input::get('specialities');
                        foreach($select_specialities as $item)
                            $user->Specialities()->attach($item);

                    return Redirect::route('doctor/index');
                    }
                    else{
                        //var_dump(Input::all());
                        return Redirect::route('doctor/add')->withErrors($validation)->withInput();
                    }
            }
        ));


        Route::get('doctor/edit/{id}', array(
            'as'=>'doctor/edit',
            'uses'=>'AdminDoctorController@edit'
        ));

        Route::post('doctor/edit/{id}', array(
            'as'=>'doctor/edit',
            function($id){
                $rules = array(
                    'fio' => array('required'),
                    'email' => array('required'),
                    'rating' => array('required','numeric'),
                    'price' => array('required','numeric'),
                    'experience' => array('required','numeric'),
                    //'pass' => array('required','confirmed'),
                    //'pass_confirmation' => array('required'),
                    'phone' => array('required'),
                    'specialities' => array('required')
                );
                $validation = Validator::make(Input::all(), $rules);

                    if ($validation->passes()){

                    $user = User::find($id);
                        $json_before = json_encode($user);

                        $user->role = 'doctor';
                        $user->link = Helper::alias(Input::get('fio'));
                        //var_dump(Input::get('status'));
                        $user->status = Input::get('status');
                        //$m = Helper::alias(Input::get('fio'));
                        //var_dump($m);

                        $doma = Input::get('doma');
                        if (!isset($doma)) $doma = 0;
                        $user->doma = $doma;

                        $det_doctor = Input::get('det_doctor');
                        if (!isset($det_doctor)) $det_doctor = 0;
                        $user->det_doctor = $det_doctor;

                        $viesd_na_dom = Input::get('viesd_na_dom');
                        if (!isset($viesd_na_dom)) $viesd_na_dom = 0;
                        $user->viesd_na_dom = $viesd_na_dom;

                        $user->password = Hash::make(Input::get('pass'));
                        $user->email = Input::get('email');
                        $user->phone = Input::get('phone');
                        $user->klinika_name = Input::get('klinika_name');
                        //var_dump(Input::get('klinika_name'));
                        //$d = base64_encode(Input::get('klinika_name'));
                        //var_dump(base64_decode($d));
                        //die();
                        $user->fio = Input::get('fio');


                        $user->experience = Input::get('experience');
                        $user->rang = Input::get('rang');
                        $user->price = Input::get('price');
                        $user->price_include = Input::get('price_include');
                        $user->grafik = Input::get('grafik');

                        $user->profil = Input::get('profil');
                        $user->description = Input::get('description');
                        $user->education = Input::get('education');
                        $user->qualif = Input::get('qualif');

                        $user->rating = Input::get('rating');


                        $user->keywords = Input::get('keywords');

                    $user->save();

                        if (Input::hasFile('logo')) {
                            $dir = '/uploads/doctors'.date('/Y/'.$user->id.'/');
                            $filename = 'logo'.'.jpg';
                            //var_dump($dir);
                            //die();

                            $image = Input::file('logo');
                            $image->move(public_path().$dir, $filename);
                            $img = Image::make(public_path().$dir.$filename);
                            $img->resize(140, 180);
                            $img->insert(public_path().'/template_image/watermark.png');
                            $img->save(public_path().$dir.'thumb_'.$filename);
                            $user->logo = $dir.'thumb_'.$filename;
                            $user->save();
                        }

                        $select_specialities = Input::get('specialities');
                        $user->Specialities()->sync($select_specialities);

                        //CRM save - after data
                        $json = json_encode($user);
                        $json = json_decode($json, true);
                        $json['specialities'] = $select_specialities;
                        $json = json_encode($json, true);

                        //$string =  serialize( $user->toArray() ) ;
                        //$string =  serialize( $user->toArray() ) ;
                        //$string = serialize( $select_specialities ) ;

                        //before in Controller
                        //$j_before = Session::get('j_before');
/*
                        //$json_before = json_encode($klinika);
                        $crm = new Crm;
                        $crm->info_before = $json_before;
                        $crm->info_after = $json;
                        $crm->object_id = $id;
                        $crm->object = "doctor";
                        $crm->user_id = Auth::user()->id;
                        $crm->save();
*/
                    return Redirect::route('doctor/index');
                }
                else{
                    return Redirect::route('doctor/edit', array('id'=>$id))->withInput()->withErrors($validation);
                }

            }
        ))->where('id', '[0-9]+');


});

    //Удаление Доктора только админу
    Route::group(array('prefix' => 'admin', 'before' => 'administrator'), function() {
        Route::get('doctor/delete/{id}', array(
            'as'=>'doctor/delete',
            'uses'=>'AdminDoctorController@delete'
        ))->where('id', '[0-9]+');

    });