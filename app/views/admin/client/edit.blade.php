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
    Редактирование оператора
@stop

@section('content')

{{ Form::model($user, array('action' => array('AdminUserController@edit', $user->id), 'role' => 'form', 'class' => 'width90 form-horizontal')) }}

        <p>
            <?php echo $errors->first('fio'); ?>
            {{ Form::label('Фамилия Имя Отчество') }}
            {{ Form::text('fio', null, array('class' => 'form-control', 'placeholder'=>'Фамилия Имя Отчество')) }}
        </p>

<p>
    <?php echo $errors->first('pass'); ?>
    {{ Form::label('Пароль') }}
    {{ Form::password('pass', array('class' => 'form-control', 'placeholder'=>'Пароль')) }}
</p>

<p>
    <?php echo $errors->first('pass_confirmation'); ?>
    {{ Form::label('Повторите пароль') }}
    {{ Form::password('pass_confirmation', array('class' => 'form-control', 'placeholder'=>'Повторите пароль')) }}
</p>

        <p>
            <?php echo $errors->first('email'); ?>
            {{ Form::label('email') }}
            {{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'Email')) }}
        </p>

        <p>
            <?php echo $errors->first('phone'); ?>
            {{ Form::label('Телефон') }}
            {{ Form::text('phone', null, array('class' => 'form-control', 'placeholder'=>'Телефон')) }}
        </p>


<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('user/index') }}" class="btn btn-danger">Отмена</a>
</p>

{{ Form::close() }}

@stop