<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 20.01.15
 * Time: 23:18
 */
?>
@extends('front')


@section('specialities')
@show


@section('content')
<div class="col-xs-12 col-sm-12 col-md-10">

    @if (\Route::current()->parameter('spec')!=null)
    {{ Speciality::find(\Route::current()->parameter('spec'))->first()->description }}
    @endif


    <div class="row margin10">
        <?php $url = Helper::getUrlWithParams(); ?>
        <?php //if (Input::get('order')=='price' && Input::get('direction')=='asc') echo $url; elseif  (Input::get('order')!=null) echo Request::url().'?'.'&order=' . 'price'.'&direction=' . 'asc'; else echo $url.'&order=' . 'price'.'&direction=' . 'asc';?>
        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='price' && Input::get('direction')=='asc') echo $url; else echo $url.'&order=' . 'price'.'&direction=' . 'asc';?>">Цена <span class="glyphicon glyphicon-chevron-down"></span></a>
        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='price' && Input::get('direction')=='desc') echo $url; else echo $url.'&order=' . 'price'.'&direction=' . 'desc';?>">Цена <span class="glyphicon glyphicon-chevron-up"></span></a>

        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='rating' && Input::get('direction')=='asc') echo $url; else echo $url.'&order=' . 'rating'.'&direction=' . 'asc';?>">Рейтинг <span class="glyphicon glyphicon-chevron-down"></span></a>
        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='rating' && Input::get('direction')=='desc') echo $url; else echo $url.'&order=' . 'rating'.'&direction=' . 'desc';?>">Рейтинг <span class="glyphicon glyphicon-chevron-up"></span></a>

        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='experience' && Input::get('direction')=='asc') echo $url; else echo $url.'&order=' . 'experience'.'&direction=' . 'asc';?>">Стаж <span class="glyphicon glyphicon-chevron-down"></span></a>
        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='experience' && Input::get('direction')=='desc') echo $url; else echo $url.'&order=' . 'experience'.'&direction=' . 'desc';?>">Стаж <span class="glyphicon glyphicon-chevron-up"></span></a>


        <label class="pull-right margin3"><input type="checkbox" class="child_checkbox" onchange='window.location.href="<?php if (Input::get('deti')=='true') echo $url; else echo $url.'&deti=' . 'true';?>"'/> Детский доктор</label>
        <label class="pull-right margin3"><input type="checkbox" class="home_checkbox" onchange='window.location.href="<?php if (Input::get('home')=='true') echo $url; else echo $url.'&home=' . 'true';?>"'/> Выезд на дом</label>

    </div>



    <div id="sorting">
    @foreach ( $users as $key => $user)
    <div id="object_list">

        <div class="col-xs-12 col-sm-12 col-md-2">
            @if ($user->logo)
            <div class="intro_doctor_image">
                {{ HTML::image($user->logo); }}
            </div>
            @else
            <div class="intro_doctor_image">
            </div>
            @endif
        </div>

        <div class="col-xs-12 col-sm-12 col-md-7">
            <div class="intro_doctor_info">
                <p class="h3_my"><a href='{{ URL::route("doctor/detail", array($user->link)) }}'>{{ $user->fio }}</a></p>

                <p>@foreach ( $user->Specialities as $key => $sp) {{ $sp->name }}; @endforeach<br/>

                    @if ($user->experience)
                        Стаж: {{ $user->experience }} <?php echo strstr(Lang::choice('mydoc.experience', $user->experience, ['n' => $user->experience], 'ru'),"  "); ?>
                    @endif

                    @if ($user->rang)
                        / {{ $user->rang }}
                    @endif
                </p>

                @if ($user->price)
                    <p class="h6_my_bold">Стоимость приема - {{ $user->price }}с. <p id="price_include" data-toggle="modal" data-target="#basicModal{{ $user->link }}" class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-edit"></span> Что входит в прием?</p></p>

                    <div class="modal fade" id="basicModal{{ $user->link }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                                    <h4 class="modal-title" id="myModalLabel">Что входит в прием?</h4>
                                </div>
                                <div class="modal-body">

                                    <p>В прием стоимостью {{ $user->price }} с. входит: <h4>{{ $user->price_include }}</h4></p>
                                </div>
                                <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <p>{{ $user->description }}</p>

            </div> <!--intro_doctor_info -->
        </div><!-- col-md-7 -->

        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="pull-left margin10">
                @if ($user->count_otzivi)
                    <p class="orange_text_big">{{ $user->count_otzivi }}</p>
                    <p class="line0"><span><?php echo strstr(Lang::choice('mydoc.ot',  $user->count_otzivi, ['n' =>  $user->count_otzivi], 'ru'),"о"); ?></span></p>
                @else
                    <p class="orange_text_big">0</p>
                    <p class="line0"><span> <?php echo strstr(Lang::choice('mydoc.ot',  0, ['n' =>  0], 'ru'),"о"); ?></span></p>
                @endif
            </div>
            <div class="pull-left margin10">
                @if ($user->rating)
                <p class="orange_text_big">{{ round($user->rating,1) }}</p>
                <p class="line0"><span>рейтинг</span></p>
                @else
                <p class="orange_text_big">{{ $user->rating_second }}</p>
                <p class="line0"><span>рейтинг</span></p>
                @endif
            </div>
            <p></p>

            <p id="price_include" data-toggle="modal" data-target="#zapis_na_priem{{ $user->link }}" class="btn btn-success" ><span class="glyphicon glyphicon-edit"></span> Онлайн запись</p></p>

            <div class="modal fade" id="zapis_na_priem{{ $user->link }}" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                            <h4 class="modal-title" id="myModalLabel">Запишитесь на прием к этому врачу<br/>
                                <span class="blue_text">по тел.: 0 (312) 986 900</span></h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <p class="h6_my">Врач: {{ $user->fio }}</p>

                                <?php echo $errors->first('name'); ?>
                                <p>{{ Form::label('Ваш номер телефона:') }}
                                    {{ Form::text('phone', null, array('required', 'pattern'=>"[0-9_-(_)]{9}", 'title'=>'Поле должно быть заполнено!', 'id'=>'phone', 'class' => ' form-control rfield', 'placeholder'=>'0(___) __ __ __')) }}
                                </p>


                                {{ Form::hidden('doctor_id', "$user->id") }}

                                <p>{{ Form::text('name', null, array('class' => ' form-control', 'placeholder'=>'Ваше имя')) }}</p>

                                <p>
                                    {{ Form::radio('pacient', 'small'); }} Ребенок
                                </p>
                                <p>
                                    {{ Form::radio('pacient', 'big', true); }} Взрослый
                                </p>

                                <p><a href="#" id="{{ $user->id }}"class="user_phone2_a">Добавить комментарий</a></p>
                                <p>{{ Form::textarea('comment', null, array('class' =>'hidden2 form-control', 'id'=>"user_phone2_comment$user->id", 'placeholder'=>'Ваш комментарий')) }}</p>

                                <p>{{ Form::submit( "Отправить", array('class' => 'btn_submit btn btn-warning submit_send_order_doctor')) }}</p>

                            </div>

                        </div>
                        <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Отменить</button></div>

                    </div>
                </div>
            </div> <!-- окно заявки -->


        </div>

        <div class="intro_doctor_kontakts">
            @if ($user->klinika_name)
            <p class="h8_my space"><span class="glyphicon glyphicon-map-marker"></span> {{ $user->klinika_name }}  </p>
            @else
            <p class="h8_my space"><span class="glyphicon glyphicon-map-marker"></span>  Бишкек   </p>
            @endif
        </div>

    </div>
    @endforeach

    {{ $users->appends(Input::all())->links() }}
    </div><!-- sorting-->
</div>

@stop


            @section('sidebar')
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <p class="h6_my_bold">Специальности</p>
                    <ul class="list">
                        @foreach($specialities as $key => $item)
                        <li><a href='{{ URL::route("doctor/doctors", array($key)) }}'>{{ $item }}</a></li>
                        @endforeach
                    </ul>
                </div>
                {{ $sidebar_libraries }}
            @stop




