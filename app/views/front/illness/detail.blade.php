<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 20.01.15
 * Time: 23:18
 */
?>
@extends('front')

@section('head')
@parent


@show


@section('title')
{{ Helper::title() }}
{{ $article->name }}
@stop

@section('description')
{{ $article->description }}
@stop

@section('specialities')
@show


@section('content')



<h2>{{{ $article->name }}}</h2>

<p>
    {{ $article->description }}
</p>

@section('sidebar')




@stop






@stop