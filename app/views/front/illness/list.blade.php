@extends('front')

@section('specialities')

@stop

@section('title')
{{ Helper::title() }}
{{ "Раздел заболеваний" }}
@stop

@section('description')
{{ "Страница со списком заболеваний" }}
@stop

@section('content')

@foreach($user as $user)
        <p class="h4_my_bold">{{ $user->specialisation }}</p>

                {{ $user->description }}

@endforeach

        <p class="h4_my_bold">Памятка пациента</p>

            @foreach($last_articles as $item)
            <h2><a href='{{ URL::route("library/article", array($item->id)) }}'> {{ $item->name }}</a></h2>
                    {{ substr($item->description,0,200) }}
            @endforeach

        <p class="h4_my_bold">{{ $user->specialisation }} – заболевания</p>


            @section('sidebar')

            <p class="h6_my_bold">Специальности</p>
            <ul class="list">
                @foreach($specialities as $key => $item)
                <li><a href='{{ URL::route("doctor", array($key)) }}'>{{ $item }}</a></li>
                @endforeach
            </ul>

            @stop


@stop




