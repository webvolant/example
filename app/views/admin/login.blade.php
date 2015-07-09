@extends('admin.login_template')
                            @section('content')
                            {{ Form::open(array('url' => 'admin/login', 'method'=>'post', 'role' => 'form', 'class' => 'form-signin')) }}

                            <p>
                                <a href="{{ URL::to('/') }}"><i class="fa fa-arrow-left"></i> <?php echo "На сайт" ?></a>
                            </p>
<p>
<?php echo $errors->first('role'); ?>
</p>


<div class="form-group has-feedback">
                @if ($errors->first('email'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                <?php echo $errors->first('email'); ?>
                                            </div>
                @else
                @endif
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=>'email')) }}

</div>

<div class="form-group has-feedback">
                @if ($errors->first('pass'))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php echo $errors->first('pass'); ?>
                </div>
                @else
                @endif
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    {{ Form::password('pass', array('class' => 'form-control', 'placeholder'=>'пароль')) }}

</div>

<div class="form-group has-feedback">
                {{ Form::submit("Войти", array('class' => 'btn btn-lg btn-success btn-block')) }}
</div>

                            {{ Form::close() }}
                            @stop

