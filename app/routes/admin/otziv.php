<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 23.04.15
 * Time: 9:16
 */




Route::group(array('prefix' => 'admin', 'before' => 'operator'), function() {

    Route::post('/reviews-last', array(
        'as'=>'reviews-last',
        function(){
            if (Request::ajax()){
                $events = array();
                $eventers = Otziv::where('status','=',0)->take(Helper::getEventsCount())->get();
                foreach ($eventers as $i){
                    $link ="<li class='divider'></li><li><a href = /admin/review/edit/$i->id >
                             <div>
                                <i class='fa fa-envelope fa-fw'></i> Отзыв N$i->id
                                    <span class='pull-right text-muted small'></span>
                            </div>
                          </a></li>";
                    array_push($events,$link);
                }
                return $events;
            }
        }
    ));



Route::get('review/index' , array(
    'as'=>'review/index',
    'uses'=>'AdminOtzivController@index'
));

Route::get('review/add', array(
    'as'=>'review/add',
    'uses'=>'AdminOtzivController@add'
));

Route::post('review/add', array(
    'as'=>'review/add',
    function(){
        $rules = array(
            'fio' => array('required'),
            'rang_qualif'=>'required',
            'rang_price'=>'required',
            'rang_vnimanie'=>'required',
        );

        $validation = Validator::make(Input::all(), $rules);
        if ($validation->passes()){

            $otziv = new Otziv;
            $json_before = json_encode($otziv);

            $otziv->client_id = Input::get('client_id');
            $otziv->fio = Input::get('fio');
            $otziv->phone = Client::find(Input::get('client_id'))->phone;
            $otziv->status = Input::get('status')[0];
            $otziv->comment = Input::get('comment');
            $otziv->doctor_id = Input::get('doctor_id');
            $otziv->rang_qualif = Input::get('rang_qualif');
            $otziv->rang_vnimanie = Input::get('rang_vnimanie');
            $otziv->rang_price = Input::get('rang_price');
            $otziv->user_id = Auth::user()->id;

            $otziv->save();

            // Пересчет для конкретного врача
            $user = User::where('id','=',$otziv->doctor_id)->first();
            //var_dump($user->id);
            //die();
            $count = Otziv::where('doctor_id','=',$otziv->doctor_id)->where('status','=',1)->count();
            if ($count!=0){
                $sum1 = Otziv::where('doctor_id','=',$otziv->doctor_id)->where('status','=',1)->sum('rang_qualif');
                $sum2 = Otziv::where('doctor_id','=',$otziv->doctor_id)->where('status','=',1)->sum('rang_price');
                $sum3 = Otziv::where('doctor_id','=',$otziv->doctor_id)->where('status','=',1)->sum('rang_vnimanie');

                $sum = ((($sum1+$sum2+$sum3)*2)/3)/$count;
                $user->count_otzivi = $count;
                $user->rating = $sum;
                $user->save();
            }

            //Ищем клиники для врача , а потом врачей для клиник и пересчитываем результат рейтинга и отзывов
            $k = $user->Kliniks()->get();
            foreach ($k as $klinika){
                $rating = 0;
                $count_otzivi = 0;
                $count_doctors = $klinika->Users->count();
                foreach ( $klinika->Users as $key => $doctor)
                    if($doctor->rating!=""){
                        $rating = $rating + $doctor->rating;
                        $count_otzivi = $count_otzivi + $doctor->count_otzivi;
                    }
                    else{
                        $rating = $rating + $doctor->rating_second;
                        $count_otzivi = $count_otzivi + $doctor->count_otzivi;
                    }
                $klinika->rating = $rating/$count_doctors;
                $klinika->count_otzivi = $count_otzivi;
                $klinika->save();
            }






            return Redirect::route('review/index');
        }
        else{

            return Redirect::route('review/add')->withInput()->withErrors($validation);
        }
    }
));


Route::get('review/edit/{id}', array(
    'as'=>'review/edit',
    'uses'=>'AdminOtzivController@edit'
));

Route::post('review/edit/{id}', array(
    'as'=>'review/edit',
    function($id){
        $rules = array(
            'fio' => array('required'),
            'rang_qualif'=>'required',
            'rang_price'=>'required',
            'rang_vnimanie'=>'required',
        );

        $validation = Validator::make(Input::all(), $rules);
        if ($validation->passes()){
/*
            $id_cl = 0;
            $phone = Input::get('phone');
            $client = Client::where('phone','LIKE', "%$phone%")->exists();

            if ($client==false){
                return Redirect::route('review/edit', array('link'=>User::where('id','=',Input::get('doctor_id'))->first()->link ))->withInput()
                    ->withErrors(['err'=>'Вы не можете оставить отзыв, вашего номера нет у нас в базе данных.']);
            }else{
                $cl = Client::where('phone','LIKE', "%$phone%")->first();
                $id_cl = $cl->id;
            }
*/

            $otziv = Otziv::find($id);
            $json_before = json_encode($otziv);

            $otziv->client_id = Input::get('client_id');
            $otziv->fio = Input::get('fio');
            $otziv->phone = Client::find(Input::get('client_id'))->phone;
            $otziv->status = Input::get('status');
            $otziv->comment = Input::get('comment');
            $otziv->doctor_id = Input::get('doctor_id');
            $otziv->rang_qualif = Input::get('rang_qualif');
            $otziv->rang_vnimanie = Input::get('rang_vnimanie');
            $otziv->rang_price = Input::get('rang_price');
            $otziv->user_id = Auth::user()->id;

            $otziv->save();

            // Пересчет для конкретного врача
            $user = User::where('id','=',$otziv->doctor_id)->first();
            //var_dump($user->id);
            //die();
            $count = Otziv::where('doctor_id','=',$otziv->doctor_id)->where('status','=',1)->count();
            if ($count!=0){
                $sum1 = Otziv::where('doctor_id','=',$otziv->doctor_id)->where('status','=',1)->sum('rang_qualif');
                $sum2 = Otziv::where('doctor_id','=',$otziv->doctor_id)->where('status','=',1)->sum('rang_price');
                $sum3 = Otziv::where('doctor_id','=',$otziv->doctor_id)->where('status','=',1)->sum('rang_vnimanie');

                $sum = ((($sum1+$sum2+$sum3)*2)/3)/$count;
                $user->count_otzivi = $count;
                $user->rating = $sum;
                $user->save();
            }

            //Ищем клиники для врача , а потом врачей для клиник и пересчитываем результат рейтинга и отзывов
            $k = $user->Kliniks()->get();
            foreach ($k as $klinika){
                $rating = 0;
                $count_otzivi = 0;
                $count_doctors = $klinika->Users->count();
                foreach ( $klinika->Users as $key => $doctor)
                    if($doctor->rating!=""){
                        $rating = $rating + $doctor->rating;
                        $count_otzivi = $count_otzivi + $doctor->count_otzivi;
                    }
                    else{
                        $rating = $rating + $doctor->rating_second;
                        $count_otzivi = $count_otzivi + $doctor->count_otzivi;
                    }
                $klinika->rating = $rating/$count_doctors;
                $klinika->count_otzivi = $count_otzivi;
                $klinika->save();
            }



/*
            //$json_before = json_encode($user);
            $json = json_encode($otziv);
            $crm = new Crm;
            $crm->info_before = $json_before;
            $crm->info_after = $json;
            $crm->object_id = $id;
            $crm->object = "review";
            $crm->user_id = Auth::user()->id;
            $crm->save();
*/
            return Redirect::route('review/index');
        }
        else{

            return Redirect::route('review/add')->withInput()->withErrors($validation);
        }
    }
))->where('id', '[0-9]+');

Route::get('review/delete/{id}', array(
    'as'=>'review/delete',
    'uses'=>'AdminOtzivController@delete'
))->where('id', '[0-9]+');

});