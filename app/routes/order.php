<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 11.04.15
 * Time: 9:34
 */


Route::post('/more-review', array(
    'as'=>'more-review',
    function(){
        if (Request::ajax()){
            //var_dump(Input::all());
            $rev = "";
            $i=1;
            //$page_cur = 0;
            $user = Input::get('user');
            //$page = Input::get('page');
            //$page_cur = $page_cur + $page; //2
            $reviews = Otziv::where('doctor_id','=',$user)->get();
            foreach($reviews as $item){
                //$i++;
                //if ($i > $page){
                $date = date('d-m-Y', strtotime($item->created_at));
                $q = "";
                $v = "";
                $p = "";
                for ($i=1; $i <= 5; $i++)
                    if ($i <= $item->rang_qualif)
                        $q .= "<span class='glyphicon glyphicon-star blau'></span>";
                    else
                        $q .= "<span class='glyphicon glyphicon-star gray'></span>";

                for ($i=1; $i <= 5; $i++)
                    if ($i <= $item->rang_vnimanie)
                        $v .= "<span class='glyphicon glyphicon-star blau'></span>";
                    else
                        $v .= "<span class='glyphicon glyphicon-star gray'></span>";

                for ($i=1; $i <= 5; $i++)
                    if ($i <= $item->rang_price)
                        $p .= "<span class='glyphicon glyphicon-star blau'></span>";
                    else
                        $p .= "<span class='glyphicon glyphicon-star gray'></span>";
                $rev .= "
                    <div class='col-md-12'>

                                            <div class='col-md-3'><p> $item->fio </p><p> $date </p>
                                            </div>

                                <div class='col-md-3 qualif'><p>Квалификация</p>
                                        $q
                                </div>

                                <div class='col-md-3 qualif'><p>Внимание</p>
                                        $v
                                </div>

                                <div class='col-md-3 qualif'><p>Цена-Качество</p>
                                        $p
                                </div>

                    </div>

                    <div class='col-md-3'>
                        <p></p>
                    </div>
                    <div class='col-md-9'>
                        <p> $item->comment </p>
                    </div>";

                // }

            } //foreach end
            //$data['rev'] = $rev;
            //$data['page_cur'] = $page_cur;
            //var_dump($data['page_cur']);
            //die();
            return $rev;
        }
    }));




Route::get('order/new', array('as'=>'order/new',
    function(){

    }));


Route::post('order/otziv', array(
    'as'=>'order/otziv',
    function(){
        $rules = array(
            'name' => array('required'),
            'reviewStars' => array('required'),
            'reviewStars2' => array('required'),
            'reviewStars3' => array('required'),
            'phone' => array('required','exists:clients'),
            'comment_doc' => array('required')
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->passes()){

            $lastname_review = Input::get('lastname_review');
            // Робот по полю
            if (!empty($lastname_review)){
                return Redirect::route('doctor/detail', array('link'=>User::where('id','=',Input::get('doctor_id'))->first()->link ))->withInput()
                    ->withErrors(['err'=>'Первый уровень защиты сработал, он говорит что вы робот!']);
            }

            $id = 0;
            $phone = Input::get('phone');
            $client = Client::where('phone','LIKE', "%$phone%")->exists();

            if ($client==false){
                return Redirect::route('doctor/detail', array('link'=>User::where('id','=',Input::get('doctor_id'))->first()->link ))->withInput()
                    ->withErrors(['err'=>'Вы не можете оставить отзыв, вашего номера нет у нас в базе данных.']);
            }else{
                $cl = Client::where('phone','LIKE', "%$phone%")->first();
                $id = $cl->id;
            }

            $ex = Otziv::where('doctor_id','=',Input::get('doctor_id'))->where('client_id','=',$id)->exists();
            //var_dump($ex);
            //die();
            if ($ex==true){
                $ex = Otziv::where('doctor_id','=',Input::get('doctor_id'))->where('client_id','=',$id)->exists();
                return Redirect::route('doctor/detail', array('link'=>User::where('id','=',Input::get('doctor_id'))->first()->link ))->withInput()
                    ->withErrors(['err'=>'Вы уже оставляли отзыв, вы не можете оставить его второй раз.']);
            }


            $otziv = new Otziv();
            $otziv->client_id = $id;
            $otziv->fio = Input::get('name');
            $otziv->phone = $phone;
            $otziv->status = 0;
            $otziv->comment = Input::get('comment_doc');
            $otziv->doctor_id = Input::get('doctor_id');
            $otziv->rang_qualif = Input::get('reviewStars');
            $otziv->rang_vnimanie = Input::get('reviewStars2');
            $otziv->rang_price = Input::get('reviewStars3');

            $otziv->save();

            /*$event = new Eventer();
            $event->order_id = $order->id;
            //$event->status_id = '';
            $event->flag = '4';
            $event->comment = 'Событие создано при помощи формы на главной странице';

            $event->date_begin = date('d:m:Y H:i', time());
            $event->date_end = '';//Input::get('date_end');

            //$event->user_id = Auth::user()->id;
            $event->save();*/
            return Redirect::route('doctor/detail', array('link'=>User::where('id','=',Input::get('doctor_id'))->first()->link ))->withErrors(['msg'=>'Вы успешно оставили отзыв!']);
        }
        else{
            //$er
            $messages = $validation->errors();
            $messages->add('error_status', 'К сожалению ошибка, отзыв не оставлен, исправьте поля.');
            return Redirect::route('doctor/detail', array('link'=>User::where('id','=',Input::get('doctor_id'))->first()->link ))->withInput()
                ->withErrors($messages);
        }
    }
));


Route::post('/order-new', array(
    'as'=>'order-new',
    function(){
        if (Request::ajax()){
        $rules = array(
            'phone' => array('required'),
            //'my_name'   => 'honeypot',
            //'my_time'   => 'required|honeytime:3'
        );
        $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){

                $lastname = Input::get('lastname');
                // Робот по полю
                if (!empty($lastname)){
                    $data['flag'] = 0;
                    $data['data'] = "Первый уровень защиты сработал, он говорит что вы робот!";
                    return $data;
                }

/*
                // Робот по Ip
                $access = 0;
                $ip = Request::ip();
                $deny = file('ip.txt');
                foreach ($deny as $item):
                    if(trim($item) == $ip) $access++;
                endforeach;
                if($access > 0 OR empty($ip)){
                    $data['flag'] = 0;
                    $data['data'] = "C вашего ip адреса уже был отправлен запрос, пожалуйста подождите 15 минут и попробуйте снова...";
                    return $data;
                }else{
                    file_put_contents('ip.txt',  $ip."\n" , FILE_APPEND);

*/


                    $id = 0;
                    $phone = Input::get('phone');
                    if ($phone == null || $phone==""){
                        return "Заполните поле телефон пожалуйста.";
                    }

                    $client = Client::where('phone','LIKE', "%$phone%")->exists();

                    if ($client==false){
                        $client2 = new Client();
                        $client2->phone = $phone;
                        $client2->save();
                        $id = $client2->id;
                    }else{
                        $cl = Client::where('phone','LIKE', "%$phone%")->first();
                        $id = $cl->id;
                    }

                    $order = new Order();
                    $order->client_id = $id;
                    $order->global_status = "0";
                    $order->save();

                    $event = new Eventer();
                    $event->order_id = $order->id;
                    //$event->status_id = '';
                    $event->flag = '4';
                    $event->comment = 'Событие создано при помощи формы на главной странице';

                    $event->date_begin = date('d:m:Y H:i', time());
                    $event->date_end = date('d.m.Y H:i', strtotime("+3 hours", time()));

                    //$event->user_id = Auth::user()->id;
                    $event->save();

                    $data['flag'] = 1;
                    $data['data'] = "Ваша заявка на прием отправлена. Наши консультанты свяжутся с Вами в течении 15 минут ежедневно в с 9:00 до 21:00 и запишут Вас на прием.";
                    return $data;
            }
            else{
                $data['flag'] = 0;
                $data['data'] = "Возможно вы не заполнили поле телефон, попробуйте еще раз.";
                return $data;
            }
        }
    }
));

Route::post('/order-new-doctor', array(
    'as'=>'order-new-doctor',
    function(){
        if (Request::ajax()){
            $rules = array(
                'phone' => array('required'),
            );
            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){

                $lastname = Input::get('lastname');
                // Робот по полю
                if (!empty($lastname)){
                    $data['flag'] = 0;
                    $data['data'] = "Первый уровень защиты сработал, он говорит что вы робот!";
                    return $data;
                }

                //$client = 0;
                $id = 0;
                $phone = Input::get('phone');
                $doctor_id = Input::get('doctor_id');
                $comment = Input::get('comment');
                $name = Input::get('name');
                $pacient = Input::get('pacient');
                $client = Client::where('phone','LIKE', "%$phone%")->exists();

                if ($client==false){
                    $client2 = new Client();
                    $client2->phone = $phone;
                    $client2->fio = $name;
                    $client2->save();
                    $id = $client2->id;
                }else{
                    $cl = Client::where('phone','LIKE', "%$phone%")->first();
                    $id = $cl->id;
                }

                $order = new Order();
                $order->client_id = $id;
                $order->global_status = "0";
                $order->comment = $comment;
                $order->doctor_id = $doctor_id;
                $order->pacient = $pacient;

                $order->save();

                $event = new Eventer();
                $event->order_id = $order->id;
                //$event->status_id = '';
                $event->flag = '4';
                $event->comment = 'Событие создано при помощи формы на странице доктора';

                $event->date_begin = date('d.m.Y H:i', time());
                $event->date_end = date('d.m.Y H:i', strtotime("+3 hours", time()));

                //$event->user_id = Auth::user()->id;
                $event->save();

                $data['flag'] = 1;
                $data['data'] = "Ваша заявка на прием отправлена. Наши консультанты свяжутся с Вами в течение 15 минут ежедневно в с 9:00 до 21:00 и запишут Вас на прием.";
                return $data;
            }
                    else{
            $data['flag'] = 0;
            $data['data'] = "Возможно вы не заполнили поле телефон, попробуйте еще раз.";
            return $data;
        }
    }
    }
));

Route::post('/order-new-klinika', array(
    'as'=>'order-new-klinika',
    function(){
        if (Request::ajax()){
            $rules = array(
                'phone' => array('required'),
            );
            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){

                $lastname = Input::get('lastname');
                // Робот по полю
                if (!empty($lastname)){
                    $data['flag'] = 0;
                    $data['data'] = "Первый уровень защиты сработал, он говорит что вы робот!";
                    return $data;
                }

                //$client = 0;
                $id = 0;
                $phone = Input::get('phone');
                $klinik_id = Input::get('klinik_id');
                $comment = Input::get('comment');
                $name = Input::get('name');
                $pacient = Input::get('pacient');
                $client = Client::where('phone','LIKE', "%$phone%")->exists();

                if ($client==false){
                    $client2 = new Client();
                    $client2->phone = $phone;
                    $client2->fio = $name;
                    $client2->save();
                    $id = $client2->id;
                }else{
                    $cl = Client::where('phone','LIKE', "%$phone%")->first();
                    $id = $cl->id;
                }

                $order = new Order();
                $order->client_id = $id;
                $order->global_status = "0";
                $order->comment = $comment;
                $order->klinik_id = $klinik_id;
                $order->pacient = $pacient;

                $order->save();

                $event = new Eventer();
                $event->order_id = $order->id;
                //$event->status_id = '';
                $event->flag = '4';
                $event->comment = 'Событие создано при помощи формы на странице доктора';

                $event->date_begin = date('d.m.Y H:i', time());
                //$event->date_end = date('d.m.Y H:i', time());

                //$date_end = date('Y-m-d');
                $event->date_end = date('d.m.Y H:i', strtotime("+3 hours", time()));

                //$event->user_id = Auth::user()->id;
                $event->save();

                $data['flag'] = 1;
                $data['data'] = "Ваша заявка на прием отправлена. Наши консультанты свяжутся с Вами в течение 15 минут ежедневно в с 9:00 до 21:00 и запишут Вас на прием.";
                return $data;
            }
            else{
                $data['flag'] = 0;
                $data['data'] = "Возможно вы не заполнили поле телефон, попробуйте еще раз.";
                return $data;
            }
        }
    }
));


Route::post('/order-new-diag', array(
    'as'=>'order-new-diag',
    function(){
        if (Request::ajax()){
            $rules = array(
                'phone' => array('required'),
            );
            $validation = Validator::make(Input::all(), $rules);
            if ($validation->passes()){

                $lastname = Input::get('lastname');
                // Робот по полю
                if (!empty($lastname)){
                    $data['flag'] = 0;
                    $data['data'] = "Первый уровень защиты сработал, он говорит что вы робот!";
                    return $data;
                }


                //$client = 0;
                $id = 0;
                $phone = Input::get('phone');
                $klinik_id = Input::get('klinik_id');
                $comment = Input::get('comment');
                $name = Input::get('name');
                $pacient = Input::get('pacient');
                $client = Client::where('phone','LIKE', "%$phone%")->exists();

                if ($client==false){
                    $client2 = new Client();
                    $client2->phone = $phone;
                    $client2->fio = $name;
                    $client2->save();
                    $id = $client2->id;
                }else{
                    $cl = Client::where('phone','LIKE', "%$phone%")->first();
                    $id = $cl->id;
                }

                $order = new Order();
                $order->client_id = $id;
                $order->global_status = "0";
                $order->comment = $comment;
                $order->klinik_id = $klinik_id;
                $order->pacient = $pacient;
                $order->diag_id = Input::get('diag_id');

                $order->save();

                $event = new Eventer();
                $event->order_id = $order->id;
                //$event->status_id = '';
                $event->flag = '4';
                $event->comment = 'Событие создано клиентом, на странице диаг. центра';

                $event->date_begin = date('d.m.Y H:i', time());
                //$event->date_end = date('d.m.Y H:i', time());

                //$date_end = date('Y-m-d');
                $event->date_end = date('d.m.Y H:i', strtotime("+3 hours", time()));

                //$event->user_id = Auth::user()->id;
                $event->save();

                $data['flag'] = 1;
                $data['data'] = "Ваша заявка на прием отправлена. Наши консультанты свяжутся с Вами в течение 15 минут ежедневно в с 9:00 до 21:00 и запишут Вас на прием.";
                return $data;
            }
            else{
                $data['flag'] = 0;
                $data['data'] = "Возможно вы не заполнили поле телефон, попробуйте еще раз.";
                return $data;
            }
        }
    }
));



