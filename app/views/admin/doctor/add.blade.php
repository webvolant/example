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
    Новый врач
@stop

@section('content')



{{ Form::open(array('url' => action('AdminDoctorController@add'), 'role' => 'form','enctype'=>'multipart/form-data', 'class' => 'form-horizontal')) }}


<p>
    @if ($errors->first('fio'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('fio'); ?></div>
    @else
    @endif
    {{ Form::label('ФИО') }}
    {{ Form::text('fio', null, array('class' => 'form-control', 'placeholder'=>'Петров Сергей Александрович')) }}
</p>

<p>
    @if ($errors->first('email'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('email'); ?></div>
    @else
    @endif
    {{ Form::label('Email') }}
    {{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'test@gmail.com')) }}
</p>

<p>
    @if ($errors->first('phone'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('phone'); ?></div>
    @else
    @endif
    {{ Form::label('Телефон') }}
    {{ Form::text('phone', null, array('class' => 'form-control', 'placeholder'=>'0(312)565656')) }}
</p>

<p>
    @if ($errors->first('klinika_name'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('klinika_name'); ?></div>
@else
@endif
{{ Form::label('Место приема - если у врача нет клиники') }}
{{ Form::text('klinika_name', null, array('id'=>'myPlaceTextBox2', 'class' => 'form-control', 'placeholder'=>'Начните вводить адрес')) }}

<?php echo "<html><head>".$map['js']."</head><body>".$map['html']."</body></html>" ?>
</p>

<p>
    @if ($errors->first('doma'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('doma'); ?></div>
    @else
    @endif
    {{ Form::checkbox('doma', '1') }} Прием на дому
</p>

<p>
    @if ($errors->first('specialities'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('specialities'); ?></div>
    @else
    @endif
    {{ Form::label('Привязка к специальностям') }}
    {{ Form::select('specialities[]',$specialities,null,array('multiple'=>true,'class'=>'form-control custom-scroll')) }}
</p>


<p>
    @if ($errors->first('logo'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('logo'); ?></div>
@else
@endif
{{ Form::label('Фото') }}
{{ Form::file('logo', array('class' => 'form-control')) }}
</p>


<p>
    @if ($errors->first('status'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('status'); ?></div>
@else
@endif
{{ Form::label('Статус') }}
{{ Form::select('status', Helper::status(), null, array('class' => 'form-control')) }}
</p>


<p>
    @if ($errors->first('rating'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('rating'); ?></div>
@else
@endif
{{ Form::label('Рейтинг') }}
{{ Form::text('rating', null, array('class' => 'form-control', 'placeholder'=>'2')) }}
</p>





<p>
    @if ($errors->first('experience'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('experience'); ?></div>
@else
@endif
{{ Form::label('Опыт') }}
{{ Form::text('experience', null, array('class' => 'form-control', 'placeholder'=>'2')) }}
</p>

<p>
    @if ($errors->first('rang'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('rang'); ?></div>
@else
@endif
{{ Form::label('Звание') }}
{{ Form::text('rang', null, array('class' => 'form-control', 'placeholder'=>'Врач высшей категории')) }}
</p>

<p>
    @if ($errors->first('price'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('price'); ?></div>
@else
@endif
{{ Form::label('Цена') }}
{{ Form::text('price', null, array('class' => 'form-control', 'placeholder'=>'300')) }}
</p>

<p>
    @if ($errors->first('price_include'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('price_include'); ?></div>
@else
@endif
{{ Form::label('Что входит в цену') }}
{{ Form::text('price_include', null, array('class' => 'form-control', 'placeholder'=>'Консультация, Осмотр')) }}
</p>

<p>
    @if ($errors->first('grafik'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('grafik'); ?></div>
@else
@endif
{{ Form::label('График') }}
{{ Form::text('grafik', null, array('class' => 'form-control', 'placeholder'=>'Пн: c 12:50 до 20:40')) }}
</p>

<p>
    @if ($errors->first('det_doctor'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('det_doctor'); ?></div>
@else
@endif
{{ Form::checkbox('det_doctor', '1') }} Детский доктор
</p>

<p>
    @if ($errors->first('viesd_na_dom'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('viesd_na_dom'); ?></div>
@else
@endif
{{ Form::checkbox('viesd_na_dom', '1') }} Выезд на дом
</p>





<p>
    @if ($errors->first('profil'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('profil'); ?></div>
@else
@endif
{{ Form::label('Профиль - основные направления по которым работает доктор') }}
{{ Form::text('profil', null, array('class' => 'form-control', 'placeholder'=>'пищевая аллергия; инфекции имунной системы;')) }}
</p>

<p>
    @if ($errors->first('description'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('description'); ?></div>
@else
@endif
{{ Form::label('Краткое описание') }}
{{ Form::text('description', null, array('class' => 'form-control', 'placeholder'=>'')) }}
</p>

<script>
    var a = "<? echo 'description' ?>" ;
    CKEDITOR.replace( a );
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
{{ Form::text('qualif', null, array('class' => 'form-control', 'placeholder'=>'Ежегодные краткосрочные конференции в Москве')) }}
</p>










<p>
    @if ($errors->first('pass'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('pass'); ?></div>
@else
@endif
{{ Form::label('Пароль') }}
{{ Form::text('pass', null, array('class' => 'form-control', 'placeholder'=>'')) }}
</p>

<p>
    @if ($errors->first('pass_confirmation'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('pass_confirmation'); ?></div>
@else
@endif
{{ Form::label('Повтор пароля') }}
{{ Form::text('pass_confirmation', null, array('class' => 'form-control', 'placeholder'=>'')) }}
</p>


<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('doctor/index') }}" class="btn btn-danger">Отмена</a>
</p>


{{ Form::close() }}
@stop