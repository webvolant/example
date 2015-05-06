@extends('admin.login_template')
                            @section('content')
                            {{ Form::open(array('url' => 'admin/login', 'method'=>'post', 'role' => 'form', 'class' => 'form-signin')) }}

                            <p>
                                <a href="{{ URL::to('/') }}"><?php echo "На сайт" ?></a>
                            </p>
<p>
<?php echo $errors->first('role'); ?>
</p>


<p>
                @if ($errors->first('email'))
                    <div class="alert alert-warning">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                <?php echo $errors->first('email'); ?>
                                                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'email')) }}
                                            </div>
                @else
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'email')) }}
                @endif
</p>

<p>
                @if ($errors->first('pass'))
                <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php echo $errors->first('pass'); ?>
                    {{ Form::password('pass', null, array('class' => 'form-control', 'placeholder'=>'пароль')) }}
                </div>
                @else
                {{ Form::text('pass', null, array('class' => 'form-control', 'placeholder'=>'пароль')) }}
                @endif
</p>

                            <p>{{ Form::submit("Отправить", array('class' => 'btn btn-lg btn-success btn-block')) }}</p>

                            {{ Form::close() }}
                            @stop

