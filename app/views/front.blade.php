<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 14.01.15
 * Time: 1:31
 */
?>

<!doctype html>
<html>
<head>
    @section('head')
        <meta charset="UTF-8">
        <title>mydoc.kg</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- CSS are placed here -->
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/bootstrap-theme.css') }}
        {{ HTML::style('template.css') }}

        {{ HTML::style('source/jquery.fancybox.css') }}

        <!-- Scripts are placed here -->
        {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js') }}
        {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.3.1/jquery.maskedinput.js') }}
        {{ HTML::script('js/bootstrap.js') }}

        {{ HTML::script('js/jquery.chained.min.js') }}
        {{ HTML::script('js/jquery.simpletip-1.3.1.min.js') }}

        {{ HTML::script('js/jquery.mousewheel-3.0.6.pack.js') }}
        {{ HTML::script('source/jquery.fancybox.pack.js') }}

        {{ HTML::script('js/sweet-alert.min.js') }}

            {{ HTML::style('slick/slick.css') }}
            {{ HTML::style('slick/slick-theme.css') }}

            {{ HTML::script('slick/slick.js') }}

        {{ HTML::style('css/sweet-alert.css') }}
        <script>
            $(document).ready(function() {
                $("#krit2").chained("#krit1");
                $(".statistics").simpletip({

                    // Configuration properties
                    content: 'Simple',
                    fixed: true

                });
                //$('#basicModal').modal();
                //$('#basicModal').modal();

                $('.car_grafik').slick({
                    infinite: true,
                    slidesToShow: 6,
                    slidesToScroll: 6
                });

                $('.car_pic').slick({
                    dots: true,
                    infinite: true,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear'
                });

            });
        </script>



    @show


</head>
<body>


<div class="container">

<div class="container">
    <div class="row">


    <div class="header">
        @section('header')





            <div class="col-xs-3 ">
                <div class="logo"></div>
            </div>

            <div class="col-xs-3 ">
                <div class="statistics">
                    <ul class="list">
                        <li><span class="orange_text">{{ $orders }} </span><?php echo strstr(Lang::choice('mydoc.orders', $orders, ['n' => $orders], 'ru'),"з"); ?> к врачам</li>
                        <li><span class="orange_text">{{ $docs }} </span><?php echo strstr(Lang::choice('mydoc.docs', $docs, ['n' => $docs], 'ru'),"в"); ?> в базе</li>
                        <li><span class="orange_text">{{ $ot }} </span><?php echo strstr(Lang::choice('mydoc.ot', $ot, ['n' => $ot], 'ru'),"о"); ?> </li>
                    </ul>
                </div>
            </div>

            <div class="col-xs-2 ">
                <div class="doctor1"></div>
            </div>

            <div class="col-xs-4 priem">



                <div class="form-group">

                    <?php echo $errors->first('phone_main'); ?>
                    {{ Form::label('Для записи на прием, впишите номер:') }}
                    <a class="pull-right">{{ Form::submit( "Отправить", array('class' => 'btn_submit_main btn btn-warning submit_send_order')) }}</a>
                    {{ Form::text('phone_main', null, array('required', 'title'=>'Поле должно быть заполнено!', 'id'=>'user_phone_main', 'class' => ' form-control rfield', 'placeholder'=>'0(___) __ __ __')) }}

                    <p>или звоните {{ Form::label(' 0312 986 900') }}</p>
                </div>



            </div>

        @show
    </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="search">
                    @section('search')
                    <div class="col-xs-12 ">
                        {{ Form::open(array('url' => 'search', 'role' => 'form', 'class' => '')) }}
                        <div class="col-xs-3 ">
                                <div class="form-group">
                                <span class="h4_my line35">Воспользуйтесь поиском!</span>
                                </div>
                        </div>

                        <div class="col-xs-4 ">
                                <div class="form-group">

                                    <select id="krit1" name="krit1" class="form-control">
                                        <option value="">Начните выбор тут</option>

                                        @foreach ($search1 as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>

                                </div>
                        </div>

                        <div class="col-xs-4 ">
                            <div class="form-group">
                                <select id="krit2" name="krit2" class="form-control">
                                    <option value="">Продолжите здесь</option>

                                    @foreach ($specialities as $key => $item)
                                    <option value="{{ $key }}" class="0">{{ $item }}</option>
                                    @endforeach

                                    @foreach ($specialisations as $key => $item)
                                    <option value="{{ $key }}" class="1">{{ $item }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-xs-1 ">
                                <div class="pull-right">{{ Form::submit( "Искать", array('class' => 'btn btn-warning')) }}</div>
                            </div>
                        {{ Form::close() }}
                    </div>
                    @show
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <nav class="navbar navbar-default" role="navigation">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ URL::route('/') }}">Главная</a></li>
                            <li><a href="{{ URL::to('doctor/doctors') }}">Врачи</a></li>
                            <li><a href="{{ URL::to('clinics/all') }}">Клиники</a></li>
                            <li><a href="{{ URL::to('diagnostica/centers') }}">Диагностические центры</a></li>
                        </ul>
                </nav>

            </div>
        </div>
    </div>



@section('specialities')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="specialities">
                    <ul class="list">
                        <?php $temp='А'; ?>
                        @foreach($specialities as $key => $item)

                            <?php
                                if (substr($item, 0 , 2)!=substr($temp, 0, 2)){
                                    echo '<h5><br/> </h5>';
                                }
                                $temp = $item;
                            ?>
                        <h5><li><a href='{{ URL::route("doctor/doctors", array($key)) }}'>{{ $item }}</a></li></h5>
                        @endforeach
                    </ul>

            </div>
        </div>
    </div>
</div>
@show

    <div class="container content">
        <div class="row">


            @section('content')
            <div class="col-xs-4">
            <section class="about track_links"><ul class="about_list_short list">
                    <li class="about_item i-closetohome ">
                        <h4>
                            Нужен врач в городе Бишкек?
                        </h4>
                        <p class="mvn">
                            Ищите врачей, используя поиск. Система подберет врачей, по указанным параметрам. Экономьте свое время!
                        </p>
                    </li>
                    <li class="about_item i-ratingsystem">
                        <h4>
                            Система рейтингов
                        </h4>
                        <p class="mvn">
                            Все наши врачи рейтингуются по множеству параметров. Вы сами можете оставить отзыв и оценку врачу.
                        </p>
                    </li>
                    <li class="about_item i-sortbyprice">
                        <h4>
                            Отсортируйте врачей по цене
                        </h4>
                        <p class="mvn">
                            Все наши врачи занесены в базу с указанием стоимости приема. Вы можете найти специалиста, ориентируясь на устраивающую вас цену.
                        </p>
                    </li>
                </ul>
            </div>
            <div class="col-xs-8">
                <ul class="about_list i-doctor_l">
                    <li class="about_item">
                        <h3><a href="{{ URL::to('diagnostica/centers') }}" class="about_link i-diagcenters" target="_blank">
                                Диагностические центры
                            </a></h3>
                        <p>
                            Вам нужно сдать анализы или провести обследование? Специализированный портал поможет Вам найти нужный центр.
                        </p>
                    </li>
                    <li class="about_item">
                        <h3><a href="{{ URL::route('library') }}" class="about_link i-pacientlib">
                                Медицинская библиотека
                            </a></h3>
                        <p>
                            Мы собрали для вас массу полезных статей о врачах, медицинских направлениях, современных методах лечения и диагностики.
                        </p>
                    </li>
                    <li class="about_item">
                        <h3><a href="{{ URL::route('illness') }}" class="about_link i-sicklist">
                                Справочник заболеваний
                            </a></h3>
                        <p>
                            Здесь Вы можете подобрать врача, который специализируется на лечении конкретного заболевания.
                        </p>
                    </li>
                </ul></section>
            </div>
            @show

            @section('sidebar')
            @show

            @section('info')
            @show
        </div>
    </div>



<div class="clear"></div>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="footer">
                @section('footer')
                <div class="col-xs-3 ">
                    <div class="logo"></div>
                </div>

                <div class="col-xs-4 about">
                    <span class="h4_my">О нас</span>
                    <p></p>
                    <span class="h8_my"><p>Сервис "Мой доктор" предоставляет доступ к данным о врачах, практикующих в клиниках и медицинских центрах Бишкека.</p></span>

                    <span class="h8_my"><p>Вы можете легко подобрать себе нужного специалиста, используя удобные опции поиска на сайте.</p></span>
                </div>

                <div class="col-xs-4">
                    <div class="registration">
                        @section('registration')
                        <span class="h4_my">Врачам и клиникам</span>
                        <ul class="list">
                            @if (Auth::check())
                            <li><span class="glyphicon glyphicon-home"> </span> Вы на сайте, {{ Auth::user()->fio }}</li>
                            <li><a href="{{ URL::route('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Выйти</a></li>
                            @else
                            <li><a href="{{ URL::route('login') }}"><span class="glyphicon glyphicon-lock"></span> Войти в личный кабинет</a></li>
                            <li><a href="{{ URL::route('registration') }}"><span class="glyphicon glyphicon-file"></span> Регистрация врача</a></li>
                            @endif

                        </ul>
                        <span class="h8_my">Регистрация врачей и клиник на портале БЕСПЛАТНА.</span>

                        @show
                    </div>
                </div>

                @show
            </div>
        </div>
        </div>
    </div>


</div>




</body>






<script type="text/javascript">
    $(document).ready(function() {

        $("#phone_otziv").mask("0(999) 99-99-99");
        $("#phone_reg").mask("0(999) 99-99-99");
        $('#user_phone_main').mask("0(999) 99-99-99");
        $('#user_phone2').mask("0(999) 99-99-99");
        $('#user_phone3').mask("0(999) 99-99-99");

        if (window.location.href.indexOf("deti") > -1) {
            $(".child_checkbox").prop("checked", true);
        }

        if (window.location.href.indexOf("home") > -1) {
            $(".home_checkbox").prop("checked", true);
        }

        $("#map_canvas").css({
            'height'	: '130px'
        });

        //добавить комментарий в заявке
        $(".hidden2").hide();
        $("a.user_phone2_a").click(function(e){
            e.preventDefault();
            var $id = $(this).attr('id');
            $("#user_phone2_comment"+$id).toggle();
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

        //заказ аякс
        $(".submit_send_order").click(function(e){
            e.preventDefault();
            var phone = $("#user_phone_main").val();
                $.post('/order-new', {phone:phone},function(data){
                    if (data['flag']=='0')
                        swal({
                            title: 'Заявка не принята',
                            text: data['data'],
                            type: 'error',
                            confirmButtonText: 'Закрыть'
                        });
                    else{
                        swal({
                            title: 'Заявка принята',
                            text: data['data'],
                            type: 'success',
                            confirmButtonText: 'Закрыть'
                        });
                    }
                });
        });

        $(".submit_send_order_doctor").click(function(e){
            e.preventDefault();
            var phone = $("#user_phone2").val();
            var doctor_id = $( "[name='doctor_id']" ).val();
            var pacient = $( "[name='pacient']" ).val();
            var name = $( "[name='name']" ).val();
            var comment = $( "[name='comment']" ).val();
            $.post('/order-new-doctor', {phone:phone,doctor_id:doctor_id,comment:comment,name:name,pacient:pacient},function(data){
                if (data['flag']=='0')
                    swal({
                        title: 'Заявка не принята',
                        text: data['data'],
                        type: 'error',
                        confirmButtonText: 'Закрыть'
                    });
                else{
                    swal({
                        title: 'Заявка принята',
                        text: data['data'],
                        type: 'success',
                        confirmButtonText: 'Закрыть'
                    });
                }

            });
        });

        $(".submit_send_order_klinika").click(function(e){
            e.preventDefault();
            var phone = $("#user_phone3").val();
            var klinik_id = $( "[name='klinik_id']" ).val();
            var pacient = $( "[name='pacient']" ).val();
            var name = $( "[name='name']" ).val();
            var comment = $( "[name='comment']" ).val();
            $.post('/order-new-klinika', {phone:phone,klinik_id:klinik_id,comment:comment,name:name,pacient:pacient},function(data){
                if (data['flag']=='0')
                    swal({
                        title: 'Заявка не принята',
                        text: data['data'],
                        type: 'error',
                        confirmButtonText: 'Закрыть'
                    });
                else{
                    swal({
                        title: 'Заявка принята',
                        text: data['data'],
                        type: 'success',
                        confirmButtonText: 'Закрыть'
                    });
                }

            });
        });


    });
</script>
</html>



