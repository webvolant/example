<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 01.04.15
 * Time: 13:40
 */


Route::group(array('prefix' => 'admin', 'before' => 'operator'), function() {
/*
    Route::get('/event', array(
        'as'=>'event',
        function(){

        }//'uses'=>'AdminOrderController@event'
    ));
*/
    Route::post('/remind', array(
        'as'=>'remind',
        function(){
            if (Request::ajax()){
                //$d = '04.05.2015 12:52'; //текущее время //22
                //$dt = new DateTime();
                //$d = date('d.m.Y H:i', time());

                //$object = DateTime::createFromFormat('d.m.Y H:i', date('d.m.Y H:i'));
                $seconds = date('U', time());
                //$seconds = $object->format('U'); //текущее время в секундах
                $events = array();// date( "U" );//date( "d.m.Y H:i" );
                $eventers = Eventer::where('flag','!=',2)->take(Helper::getEventsCount())->get();
                foreach ($eventers as $i):
                    $object = DateTime::createFromFormat('d.m.Y H:i', $i->date_end);
                    $object_seconds = $object->format('U');
                    $last_time = (($object_seconds - $seconds)/60);
                    if (($last_time <= Helper::orderTime()) && ($last_time > Helper::latestOrderTime())){
                        $link ="<li class='divider'></li><li><a href = /admin/order/edit/$i->order_id >
                             <div>
                                <i class='fa fa-envelope fa-fw'></i> Заявка N$i->order_id
                                    <span class='pull-right text-muted small'>$last_time - осталось времени.</span>
                            </div>
                          </a></li>";
                        array_push($events,$link);
                    }
                endforeach;
                return $events;
            }
        }
    ));

    Route::post('/remind-last', array(
        'as'=>'remind-last',
        function(){
            if (Request::ajax()){
                //$d = '05.05.2015 15:52'; //текущее время //22
                //$object = DateTime::createFromFormat('d.m.Y H:i', time());
                //$seconds = $object->format('U'); //текущее время в секундах
                $seconds = date('U', time());
                $events = array();// date( "U" );//date( "d.m.Y H:i" );
                $eventers = Eventer::where('flag','!=',2)->take(Helper::getEventsCount())->get();
                //var_dump($eventers->count());
                foreach ($eventers as $i):
                    $object = DateTime::createFromFormat('d.m.Y H:i', $i->date_end);
                    $object_seconds = $object->format('U');
                    $last_time = (($object_seconds - $seconds)/60);
                    if (($last_time <= Helper::latestOrderTime()) && ($last_time > Helper::latestOrderTime2() )){
                        $l = round(abs($last_time)/60);
                        $link ="<li class='divider'></li><li><a href = /admin/order/edit/$i->order_id >
                             <div>
                                <i class='fa fa-envelope fa-fw'></i> Заявка N$i->order_id
                                    <span class='pull-right text-muted small'>$l - Прошло времени.</span>
                                    <span class='pull-right text-muted small'>$i->date_end - Запланированная дата.</span>
                            </div>
                          </a></li>";
                        array_push($events,$link);
                    }
                endforeach;
                return $events;
            }
        }
    ));


 /*   Route::get('/event', array(
        'as'=>'event',
        function(){

        }//'uses'=>'AdminOrderController@event'
    ));*/


    Route::post('/add/event', array(
        'as'=>'add/event',
        function(){
            if (Request::ajax()){
                $event = new Eventer();

                $event->order_id = Input::get('order_id');

                //$event->status_id = Input::get('status');
                $event->flag = Input::get('flag');
                $event->comment = Input::get('comment');

                $event->date_begin = Input::get('date_begin');
                $event->date_end = Input::get('date_end');

                $event->user_id = Auth::user()->id;

                $event->save();
                return '<div class="alert alert-success" role="alert">Операция завершена</div>';
            }
        }
    ));

    Route::post('/edit/event/{id}', array(
        'as'=>'edit/event',
        function($id){
            if (Request::ajax()){
                $event = Eventer::find($id)->first();
                $json_before = json_encode($event);

                //$event->order_id = Input::get('order_id');

                //$event->status_id = Input::get('status')[0];
                $event->flag = Input::get('flag')[0];
                $event->comment = Input::get('comment');

                //$event->date_begin = Input::get('date_begin');
                $event->date_end = Input::get('date_end');

                $event->user_id = Auth::user()->id;

                $event->save();

                $json = json_encode($event);

                $crm = new Crm;
                $crm->info_before = $json_before;
                $crm->info_after = $json;
                $crm->object = "event";
                $crm->user_id = Auth::user()->id;
                $crm->save();

                return '<div class="alert alert-success" role="alert">Операция завершена</div>';
            }
        }
    ))->where('id', '[0-9]+');



    Route::get('order/index' , array(
        'as'=>'order/index',
        'uses'=>'AdminOrderController@index'
    ));

    Route::get('order/add', array(
        'as'=>'order/add',
        'uses'=>'AdminOrderController@add'
    ));

    Route::post('order/add', array(
        'as'=>'order/add',
        function(){
            $rules = array(
                //'name' => array('required','unique:specialities,name')
            );
            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){
                $order = new Order();
                //var_dump(Input::get('global_status')[0]);
                //die();
                $order->global_status = Input::get('global_status')[0];
                $order->client_id = Input::get('client')[0];
                $order->operator_id = Auth::user()->id;
                $order->doctor_id = Input::get('doctor')[0];
                //$order->otziv_id
                $order->save();
                return Redirect::route('order/index');
            }
            else{

                return Redirect::route('order/add')->withInput()->withErrors($validation);
            }
        }
    ));


    Route::get('order/edit/{id}', array(
        'as'=>'order/edit',
        'uses'=>'AdminOrderController@edit'
    ));

    Route::post('order/edit/{id}', array(
        'as'=>'order/edit',
        function($id){
            $rules = array(
                //'name' => array('required','unique:specialities,name')
            );

            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){
                $status = Status::find($id);

                $status->name = Input::get('name');
                $status->save();
                return Redirect::route('order/index');
            }
            else{

                return Redirect::route('order/add')->withInput()->withErrors($validation);
            }
        }
    ))->where('id', '[0-9]+');

    Route::get('order/delete/{id}', array(
        'as'=>'order/delete',
        'uses'=>'AdminOrderController@delete'
    ))->where('id', '[0-9]+');

});