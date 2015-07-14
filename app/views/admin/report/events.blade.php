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
    Отчетность по заявкам
@stop


@section('content')
<p class="pull-right">
</p>


{{ Form::open(array('to' => 'report/orders', 'role' => 'form', 'class' => 'width90 form-inline', 'id'=>'')) }}

<p>
    {{ Form::label('По каким событиям сделать отчет?') }}
    <select id="events" name="type">
        <option value="0">Ожидающие события</option>
        <option value="1">Просроченные события</option>
        <option value="2">Выполненные события</option>
    </select>
</p>

<p>
{{ Form::label('Начало периода') }}
{{ Form::text('t_begin',null,array('id'=>'datepick','class'=>'datepick form-control','placeholder'=>'Кликните для выбора даты')) }}
</p>

<p>
{{ Form::label('Конец периода') }}
{{ Form::text('t_end',null,array('id'=>'datepick','class'=>'datepick form-control','placeholder'=>'Кликните для выбора даты')) }}
</p>



<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
</p>

{{ Form::close() }}
@if (isset($events))
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
                            <th>Глобальное состояние</th>
                            <th>Создано</th>
                            <th>Статус</th>
                            <th>Оператор</th>
                            <th>Начало события</th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach ( $events as $key => $user)
                        <tr>
                            <td><a href='{{ URL::route("order/edit", array($user->order_id)) }}'>{{ $user->id }}</a></td>
                            <td><a href='{{ URL::route("order/edit", array($user->order_id)) }}'>{{ Helper::getStrGlobalStatus($user->global_status) }}</a></td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ Status::getName($user->status_id) }}</td>
                            <td>{{ User::getName($user->user_id) }} </td>
                            <td>{{ $user->date_begin }} </td>
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
@endif;

@stop

