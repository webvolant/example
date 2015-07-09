<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>my-doc.kg - Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    {{ HTML::style('bower_components/bootstrap/dist/css/bootstrap.min.css') }}
    <!-- MetisMenu CSS -->
    {{ HTML::style('bower_components/metisMenu/dist/metisMenu.min.css') }}
    <!-- Custom CSS -->
    {{ HTML::style('dist/css/sb-admin-2.css') }}
    <!-- Custom Fonts -->
    {{ HTML::style('bower_components/font-awesome/css/font-awesome.min.css') }}
    {{ HTML::style('template.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="admin_background_login">
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-dashboard"></i> Контрольная Панель my-doc.kg</h3>
                    </div>
                    <div class="panel-body">
                                @yield('content','')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
{{ HTML::script('bower_components/jquery/dist/jquery.min.js') }}

<!-- Bootstrap Core JavaScript -->
{{ HTML::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}

<!-- Metis Menu Plugin JavaScript -->
{{ HTML::script('bower_components/metisMenu/dist/metisMenu.min.js') }}

<!-- Custom Theme JavaScript -->
{{ HTML::script('dist/js/sb-admin-2.js') }}


</body>

</html>

