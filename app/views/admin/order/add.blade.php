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
{{ Form::select('client',$clients,null,array('class'=>'form-control custom-scroll')) }}
</p>

<p>
    @if ($errors->first('client'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('client'); ?></div>
@else
@endif
{{ Form::label('Привязка к доктору') }}
{{ Form::select('doctor',$doctors,null,array('class'=>'form-control custom-scroll')) }}
</p>




<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('order/index') }}" class="btn btn-danger">Отмена</a>
</p>

{{ Form::close() }}
@stop