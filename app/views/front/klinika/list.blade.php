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
<div class="col-md-9">

    <div class="specialisations">
        <ul class="list">
            @foreach($specialisations2 as $key => $item)
            <h5>
                <li>
                    <a href='{{ URL::route("clinics/all", array($item->id)) }}'> {{ $item->specialisation }}</a>

                    <div class="pull-right">{{ $count = Klinika::getKliniksBySpecialisationsCount($item->id) }}</div>
                </li>
            </h5>

            @endforeach

        </ul>

    </div>

    @if (\Route::current()->parameter('spec')!=null)
        {{ Speciality::find(\Route::current()->parameter('spec'))->first()->description_specialisation }}
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

                    <div class="col-md-2">
                        @if ($user->logo)
                            <div class="intro_klinika_image">
                                {{ HTML::image($user->logo); }}
                            </div>
                        @else
                            <div class="intro_klinika_image">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="intro_doctor_info">
                            <p class="h3_my"><a href='{{ URL::route("clinic/detail", array($user->link)) }}'>{{ $user->name }}</a></p>

                            <p><span class="h6_my"> Направления клиники: </span> @foreach(Klinika::getSpecialisations($user->id) as $item) {{ $item }} @endforeach </p>
                            <p>{{ $user->description }}</p>

                        </div> <!--intro_doctor_info -->
                    </div>

                    <div class="col-md-4">
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
                            <p class="orange_text_big">{{ $user->rating_second }}</p>
                            <p class="line0"><span>рейтинг</span></p>
                            @endif
                        </div>
                        <p></p>

                        <p id="price_include" data-toggle="modal" data-target="#zapis_na_priem{{ $user->link }}" class="btn btn-success" ><span class="glyphicon glyphicon-edit"></span>  Онлайн запись</p></p>

                        <span class="h8_my">или по телефону: </span>
                        <p class="orange_text_small">{{ $user->phone }} </p>

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
                                                {{ Form::text('phone', null, array('required', 'pattern'=>"[0-9_-(_)]{9}", 'title'=>'Поле должно быть заполнено!', 'id'=>'user_phone3', 'class' => ' form-control rfield', 'placeholder'=>'0(___) __ __ __')) }}
                                            </p>
                                            <p>{{ Form::text('name', null, array('class' => ' form-control', 'placeholder'=>'Ваше имя')) }}</p>

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
                       <span class="glyphicon glyphicon-map-marker"></span>{{  $user->address }}  <span class="glyphicon glyphicon-phone">     </span>{{ $user->phone }}
                    </div>

                @section('sidebar')
                    <div class="col-md-3">
                        <div class="sidebar_item">
                            <p><a href="{{ URL::route('library') }}">Медицинская библиотека</a></p>
                            <p>
                                Полезные статьи о заболеваниях, современных методах лечения и диагностиках.
                            </p>
                        </div>

                        <div class="sidebar_item">
                            <p><a href="{{ URL::route('library') }}">Диагностические центры</a></p>
                            <p>
                                Вам нужно провести диагностику или обследование? Специализированный портал поможет подобрать диагностический центр рядом с домом.
                            </p>
                        </div>

                        <div class="sidebar_item">
                            <p><a href="{{ URL::route('illness') }}">Справочник заболеваний</a></p>
                            <p>
                                Медицинский справочник болезней от А до Я.
                            </p>
                        </div>
                    </div>
                @stop

        </div>
    @endforeach
    </div>

        {{ $users->appends(Input::all())->links() }}
</div>


@stop