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
    Новый статус
@stop

@section('content')



{{ Form::open(array('url' => action('AdminStatusController@add'), 'role' => 'form', 'class' => 'form-horizontal')) }}

<p>
    <?php echo $errors->first('name'); ?>
    {{ Form::label('Название') }}
    {{ Form::text('name', null, array('class' => 'form-control', 'placeholder'=>'Специальность')) }}
</p>

<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('status/index') }}" class="btn btn-danger">Отмена</a>
</p>

{{ Form::close() }}
@stop