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


@section('breadcrumb')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php //echo trans('general.articles'); ?>
        <small><?php //echo trans('general.control_panel'); ?></small>
    </h1>

    <ol class="breadcrumb">
        <li>
            <a href="{{ URL::to('/admin/') }}">
                <i class="fa fa-dashboard"></i> <span><?php echo 'Панель управления' ?></span>
            </a>
        </li>
        <li class="">
            <a href="{{ URL::route('test/index') }}">
                <i class="fa"></i> <span><?php echo 'Анализы и Исследования' ?></span>
            </a>
        </li>
        <li class="active"><?php echo 'Добавить'; ?></li>
    </ol>
</section>
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
            {{ Form::select('parent_id', $parentList, null, array('class' => 'form-control')) }}
        </p>
    </div>

<p>
    {{ Form::submit( 'Отправить', array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('test/index') }}" class="btn btn-danger"><?php echo 'Отменить'; ?></a>
</p>

{{ Form::close() }}

@stop