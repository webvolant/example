<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 22.01.15
 * Time: 3:39
 */
?>
@extends('admin')

@section('page-header')
    Редактирование

@stop

@section('content')

    {{ Form::model($user, array('action' => array('AdminKlinikaController@edit', $user->id), 'role' => 'form', 'enctype'=>'multipart/form-data', 'class' => 'form-horizontal')) }}
    <div class="row">
    <div class="col-md-12">
        {{ Form::submit( "Сохранить", array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::route('doctor/index') }}" class="btn btn-danger">Отмена</a>
    </div>
    </div>
    <hr/>

    <div class="tests_all">
        <?php echo $tests; ?>
    </div>


    <p><a href="" class="test-new btn btn-primary">Выбрать исследование</a>
        {{ Form::hidden('klinik_id', "$user->id") }}
        <a href="" class="test-save btn btn-success">Сохранить</a></p>

    <div class="tests">

    </div>
    <div class="clear"></div>

    <div class="row">
        <div class="col-md-4">
            @if ($errors->first('doctors'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('doctors'); ?></div>
            @else
            @endif
            {{ Form::label('') }}
            {{ Form::select('doctors[]',$doctors,$doctors_current,array('multiple'=>true,'class'=>'form-control custom-scroll')) }}
        </div>

        <div class="col-md-4">
            @if ($errors->first('type'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('type'); ?></div>
            @else
            @endif
            {{ Form::label('Тип') }}
            {{ Form::select('type', Helper::typeOfObject(), null, array('class' => 'form-control')) }}
        </div>

        <div class="col-md-4">
            @if ($errors->first('status'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('status'); ?></div>
            @else
            @endif
            {{ Form::label('Статус') }}
            {{ Form::select('status', Helper::status(), null, array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-6">
            @if ($errors->first('name'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('name'); ?></div>
            @else
            @endif
            {{ Form::label('Название клиники') }}
            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder'=>'Клиника АльфаМед')) }}
        </div>

        <div class="col-md-6">
            @if ($errors->first('fio'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('fio'); ?></div>
            @else
            @endif
            {{ Form::label('ФИО Контактного лица Клиники') }}
            {{ Form::text('fio', null, array('class' => 'form-control', 'placeholder'=>'Петров Сергей Александрович')) }}
        </div>

        <div class="col-md-6">
            @if ($errors->first('email'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('email'); ?></div>
            @else
            @endif
            {{ Form::label('Email клиники') }}
            {{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'test@gmail.com')) }}
        </div>
        <div class="col-md-6">
            @if ($errors->first('phone'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('phone'); ?></div>
            @else
            @endif
            {{ Form::label('Телефон клиники') }}
            {{ Form::text('phone', null, array('class' => 'form-control', 'placeholder'=>'0(312)565656')) }}
        </div>
        <div class="col-md-6">
            @if ($errors->first('address'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('address'); ?></div>
            @else
            @endif
            {{ Form::label('Адрес клиники') }}
            {{ Form::text('address', null, array('id'=>'myPlaceTextBox2', 'class' => 'form-control', 'placeholder'=>'Введите местоположение')) }}
            <?php echo "<html><head>".$map['js']."</head><body>".$map['html']."</body></html>" ?>
        </div>


        <div class="col-md-6">
            @if ($errors->first('grafik'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('grafik'); ?></div>
            @else
            @endif
            {{ Form::label('График') }}
            {{ Form::text('grafik', null, array('class' => 'form-control', 'placeholder'=>'Пн: c 12:50 до 20:40')) }}
        </div>


    </div>




    <div class="row">
        <div class="col-md-12">
            @if ($errors->first('images'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('images'); ?></div>
            @else
            @endif
            {{ Form::label('Изображения клиники - выделите сразу несколько изображений для загрузки') }}
            {{ Form::file('images[]', array('multiple'=>'true', 'class' => 'form-control')) }}

            @if (count($images) > 0)
                @foreach($images as $item)
                    <div class="image">
                        <img class="img-responsive admin_panel_images" src="<?php $_SERVER['SERVER_NAME']?>{{ $item->path_small; }}"/>
                        <div class="absolute"><button class="btn btn-danger images-delete" id="{{$item->id}}"><span class="fa fa-remove"></span></button> </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-warning" role="alert">Изображения не добавлены, рекомендуем добавить!</div>
            @endif

        </div>
    </div>

    <script type="text/javascript">
        $(".images-delete").click(function(e) {
            e.preventDefault();
            $(this).parents('.image').remove();
            var images_id = $(this).attr('id');
            var klinik_id = <?php echo $user->id ?>;
            $.post('/admin/images-delete', {images_id:images_id,klinik_id:klinik_id},function(data){
                console.log(data);
            });
        });
    </script>
    <div class="clear"></div>

    <div class="row">
    <div class="col-md-12">
        @if ($errors->first('description'))
            <div class="alert alert-danger" role="alert"><?php echo $errors->first('description'); ?></div>
        @else
        @endif
        {{ Form::label('Краткое описание клиники') }}
        {{ Form::text('description', null, array('id'=>'description', 'class' => 'form-control')) }}
    </div>

    <script type="text/javascript">
        /*CKEDITOR.replace( 'description', {
         allowedContent: true
         } );*/
        CKEDITOR.replace( 'description', {
            //allowedContent:true
        });

        CKEDITOR.instances.description.setData($('input#description').val());
        timer = setInterval(updateDiv,100);
        function updateDiv(){
            var editorText = CKEDITOR.instances.description.getData();

            $( "[name='description']" ).val(editorText);
        }
    </script>

    <div class="col-md-6">
        @if ($errors->first('logo'))
            <div class="alert alert-danger" role="alert"><?php echo $errors->first('logo'); ?></div>
        @else
        @endif
        {{ Form::label('Логотип') }}
        {{ Form::file('logo', array('class' => 'form-control')) }}

        @if ($user->logo)
            <div class="image">
                <img class="img-responsive admin_panel_images" src="<?php $_SERVER['SERVER_NAME']?>{{ $user->logo; }}"/>
                <div class="absolute"><button class="btn btn-danger imagelogo-delete" id="{{$user->id}}"><span class="fa fa-remove"></span></button> </div>
            </div>
            <div class="clear"></div>
        @else
            <div class="alert alert-warning" role="alert">Логотип не добавлен, рекомендуем добавить!</div>
        @endif

        <script type="text/javascript">
            $(".imagelogo-delete").click(function(e) {
                e.preventDefault();
                $(this).parents('.image').remove();
                var images_id = $(this).attr('id');
                var klinik_id = <?php echo $user->id ?>;
                $.post('/admin/imagelogo-delete', {images_id:images_id,klinik_id:klinik_id},function(data){
                    console.log(data);
                });
            });
        </script>
    </div>
    <div class="col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">Мета информация</div>
            <div class="panel-body">
                @if ($errors->first('keywords'))
                    <div class="alert alert-danger" role="alert"><?php echo $errors->first('keywords'); ?></div>
                @else
                @endif
                {{ Form::label('Ключевые слова - наиболее важные слова из описания врача') }}
                {{ Form::textarea('keywords', null, array('class' => 'form-control', 'placeholder'=>'клиника, Косметология, в Бишкеке, Название клиники')) }}
            </div>
        </div>
    </div>


    <div class="col-md-12">
        {{ Form::submit( "Сохранить", array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::route('doctor/index') }}" class="btn btn-danger">Отмена</a>
    </div>
    </div>
    {{ Form::close() }}

@stop