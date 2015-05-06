<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 08.04.15
 * Time: 8:35
 */


Route::group(array('prefix' => 'admin', 'before' => 'operator'), function() {

    Route::post('/test-save', array(
        'as'=>'test-save',
        function(){
            if (Request::ajax()){
                $rules = array(
                    //'phone' => array('required'),
                );
                $validation = Validator::make(Input::all(), $rules);
                if ($validation->passes()){
                    //var_dump(Input::all());
                    $test_id = json_decode(Input::get('test_id'));
                    $price_for_test = json_decode(Input::get('price_for_test'));
                    $klinik_id = Input::get('klinik_id');
                    //var_dump($test_id);
                    $kl = Klinika::find(1);
                    var_dump($test_id);

                    for ($i = 0; $i < count($test_id); $i++){
                        $kl->Tests()->attach($test_id[$i], array('price', 1));
                    }

                    //$resource->pivot->gcal_id = "TEST";
                    //$resource->pivot->save();
                    //for ($i = 0; $i < count($test_id); $i++)
                    //{
                        //echo $test_id[$i];
                        //$select_specialities = Input::get('specialities');

                    //}
                    //foreach ($test_id as $item)

                    //$data['flag'] = 1;
                    //$data['data'] = "Были обновлены заданные исследования для клиники";
                    //return $data;
                }
                else{
                    $data['flag'] = 0;
                    $data['data'] = "Что то не так, исследования не были обновлены";
                    return $data;
                }
            }
        }
    ));


    Route::get('klinika/index' , array(
        'as'=>'klinika/index',
        'uses'=>'AdminKlinikaController@index'
    ));

    Route::get('klinika/add', array(
        'as'=>'klinika/add',
        'uses'=>'AdminKlinikaController@add'
    ));

    Route::post('klinika/add', array(
        'as'=>'klinika/add',
        function(){
            $rules = array(
                //'fio' => array('required'),
                //'email' => array('required','unique:users,email'),
                //'pass' => array('required','confirmed'),
                //'pass_confirmation' => array('required'),
                //'phone' => array('required'),
                //'specialities' => array('required')
            );


            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){

                $klinika = new Klinika;
                $klinika->link = Helper::alias(Input::get('name'));
                //$m = Helper::alias(Input::get('fio'));
                //var_dump($m);

                $klinika->name = Input::get('name');
                //$user->password = Hash::make(Input::get('pass'));
                $klinika->email = Input::get('email');
                $klinika->phone = Input::get('phone');
                $klinika->address = Input::get('address');
                $klinika->fio = Input::get('fio');


                $klinika->grafik = Input::get('grafik');

                $klinika->save();

                $select_doctors = Input::get('doctors');
                foreach($select_doctors as $item)
                    $klinika->Users()->attach($item);

                $klinika->description = Input::get('description');
                //$klinika->logo = Input::get('logo');
                if (Input::hasFile('logo')) {
                    $dir = '/uploads'.date('/Y/m/d/');

                    do {
                        $filename = str_random(30).'.jpg';
                    } while (File::exists(public_path().$dir.$filename));
                    Input::file('logo')->move(public_path().$dir, $filename);
                    $klinika->logo = $dir.$filename;
                    $klinika->save();
                }

                if (Input::hasFile('images')) {
                    $dir = '/uploads'.date('/Y/m/d/');
                    foreach(Input::file('images') as $image)
                    {
                        $filename = str_random(10).'.jpg';
                        $image->move(public_path().$dir, $filename);
                    }
                    /*$dir = '/uploads'.date('/Y/m/d/');

                    do {
                        $filename = str_random(10).'.jpg';
                    } while (File::exists(public_path().$dir.$filename));
                    Input::file('logo')->move(public_path().$dir, $filename);
                    $klinika->logo = $dir.$filename;
                    $klinika->save();*/
                }

                return Redirect::route('klinika/index');
            }
            else{

                return Redirect::route('klinika/add')->withInput()->withErrors($validation);
            }
        }
    ));


    Route::get('klinika/edit/{id}', array(
        'as'=>'klinika/edit',
        'uses'=>'AdminKlinikaController@edit'
    ));

    Route::post('klinika/edit/{id}', array(
        'as'=>'klinika/edit',
        function($id){
            $rules = array(
                'fio' => array('required'),
                //'email' => array('required','unique:users,email'),
                //'pass' => array('required','confirmed'),
                //'pass_confirmation' => array('required'),
                //'phone' => array('required')
            );
            $validation = Validator::make(Input::all(), $rules);

            if ($validation->passes()){

                $klinika = Klinika::find($id);

                $klinika->link = Helper::alias(Input::get('name'));
                //$m = Helper::alias(Input::get('fio'));
                //var_dump($m);

                $klinika->name = Input::get('name');
                //$user->password = Hash::make(Input::get('pass'));
                $klinika->email = Input::get('email');
                $klinika->phone = Input::get('phone');
                $klinika->address = Input::get('address');
                $klinika->fio = Input::get('fio');


                $klinika->grafik = Input::get('grafik');

                $klinika->save();

                $select_doctors = Input::get('doctors');
                $klinika->Users()->sync($select_doctors);

                $klinika->description = Input::get('description');
                //$klinika->logo = Input::get('logo');
                /*if (Input::hasFile('logo')) {
                    $dir = '/uploads'.date('/Y/m/d/');

                    do {
                        $filename = str_random(30).'.jpg';
                    } while (File::exists(public_path().$dir.$filename));
                    Input::file('logo')->move(public_path().$dir, $filename);
                    $klinika->logo = $dir.$filename;
                    $klinika->save();
                }*/
                //var_dump(Input::file('images'));
                //die();


                if (Input::hasFile('logo')) {
                    $dir = '/uploads'.date('/Y/'.$klinika->id.'/');
                    //$photodb = new Photo();
                    $filename = 'logo'.'.jpg';

                    //var_dump(public_path().$dir, $filename);
                    //die();

                    $image = Input::file('logo');
                    $image->move(public_path().$dir, $filename);

                    $img = Image::make(public_path().$dir.$filename);
                    $img->resize(560, 280);
                    $img->insert(public_path().'/template_image/watermark.png');
                    //var_dump(public_path().'/template_image/watermark.png');
                    //die();

                    $img->save(public_path().$dir.'thumb_'.$filename);

                    // $klinika->logo = $dir . $filename;
                    $klinika->logo = $dir.'thumb_'.$filename;
                    //$photodb->klinik_id = $klinika->id;
                    $klinika->save();
                    //var_dump(public_path().$dir, $filename);
                    //die();
                }

                if (Input::hasFile('images')) {
                    $dir = '/uploads'.date('/Y/'.$klinika->id.'/');
                    $i = 1;
                    foreach(Input::file('images') as $image)
                    {
                        $photodb = new Photo();
                        $filename = $i.'.jpg';

                        $image->move(public_path().$dir, $filename);

                        $img = Image::make(public_path().$dir.$filename);
                        $img->resize(460, 280);
                        $img->insert(public_path().'/template_image/watermark.png');
                        //$img->insert('public/watermark.png');
                        $img->save(public_path().$dir.'thumb_'.$filename);
                        $photodb->path_small = $dir.'thumb_'.$filename;


                        $img_big = Image::make(public_path().$dir.$filename);
                        $img_big->resize(720, 640);

                        $img_big->insert(public_path().'/template_image/watermark.png');

                        $img_big->save(public_path().$dir.'big_'.$filename);
                        $photodb->path_big = $dir.'big_'.$filename;

                        $photodb->path = $dir. $filename;
                        $photodb->klinik_id = $klinika->id;
                        $photodb->save();
                        $i++;
                    }
                }

                //CRM save - after data
                $json = json_encode($klinika);
                $json = json_decode($json, true);
                $json['doctors'] = $select_doctors;
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
                return Redirect::route('klinika/index');
            }
            else{
                return Redirect::route('klinika/edit', array('id'=>$id))->withInput()->withErrors($validation);
            }

        }
    ))->where('id', '[0-9]+');

    Route::get('klinika/delete/{id}', array(
        'as'=>'klinika/delete',
        'uses'=>'AdminKlinikaController@delete'
    ))->where('id', '[0-9]+');

});