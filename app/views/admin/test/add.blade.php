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
Новое исследование
@stop

@section('content')

{{ Form::open(array('url' => action('AdminTestController@add'), 'role' => 'form', 'class' => 'width90 form-horizontal')) }}

        <p>
            <?php echo $errors->first('name'); ?>
            {{ Form::label('name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </p>

        <p>
            <?php echo $errors->first('parent_id'); ?>
            {{ Form::label('Root') }}
            {{ Form::select('parent_id', $list, null, array('class' => 'form-control')) }}
        </p>

<p>
    @if ($errors->first('description'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('description'); ?></div>
@else
@endif
{{ Form::label('Описание') }}
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
    {{ Form::submit( 'Отправить', array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('test/index') }}" class="btn btn-danger"><?php echo 'Отменить'; ?></a>
</p>

{{ Form::close() }}

@stop