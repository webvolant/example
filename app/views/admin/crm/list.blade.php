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
    История изменений на сайте
@stop


@section('content')
<p class="pull-right">

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
            <th>Данные до</th>
            <th>Данные после</th>
            <th>Объект</th>
            <th>user_id</th>
            <th><i class="fa fa-wrench fa-fw"></th>
        </tr>

    </thead>
    <tbody>
        @foreach ( $users as $key => $user)
            <tr>
                <td><a href=''>{{ $user->id }}</a></td>
                <td>
                    <?php //var_dump(unserialize($user->info_after));
                    var_dump(json_decode($user->info_before)) ?>

                    <?php foreach (json_decode($user->info_before) as $key => $item)
                    {
                        /*if (is_array($item)){
                            foreach ($item as $key2 => $item2){
                                echo '   '.$key2.' '.$item2.'<br/>';
                                    if (is_array($item2)){
                                        foreach ($item as $key3 => $item3)
                                            echo '   '.$key3.' '.$item3.'<br/>';
                                    }
                                    else{
                                        echo $key2.' '.$item2.'<br/>';
                                    }
                            }
                        }
                        else{
                            echo $key.' '.$item.'<br/>';
                        }*/
                    }
                    ?>
                </td>

                <td>
                    <?php //var_dump(unserialize($user->info_after));
                    var_dump(json_decode($user->info_after)) ?>

                    <?php foreach (json_decode($user->info_after) as $key => $item)
                    {
                        if (is_array($item)){
                            foreach ($item as $key2 => $item2)
                            echo '   '.$key2.' '.$item2.'<br/>';
                        }
                        else{
                            echo $key.' '.$item.'<br/>';
                        }
                    }
                    ?>
                </td>

                <td>{{ $user->object }}</td>

                <td>{{ User::getName($user->user_id) }}</td>
                <td class="gradeA">
                    <a href='' class="btn btn-info"><i class="fa fa-wrench fa-fw"></i></a>
                    <a href='' class="btn btn-danger"><i class="fa fa-trash-o fa-fw"></i></a>
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

