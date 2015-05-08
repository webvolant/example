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
    Новая клиника
@stop

@section('content')



{{ Form::open(array('url' => action('AdminKlinikaController@add'), 'enctype'=>'multipart/form-data', 'role' => 'form', 'class' => 'form-horizontal')) }}

<p>
    @if ($errors->first('status'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('status'); ?></div>
@else
@endif
{{ Form::label('Статус') }}
{{ Form::select('status', Helper::status(), null, array('class' => 'form-control')) }}
</p>

<p>
    @if ($errors->first('name'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('name'); ?></div>
@else
@endif
{{ Form::label('Название клиники') }}
{{ Form::text('name', null, array('class' => 'form-control', 'placeholder'=>'Клиника АльфаМед')) }}
</p>

<p>
    @if ($errors->first('fio'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('fio'); ?></div>
    @else
    @endif
    {{ Form::label('ФИО Контактного лица Клиники') }}
    {{ Form::text('fio', null, array('class' => 'form-control', 'placeholder'=>'Петров Сергей Александрович')) }}
</p>

<p>
    @if ($errors->first('email'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('email'); ?></div>
    @else
    @endif
    {{ Form::label('Email клиники') }}
    {{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'test@gmail.com')) }}
</p>

<p>
    @if ($errors->first('phone'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('phone'); ?></div>
    @else
    @endif
    {{ Form::label('Телефон клиники') }}
    {{ Form::text('phone', null, array('class' => 'form-control', 'placeholder'=>'0(312)565656')) }}
</p>

<p>
    @if ($errors->first('address'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('address'); ?></div>
    @else
    @endif
    {{ Form::label('Адрес клиники') }}
    {{ Form::text('address', null, array('class' => 'form-control', 'placeholder'=>'Панфилова 23')) }}
</p>



<p>
    @if ($errors->first('doctors'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('doctors'); ?></div>
    @else
    @endif
    {{ Form::select('doctors[]',$doctors,null,array('multiple'=>true,'class'=>'form-control custom-scroll')) }}
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
    @if ($errors->first('logo'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('logo'); ?></div>
@else
@endif
{{ Form::label('Логотип') }}
{{ Form::file('logo', null, array('class' => 'form-control')) }}
</p>

<p>
    @if ($errors->first('description'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('description'); ?></div>
@else
@endif
{{ Form::label('Краткое описание клиники') }}
{{ Form::text('description', null, array('class' => 'form-control', 'placeholder'=>'Многопрофильный медицинский центр, специализирующийся на проведении диагностического обследования взрослых и детей от 14 лет.')) }}
</p>

<script>
    var a = "<? echo 'description' ?>" ;
    CKEDITOR.replace( a );
</script>











<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('klinika/index') }}" class="btn btn-danger">Отмена</a>
</p>


{{ Form::close() }}
@stop