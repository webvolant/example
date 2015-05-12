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
    Новая заявка
@stop

@section('content')



{{ Form::open(array('url' => action('AdminOrderController@add'), 'role' => 'form', 'class' => 'width90 form-horizontal')) }}

<p>
    @if ($errors->first('global_status'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('global_status'); ?></div>
@else
@endif
{{ Form::label('Глобальный статус') }}
{{ Form::select('global_status',Helper::globalStatus(),null,array('class'=>'form-control')) }}
</p>


<p>
    @if ($errors->first('client'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('client'); ?></div>
@else
@endif
{{ Form::label('Привязка к клиенту') }}
{{ Form::select('client',['NULL'=>'Ничего не выбрано'] + $clients,NULL,array('id'=>'client','class'=>'form-control custom-scroll')) }}
</p>

<p>
    @if ($errors->first('doctor'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('doctor'); ?></div>
@else
@endif
{{ Form::label('Привязка к доктору') }}
{{ Form::select('doctor',['NULL'=>'Ничего не выбрано'] + $doctors,NULL,array('id'=>'doctor','class'=>'form-control custom-scroll')) }}
</p>

<p>
    @if ($errors->first('klinika'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('klinika'); ?></div>
@else
@endif
{{ Form::label('Привязка к клинике') }}
{{ Form::select('klinika',['NULL'=>'Ничего не выбрано'] + $kliniks,NULL,array('id'=>'klinika','class'=>'form-control custom-scroll')) }}
</p>

<p>
    @if ($errors->first('diag'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('diag'); ?></div>
@else
@endif
{{ Form::label('Привязка к диагностике') }}
{{ Form::select('diag',['NULL'=>'Ничего не выбрано'] + $diags,NULL,array('id'=>'diag','class'=>'form-control custom-scroll')) }}
</p>



<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('order/index') }}" class="btn btn-danger">Отмена</a>
</p>

{{ Form::close() }}
@stop