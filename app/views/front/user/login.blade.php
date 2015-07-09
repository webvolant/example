
@extends('front')

@section('header')
@parent

@stop


@section('content')

{{ Form::open(array('route' => 'login', 'role' => 'form', 'class' => 'form-inline')) }}

<p>
</p>

<p>
@if ($errors->first('email'))
<div class="alert alert-warning">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <?php echo $errors->first('email'); ?>
    {{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'email')) }}
</div>
@else
{{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'email')) }}
@endif
</p>

<p>
@if ($errors->first('pass'))
<div class="alert alert-warning">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <?php echo $errors->first('pass'); ?>
    {{ Form::password('pass', array('class' => 'form-control', 'placeholder'=>'пароль')) }}
</div>
@else
{{ Form::password('pass', array('class' => 'form-control', 'placeholder'=>'пароль')) }}
@endif
</p>

<p>
    {{ Form::checkbox('remember-me') }}
    {{ Form::label('Запомнить меня!') }}
</p>

<p>{{ Form::submit("Отправить", array('class' => 'btn btn-primary')) }}</p>

{{ Form::close() }}

@stop

