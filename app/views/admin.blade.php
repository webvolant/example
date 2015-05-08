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
    <meta charset="UTF-8">
    <title>mydoc.kg Admin Panel</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Bootstrap Core CSS -->
    {{ HTML::style('bower_components/bootstrap/dist/css/bootstrap.min.css') }}
    <!-- MetisMenu CSS -->
    {{ HTML::style('bower_components/metisMenu/dist/metisMenu.min.css') }}

    <!-- DataTables CSS -->
    {{ HTML::style('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}

    <!-- DataTables Responsive CSS -->
    {{ HTML::style('bower_components/datatables-responsive/css/dataTables.responsive.css') }}

    <!-- Custom CSS -->
    {{ HTML::style('dist/css/sb-admin-2.css') }}
    <!-- Custom Fonts -->
    {{ HTML::style('bower_components/font-awesome/css/font-awesome.min.css') }}

    {{ HTML::style('css/jquery.datetimepicker.css') }}

    {{ HTML::style('css/sweet-alert.css') }}

    {{ HTML::style('template.css') }}

    <!-- jQuery -->
    {{ HTML::script('bower_components/jquery/dist/jquery.min.js') }}

    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}

    <!-- Metis Menu Plugin JavaScript -->
    {{ HTML::script('bower_components/metisMenu/dist/metisMenu.min.js') }}

    <!-- DataTables JavaScript -->
    {{ HTML::script('bower_components/DataTables/media/js/jquery.dataTables.min.js') }}
    {{ HTML::script('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}


</head>
<body>

<div id="wrapper">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{ URL::to('/') }}">MYDOC.KG</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-messages">
        <li>
            <a class="text-center" href="#">
                <strong>Идет загрузка</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
    <!-- /.dropdown-messages -->
</li>
<!-- /.dropdown -->
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-tasks">

        <li>
            <a class="text-center" href="#">
                <strong>Идет загрузка</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
    <!-- /.dropdown-tasks -->
</li>
<!-- /.dropdown -->
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-alerts">


        <li>
            <a class="text-center" href="#">
                <strong>Идет загрузка</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
    </ul>
    <!-- /.dropdown-alerts -->
</li>
<!-- /.dropdown -->
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li><a href='{{ URL::route("doctor/edit", array(Auth::user()->id)) }}'><i class="fa fa-user fa-fw"></i>Профиль юзера</a>
        </li>
        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
        </li>
        <li class="divider"></li>
        <li><a href="{{ URL::route('logout') }}"><i class="fa fa-sign-out fa-fw"></i>Выйти</a>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>
                <a href="{{ URL::route('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Админ Панель</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-calendar fa-fw"></i>История изменений<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::route('crm/docs') }}"><i class="fa fa-list fa-fw"></i>Врачи</a>
                        <a href="{{ URL::route('crm/kliniks') }}"><i class="fa fa-list fa-fw"></i>Клиники</a>
                        <a href="{{ URL::route('crm/events') }}"><i class="fa fa-list fa-fw"></i>События заявок</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>









            <li>
                <a href="#"><i class="fa fa-edit fa-fw"></i>Менеджер заявок<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::route('order/index') }}"><i class="fa fa-list fa-fw"></i>Управление заявками</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('order/add') }}"><i class="fa fa-plus fa-fw"></i>Добавить заявку</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>




            <li class="active">
                <a href="#"><i class="fa fa-edit fa-fw"></i>Менеджер операторов<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::route('user/index') }}"><i class="fa fa-list fa-fw"></i>Управление операторами</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('user/add') }}"><i class="fa fa-plus fa-fw"></i>Добавить оператора</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li class="active">
                <a href="#"><i class="fa fa-edit fa-fw"></i>Менеджер врачей<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::route('doctor/index') }}"><i class="fa fa-list fa-fw"></i>Управление врачами</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('doctor/add') }}"><i class="fa fa-plus fa-fw"></i>Добавить врача</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-edit fa-fw"></i>Менеджер Специальностей<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::route('speciality/index') }}"><i class="fa fa-list fa-fw"></i>Управление специальностями</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('speciality/add') }}"><i class="fa fa-plus fa-fw"></i>Добавить специальность</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-edit fa-fw"></i>Менеджер статусов<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::route('status/index') }}"><i class="fa fa-list fa-fw"></i>Управление статусами</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('status/add') }}"><i class="fa fa-plus fa-fw"></i>Добавить статус</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>


            <li class="active">
                <a href="#"><i class="fa fa-edit fa-fw"></i>Менеджер Клиник<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::route('klinika/index') }}"><i class="fa fa-list fa-fw"></i>Управление клиниками</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('klinika/add') }}"><i class="fa fa-plus fa-fw"></i>Добавить клинику</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li class="active">
                <a href="#"><i class="fa fa-edit fa-fw"></i>Отзывы<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::route('review/index') }}"><i class="fa fa-list fa-fw"></i>Управление отзывами</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('review/add') }}"><i class="fa fa-plus fa-fw"></i>Добавить Отзыв</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>


            <li class="active">
                <a href="#"><i class="fa fa-edit fa-fw"></i>Статьи и Заболевания<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::route('illness/index') }}"><i class="fa fa-list fa-fw"></i>Все Заболевания</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('illness/add') }}"><i class="fa fa-plus fa-fw"></i>Добавить заболевание</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('article/index') }}"><i class="fa fa-list fa-fw"></i>Все статьи</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('article/add') }}"><i class="fa fa-plus fa-fw"></i>Добавить статью</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>


        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                    <h3 class="page-header">@yield('page-header','')</h3>

                    @yield('content','')

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<div class="header">
    @section('header')

    <div>

    </div>

    @show
</div>



@section('sidebar')
@show






</body>



<!-- Custom Theme JavaScript -->
{{ HTML::script('dist/js/sb-admin-2.js') }}

{{ HTML::script('js/jquery.datetimepicker.js') }}

{{ HTML::script('js/jquery.favicon.js') }}

{{ HTML::script('ckeditor/ckeditor.js') }}

{{ HTML::script('js/sweet-alert.min.js') }}


<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({

        });

        $('#map_canvas').css({'display':'none'}); //запрет на вывод карты



        $('#formid-add-event').submit(function(e){
            e.preventDefault();

            var date_begin = $(this).find('input[name=date_begin]').val();
            var date_end = $(this).find('input[name=date_end]').val();
            var comment = $(this).find('input[name=comment]').val();
            var status = $(this).find('select[name=status]').val();
            var flag = $(this).find('select[name=flag]').val();

            var order_id = "<?php if(isset($order->id)) echo $order->id; ?>";

            $.post('/admin/add/event', {date_begin:date_begin,date_end:date_end,comment:comment,status:status,flag:flag,order_id:order_id},function(data){
                $('.message').html(data);
                //console.log(data);
                location.reload();
            });
        });

        $('#formid-edit-event').submit(function(e){
            e.preventDefault();

            var id = 1;
            var date_begin = $(this).find('input[name=date_begin]').val();
            var date_end = $(this).find('input[name=date_end]').val();
            var comment = $(this).find('input[name=comment]').val();
            var status = $(this).find('select[name=status]').val();
            var flag = $(this).find('select[name=flag]').val();

            var order_id = "<?php if(isset($order->id)) echo $order->id; ?>";

            $.post('/admin/edit/event/'+id, {date_begin:date_begin,date_end:date_end,comment:comment,status:status,flag:flag,order_id:order_id},function(data){
                $('.message').html(data);
                //console.log(data);
                location.reload();
            });
        });

        //$("#datetimepicker").each(function() {
        $("#datetimepicker_begin").datetimepicker({
            value:new Date(),
            format:'d.m.Y H:i',
            //inline:true,
            lang:'ru'
        });

        $("#datetimepicker_end").datetimepicker({
            format:'d.m.Y H:i',
            //inline:true,
            lang:'ru'
        });

        $('.datepick').each(function(){
            $(this).datetimepicker({
                format:'d.m.Y H:i',
                //inline:true,
                lang:'ru'
            });
        });






        //Добавление формы в клиниках для выбора теста.
        var $i=0;
        $(".test-new").click(function(e) {
            e.preventDefault();
            var arr = <?php if (isset($parentList)) echo json_encode($parentList); else echo '[]'; ?>;
            var selector = "<form class='' role='form'><div class='div50 margin10'><label for='test_id'>Исследование</label><select class='form-control' id='test_id"+$i+"'></select></div>";
                $(".tests").append(selector);
            var form = "<div class='div50 margin10'><label for='price_for_test'>Цена на исследование</label><input class='form-control' id = 'price_for_test"+$i+"'/></div></form>";
                $(".tests").append(form);

            var select = $("#test_id"+$i);
            select.html('');

            if (arr){
                $.each(arr, function(i, value) {
                    select.append('<option id="' + i + '" value="' + i + '">' + value + '</option>');
                });
                $i=$i+1;
            }
        });

        //Сохранение значений из формы в клиниках.
        $(".test-save").click(function(e) {
            e.preventDefault();
            var $p = 0;
            /*
            var test_id = $("select[name=test_id]").val();
            var price_for_test = $("input[name=price_for_test]").val();
            var klinik_id = $("input[name=klinik_id]").val();
            */
            var klinik_id = $("input[name=klinik_id]").val();

            var arr = [];
            arr["test_id"] = [];
            arr["price_for_test"] = [];
            //arr["links"] = [];

            $(".tests select").each(function(i) {
                arr.test_id.push($("select[id=test_id"+$p+"]").val());
                arr.price_for_test.push($("input[id=price_for_test"+$p+"]").val());
                //arr.price_for_test.push($("input[id=links"+$p+"]").val());
                //window.alert(test_id);
                //window.alert(price_for_test);
                $p=$p+1;
            });
            $.post('/admin/test-save', {test_id:JSON.stringify(arr.test_id),price_for_test:JSON.stringify(arr.price_for_test),klinik_id:klinik_id},function(data){
                //$(".dropdown-messages").html(data);
                if (data['flag']=='0')
                    swal({
                        title: 'Ошибка',
                        text: data['data'],
                        type: 'error',
                        confirmButtonText: 'Закрыть'
                    });
                else{
                    swal({
                        title: 'Успех',
                        text: data['data'],
                        type: 'success',
                        confirmButtonText: 'Закрыть'
                    });
                }
            });
        });

        //удаление значений из формы в клиниках.
        $(".test-delete").click(function(e) {
            e.preventDefault();
            $(this).parents('p').remove();//.html('Исследование было удалено!');
            var test_id = $(this).attr('id');
            var klinik_id = $("input[name=klinik_id]").val();
            $.post('/admin/test-delete', {test_id:test_id,klinik_id:klinik_id},function(data){

            });
        });











        $(".dropdown-toggle").click(function() {
            var date_begin = "";
            $.post('/admin/reviews-last', {name:date_begin},function(data){
                $(".dropdown-messages").html(data);
                //console.log(data);
                if (data==""){
                    //$.favicon('/public/template_image/favicon.ico');
                }else{
                    //$.favicon('/public/template_image/favicon_warning.ico');
                }

            });
            //}, 10000);
        });

        $(".dropdown-toggle").click(function() {
            var date_begin = "";
            $.post('/admin/remind-last', {name:date_begin},function(data){
                $(".dropdown-tasks").html(data);
                //console.log(data);
                if (data==""){
                    //$.favicon('/public/template_image/favicon.ico');
                }else{
                    //$.favicon('/public/template_image/favicon_warning.ico');
                }

            });
            //}, 10000);
        });


        $(".dropdown-toggle").click(function() {
            var date_begin = "";
            $.post('/admin/remind', {name:date_begin},function(data){
                $(".dropdown-alerts").html(data);
                //console.log(data);
                if (data==""){
                    $.favicon('/public/template_image/favicon.ico');
                }else{
                    $.favicon('/public/template_image/favicon_warning.ico');
                }

            });
            //}, 10000);
        });

        setTimeout(function() {
            var date_begin = "";
            $.post('/admin/remind', {name:date_begin},function(data){
                $(".dropdown-alerts").html(data);
                //console.log(data);
                if (data==""){
                    $.favicon('/public/template_image/favicon.ico');
                }else{
                    $.favicon('/public/template_image/favicon_warning.ico');
                }
            });
        }, 100);

        setInterval(function() {
            var date_begin = "";
            $.post('/admin/remind', {name:date_begin},function(data){
                $(".dropdown-alerts").html(data);
                //console.log(data);
                if (data==""){
                    $.favicon('/public/template_image/favicon.ico');
                }else{
                     $.favicon('/public/template_image/favicon_warning.ico');
                }
            });
        }, 90000);//20000);





    });
</script>

</html>



