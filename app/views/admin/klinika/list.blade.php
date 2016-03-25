<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 20.01.15
 * Time: 23:18
 */
?>
@extends('admin')

@section('page-header')
    Учреждения
@stop


@section('content')
<p class="pull-right">
    <a href="{{ URL::route('klinika/add') }}" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i>Добавить</a>
</p>


<!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">

</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div class="dataTable_wrapper">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>

        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Email</th>
            <th>Конт.Лицо</th>
            <th>Телефон</th>
            <th>Адрес</th>
            <th>Тип</th>
            <th><i class="fa fa-wrench fa-fw"></th>
        </tr>

    </thead>
    <tbody>
        @foreach ( $users as $key => $user)
            <tr>
                <td class="gradeB"><a href='{{ URL::route("klinika/edit", array($user->id)) }}'>{{ $user->id }}</a></td>
                <td class="gradeA"><a href='{{ URL::route("klinika/edit", array($user->id)) }}'>{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->fio }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ Klinika::getType($user->type) }}</td>
                <td>
                    <a href='{{ URL::route("klinika/edit", array($user->id)) }}' class="btn btn-info"><i class="fa fa-wrench fa-fw"></i></a>
                    <a href='{{ URL::route("klinika/delete", array($user->id)) }}' class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить объект?')"><i class="fa fa-trash-o fa-fw"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>


@stop

