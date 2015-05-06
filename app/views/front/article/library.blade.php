@extends('front')

@section('specialities')

@stop



@section('content')

        <p class="h4_my_bold">Справочник пациента</p>

                <div class="specialisations">
                    <ul class="list">
                        @foreach($specialisations2 as $key => $item)
                        <h5>
                            <li>
                                <a href='{{ URL::route("library/specialisation", array($item->specialisation_alias)) }}'> {{ $item->specialisation }}</a>

                                <div class="pull-right">{{ $count = Article::where('speciality_id','=',$item->id)->count() }}</div>
                            </li>
                        </h5>

                        @endforeach

                    </ul>

                </div>


        <p class="h4_my_bold">Новые статьи</p>

            @foreach($last_articles as $item)
                    <h2><a href='{{ URL::route("library/article", array($item->link)) }}'> {{ $item->name }}</a></h2>
                        {{ substr($item->description,0,650) }}...
            @endforeach

            <?php //echo $last_articles->links(); ?>

            @section('sidebar')

            <p class="h6_my_bold">Специальности</p>
            <ul class="list">
                @foreach($specialities as $key => $item)
                <li><a href='{{ URL::to("doctor/doctors", array($key)) }}'>{{ $item }}</a></li>
                @endforeach
            </ul>


            @stop


@stop




