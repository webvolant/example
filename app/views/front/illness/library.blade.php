@extends('front')

@section('specialities')

@stop

@section('title')
{{ Helper::title() }}
{{ "Библиотека заболеваний" }}
@stop

@section('description')
{{ "заболевания" }}
@stop

@section('content')
<div class="col-xs-12 col-sm-12 col-md-10">
        <p class="h4_my_bold">Справочник пациента</p>

            <ul class="list column3">
                <?php $temp='А'; ?>
                @foreach($illness as $key => $item)

                    @if (substr($item->name, 0 , 2)!=substr($temp, 0, 2))
                        <h4><br/>{{ substr($item->name, 0 , 2) }} </h4>
                    @endif
                    <?php $temp = $item->name; ?>

                    <h5><li><a href='{{ URL::route("illness/detail", array($item->link)) }}'>{{ $item->name }}</a></li></h5>
                @endforeach
            </ul>
    </div>
<div class="col-xs-12 col-sm-12 col-md-2">
            @section('sidebar')

            <p class="h6_my_bold">Специальности</p>
            <ul class="list">
                @foreach($specialities as $key => $item)
                <li><a href='{{ URL::to("doctor/doctors", array($key)) }}'>{{ $item }}</a></li>
                @endforeach
            </ul>
</div>

            @stop


@stop




