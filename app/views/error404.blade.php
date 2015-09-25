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
    @show

    <!-- CSS are placed here -->
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/bootstrap-theme.css') }}
    {{ HTML::style('template.css') }}

    {{ HTML::style('source/jquery.fancybox.css') }}

    {{ HTML::style('css/component.css') }}

    <!-- Scripts are placed here -->
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js') }}
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.3.1/jquery.maskedinput.js') }}
    {{ HTML::script('js/bootstrap.js') }}

    {{ HTML::script('js/jquery.chained.min.js') }}

    {{ HTML::style('bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css') }}

    {{ HTML::script('js/jquery.simpletip-1.3.1.min.js') }}

    {{ HTML::script('js/jquery.mousewheel-3.0.6.pack.js') }}
    {{ HTML::script('source/jquery.fancybox.pack.js') }}

    {{ HTML::script('js/sweet-alert.min.js') }}

    {{ HTML::style('slick/slick.css') }}
    {{ HTML::style('slick/slick-theme.css') }}

    {{ HTML::script('slick/slick.js') }}

    {{ HTML::script('js/modernizr.custom.js') }}


    {{ HTML::style('css/sweet-alert.css') }}




    @show


</head>
<body>

<div class="content row">
    @section('content')
    <div class="center row">
            <div class="err-image col-xs-12 col-sm-6 col-md-6">

            </div>
            <div class=" col-xs-12 col-sm-6 col-md-6">
                <h4 class="error404">404 <span class="error404text">ошибка</span></h4>
                <p>Думаю на сайте не оказалось запрашиваемой ссылки, данная ошибка могла возникнуть по разным причинам.</p>

                <p>Попробуйте перейти по следующему линку. </p>
                <h3>
                    <a href="{{ URL::to('/') }}"><?php echo "МОЙ ДОКТОР" ?></a>
                </h3>

            </div>
    </div>
    @show
</div>



</div> <!-- container -->

</body>


{{ HTML::script('bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js') }}


{{ HTML::script('js/bl-search.js') }}

</html>



