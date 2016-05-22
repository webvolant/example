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
    Пользователи
@stop


@section('content')
<p class="pull-right">
    <a href="{{ URL::route('doctor/add') }}" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i>Добавить</a>
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
            <th>ФИО</th>
            <th>Статус</th>
            <th>Обновлено</th>
            <!--<th>Дома</th>-->
            <th>Телефон</th>
            <th>Клиника</th>
            <th><i class="fa fa-wrench fa-fw"></th>
        </tr>

    </thead>
    <tbody>
        @foreach ( $users as $key => $user)
            <tr>
                <td><a href='{{ URL::route("doctor/edit", array($user->id)) }}'>{{ $user->id }}</a></td>
                <td><a href='{{ URL::route("doctor/edit", array($user->id)) }}'>{{ $user->fio }}</a></td>
                <td>{{ Helper::getStrStatus($user->status) }}</td>
                <td>{{ $user->updated_at }}</td>
                <!--<td></td>-->
                <td>{{ $user->phone }}</td>
                <td>{{ $user->klinika_name }}</td>
                <td class="gradeA">
                    <a href='{{ URL::route("doctor/edit", array($user->id)) }}' class="btn btn-info"><i class="fa fa-wrench fa-fw"></i></a>
                    <a href='{{ URL::route("doctor/delete", array($user->id)) }}' class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить объект?')"><i class="fa fa-trash-o fa-fw"></i></a>
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

