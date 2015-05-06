<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 22.01.15
 * Time: 3:39
 */
?>
@extends('admin::empty')




@section('sidebar')
@parent

@stop

@section('breadcrumb')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo trans('general.articles'); ?>
        <small><?php echo trans('general.control_panel'); ?></small>
    </h1>

    <ol class="breadcrumb">
        <li>
            <a href="{{ URL::to('/admin/') }}">
                <i class="fa fa-dashboard"></i> <span><?php echo trans('general.dashboard'); ?></span>
            </a>
        </li>
        <li class="">
            <a href="{{ URL::route('category/index') }}">
                <i class="fa"></i> <span><?php echo trans('general.categories'); ?></span>
            </a>
        </li>
        <li class="active"><?php echo trans('general.edit'); ?></li>
    </ol>
</section>
@stop


@section('content')


{{ Form::model($cat, array('action' => array('Barkalovlab\Category\CategoryController@edit', $cat->id), 'role' => 'form', 'class' => 'form-horizontal')) }}


<ul class="nav nav-tabs">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <li>
        <a href="#{{ $localeCode }} " data-toggle="tab">{{ $localeCode }}</a>
    </li>
    @endforeach
</ul>

<div class="tab-content">
    <?php $i=0; ?>
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <?php if ($i==0){ ?>
        <div class="tab-pane active" id="{{ $localeCode }}">
    <?php } else { ?>
        <div class="tab-pane" id="{{ $localeCode }}">
    <?php } ?>
            <p>
                <?php echo $errors->first('name_'.$localeCode); ?>
                {{ Form::label(trans ('general.name')) }}
                {{ Form::text('name_'.$localeCode, null, array('class' => 'form-control')) }}
            </p>

            <p>
                <?php echo $errors->first('parent_id'); ?>
                {{ Form::label(trans ('general.root')) }}
                {{ Form::select('parent_id', $parentList, null, array('class' => 'form-control')) }}
            </p>
        </div>
    <?php $i+=1; ?>
    @endforeach


</div>

<p>
    {{ Form::submit( trans('general.save'), array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('category/index') }}" class="btn btn-danger">{{ trans('general.cancel') }}</a>
</p>

{{ Form::close() }}

@stop