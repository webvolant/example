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
    Редактирование специальности
@stop

@section('content')

{{ Form::model($user, array('action' => array('AdminSpecialityController@edit', $user->id), 'role' => 'form', 'class' => 'width90 form-horizontal')) }}

<p>
    <?php echo $errors->first('name'); ?>
    {{ Form::label('Специальность') }}
    {{ Form::text('name', null, array('class' => 'form-control', 'placeholder'=>'Специальность')) }}
</p>

<p>
    <?php echo $errors->first('specialisation'); ?>
    {{ Form::label('Направление') }}
    {{ Form::text('specialisation', null, array('class' => 'form-control', 'placeholder'=>'Направление')) }}
</p>


<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('speciality/index') }}" class="btn btn-danger">Отмена</a>
</p>

{{ Form::close() }}

@stop