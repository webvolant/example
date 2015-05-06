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
    Новая статья
@stop

@section('content')



{{ Form::open(array('url' => action('AdminArticleController@add'), 'role' => 'form', 'class' => 'form-horizontal')) }}


<p>
    @if ($errors->first('name'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('name'); ?></div>
    @else
    @endif
    {{ Form::label('Заголовок статьи') }}
    {{ Form::text('name', null, array('class' => 'form-control', 'placeholder'=>'Заголовок статьи')) }}
</p>

<p>
    @if ($errors->first('description'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('description'); ?></div>
    @else
    @endif
    {{ Form::label('Полное описание') }}
    {{ Form::textarea('description', null, array('class' => 'form-control', 'placeholder'=>'')) }}
</p>

<script>
    var a = "<? echo 'description' ?>" ;
    CKEDITOR.replace( a );
</script>

<p>
    @if ($errors->first('specialities'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('specialities'); ?></div>
    @else
    @endif
    {{ Form::label('Направление') }}
    {{ Form::select('specialities',$specialities,null,array('class'=>'form-control custom-scroll')) }}
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
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('article/index') }}" class="btn btn-danger">Отмена</a>
</p>


{{ Form::close() }}
@stop