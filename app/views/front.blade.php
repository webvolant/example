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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @section('meta')
        <title>@yield('title', Helper::title() )</title>
        <meta name="description" content="@yield('description', Helper::description())">
        <meta name="keywords" content="@yield('keywords', Helper::keywords())">
    @show

        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('template.css') }}

        {{ HTML::style('source/jquery.fancybox.css') }}
        {{ HTML::style('css/component.css') }}
        {{ HTML::style('bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css') }}
        {{ HTML::style('slick/slick.css') }}
        {{ HTML::style('slick/slick-theme.css') }}
        {{ HTML::style('css/sweet-alert.css') }}


    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js') }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.3.1/jquery.maskedinput.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/jquery.chained.min.js') }}
    {{ HTML::script('js/jquery.mousewheel-3.0.6.pack.js') }}
    {{ HTML::script('source/jquery.fancybox.pack.js') }}
    {{ HTML::script('js/sweet-alert.min.js') }}
    {{ HTML::script('slick/slick.min.js') }}
    {{ HTML::script('js/modernizr.custom.js') }}


            <!-- Facebook Pixel Code -->
            <script>
                !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
                    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
                    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
                        document,'script','//connect.facebook.net/en_US/fbevents.js');

                fbq('init', '570951866393985');
                fbq('track', "PageView");</script>
            <noscript><img height="1" width="1" style="display:none"
                           src="https://www.facebook.com/tr?id=570951866393985&ev=PageView&noscript=1"
                /></noscript>
            <!-- End Facebook Pixel Code -->


    <script>
        $(document).ready(function() {
            $("#krit2").chained("#krit1");

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

    <meta name="openstat-verification" content="1a6bee1de0321fd3ea1e616659e2fce60d9ef9da" />


    @show


</head>
<body>

<div class="container">
    <div class="row header">
            @section('header')
                <div class=" col-xs-6 col-sm-7 col-md-4 paddingtop15">
                    <a href="{{ URL::route('/') }}"><div class="logo"></div></a>
                </div>

                <div class="col-xs-6 col-sm-5 col-md-2 paddingtop15">
                        <ul class="list">
                            <li><span class="orange_text">{{ $orders+75 }} </span><?php echo strstr(Lang::choice('mydoc.orders', $orders+75, ['n' => $orders+75], 'ru'),"з"); ?></li>
                            <li><span class="orange_text">{{ $docs }} </span><?php echo strstr(Lang::choice('mydoc.docs', $docs, ['n' => $docs], 'ru'),"в"); ?></li>
                            <li><span class="orange_text">{{ $ot }} </span><?php echo strstr(Lang::choice('mydoc.ot', $ot, ['n' => $ot], 'ru'),"о"); ?> </li>
                        </ul>
                </div>

                <div class="col-xs-offset-0 col-xs-6 col-sm-6 col-md-offset-0 col-md-2 hidden-xs">
                    <div class="doctor1"></div>
                </div>

                <div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-5  col-md-offset-0 col-md-4">
                    <div class="form-group form-inline order_form">
                        <?php echo $errors->first('phone_main'); ?>

                        <span class="h3_my"><span class="h4_my"> Поможем найти врача звоните</span><br/>
                            <span class="orange_text_big pull-left margintop20">0 </span>
                            <ul class="numbers pull-left margin-left10">
                                <li class="orange_text_small"><a data-tooltip="Кликайте по коду оператора для звонка" href="tel:+996312986900">(312)</a></li>
                                <li class="orange_text_small"><a data-tooltip="Кликайте по коду оператора для звонка" href="tel:+996706986900">(706)</a></li>
                                <li class="orange_text_small"><a data-tooltip="Кликайте по коду оператора для звонка" href="tel:+996770986900">(770)</a></li>
                            </ul>
                            <span class="orange_text_big pull-left margintop20 margin-left10"> 98-69-00</span>
                            <!--<span class="orange_text">0,(770) 98-69-00</span><br/>-->

                        </span>
                            <div class="clear"></div>
                            <div class="ab_tip">Кликайте по коду оператора для звонка</div>
                            <p><span class="h7_my"> или оставьте свой номер</span></p>
                        {{ Form::text('phone_main', null, array('required', 'title'=>'Поле должно быть заполнено!', 'id'=>'phone', 'class' => 'form-control form-inline width250', 'placeholder'=>'0(___) __ __ __')) }}
                        <!-- Honeypot::generate('my_name', 'my_time') -->
                        <div class="lastname">
                            {{ Form::text('lastname', null, array('title'=>'Поле должно быть заполнено!', 'id'=>'lastname', 'class' => 'form-control')) }}
                        </div>
                        <?php //Form::submit( "OK", array('class' => '')) ?>
                            <input class="form-control form-inline btn_submit_main btn btn-warning submit_send_order" type="submit" value="OK" onClick="ga('send', 'event', { eventCategory: 'BUTTON', eventAction: 'CLICK', eventLabel: 'OK'});">


                    </div>
                </div>
            @show
    </div>

    <div class="row">
            <div class="search col-xs-12 col-sm-12 col-md-12">

                    @section('search')

                        <div class="col-xs-12 col-sm-6 col-md-5 padding_left_right">
                            {{ Form::open(array('url' => 'search', 'role' => 'form', 'class' => '')) }}
                                <div class="form-group">

                                    <select id="krit1" name="krit1" class="form-control" placeholder="Критерий поиска">
                                        @foreach ($search1 as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>

                                </div>
                        </div>

                <?php //Test::getTreeWithLinks() ?>
                <?php //die() ?>
                        <div class="col-xs-12 col-sm-6 col-md-5 padding_left_right">
                            <div class="form-group">
                                <a id="test_icon" class="pull-left" data-toggle="modal" data-target="#testsModal" class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-edit"></span></a>
                                <select id="krit2" name="krit2" class="form-control">
                                    <option value="">Выберите параметр</option>

                                    @foreach ($specialities as $key => $item)
                                    <option value="{{ $key }}" class="0">{{ $item }}</option>
                                    @endforeach

                                    @foreach ($specialisations as $key => $item)
                                    <option value="{{ $key }}" class="1">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="modal fade" id="testsModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                                            <h4 class="modal-title" id="myModalLabel">Выберите исследование</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="column3">
                                                {{ Test::getTreeWithLinks() }}
                                            </div>
                                        </div>
                                        <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="illnessModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                                            <h4 class="modal-title" id="myModalLabel">Выберите заболевание</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="column3">
                                                <ul class="list">
                                                    <?php $temp='А'; ?>
                                                    @foreach($illness as $key => $item)

                                                    @if (substr($item->name, 0 , 2)!=substr($temp, 0, 2))
                                                    <h4><br/>{{ substr($item->name, 0 , 2) }} </h4>
                                                    @endif
                                                    <?php $temp = $item->name; ?>

                                                    <h5><li><a href='{{ URL::route("illness/detail", array($item->link)) }}'>{{ $item->name }}</a></li></h5>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-12 col-md-offset-0 col-md-2 padding_left_right">
                                <div class="">{{ Form::submit( "Начать поиск", array('class' => 'form-control btn btn-warning')) }}</div>
                            </div>
                        {{ Form::close() }}
                    @show
            </div>
    </div>

        <div class="row">
                <!-- Static navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Навигация</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav cl-effect-1">
                                <!--<li><a href=""><span class="glyphicon glyphicon-home"></span> Главная</a></li>-->
                                <li><a href="{{ URL::to('doctor/doctors') }}"><span class="glyphicon glyphicon-user"></span> Врачи</a></li>
                                <li><a href="{{ URL::to('clinics/all') }}"><span class="glyphicon glyphicon-plus"></span> Клиники</a></li>
                                <li><a href="{{ URL::to('diagnostica/centers') }}"><span class="glyphicon glyphicon-search"></span> Диагностические центры и лаборатории</a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                </div>
        </div>



        <div class="content row">


            @section('content')
            <div class="col-xs-12 col-sm-12 col-md-3">
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
                    <!--<li class="about_item i-sortbyprice">
                        <h4>
                            Отсортируйте врачей по цене
                        </h4>
                        <p class="mvn">
                            Все наши врачи занесены в базу с указанием стоимости приема. Вы можете найти специалиста, ориентируясь на устраивающую вас цену.
                        </p>
                    </li>-->
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 margintop20">

                <div class="i-doctor_l col-md-3 hidden-xs hidden-sm">
                </div>

                    <div class="col-md-3">
                        <p><span class="i-diagcenters"></span></p>
                        <h5><a href="{{ URL::to('diagnostica/centers') }}">Диагностические центры</a></h5>
                        <p>Вам нужно сдать анализы или провести обследование? Специализированный портал поможет Вам найти нужный центр.</p>
                    </div>

                    <div class="col-md-3">
                        <p><span class="i-pacientlib"></span></p>
                        <h5><a href="{{ URL::route('library') }}">Медицинская библиотека</a></h5>
                        <p>Мы собрали для вас массу полезных статей о врачах, медицинских направлениях, современных методах лечения и диагностики.</p>
                    </div>

                    <div class="col-md-3">
                        <p><span class="i-sicklist"></span></p>
                        <h5><a href="{{ URL::route('illness') }}">Справочник заболеваний</a></h5>
                        <p>Здесь Вы можете подобрать врача, который специализируется на лечении конкретного заболевания.</p>
                    </div>
            </div>
            @show



            @section('sidebar')
            @show

            @section('info')
            @show
        </div>

    @section('specialities')
        <div class="row">
            <div class="specialities col-xs-12 col-sm-12 col-md-12">
                <ul class="list">
                    <?php $temp='А'; ?>
                    @foreach($specialities as $key => $item)

                        <?php
                        if (substr($item, 0 , 2)!=substr($temp, 0, 2)){
                        echo '<h5 ><br/> </h5>';
                        }
                        $temp = $item;
                        ?>
                        <h5 class="font13"><li><a class="font13" href='{{ URL::route("doctor/doctors", array($key)) }}'>{{ $item }}</a></li></h5>
                    @endforeach
                </ul>

            </div>
        </div>
    @show

<div class="clear"></div>

    <div class="row">
        <div class="footer col-xs-12 col-sm-12 col-md-12">
                @section('footer')
                <div class="col-xs-6 col-sm-6 col-md-3">
                    <script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"></div>
                    <div class="logo2"></div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-4 about">
                    <span class="h4_my">О нас</span>
                    <p></p>
                    <span class="h8_my"><p>Сервис "Мой доктор" предоставляет доступ к данным о врачах, практикующих в клиниках и медицинских центрах Бишкека.</p></span>

                    <span class="h8_my"><p>Вы можете легко подобрать себе нужного специалиста, используя удобные опции поиска на сайте.</p></span>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="registration">
                        @section('registration')
                        <span class="h4_my">Врачам и клиникам</span>
                        <p><span class="h8_my">Регистрация врачей и клиник на портале БЕСПЛАТНА.</span></p>
                        <ul class="list">
                            @if (Auth::check())
                            <li><span class="glyphicon glyphicon-home"> </span> Вы на сайте, {{ Auth::user()->fio }}</li>
                            <li><a href="{{ URL::route('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Выйти</a></li>
                            @else
                            <!--<li><a href="{{ URL::route('login') }}"><span class="glyphicon glyphicon-lock"></span> Войти в личный кабинет</a></li>-->
                            <li><a href="{{ URL::route('registration') }}"><span class="glyphicon glyphicon-file"></span> Регистрация врача</a></li>
                            @endif

                        </ul>
                        <p><span class="h8_my">Пишите нам - office@my-doc.kg</span></p>


                        @show
                    </div>

                    <div class="pull-left margin-left10">
                        <!-- WWW.NET.KG , code for http://www.my-doc.kg -->
                        <script language="javascript" type="text/javascript">
                            java="1.0";
                            java1=""+"refer="+escape(document.referrer)+"&amp;page="+escape(window.location.href);
                            document.cookie="astratop=1; path=/";
                            java1+="&amp;c="+(document.cookie?"yes":"now");
                        </script>
                        <script language="javascript1.1" type="text/javascript">
                            java="1.1";
                            java1+="&amp;java="+(navigator.javaEnabled()?"yes":"now");
                        </script>
                        <script language="javascript1.2" type="text/javascript">
                            java="1.2";
                            java1+="&amp;razresh="+screen.width+'x'+screen.height+"&amp;cvet="+
                                    (((navigator.appName.substring(0,3)=="Mic"))?
                                            screen.colorDepth:screen.pixelDepth);
                        </script>
                        <script language="javascript1.3" type="text/javascript">java="1.3"</script>
                        <script language="javascript" type="text/javascript">
                            java1+="&amp;jscript="+java+"&amp;rand="+Math.random();
                            document.write("<a href='http://www.net.kg/stat.php?id=4757&amp;fromsite=4757' target='_blank'>"+
                                    "<img src='http://www.net.kg/img.php?id=4757&amp;"+java1+
                                    "' border='0' alt='WWW.NET.KG' width='88' height='31' /></a>");
                        </script>
                        <noscript>
                            <a href='http://www.net.kg/stat.php?id=4757&amp;fromsite=4757' target='_blank'><img
                                        src="http://www.net.kg/img.php?id=4757" border='0' alt='WWW.NET.KG' width='88'
                                        height='31' /></a>
                        </noscript>
                        <!-- /WWW.NET.KG -->
                    
					<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=34190090&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/34190090/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:34190090,lang:'ru'});return false}catch(e){}" /></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter34190090 = new Ya.Metrika({
                    id:34190090,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/34190090" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71399419-1', 'auto');
  ga('send', 'pageview');

</script>

					</div>


                    <div class="developed pull-right">

                    <style>
                        img.developed_logo {
                        position: relative;
                        top:-2px;
                        }
                    </style>
                        <img src="/public/template_image/ablogo.png" class="developed_logo" width="20px" height="20px"/> <a href="http://abs-it.net">AB SOLUTIONS</a> - Разработка веб-сайта<br/>
                        <div class="pull-right"><a href="mailto:barkalov_anton@mail.ru"><span class="glyphicon glyphicon-envelope"></span>  Антон Баркалов</a></div>
                    </div>


                </div>

                @show
        </div>
    </div>

</div> <!-- container -->


<script type="text/javascript">
    (function(){ var widget_id = 'AuS6rkkL4Y'; var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();
</script>


<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 955035807;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/955035807/?value=0&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>

</body>

{{ HTML::script('bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js') }}
{{ HTML::script('js/bl-search.js') }}


<script type="text/javascript">
    $(document).ready(function() {
        $(".diag_link").click(function(e){
            e.preventDefault();
            var diag_id = $(this).attr('id');
            var diag_text = $(this).text();
            //window.alert(diag_text);
            if (diag_id){
                $('#zapis_na_priem').modal('show');
                $(".diag_text").html(diag_text);
                $("#diag_for_order").val(diag_id);
            }
        });


        $("#phone_otziv").mask("0(999) 99-99-99");
        $("#phone_reg").mask("0(999) 99-99-99");

        var $inputs = $('input[id=phone]');
        $.each($inputs,function(){
            $(this).mask("0(999) 99-99-99");
        });


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
            //window.alert($id);
            $("#user_phone2_comment"+$id).toggle();
        });


        //как собираем отзывы
        $(".hidden-reviews").hide();
        $("a.how-reviews-link").click(function(e){
            e.preventDefault();
            //var $id = $(this).attr('id');
            $(".how-reviews").toggle(200);
        });





        //заказ аякс
        $(".submit_send_order").click(function(e){
            e.preventDefault();
            var phone = $("#phone").val();
            var lastname = $("#lastname").val();
                $.post('/order-new', {lastname:lastname,phone:phone},function(data){
                    console.log(data);
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
            var phone = $(this).parents('.modal').find("#phone").val();
            var doctor_id = $(this).parents('.modal').find( "[name='doctor_id']" ).val();
            var pacient = $(this).parents('.modal').find( "[name='pacient']" ).val();
            var name = $(this).parents('.modal').find( "[name='name']" ).val();
            var comment = $(this).parents('.modal').find( "[name='comment']" ).val();
            var lastname = $(this).parents('.modal').find( "[name='lastname']" ).val();
            $.post('/order-new-doctor', {lastname:lastname,phone:phone,doctor_id:doctor_id,comment:comment,name:name,pacient:pacient},function(data){

                    // do something…

                if (data['flag']=='0')
                    swal({
                        title: 'Заявка не принята',
                        text: data['data'],
                        type: 'error',
                        confirmButtonText: 'Закрыть'
                    });
                else{
                    $('.modal').hide();
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
            var phone = $(this).parents('.modal').find("#phone").val();
            var klinik_id = $(this).parents('.modal').find( "[name='klinik_id']" ).val();
            var pacient = $(this).parents('.modal').find( "[name='pacient']" ).val();
            var name = $(this).parents('.modal').find( "[name='name']" ).val();
            var comment = $(this).parents('.modal').find( "[name='comment']" ).val();
            var lastname = $(this).parents('.modal').find( "[name='lastname']" ).val();
            $.post('/order-new-klinika', {lastname:lastname,phone:phone,klinik_id:klinik_id,comment:comment,name:name,pacient:pacient},function(data){
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

        $(".submit_send_order_diag").click(function(e){

            e.preventDefault();
            var phone = $(this).parents('.modal').find("#phone").val();
            var klinik_id = $(this).parents('.modal').find( "[name='klinik_id']" ).val();
            var pacient = $(this).parents('.modal').find( "[name='pacient']" ).val();
            var name = $(this).parents('.modal').find( "[name='name']" ).val();
            var comment = $(this).parents('.modal').find( "[name='comment']" ).val();
            var diag_id = $(this).parents('.modal').find( "[name='diag_id']" ).val();
            var lastname = $(this).parents('.modal').find( "[name='lastname']" ).val();
            $.post('/order-new-diag', {lastname:lastname,phone:phone,klinik_id:klinik_id,comment:comment,name:name,pacient:pacient,diag_id:diag_id},function(data){
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

/*
        $("#krit2").multiselect({
            nonSelectedText: 'Ничего не выбрано!',

            enableFiltering: true
        });
*/

    });



    /*jQuery(document).ready(function() {
        jQuery(window).load(function() {

            jQuery(".ab_tip").css("display","block").delay( 2800 );
        });
    });*/
</script>
</html>



