<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 20.01.15
 * Time: 23:18
 */
?>
@extends('front')


@section('title')
{{ Helper::title() }}
{{ "Диагностические центры" }}
@stop

@section('description')
{{ "большая база данных диагностических центров" }}
@stop

@section('specialities')
<div class="row">
    <div class="column_5 col-xs-12 col-sm-12 col-md-12">
<!--
        <ul class="list">
            <li class="column">
                <div class="spec_list_head"><a href="/diagnostica/centers/uzi/">УЗИ</a></div>
                <div>– <a href="/diagnostica/centers/uzi/">при беременности</a></div>
                <div>– <a href="/uzi/uzi-brushnoi-polosti/">брюшной полости</a></div>
                <div>– <a href="/uzi/uzi-malogo-taza/">малого таза</a></div>
                <div>– <a href="/uzi/uzi-pochek/">почек</a></div>
                <div>– <a href="/ehokardiografiya/">сердца (ЭХОКГ)</a></div>
                <div>– <a href="/3d-uzi/">3D УЗИ</a></div>
            </li>
            <li class="column">
                <div class="spec_list_head"><a href="/komputernaya-tomografiya/">КТ</a></div>
                <div>– <a href="/komputernaya-tomografiya/kt-golovi/">головного мозга</a></div>
                <div>– <a href="/komputernaya-tomografiya/kt-leghih-i-serdca/">легких</a></div>
                <div>– <a href="/komputernaya-tomografiya/kt-brushnoi-polosti/">брюшной полости</a></div>
                <div>– <a href="/komputernaya-tomografiya/kt-pozvonochnika/">позвоночника</a></div>
                <div>– <a href="/komputernaya-tomografiya/kt-grudnoi-kletki/">грудной клетки</a></div>
                <div>– <a href="/komputernaya-tomografiya/kt-pochek/">почек</a></div>
            </li>
            <li class="column">
                <div class="spec_list_head"><a href="/mrt/">МРТ</a></div>
                <div>– <a href="/diagnostica/centers/mrt-magnito-rezonansnaya-tomografiya-0-4-tesla/mrt-golovnogo-mozga">головного мозга</a></div>
                <div>– <a href="/mrt/mrt-otdelov-pozvonochnika/">позвоночника</a></div>
                <div>– <a href="/mrt/mrt-kolennogo-sustava/">коленного сустава</a></div>
                <div>– <a href="/mrt/mrt-brushnoi-polosti-zabrjushinnogo-prostranstva/">брюшной полости</a></div>
                <div>– <a href="/mrt/mrt-malogo-taza/">малого таза</a></div>
                <div>– <a href="/mrt/mrt-gipofiza/">гипофиза</a></div>
            </li>
            <li class="column">
                <div class="spec_list_head"><a href="/rentgen/">Рентген</a></div>
                <div>– <a href="/rentgen/rentgen-legkih/">легких</a></div>
                <div>– <a href="/rentgen/rentgen-pozvonochnika/">позвоночника</a></div>
                <div>– <a href="/rentgen/rentgen-grudnoi-kletki/">грудной клетки</a></div>
                <div>– <a href="/rentgen/rentgen-sustavov/">суставов</a></div>
                <div>– <a href="/rentgen/mammografia/">маммография</a></div>
                <div>– <a href="/rentgen/rentgen_tolstoj_kishki_irrigoskopia/">ирригоскопия</a></div>
            </li>
            <li class="column">
                <div><a href="/fluorografiya/">Флюорография</a></div>
                <div><a href="/func-diagnostika/sutochnoe-ekg/">Электрокардиография (ЭКГ)</a></div>
                <div><a href="/endoskopicheskie-issledovaniya/kolonoskopiya/">Колоноскопия</a></div>
                <div><a href="/gastroskopiya/">Гастроскопия</a></div>
                <div><a href="/bronhoskopiya/">Бронхоскопия</a></div>
                <div><a href="/analiz-krovi/">Анализ крови</a></div>
            </li>
        </ul>
-->


    </div>
</div>
@stop

@section('content')


<div class="col-xs-12 col-sm-12 col-md-10">

    @if (\Route::current()->parameter('diag')!=null)
    {{ Test::where('link','=',\Route::current()->parameter('diag'))->first()->description }}
    @endif

    @if (\Route::current()->parameter('area')!=null)
    {{ Test::where('link','=',\Route::current()->parameter('area'))->first()->description }}
    @endif


    <div class="row margin10">
        <?php $url = Helper::getUrlWithParams(); ?>

        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='price' && Input::get('direction')=='asc') echo $url; else echo $url.'&order=' . 'price'.'&direction=' . 'asc';?>">Цена <span class="glyphicon glyphicon-chevron-down"></span></a>
        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='price' && Input::get('direction')=='desc') echo $url; else echo $url.'&order=' . 'price'.'&direction=' . 'desc';?>">Цена <span class="glyphicon glyphicon-chevron-up"></span></a>

        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='rating' && Input::get('direction')=='asc') echo $url; else echo $url.'&order=' . 'rating'.'&direction=' . 'asc';?>">Рейтинг <span class="glyphicon glyphicon-chevron-down"></span></a>
        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='rating' && Input::get('direction')=='desc') echo $url; else echo $url.'&order=' . 'rating'.'&direction=' . 'desc';?>">Рейтинг <span class="glyphicon glyphicon-chevron-up"></span></a>

        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='count_otzivi' && Input::get('direction')=='asc') echo $url; else echo $url.'&order=' . 'count_otzivi'.'&direction=' . 'asc';?>">Отзывы <span class="glyphicon glyphicon-chevron-down"></span></a>
        <a class="pull-left margin3 btn btn-default btn-sm" href="<?php if (Input::get('order')=='count_otzivi' && Input::get('direction')=='desc') echo $url; else echo $url.'&order=' . 'count_otzivi'.'&direction=' . 'desc';?>">Отзывы <span class="glyphicon glyphicon-chevron-up"></span></a>



    </div>



    <div id="sorting">
        @foreach ( $users as $key => $user)
        <div id="object_list">

                    <div class="col-xs-12 col-sm-12 col-md-2">
                        @if ($user->logo)
                            <div class="intro_klinika_image">
                                {{ HTML::image($user->logo); }}
                            </div>
                        @else
                            <div class="intro_klinika_image">
                            </div>
                        @endif
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="intro_doctor_info">
                            <p class="h3_my"><a href='{{ URL::route("diagnostica/detail", array($user->link)) }}'>{{ $user->name }}</a></p>

                            <p><span class="h6_my"> Направления клиники: </span> @foreach(Klinika::getSpecialisations($user->id) as $item) {{ $item }} @endforeach </p>

                            <?php mb_internal_encoding("UTF-8"); ?>
                            <p><?php echo mb_substr(html_entity_decode($user->description, ENT_QUOTES, 'UTF-8'), 0, 500);?>
                                <a href="{{ URL::route("clinic/detail", array($user->link)); }}">.....</a> </p>

                        </div> <!--intro_doctor_info -->
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="pull-left margin20">
                            @if ($user->count_otzivi)
                            <p class="orange_text_big">{{ $user->count_otzivi }}</p>
                            <p class="line0"><span><?php echo strstr(Lang::choice('mydoc.ot',  $user->count_otzivi, ['n' =>  $user->count_otzivi], 'ru'),"о"); ?></span></p>
                            @else
                            <p class="orange_text_big">0</p>
                            <p class="line0"><span> <?php echo strstr(Lang::choice('mydoc.ot',  0, ['n' =>  0], 'ru'),"о"); ?></span></p>
                            @endif
                        </div>
                        <div class="pull-left margin20">
                            @if ($user->rating)
                            <p class="orange_text_big">{{ round($user->rating,1) }}</p>
                            <p class="line0"><span>рейтинг</span></p>
                            @else
                            <p class="orange_text_big">1</p>
                            <p class="line0"><span>рейтинг</span></p>
                            @endif
                        </div>
                        <p></p>

                        <p id="price_include" data-toggle="modal" data-target="#zapis_na_priem{{ $user->link }}" class="btn btn-success" ><span class="glyphicon glyphicon-edit"></span>  Онлайн запись</p></p>

                        <span class="h8_my">или по телефону: </span>
                        <p class="orange_text_small">0312 986 900</p>

                            <?php $grafik = explode(";",$user->grafik); ?>
                            <span class="glyphicon glyphicon-time left h4_my"></span>
                            <ul class="list">
                                @foreach ( $grafik as $key => $item)
                                <li>{{ $item }}</li>
                                @endforeach
                            </ul>




                        <div class="modal fade" id="zapis_na_priem{{ $user->link }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                                        <h4 class="modal-title" id="myModalLabel">Онлайн запись</h4>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <p class="h6_my">Клиника: {{ $user->name }}</p>

                                            <?php echo $errors->first('name'); ?>
                                            <p>{{ Form::label('Ваш номер телефона:') }}
                                                {{ Form::text('phone', null, array('required', 'pattern'=>"[0-9_-(_)]{9}", 'title'=>'Поле должно быть заполнено!', 'id'=>'phone', 'class' => ' form-control rfield', 'placeholder'=>'0(___) __ __ __')) }}
                                            </p>
                                            <p>{{ Form::text('name', null, array('class' => ' form-control', 'placeholder'=>'Ваше имя')) }}</p>

                                            <div class="lastname">
                                                {{ Form::text('lastname', null, array('title'=>'Поле должно быть заполнено!', 'id'=>'lastname', 'class' => 'form-control')) }}
                                            </div>

                                            {{ Form::hidden('klinik_id', "$user->id") }}
                                            <p>
                                                {{ Form::radio('pacient', 'small'); }} Ребенок
                                            </p>
                                            <p>
                                                {{ Form::radio('pacient', 'big', true); }} Взрослый
                                            </p>

                                            <p><a href="#" id="{{ $user->id }}"class="user_phone2_a">Добавить комментарий</a></p>
                                            <p>{{ Form::textarea('comment', null, array('class' =>'hidden2 form-control', 'id'=>"user_phone2_comment$user->id", 'placeholder'=>'Ваш комментарий')) }}</p>

                                            <p>{{ Form::submit( "Отправить", array('class' => 'btn_submit btn btn-warning submit_send_order_klinika')) }}</p>

                                        </div>

                                    </div>
                                    <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Отменить</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="intro_doctor_kontakts">
                       <span class="glyphicon glyphicon-map-marker"></span>{{  $user->address }}  <span class="glyphicon glyphicon-phone">     </span>0312 986 900
                    </div>



        </div>
    @endforeach
    </div>

    <div class="col-xs-12 col-sm-12 col-md-2">
        @section('sidebar')
        <!--{{ Test::getListWithLinks() }}-->
        {{ $sidebar_libraries }}
        @stop
    </div>

        {{ $users->appends(Input::all())->links() }}
</div>



@stop