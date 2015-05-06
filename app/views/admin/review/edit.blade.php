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
    Редактирование отзыва
@stop

@section('content')

{{ Form::model($otziv, array('action' => array('AdminOtzivController@edit', $otziv->id), 'role' => 'form', 'class' => 'width90 form-horizontal')) }}

<p>
    @if ($errors->first('fio'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('fio'); ?></div>
@else
@endif
{{ Form::label('Имя клиента') }}
{{ Form::text('fio',null,array('class'=>'form-control')) }}
</p>

<p>
    @if ($errors->first('phone'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('phone'); ?></div>
@else
@endif
{{ Form::label('Телефон') }}
{{ Form::text('phone',null,array('class'=>'form-control')) }}
</p>

<p>
    @if ($errors->first('rang_qualif'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('rang_qualif'); ?></div>
@else
@endif
{{ Form::label('Оценка квалификации') }}
{{ Form::text('rang_qualif',null,array('class'=>'form-control')) }}
</p>

<p>
    @if ($errors->first('rang_price'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('rang_price'); ?></div>
@else
@endif
{{ Form::label('Оценка цены-качества') }}
{{ Form::text('rang_price',null,array('class'=>'form-control')) }}
</p>

<p>
    @if ($errors->first('rang_vnimanie'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('rang_vnimanie'); ?></div>
@else
@endif
{{ Form::label('Оценка внимания') }}
{{ Form::text('rang_vnimanie',null,array('class'=>'form-control')) }}
</p>

<p>
    @if ($errors->first('comment'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('comment'); ?></div>
@else
@endif
{{ Form::label('Комментарий') }}
{{ Form::textarea('comment',null,array('class'=>'form-control')) }}
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
    @if ($errors->first('doctor_id'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('doctor_id'); ?></div>
@else
@endif
{{ Form::label('ID доктора') }}
{{ Form::text('doctor_id',null,array('class'=>'form-control')) }}
</p>

<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('review/index') }}" class="btn btn-danger">Отмена</a>
</p>

{{ Form::close() }}


@stop