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
    Редактирование статуса
@stop

@section('content')

{{ Form::model($user, array('action' => array('AdminStatusController@edit', $user->id), 'role' => 'form', 'class' => 'form-horizontal')) }}

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