@extends('front')

@section('header')
@parent

@stop

@section('title')
{{ Helper::title() }}
{{ "Регистрация" }}
@stop

@section('description')

@stop

@section('content')
{{ Form::open(array('route' => 'registration', 'method'=>'post', 'role' => 'form', 'class' => 'form-inline form_reg')) }}


<p>
</p>

<p>
    <?php echo $errors->first('fio'); ?>
    {{ Form::text('fio', null, array('class' => 'form-control', 'placeholder'=>'Фамилия Имя Отчестство')) }}
</p>

<p>
    @if ($errors->first('phone'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('phone'); ?></div>
@else
@endif
{{ Form::text('phone', null, array('type'=>'tel','required pattern'=>"[0-9_-]{9}", 'title'=>"Формат: (312) 99 99 99", 'id'=>'phone_reg', 'class' => ' form-control', 'placeholder'=>'(___) __ __ __')) }}
<span class="h8_my"></span></p>

<p>
    {{ Form::radio('interes', 'self', true); }} Я представляю свои интересы
</p>
<p>
    {{ Form::radio('interes', 'klinika'); }} Я представляю интересы клиники
</p>

<p>{{ Form::submit( "Отправить" , array('class' => 'btn btn-primary btn_submit')) }}</p>

{{ Form::close() }}

@stop
