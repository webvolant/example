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
    Редактирование врача
@stop

@section('content')




{{ Form::model($user, array('action' => array('AdminDoctorController@edit', $user->id), 'role' => 'form','enctype'=>'multipart/form-data', 'class' => 'width90 form-horizontal')) }}


<p>
    {{ Form::submit( "Сохранить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('doctor/index') }}" class="btn btn-danger">Отмена</a>
</p>

<div class="row">
<div class="col-xs-6">
    @if ($errors->first('fio'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('fio'); ?></div>
@else
@endif
{{ Form::label('ФИО') }}
{{ Form::text('fio', null, array('class' => 'form-control', 'placeholder'=>'Петров Сергей Александрович')) }}
</div>

<div class="col-xs-6">
@if ($errors->first('link'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('link'); ?></div>
    @else
    @endif
    {{ Form::label('Ссылка') }}
    {{ Form::text('link', null, array('class' => 'form-control', 'placeholder'=>'petrov-aleksandr')) }}
</div>

    </div>


<div class="row">
<div class="col-xs-6">
    @if ($errors->first('email'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('email'); ?></div>
@else
@endif
{{ Form::label('Email') }}
{{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'test@gmail.com')) }}
</div>

<div class="col-xs-6">
    @if ($errors->first('phone'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('phone'); ?></div>
@else
@endif
{{ Form::label('Телефон') }}
{{ Form::text('phone', null, array('class' => 'form-control', 'placeholder'=>'0(312)565656')) }}
</div>
    </div>



<div class="row">
<div class="col-xs-12">
<div class="alert alert-success" role="alert">
    <h5>Клиники за которыми закреплен врач:</h5>

@foreach($user->Kliniks as $klinika)
<?php //var_dump($klinika) ?>
<div class="panel panel-info">
    <div class="panel-heading"><a href='{{ URL::route("klinika/edit", array($klinika->id)) }}'>{{ $klinika->name }}</a></div>
    <div class="panel-body">
            <p>Адрес: {{ $klinika->address }}</p>
    </div>
</div>
@endforeach
</div>
</div>
</div>



<div class="row"><p>
<div class="col-xs-6">
    @if ($errors->first('specialities'))
        <div class="alert alert-danger" role="alert"><?php echo $errors->first('specialities'); ?></div>
    @else
    @endif
    {{ Form::label('Привязка к специальностям') }}
    {{ Form::select('specialities[]',$specialities,$specialities_current,array('multiple'=>true,'class'=>'form-control custom-scroll')) }}
</div>

<div class="col-xs-6">
@if ($errors->first('status'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('status'); ?></div>
    @else
    @endif
    {{ Form::label('Статус') }}
    {{ Form::select('status', Helper::status(), null, array('class' => 'form-control')) }}
    </div></p>
</div>


<div class="row"><p>
<div class="col-xs-12">
    @if ($errors->first('klinika_name'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('klinika_name'); ?></div>
@else
@endif
{{ Form::label('Место приема - если у врача нет клиники') }}
{{ Form::text('klinika_name', null, array('id'=>'myPlaceTextBox2', 'class' => 'form-control', 'placeholder'=>'Начните вводить адрес')) }}

<?php echo "<html><head>".$map['js']."</head><body>".$map['html']."</body></html>" ?>
</div></p>
</div>


<div class="row"><p>
<div class="col-xs-3">
    @if ($errors->first('pay_doctor'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('pay_doctor'); ?></div>
@else
@endif
{{ Form::checkbox('pay_doctor', '1') }} Платный врач
</div>

<div class="col-xs-3">
@if ($errors->first('doma'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('doma'); ?></div>
@else
@endif
{{ Form::checkbox('doma', '1') }} Прием на дому
</div>

<div class="col-xs-3">
@if ($errors->first('det_doctor'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('det_doctor'); ?></div>
@else
@endif
{{ Form::checkbox('det_doctor', '1') }} Детский доктор
</div>


<div class="col-xs-3">
@if ($errors->first('viesd_na_dom'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('viesd_na_dom'); ?></div>
@else
@endif
{{ Form::checkbox('viesd_na_dom', '1') }} Выезд на дом

</div>
    </p>
</div>





<div class="row">
<div class="col-xs-4">
    @if ($errors->first('rating'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('rating'); ?></div>
@else
@endif
{{ Form::label('Рейтинг') }}
{{ Form::text('rating', '1', array('class' => 'form-control', 'placeholder'=>'2')) }}
</div>






<div class="col-xs-4">
    @if ($errors->first('experience'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('experience'); ?></div>
@else
@endif
{{ Form::label('Опыт') }}
{{ Form::text('experience', null, array('class' => 'form-control', 'placeholder'=>'2')) }}
</div>

<div class="col-xs-4">
    @if ($errors->first('rang'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('rang'); ?></div>
@else
@endif
{{ Form::label('Звание') }}
{{ Form::text('rang', null, array('class' => 'form-control', 'placeholder'=>'Врач высшей категории')) }}
</div>

    </div>




<div class="row">
<div class="col-xs-6">
    @if ($errors->first('price'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('price'); ?></div>
@else
@endif
{{ Form::label('Цена') }}
{{ Form::text('price', null, array('class' => 'form-control', 'placeholder'=>'300')) }}
</div>

<div class="col-xs-6">
    @if ($errors->first('price_include'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('price_include'); ?></div>
@else
@endif
{{ Form::label('Что входит в цену') }}
{{ Form::text('price_include', null, array('class' => 'form-control', 'placeholder'=>'Консультация, Осмотр')) }}
</div>

    </div>


<div class="row">
<div class="col-xs-12">
    @if ($errors->first('grafik'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('grafik'); ?></div>
@else
@endif
{{ Form::label('График') }}
{{ Form::text('grafik', null, array('class' => 'form-control', 'placeholder'=>'Пн: c 12:50 до 20:40')) }}
</div>
</div>






<p>
    @if ($errors->first('profil'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('profil'); ?></div>
@else
@endif
{{ Form::label('Профиль - основные направления по которым работает доктор') }}
{{ Form::text('profil', null, array('id'=>'profil', 'class' => 'form-control', 'placeholder'=>'пищевая аллергия; инфекции имунной системы;')) }}
</p>

<script type="text/javascript">
    CKEDITOR.replace( 'profil' );
    CKEDITOR.instances.profil.setData($('input#profil').val());
    timer = setInterval(updateDiv,100);
    function updateDiv(){
        var editorText = CKEDITOR.instances.profil.getData();
        $( "[name='profil']" ).val(editorText);
    }
</script>


<p>
    @if ($errors->first('description'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('description'); ?></div>
@else
@endif
{{ Form::label('Краткое описание') }}
{{ Form::text('description', null, array('id'=>'description', 'class' => 'form-control', 'placeholder'=>'')) }}
</p>

<script type="text/javascript">
    CKEDITOR.replace( 'description' );
    CKEDITOR.instances.description.setData($('input#description').val());
    timer = setInterval(updateDiv,100);
    function updateDiv(){
        var editorText = CKEDITOR.instances.description.getData();
        $( "[name='description']" ).val(editorText);
    }
</script>

<p>
    @if ($errors->first('education'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('education'); ?></div>
@else
@endif
{{ Form::label('Образование') }}
{{ Form::text('education', null, array('class' => 'form-control', 'placeholder'=>'Московский государственный университет 1978г')) }}
</p>

<p>
    @if ($errors->first('qualif'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('qualif'); ?></div>
@else
@endif
{{ Form::label('Курсы повышения квалификации') }}
{{ Form::text('qualif', null, array('id'=>'qualif', 'class' => 'form-control', 'placeholder'=>'Ежегодные краткосрочные конференции в Москве')) }}
</p>

<script type="text/javascript">
    CKEDITOR.replace( 'qualif' );
    CKEDITOR.instances.qualif.setData($('input#qualif').val());
    timer = setInterval(updateDiv,100);
    function updateDiv(){
        var editorText = CKEDITOR.instances.qualif.getData();
        $( "[name='qualif']" ).val(editorText);
    }
</script>





<div class="col-xs-6">
    <div class="row">
        @if ($errors->first('logo'))
            <div class="alert alert-danger" role="alert"><?php echo $errors->first('logo'); ?></div>
        @else
        @endif
        {{ Form::label('Фотография доктора') }}
        {{ Form::file('logo', array('class' => 'form-control')) }}

        @if ($user->logo)
            <div class="image">
                <img class="img-responsive admin_panel_images" src="<?php $_SERVER['SERVER_NAME']?>{{ $user->logo; }}"/>
                <div class="absolute"><button class="btn btn-danger imagelogodoctor-delete" id="{{$user->id}}"><span class="fa fa-remove"></span></button> </div>
            </div>
            <div class="clear"></div>
        @else
            <div class="alert alert-warning" role="alert">Фотография врача не добавлена, рекомендуем добавить!</div>
        @endif
    </div>

    <script type="text/javascript">
        $(".imagelogodoctor-delete").click(function(e) {
            e.preventDefault();
            $(this).parents('.image').remove();
            var images_id = $(this).attr('id');
            var user_id = $(this).attr('id');
            $.post('/admin/imagelogodoctor-delete', {images_id:images_id,user_id:user_id},function(data){
                console.log(data);
            });
        });
    </script>
</div>

<div class="col-xs-6">
<div class="panel panel-warning">
    <div class="panel-heading">Мета информация</div>
    <div class="panel-body">

        <p>
        @if ($errors->first('keywords'))
            <div class="alert alert-danger" role="alert"><?php echo $errors->first('keywords'); ?></div>
            @else
            @endif
            {{ Form::label('Ключевые слова - наиболее важные слова из описания врача') }}
            {{ Form::textarea('keywords', null, array('class' => 'form-control', 'placeholder'=>'врач, Косметолог, в Бишкеке, хороший, квалифицированный')) }}
            </p>
    </div>
</div>
</div>


</div>



<div class="col-xs-6 hidden-xs hidden-sm hidden-md hidden-lg">
    @if ($errors->first('pass'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('pass'); ?></div>
@else
@endif
{{ Form::label('Пароль') }}
{{ Form::text('pass', null, array('class' => 'form-control', 'placeholder'=>'')) }}

    @if ($errors->first('pass_confirmation'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('pass_confirmation'); ?></div>
@else
@endif
{{ Form::label('Повтор пароля') }}
{{ Form::text('pass_confirmation', null, array('class' => 'form-control', 'placeholder'=>'')) }}

</div>





<p>
    {{ Form::submit( "Сохранить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('doctor/index') }}" class="btn btn-danger">Отмена</a>
</p>

{{ Form::close() }}

@stop