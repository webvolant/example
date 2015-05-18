@extends('front')

@section('header')
@parent

@stop

@section('title')
{{ Helper::title() }}
{{ "Регистрация - шаг2" }}
@stop

@section('description')

@stop


@section('content')
{{ Form::open(array('url' => 'registration/step2', 'method'=>'post', 'role' => 'form', 'class' => 'form-inline')) }}


<p>
</p>


<p>
    <?php echo $errors->first('klinika'); ?>
    {{ Form::text('klinika', null, array('class' => 'form-control', 'placeholder'=>'Название клиники, в которой Вы принимаете')) }}
</p>

@if ($flag_interes==="self")
<p>
    <?php echo $errors->first('doma'); ?>
    {{ Form::checkbox('doma', '1') }} Я веду прием в домашних условиях
</p>
@else
@endif

<p>
    <?php echo $errors->first('email'); ?>
    {{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'email')) }}
</p>

@if ($flag_interes==="self")
<p>
    <?php echo $errors->first('dogovor'); ?>
    {{ Form::checkbox('dogovor', '1', true) }} Я принимаю условия Договора оферты
</p>
@else
<p>
    <?php echo $errors->first('dogovor'); ?>
    {{ Form::checkbox('dogovor', '1', true) }} Я принимаю условия Договора оферты
</p>
@endif


<p>{{ Form::submit( "Отправить" , array('class' => 'btn btn-primary')) }}</p>

{{ Form::close() }}

@stop
