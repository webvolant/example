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
    Новый оператор
@stop

@section('content')



{{ Form::open(array('url' => action('AdminUserController@add'), 'role' => 'form', 'class' => 'width90 form-horizontal')) }}

    <p>
        @if ($errors->first('fio'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('fio'); ?></div>
    @else
    @endif
    {{ Form::label('ФИО') }}
    {{ Form::text('fio', null, array('class' => 'form-control', 'placeholder'=>'')) }}
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
    @if ($errors->first('email'))
        <div class="alert alert-danger" role="alert"><?php echo $errors->first('email'); ?></div>
    @else
    @endif
    {{ Form::label('email') }}
    {{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'')) }}
</p>

<p>
    @if ($errors->first('phone'))
        <div class="alert alert-danger" role="alert"><?php echo $errors->first('phone'); ?></div>
    @else
    @endif
    {{ Form::label('Телефон') }}
    {{ Form::text('phone', null, array('class' => 'form-control', 'placeholder'=>'')) }}
</p>

<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('user/index') }}" class="btn btn-danger">Отмена</a>
</p>

{{ Form::close() }}
@stop