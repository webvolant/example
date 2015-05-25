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
    Редактирование специальности
@stop

@section('content')

{{ Form::model($user, array('action' => array('AdminSpecialityController@edit', $user->id), 'role' => 'form', 'class' => 'width90 form-horizontal')) }}

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
{{ Form::label('Краткое описание специальности') }}
{{ Form::text('description', null, array('id'=>'description','class' => 'form-control', 'placeholder'=>'')) }}
</p>

<script type="text/javascript">
    CKEDITOR.replace( 'description' );
    CKEDITOR.instances.description.setData($('input#description').val());
    timer = setInterval(updateDiv,100);
    function updateDiv(){
        var editorText = CKEDITOR.instances.description.getData();
        $( "[name='description']" ).val(editorText);
    }
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
{{ Form::label('Краткое описание направления') }}
{{ Form::text('description_specialisation', null, array('id'=>'description_specialisation','class' => 'form-control', 'placeholder'=>'')) }}
</p>

<script type="text/javascript">
    CKEDITOR.replace( 'description_specialisation' );
    CKEDITOR.instances.description_specialisation.setData($('input#description_specialisation').val());
    timer = setInterval(updateDiv,100);
    function updateDiv(){
        var editorText = CKEDITOR.instances.description_specialisation.getData();
        $( "[name='description_specialisation']" ).val(editorText);
    }
</script>

<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('speciality/index') }}" class="btn btn-danger">Отмена</a>
</p>

{{ Form::close() }}

@stop