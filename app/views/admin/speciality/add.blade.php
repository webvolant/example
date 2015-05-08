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
    Новая специальность
@stop

@section('content')



{{ Form::open(array('url' => action('AdminSpecialityController@add'), 'role' => 'form', 'class' => 'width90 form-horizontal')) }}

<p>
    <?php echo $errors->first('name'); ?>
    {{ Form::label('Специальность') }}
    {{ Form::text('name', null, array('class' => 'form-control', 'placeholder'=>'Специальность')) }}
</p>



<p>
    @if ($errors->first('description'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('description'); ?></div>
@else
@endif
{{ Form::label('Описание') }}
{{ Form::text('description', null, array('class' => 'form-control', 'placeholder'=>'')) }}
</p>

<script>
    var a = "<? echo 'description' ?>" ;
    CKEDITOR.replace( a );
</script>


<p>
    <?php echo $errors->first('specialisation'); ?>
    {{ Form::label('Направление') }}
    {{ Form::text('specialisation', null, array('class' => 'form-control', 'placeholder'=>'Направление')) }}
</p>
<p>
    @if ($errors->first('description_specialisation'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('description_specialisation'); ?></div>
@else
@endif
{{ Form::label('Краткое описание') }}
{{ Form::text('description_specialisation', null, array('class' => 'form-control', 'placeholder'=>'')) }}
</p>

<script>
    var a = "<? echo 'description' ?>" ;
    CKEDITOR.replace( a );
</script>

<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('speciality/index') }}" class="btn btn-danger">Отмена</a>
</p>

{{ Form::close() }}
@stop