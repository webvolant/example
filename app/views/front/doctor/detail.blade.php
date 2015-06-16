<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 20.01.15
 * Time: 23:18
 */
?>
@extends('front')

    @section('head')
    @parent
    @show


@section('title')
    {{ Helper::title() }}
    {{ "Врач - ".$user->fio }}
@stop

@section('description')
    {{ $user->description }}
@stop

    @section('specialities')
    @show


@section('content')
<div class="col-xs-12 col-sm-12 col-md-9">

<p>
    <?php //var_dump($errors->first('msg')); ?>
    @if($errors->first('msg'))
    <h4><div class="alert alert-success" role="alert">{{ $errors->first('msg') }}</div></h4>
    @endif

    <?php //var_dump($errors->first('err')); ?>
    @if($errors->first('error_status'))
        <h4><div class="alert alert-danger" role="alert">{{ $errors->first('error_status') }}</div></h4>
        <script type="text/javascript">
            $(document).ready(function() {

            //window.alert('hel');
                swal({
                    title: 'Отзыв не принят',
                    text: 'Ошибка',
                    type: 'error',
                    confirmButtonText: 'Закрыть'
                });
            });
        </script>
    @endif

</p>

<?php
$grafik_arr = explode(";", $user->grafik);
?>


                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2">
                        @if ($user->logo)
                            <div class="intro_doctor_image">
                                {{ HTML::image($user->logo,'doctor',array('class' => 'img-responsive')) }}
                            </div>
                        @else
                            <div class="intro_doctor_image">

                            </div>
                        @endif
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="intro_doctor_info">

                            <p class="h3_my"><?php $f = substr($user->fio,0,strpos($user->fio," ")); $name = substr($user->fio,strpos($user->fio," ")) ?><?php echo $f; ?>
                            <?php echo $name; ?></p>

                            <p>@foreach ( $user->Specialities as $key => $sp) {{ $sp->name }}; @endforeach<br/>
                                Стаж: {{ $user->experience }} <?php echo strstr(Lang::choice('mydoc.experience', $user->experience, ['n' => $user->experience], 'ru'),"  "); ?>
                                / {{ $user->rang }}
                                <!-- @foreach ( $user->Specialities as $key => $sp) {{ $sp->specialisation }} @endforeach --></p>

                            <p class="h6_my_bold">Стоимость приема - {{ $user->price }}с. <p id="price_include" data-toggle="modal" data-target="#basicModal" class="btn btn-info btn-sm" ><span class="glyphicon glyphicon-edit"></span> Что входит в прием?</p></p>

                            <div class="modal fade" id="basicModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                                            <h4 class="modal-title" id="myModalLabel">Что входит в прием?</h4>
                                        </div>
                                        <div class="modal-body">

                                            <p>В прием стоимостью {{ $user->price }} с. входит: <h4>{{ $user->price_include }}</h4></p>
                                        </div>
                                        <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <p>{{ $user->description }}</p>

                            </div> <!--intro_doctor_info -->







                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="pull-left margin20">
                            @if ($user->count_otzivi)
                                <p class="orange_text_big">{{ $user->count_otzivi }}</p>
                                <p class="line0"><span><?php echo strstr(Lang::choice('mydoc.ot',  $user->count_otzivi, ['n' =>  $user->count_otzivi], 'ru'),"о"); ?></span></p>
                            @else
                                <p class="orange_text_big">0</p>
                                <p class="line0"><span> <?php echo strstr(Lang::choice('mydoc.ot',  0, ['n' =>  0], 'ru'),"о"); ?></span></p>
                            @endif
                        </div>
                        <div class="pull-left margin20">
                            @if ($user->rating)
                                <p class="orange_text_big">{{ round($user->rating,1) }}</p>
                                <p class="line0"><span>рейтинг</span></p>
                            @else
                                <p class="orange_text_big">1</p>
                                <p class="line0"><span>рейтинг</span></p>
                            @endif
                        </div>
                        <p></p>



                        <p id="price_include" data-toggle="modal" data-target="#zapis_na_priem" class="btn btn-success" ><span class="glyphicon glyphicon-edit"></span> Онлайн запись</p></p>

                        <div class="modal fade" id="zapis_na_priem" tabindex="-1" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header"><button class="close" type="button" data-dismiss="modal">x</button>
                                        <h4 class="modal-title" id="myModalLabel">Запишитесь на прием к этому врачу<br/>
                                            <span class="blue_text">по тел.: 0 (312) 986 900</span></h4>
                                    </div>
                                    <div class="modal-body">


                                        <div class="form-group">
                                            <p class="h6_my">Врач: {{ $user->fio }}</p>

                                            <?php echo $errors->first('name'); ?>
                                            <p>{{ Form::label('Ваш номер телефона:') }}
                                            {{ Form::text('phone', null, array('required', 'pattern'=>"[0-9_-(_)]{9}", 'title'=>'Поле должно быть заполнено!', 'id'=>'phone', 'class' => ' form-control rfield', 'placeholder'=>'(___) __ __ __')) }}
                                            </p>


                                            {{ Form::hidden('doctor_id', "$user->id") }}

                                            <p>{{ Form::text('name', null, array('class' => ' form-control', 'placeholder'=>'Ваше имя')) }}</p>

                                            <p>
                                                {{ Form::radio('pacient', 'small'); }} Ребенок
                                            </p>
                                            <p>
                                                {{ Form::radio('pacient', 'big', true); }} Взрослый
                                            </p>

                                            <p><a href="" id="{{ $user->id }} "class="user_phone2_a">Добавить комментарий</a></p>
                                            <p>{{ Form::textarea('comment', null, array('class' =>'hidden2 form-control', 'id'=>"user_phone2_comment$user->id", 'placeholder'=>'Ваш комментарий')) }}</p>

                                            <p>{{ Form::submit( "Отправить", array('class' => 'btn_submit btn btn-warning submit_send_order_doctor')) }}</p>

                                        </div>


                                    </div>
                                    <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Отменить</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>







                </div>


<div class="car_grafik">
<?php

    //$date = date("Y-m-d");
    //echo "Сегодня: ".$date."<br>";
    //$yesterday = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
    //$month25 = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+25, date("Y")));
    //echo "Вчера: ".$yesterday;
    //echo "Спустя 25 дней: ".$month25.'<br/>';
    for ($i=0; $i < 10;$i++){
        echo '<div class="divs">';
        //echo $item;
        $day = date("d",mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y")));
        $month = date("n",mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y")));
        $tag = date("w",mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y")));



        if ($tag==1){
            $flag = 0;
            $hours = "";
            foreach($grafik_arr as $item)
                if (stristr($item,'Пн')){
                    $flag = 1;
                    $pos = strpos($item, "с");
                    $hours = substr($item, $pos);
                }
            if ($flag==1){
                echo '<br/>'.'Пн, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo $hours.'<br/>';
            }
            else
            {
                echo '<br/>'.'Пн, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo "Выходной день";
            }
        }

        elseif ($tag==2){
            $flag = 0;
            $hours = "";
            foreach($grafik_arr as $item)
                if (stristr($item,'Вт')){
                    $flag = 1;
                    $pos = strpos($item, "с");
                    $hours = substr($item, $pos);
                }
            if ($flag==1){
                echo '<br/>'.'Вт, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo $hours.'<br/>';
            }
            else
            {
                echo '<br/>'.'Вт, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo "Выходной день";
            }

        }

        elseif ($tag==3){
            $flag = 0;
            $hours = "";
            foreach($grafik_arr as $item)
                if (stristr($item,'Ср')){
                    $flag = 1;
                    $pos = strpos($item, "с");
                    $hours = substr($item, $pos);
                }
            if ($flag==1){
                echo '<br/>'.'Ср, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo $hours.'<br/>';
            }
            else
            {
                echo '<br/>'.'Ср, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo "Выходной день";
            }

        }
        elseif ($tag==4){
            $flag = 0;
            $hours = "";
            foreach($grafik_arr as $item)
                if (stristr($item,'Чт')){
                    $flag = 1;
                    $pos = strpos($item, "с");
                    $hours = substr($item, $pos);
                }
            if ($flag==1){
                echo '<br/>'.'Чт, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo $hours.'<br/>';
            }
            else
            {
                echo '<br/>'.'Чт, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo "Выходной день";
            }

        }
        elseif ($tag==5){
            $flag = 0;
            $hours = "";
            foreach($grafik_arr as $item)
                if (stristr($item,'Пт')){
                    $flag = 1;
                    $pos = strpos($item, "с");
                    $hours = substr($item, $pos);
                }
            if ($flag==1){
                echo '<br/>'.'Пт, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo $hours.'<br/>';
            }
            else
            {
                echo '<br/>'.'Пт, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo "Выходной день";
            }

        }
        elseif ($tag==6){
            $flag = 0;
            $hours = "";
            foreach($grafik_arr as $item)
                if (stristr($item,'Сб')){
                    $flag = 1;
                    $pos = strpos($item, "с");
                    $hours = substr($item, $pos);
                }
            if ($flag==1){
                echo '<br/>'.'Сб, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo $hours.'<br/>';
            }
            else
            {
                echo '<br/>'.'Сб, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo "Выходной день";
            }

        }
        elseif ($tag==0){
            $flag = 0;
            $hours = "";
            foreach($grafik_arr as $item)
                if (stristr($item,'Вс')){
                    $flag = 1;
                    $pos = strpos($item, "с");
                    $hours = substr($item, $pos);
                }
            if ($flag==1){
                echo '<br/>'.'Вс, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo $hours.'<br/>';
            }
            else{
                echo '<br/>'.'Вс, '.$day.' '.Helper::russian_date($month).'<br/>';
                echo "Выходной день";
            }


        }

        echo '</div>';
    }
    ?>
</div> <!-- график работы -->


<div class="review_info_orange">
                        <p class="h6_my">Общее мнение пациентов / по 1 отзыву</p>
                        <div class="col-md-3">
                            <p class="orange_text">Отлично</p>
                        </div>
                        <div class="col-md-3"><p class="margin3">Квалификация</p>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                        </div>
                        <div class="col-md-3"><p class="margin3">Внимание</p>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                        </div>
                        <div class="col-md-3"><p class="margin3">Цена-качество</p>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                            <span class="glyphicon glyphicon-star blau"></span>
                        </div>
                </div> <!-- на оранжевом отзывы для справки -->

                <div class="how-reviews hidden-reviews">  <!-- Как собираем отзывы -->
                    <h4 class="h4_my">Как мы собираем отзывы</h4>
                    <ul class="steps_list">
                        <li class="steps_item i-step-request">Мы записываем Вас к врачу</li>
                        <li class="steps_item i-step-doctor">Вы приходите на прием</li>
                        <li class="steps_item i-step-call">Мы звоним и спрашиваем Ваше мнение о враче</li>
                        <li class="steps_item i-step-review">И публикуем его в анкете врача</li>
                    </ul>

                    <p>
                        Отзывы собираются нами в ходе телефонного и электронного опроса пациентов, записавшихся на прием к врачу через портал my-doc.kg
                    </p>
                    <p>
                        Во избежание появления на портале рекламных или антирекламных отзывов мы публикуем только отзывы, полученные от людей, которые записывались к врачу через наш сервис.
                    </p>
                </div>

                <p class="pull-right margin10"><a href="" class="how-reviews-link">Как мы собираем отзывы</a></p>

<div class="row otzivi">
                <?php //var_dump($otzivi->count()); ?>
                <?php if ($otzivi->count()): ?>
                    <h4 class="h4_my">Отзывы пациентов о враче</h4>
                    <div class="reviews">
                        <?php foreach($otzivi as $item) { ?>
                            <div class="col-md-12">

                                <div class="col-md-3"><p>{{ $item->fio }}</p><p>{{ date("d-m-Y", strtotime($item->created_at)) }}</p>
                                </div>

                                    <div class="col-md-3"><p>Квалификация</p>
                                        <?php for ($i=1; $i <= 5; $i++){ ?>
                                            <?php if ($i <= $item->rang_qualif) { ?>
                                            <span class="glyphicon glyphicon-star blau"></span>
                                            <?php } else { ?>
                                            <span class="glyphicon glyphicon-star gray"></span>
                                            <?php } ?>
                                        <? } ?>
                                    </div>

                                    <div class="col-md-3"><p>Внимание</p>
                                        <?php for ($i=1; $i <= 5; $i++){ ?>
                                            <?php if ($i <= $item->rang_vnimanie) { ?>
                                                <span class="glyphicon glyphicon-star blau"></span>
                                            <?php } else { ?>
                                                <span class="glyphicon glyphicon-star gray"></span>
                                            <?php } ?>
                                        <? } ?>
                                    </div>

                                    <div class="col-md-3"><p>Цена-качество</p>
                                        <?php for ($i=1; $i <= 5; $i++){ ?>
                                            <?php if ($i <= $item->rang_price) { ?>
                                                <span class="glyphicon glyphicon-star blau"></span>
                                            <?php } else { ?>
                                                <span class="glyphicon glyphicon-star gray"></span>
                                            <?php } ?>
                                        <? } ?>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                    <p></p>
                            </div>
                            <div class="col-md-9">
                                <p>{{ $item->comment }}</p>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if (($count_otzivi - Helper::reviews_count()) > Helper::reviews_count()) { ?>
                        <a href="" class="more-reviews">Еще {{ $count_otzivi-Helper::reviews_count() }} <?php echo strstr(Lang::choice('mydoc.ot', $count_otzivi, ['n' => $count_otzivi], 'ru'),"о"); ?></a>
                    <?php } ?>
                <?php endif; ?>
</div> <!-- вывод двух отзывов -->


<div class="review">

    {{ Form::open(array('url' => 'order/otziv', 'role' => 'form', 'class' => 'form_otziv')) }}

    <div class="form-group">
        <h4 class="h4_my">Нам важно ваше мнение! Оставьте отзыв о приеме врача</h4>
        <p><span class="h8_my">Заполните пожалуйста все поля</span></p>


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4">
                <p>Квалификация</p>
                <p>
                    @if ($errors->first('reviewStars'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('reviewStars'); ?></div>
                @else
                @endif
                    <div id="reviewStars-input">
                        <input id="star-4" type="radio" name="reviewStars" value="5"/>
                        <label title="отлично" for="star-4"></label>

                        <input id="star-3" type="radio" name="reviewStars" value="4"/>
                        <label title="хорошо" for="star-3"></label>

                        <input id="star-2" type="radio" name="reviewStars" value="3"/>
                        <label title="удовлетворительно" for="star-2"></label>

                        <input id="star-1" type="radio" name="reviewStars" value="2"/>
                        <label title="плохо" for="star-1"></label>

                        <input id="star-0" type="radio" name="reviewStars" value="1"/>
                        <label title="очень плохо" for="star-0"></label>
                    </div>
                </p>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4">
                <p>Внимание</p>
                <p>
                    @if ($errors->first('reviewStars2'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('reviewStars2'); ?></div>
                @else
                @endif
                <div id="reviewStars2-input">
                    <input id="star-44" type="radio" name="reviewStars2" value="5"/>
                    <label title="отлично" for="star-44"></label>

                    <input id="star-33" type="radio" name="reviewStars2" value="4"/>
                    <label title="хорошо" for="star-33"></label>

                    <input id="star-22" type="radio" name="reviewStars2" value="3"/>
                    <label title="удовлетворительно" for="star-22"></label>

                    <input id="star-11" type="radio" name="reviewStars2" value="2"/>
                    <label title="плохо" for="star-11"></label>

                    <input id="star-00" type="radio" name="reviewStars2" value="1"/>
                    <label title="очень плохо" for="star-00"></label>
                </div>
                </p>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4">
                <p>Цена-качество</p>
                <p>
                    @if ($errors->first('reviewStars3'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('reviewStars3'); ?></div>
                @else
                @endif
                <div id="reviewStars3-input">
                    <input id="star-444" type="radio" name="reviewStars3" value="5"/>
                    <label title="отлично" for="star-444"></label>

                    <input id="star-333" type="radio" name="reviewStars3" value="4"/>
                    <label title="хорошо" for="star-333"></label>

                    <input id="star-222" type="radio" name="reviewStars3" value="3"/>
                    <label title="удовлетворительно" for="star-222"></label>

                    <input id="star-111" type="radio" name="reviewStars3" value="2"/>
                    <label title="плохо" for="star-111"></label>

                    <input id="star-000" type="radio" name="reviewStars3" value="1"/>
                    <label title="очень плохо" for="star-000"></label>
                </div>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <p>
                    @if ($errors->first('comment_doc'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('comment_doc'); ?></div>
                @else
                @endif
                {{ Form::textarea('comment_doc', null, array('class' => 'form-control review_form', 'id'=>'', 'placeholder'=>'Напишите здесь текст отзыва')) }}
                </p>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <p>
                    @if ($errors->first('name'))
                <div class="alert alert-danger" role="alert"><?php echo $errors->first('name'); ?></div>
                @else
                @endif
                {{ Form::text('name', null, array('class' => 'form-control', 'id'=>'', 'placeholder'=>'Ваше имя')) }}
                </p>

                <p>
                    @if ($errors->first('phone'))
                    <div class="alert alert-danger" role="alert"><?php echo $errors->first('phone'); ?></div>
                    @else
                    @endif
                    {{ Form::text('phone', null, array('required', 'pattern'=>"[0-9_-(_)]{9}", 'title'=>'Поле должно быть заполнено!', 'id'=>'phone_otziv', 'class' => ' form-control', 'placeholder'=>'0(___) __ __ __')) }}
                <span class="h8_my">Мы просим указать ваш телефон для контроля достоверности отзывов</span></p>


                {{ Form::hidden('doctor_id', "$user->id") }}
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
            <p class="text-center">{{ Form::submit( "Высказаться", array('class' => 'btn btn-lg btn-info')) }}</p>
            </div>
        </div>

    </div>

    {{ Form::close() }}

</div>  <!-- ФОРМА ввода отзыва -->


</div>

@stop






@section('sidebar')
    <div class="col-xs-12 col-sm-12 col-md-3">
        <p class="h4_my">Информация о враче</p>

        <p class="h6_my_bold">Местоположение</p>
        <div id="map">
            <?php echo "<html><head>".$map['js']."</head>".$map['html'] ?>
            @if ($user->klinika_name)
            <p class="h8_my space"><span class="glyphicon glyphicon-map-marker"></span> {{ $user->klinika_name }}  </p>
            @endif
            @foreach ($kliniks as $item)
            <p class="h8_my space"><span class="glyphicon glyphicon-map-marker"></span> {{ $item->address }}  </p>
            @endforeach


        </div>

        <p class="h6_my_bold">Специализация</p>
        <p>@foreach ( explode(';',$user->profil) as $key => $sp) {{ $sp }}<br/> @endforeach</p>

        <p class="h6_my_bold">Образование</p>
        <p>{{ $user->education }}</p>

        <p class="h6_my_bold">Курсы и повышение квалификации</p>
        <p>{{ $user->qualif }}</p>


        <ul class="list">

        </ul>

    </div>
@stop