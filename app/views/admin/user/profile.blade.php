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

@section('content')

<p>
    name: {{ $user->name }}
</p>
<p>
    email: {{ $user->email }}
</p>




@stop