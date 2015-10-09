<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 20.01.15
 * Time: 23:18
 */
?>
@extends('front')

        @section('head')
            @parent



        @show

@section('title')
{{ Helper::title() }}
{{ $user->name }}
@stop

@section('description')
{{ $user->description }}
@stop

@if($user->keywords)
@section('keywords')
{{ $user->keywords }}
@stop
@endif

@section('specialities')
@show

@section('content')

<div class="border col-md-12">
    <div class="col-md-7 block1">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
                <span class="h3_my margintop20">{{ $user->name }}</span>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="pull-right margin10 right20">
                    @if ($user->rating)
                    <p class="orange_text_big">{{ round($user->rating,1) }}</p>
                    <p class="line0"><span>рейтинг</span></p>
                    @else
                    <p class="orange_text_big">1</p>
                    <p class="line0"><span>рейтинг</span></p>
                    @endif
                </div>
                <div class="pull-right margin10 right20">
                    @if ($user->count_otzivi)
                    <p class="orange_text_big">{{ $user->count_otzivi }}</p>
                    <p class="line0"><span><?php echo strstr(Lang::choice('mydoc.ot',  $user->count_otzivi, ['n' =>  $user->count_otzivi], 'ru'),"о"); ?></span></p>
                    @else
                    <p class="orange_text_big">0</p>
                    <p class="line0"><span> <?php echo strstr(Lang::choice('mydoc.ot',  0, ['n' =>  0], 'ru'),"о"); ?></span></p>
                    @endif
                </div>
            </div>
        </div>

            <div class="clear">
                <div class="car_pic">
                    @foreach ( $photos as $key => $item)
                    <div class="">
                        <a class="fancybox" rel="gallery1" href="<?php echo url().'/'.$item->path_big; ?>">
                            {{ HTML::image($item->path_small) }}
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>

    </div>


    <div class="col-md-5">
        <p class="h4_my line75">Информация</p>

        <p class="h6_my"><span class=" h4_my glyphicon glyphicon-map-marker"> </span>  {{ $user->address }}</p>
        <div id="map">
            <?php echo "<html><head>".$map['js']."</head>".$map['html'] ?>
        </div>

        <div class="col-md-6">
            <?php $grafik = explode(";",$user->grafik); ?>
            <span class="glyphicon glyphicon-time left margin10 h4_my"></span>
            <ul class="list">
                @foreach ( $grafik as $key => $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6 paddingtop15">

            <p id="price_include" data-toggle="modal" data-target="#zapis_na_priem" class="btn btn-success" ><span class="glyphicon glyphicon-edit"></span>  Онлайн запись</p></p>
            <div class="modal fade" id="zapis_na_priem" tabindex="-1" role="dialog">
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

                                {{ Form::hidden('klinik_id', "$user->id") }}
                                <p>
                                    {{ Form::radio('pacient', 'small'); }} Ребенок
                                </p>
                                <p>
                                    {{ Form::radio('pacient', 'big', true); }} Взрослый
                                </p>

                                <p><a href="" id="{{ $user->id }}" class="user_phone2_a">Добавить комментарий</a></p>
                                <p>{{ Form::textarea('comment', null, array('class' =>'hidden2 form-control', 'id'=>"user_phone2_comment$user->id", 'placeholder'=>'Ваш комментарий')) }}</p>

                                <p>{{ Form::submit( "Отправить", array('class' => 'btn_submit btn btn-warning submit_send_order_klinika')) }}</p>

                            </div>


                        </div>
                        <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Отменить</button>

                        </div>
                    </div>
                </div>
            </div>
            <span class="h8_my">или по телефону: </span>
            <p class="orange_text_small">0312 986 900</p>
        </div>

    </div>




</div><!--col 12 -->

<div class="col-md-12 block1 border">
   <div class="row">

        <p class="h4_my line45">О Клинике / специализация</p>

        <p>{{ $user->description }}</p>
        <p><b>Специализации:</b> @foreach ( Klinika::getSpecialisations($user->id) as $item ) {{ $item }} @endforeach </p>
   </div>
</div>


<div class="col-md-12">
        <p class="h4_my line35">Врачи выбранной клиники</p>
        <a class="sort-price-asc btn btn-default btn-sm">Цена <span class="glyphicon glyphicon-chevron-down"></span></a>
        <a class="sort-price-desc btn btn-default btn-sm">Цена <span class="glyphicon glyphicon-chevron-up"></span></a>

        <a class="sort-docs-asc btn btn-default btn-sm">Рейтинг <span class="glyphicon glyphicon-chevron-down"></span></a>
        <a class="sort-docs-desc btn btn-default btn-sm">Рейтинг <span class="glyphicon glyphicon-chevron-up"></span></a>

        <a class="sort-exp-asc btn btn-default btn-sm">Стаж <span class="glyphicon glyphicon-chevron-down"></span></a>
        <a class="sort-exp-desc btn btn-default btn-sm">Стаж <span class="glyphicon glyphicon-chevron-up"></span></a>

        <p class="pull-right">
            <select id="count" name="count" class="form-control">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="40">40</option>
            </select>
        </p>

        <p class="pull-right">
            <select id="specialities" name="specialities" class="form-control">
                <option value="-">-</option>
                @foreach(Klinika::getSpecialities($user->id) as $key => $spec)
                <option value="{{ $spec }}">{{ $spec }}</option>
                @endforeach
            </select>
        </p>
</div>

<div id="sorting">
    <?php $specs = ""; //для сортировки ?>
    @foreach ($users as $key => $user)

    @foreach ($user->Specialities as $key => $sp) <?php $specs .= $sp->name.';'; ?> @endforeach

    <div id="object" data-price="{{ $user->price }}" data-exp="{{ $user->experience }}" data-spec="{{ $specs }}"
                                data-rating="<?php if ($user->rating) echo $user->rating; else $user->rating_second; ?>">
    <?php $specs=""; //ОБнулить для след. ?>

        <div class="col-md-2">
            @if ($user->logo)
            <div class="intro_doctor_image">
                {{ HTML::image($user->logo); }}
            </div>
            @else
            <div class="intro_doctor_image">
            </div>
            @endif
        </div>

        <div class="col-md-7">
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

        <div class="col-md-3">
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
                <p class="orange_text_big">1</p>
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

                                <div class="lastname">
                                    {{ Form::text('lastname', null, array('title'=>'Поле должно быть заполнено!', 'id'=>'lastname', 'class' => 'form-control')) }}
                                </div>
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
                        <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Отменить</button>

                        </div>
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
</div>


<script type="text/javascript">
$(document).ready(function() {

    if (window.location.href.indexOf("deti") > -1) {
        $(".child_checkbox").prop("checked", true);
    }

    if (window.location.href.indexOf("home") > -1) {
        $(".home_checkbox").prop("checked", true);
    }

    $(".fancybox").fancybox({
        maxWidth:'650',
        maxHeight:'400',
        openEffect	: 'none',
        closeEffect	: 'none'
    });





    //как собираем отзывы
    $(".hidden-reviews").hide();
    $("a.how-reviews-link").click(function(e){
        e.preventDefault();
        //var $id = $(this).attr('id');
        $(".how-reviews").toggle(200);
    });


    //еще отзывы
    $(".more-reviews").click(function(e){
        e.preventDefault();
        var user = $(".doctor_id").text();
        if (user){
            $("a.more-reviews").html('Пожалуйста подождите!');
            $.post('/more-review', {user:user},function(data){
                $(".reviews").html(data);
                $("a.more-reviews").hide();
            });
        }
    });

    var num = $(this).find("select[id=count]").val();
    //window.alert(num);

    $("#count").init(function(){
        $("#sorting > div#object").slice(0,num)
            .css('background-color', '').css('display', 'block');
        $("#sorting > div#object").slice(num)
            .css('background-color', '').css('display', 'none');
        //window.alert(num);
    });

    $("#count").change(function(){
        var num = $(this).val();
        //window.alert(num);
        $("#sorting > div#object").slice(0,num)
            .css('background-color', '').css('display', 'block');
        $("#sorting > div#object").slice(num)
            .css('background-color', '').css('display', 'none');
        //window.alert(num);
    });











    var myArray = $("#sorting > div#object");
    var count = 0;
    $("#specialities").change(function(){
        var spec = $(this).val();
        $('#sorting').each(function () { //нужно искать в элементах которые с display block
            $("#sorting > div#object").css('display', 'none');
            $("#sorting > div#object[data-spec*="+ spec +"]").css({'display':'block'});
            $("#sorting").append($("#sorting > div#object"));
        });
    });

    $('.sort-price-asc').click(function(){
        myArray.sort(function (a, b) {

            // convert to integers from strings
            a = parseInt($(a).attr("data-price"), 10);
            b = parseInt($(b).attr("data-price"), 10);
            count += 2;
            // compare
            if(a < b) {
                return 1;
            } else if(a > b) {
                return -1;
            } else {
                return 0;
            }
        });

        myArray.css('background-color', '').css('display', 'none');
        $("#sorting").append(myArray);

        $("#sorting > div#object").slice(0,num)
            .css('background-color', '').css('display', 'block');

    });

    $('.sort-price-desc').click(function(){
        myArray.sort(function (a, b) {

            // convert to integers from strings
            a = parseInt($(a).attr("data-price"), 10);
            b = parseInt($(b).attr("data-price"), 10);
            count += 2;
            // compare
            if(a > b) {
                return 1;
            } else if(a < b) {
                return -1;
            } else {
                return 0;
            }
        });

        myArray.css('background-color', '').css('display', 'none');
        $("#sorting").append(myArray);

        $("#sorting > div#object").slice(0,num)
            .css('background-color', '').css('display', 'block');

    });


    $('.sort-exp-asc').click(function(){
        myArray.sort(function (a, b) {

            // convert to integers from strings
            a = parseInt($(a).attr("data-exp"), 10);
            b = parseInt($(b).attr("data-exp"), 10);
            count += 2;
            // compare
            if(a < b) {
                return 1;
            } else if(a > b) {
                return -1;
            } else {
                return 0;
            }
        });

        myArray.css('background-color', '').css('display', 'none');
        $("#sorting").append(myArray);

        $("#sorting > div#object").slice(0,num)
            .css('background-color', '').css('display', 'block');

    });

    $('.sort-exp-desc').click(function(){
        myArray.sort(function (a, b) {

            // convert to integers from strings
            a = parseInt($(a).attr("data-exp"), 10);
            b = parseInt($(b).attr("data-exp"), 10);
            count += 2;
            // compare
            if(a > b) {
                return 1;
            } else if(a < b) {
                return -1;
            } else {
                return 0;
            }
        });

        myArray.css('background-color', '').css('display', 'none');
        $("#sorting").append(myArray);

        $("#sorting > div#object").slice(0,num)
            .css('background-color', '').css('display', 'block');

    });

    $('.sort-rating-asc').click(function(){
        myArray.sort(function (a, b) {

            // convert to integers from strings
            a = parseInt($(a).attr("data-rating"), 10);
            b = parseInt($(b).attr("data-rating"), 10);
            count += 2;
            // compare
            if(a < b) {
                return 1;
            } else if(a > b) {
                return -1;
            } else {
                return 0;
            }
        });

        myArray.css('background-color', '').css('display', 'none');
        $("#sorting").append(myArray);

        $("#sorting > div#object").slice(0,num)
            .css('background-color', '').css('display', 'block');

    });

    $('.sort-rating-desc').click(function(){
        myArray.sort(function (a, b) {

            // convert to integers from strings
            a = parseInt($(a).attr("data-rating"), 10);
            b = parseInt($(b).attr("data-rating"), 10);
            count += 2;
            // compare
            if(a > b) {
                return 1;
            } else if(a < b) {
                return -1;
            } else {
                return 0;
            }
        });

        myArray.css('background-color', '').css('display', 'none');
        $("#sorting").append(myArray);

        $("#sorting > div#object").slice(0,num)
            .css('background-color', '').css('display', 'block');

    });

});
</script>

@stop