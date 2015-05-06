@extends('front')

@section('specialities')

@stop



@section('content')

        <p class="h4_my_bold">{{ $user->specialisation }}</p>

                {{ $user->description }}


        <p class="h4_my_bold">Памятка пациента</p>

            @foreach($last_articles as $item)
            <h2><a href='{{ URL::route("library/article", array($item->link)) }}'> {{ $item->name }}</a></h2>
{{ substr($item->description,0,650) }}...
            @endforeach

        <p class="h4_my_bold">{{ $user->specialisation }} – заболевания</p>

        @foreach($illness as $item)
            <ul class="list">
                <li><a href='{{ URL::route("illness/detail", array($item->link)) }}'> {{ $item->name }}</a></li>
            </ul>
        @endforeach

            @section('sidebar')

            <p class="h6_my_bold">Специальности</p>
            <ul class="list">
                @foreach($specialities as $key => $item)
                <li><a href='{{ URL::route("doctor", array($key)) }}'>{{ $item }}</a></li>
                @endforeach
            </ul>

            @stop


@stop




