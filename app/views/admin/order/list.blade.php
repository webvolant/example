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
    Заявки
@stop


@section('content')
<p class="pull-right">
    <a href="{{ URL::route('order/add') }}" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i>Добавить</a>
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
                            <th>Статус</th>
                            <th>Клиент</th>
                            <th>Телефон</th>
                            <th>Врач</th>
                            <th>Клиника</th>
                            <th>Создано</th>
                            <th><i class="fa fa-wrench fa-fw"></th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach ( $users as $key => $user)
                        <tr>
                            <td><a href='{{ URL::route("order/edit", array($user->id)) }}'>{{ $user->id }}</a></td>
                            <td><a href='{{ URL::route("order/edit", array($user->id)) }}'>{{ Helper::getStrGlobalStatus($user->global_status) }}</a></td>
                            <td>{{ Client::getName($user->client_id) }}</td>
                            <td>{{ Client::getPhone($user->client_id) }}</td>
                            <td>@if ($user->doctor_id)
                                    <a href='{{ URL::route("doctor/edit", array($user->doctor_id)) }}' class="green">{{ User::getName($user->doctor_id) }}</a>
                                @endif
                                <br/>
                                <?php $doc = User::find($user->doctor_id); ?>
                                <?php if ($doc) { ?>
                                @foreach($doc->Kliniks as $klinika)
                                    <a href='{{ URL::route("klinika/edit", array($klinika->id)) }}'>{{ $klinika->name }}</a><br/>
                                @endforeach
                                <?php } else { echo 'Доктор не закреплен за клиникой'; } ?>
                            </td>
                            <td>
                                @if ($user->klinik_id)
                                    <a href='{{ URL::route("klinika/edit", array($user->klinik_id)) }}'>{{ Klinika::getName($user->klinik_id) }}</a>
                                @endif
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td class="gradeA">
                                <a href='{{ URL::route("order/edit", array($user->id)) }}' class="btn btn-info"><i class="fa fa-wrench fa-fw"></i></a>
                                <a href='{{ URL::route("order/delete", array($user->id)) }}' class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить объект?')"><i class="fa fa-trash-o fa-fw"></i></a>
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

