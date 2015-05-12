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
    Редактирование заявки
@stop

@section('content')



<p class="pull-right">
<p id="event_include" data-toggle="modal" data-target="#basicModal" class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-edit"></span> Добавить событие</p>
</p>

<!-- add event -->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                <h4 class="modal-title" id="myModalLabel">Событие для заявки</h4>
            </div>
            <div class="modal-body">

                <p><h4></h4></p>

                {{ Form::open(array('url' => 'add/event', 'role' => 'form', 'class' => 'width90 form-horizontal', 'id'=>'formid-add-event')) }}

                <p>
                    @if ($errors->first('date_begin'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('date_begin'); ?></div>
                @else
                @endif
                {{ Form::label('Дата/время создания') }}
                {{ Form::text('date_begin',null,array('id'=>'datetimepicker_begin','class'=>'form-control','placeholder'=>'Кликните для выбора даты')) }}
                </p>

                <p>
                    @if ($errors->first('date_end'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('date_end'); ?></div>
                @else
                @endif
                {{ Form::label('Дата исполнения события') }}
                {{ Form::text('date_end',null,array('id'=>'datetimepicker_end','class'=>'form-control','placeholder'=>'Кликните для выбора даты')) }}
                </p>


                <p>
                    @if ($errors->first('comment'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('comment'); ?></div>
                @else
                @endif
                {{ Form::label('Комментарий') }}
                {{ Form::text('comment',null,array('class'=>'form-control','placeholder'=>'Комментарий')) }}
                </p>
                <p>
                    @if ($errors->first('status'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('status'); ?></div>
                @else
                @endif
                {{ Form::label('Статус события') }}
                {{ Form::select('status', $status, null, array('class' => 'form-control')) }}
                </p>

                <p>
                    @if ($errors->first('flag'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('flag'); ?></div>
                @else
                @endif
                {{ Form::label('Флаг события') }}
                {{ Form::select('flag', Helper::eventStatus(), null, array( 'class' => 'form-control')) }}
                </p>
                <p>
                    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
                </p>

                {{ Form::close() }}

                <p class="message"></p>

            </div>
            <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>

            </div>
        </div>
    </div>
</div>






{{ Form::model($order, array('action' => array('AdminOrderController@edit', $order->id), 'role' => 'form', 'class' => 'width90 form-horizontal')) }}

<p>
    @if ($errors->first('global_status'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('global_status'); ?></div>
@else
@endif
{{ Form::label('Глобальный статус') }}
{{ Form::select('global_status',Helper::globalStatus(),$order->global_status,array('class'=>'form-control')) }}
</p>

    <p>
        @if ($errors->first('client'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('client'); ?></div>
    @else
    @endif
    {{ Form::label('Привязка к клиенту') }}
    {{ Form::select('client',['NULL'=>'Ничего не выбрано'] + $clients,$order->client_id,array('id'=>'client','class'=>'form-control custom-scroll')) }}
    </p>

    <p>
        @if ($errors->first('doctor'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('doctor'); ?></div>
    @else
    @endif
    {{ Form::label('Привязка к доктору') }}
    {{ Form::select('doctor',['NULL'=>'Ничего не выбрано'] + $doctors,$order->doctor_id,array('id'=>'doctor','class'=>'form-control custom-scroll')) }}
    </p>

    <p>
        @if ($errors->first('klinika'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('klinika'); ?></div>
    @else
    @endif
    {{ Form::label('Привязка к клинике') }}
    {{ Form::select('klinika',['NULL'=>'Ничего не выбрано'] + $kliniks,$order->klinik_id,array('id'=>'klinika','class'=>'form-control custom-scroll')) }}
    </p>

    <p>
        @if ($errors->first('diag'))
    <div class="alert alert-danger" role="alert"><?php echo $errors->first('diag'); ?></div>
    @else
    @endif
    {{ Form::label('Привязка к диагностике') }}
    {{ Form::select('diag',['NULL'=>'Ничего не выбрано'] + $diags,$order->diag_id,array('id'=>'diag','class'=>'form-control custom-scroll')) }}
    </p>



<p>
    @if ($errors->first('comment'))
<div class="alert alert-danger" role="alert"><?php echo $errors->first('comment'); ?></div>
@else
@endif
{{ Form::label('Комментарий к заявке') }}
{{ Form::text('comment', null, array('class' => 'form-control', 'placeholder'=>'')) }}
</p>


<p>
    {{ Form::submit( "Отправить", array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::route('order/index') }}" class="btn btn-danger">Отмена</a>
</p>

{{ Form::close() }}


<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                События заявки
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>

                        <tr>
                            <th>id</th>
                            <th>Статус</th>
                            <th>Комментарий</th>
                            <th>Оператор</th>
                            <th>Создание</th>
                            <th>Исполнение</th>
                            <th><i class="fa fa-wrench fa-fw"></th>
                        </tr>

                        </thead>
                        <tbody>
                        @foreach ( $events as $key => $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ Helper::getStrEventStatus($user->flag) }}</td>
                            <td>{{ $user->comment }}</td>
                            <td>{{ User::getName($user->user_id) }}</td>
                            <td>{{ $user->date_begin }}</td>
                            <td>{{ $user->date_end }}</td>
                            <td class="gradeA">

                                <p id="event_include" data-toggle="modal" data-target="#basicModal-edit{{ $user->id }}" class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-edit"></span> Редактировать</p>

                                <!-- Edit event -->
                                <div class="modal fade" id="basicModal-edit{{ $user->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                                                <h4 class="modal-title" id="myModalLabel">Событие для заявки</h4>
                                            </div>
                                            <div class="modal-body">

                                                <p><h4></h4></p>

                                                {{ Form::model($user, array('url' => '/edit/event', $user->id, 'role' => 'form', 'class' => 'width90 form-horizontal formid-edit-event', 'id'=>'formid-edit-event'.$user->id)) }}

                                                <p>
                                                    @if ($errors->first('date_begin'))
                                                <div class="alert alert-danger" role="alert"><?php echo $errors->first('date_begin'); ?></div>
                                                @else
                                                @endif
                                                {{ Form::label('Дата/время создания') }}
                                                {{ Form::text('date_begin',null,array('disabled', 'id'=>'datetimepicker_begin','class'=>'form-control','placeholder'=>'Кликните для выбора даты')) }}
                                                </p>

                                                <p>
                                                    @if ($errors->first('date_end'))
                                                <div class="alert alert-danger" role="alert"><?php echo $errors->first('date_end'); ?></div>
                                                @else
                                                @endif
                                                {{ Form::label('Дата исполнения события') }}
                                                {{ Form::text('date_end',null,array('id'=>'datetimepicker_end_edit','class'=>'datepick form-control','placeholder'=>'Кликните для выбора даты')) }}
                                                </p>


                                                <p>
                                                    @if ($errors->first('comment'))
                                                <div class="alert alert-danger" role="alert"><?php echo $errors->first('comment'); ?></div>
                                                @else
                                                @endif
                                                {{ Form::label('Комментарий') }}
                                                {{ Form::text('comment',null,array('class'=>'form-control','placeholder'=>'Комментарий')) }}
                                                </p>

                                                <p>
                                                    @if ($errors->first('status'))
                                                <div class="alert alert-danger" role="alert"><?php echo $errors->first('status'); ?></div>
                                                @else
                                                @endif
                                                {{ Form::label('Статус события') }}
                                                {{ Form::select('status', $status, $user->status_id, array('disabled','class' => 'form-control')) }}
                                                </p>

                                                <p>
                                                    @if ($errors->first('flag'))
                                                <div class="alert alert-danger" role="alert"><?php echo $errors->first('flag'); ?></div>
                                                @else
                                                @endif
                                                {{ Form::label('Флаг события') }}
                                                {{ Form::select('flag', Helper::eventStatus(), $user->flag, array('class' => 'form-control')) }}
                                                </p>

                                                {{ Form::hidden('event_id', "$user->id") }}
                                                <p>
                                                    {{ Form::submit( "Отправить", array('class' => 'formid-edit-event btn btn-primary')) }}
                                                </p>

                                                {{ Form::close() }}

                                                <p class="message"></p>

                                            </div>
                                            <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
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