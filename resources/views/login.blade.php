<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>SIRS</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/matrix-login.css') }}" />
        <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <link rel="icon" href="{{ asset('img/icon2.png') }}">

    </head>
    <body>
        <div id="loginbox"> 
            <form id="loginform" class="form-vertical" method="POST" action="{{ url('/login') }}">
                @if(Session::has('flash_message_error'))
                <div class="alert alert-danger" role="alert-block">
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
                @endif   

                @if(Session::has('flash_message_success'))
                <div class="alert alert-success" role="alert-block">
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
                @endif

                @csrf
                 <div class="control-group normal_text"> <h3><img src="{{ url('img/logo.png') }}" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Email" name="email" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="{{ url('/doctor') }}" class="btn btn-info">Doctor Schedule</a></span>
                    <span class="pull-right"><input value="Login" type="submit" class="btn btn-success" /></span>
                </div>
            </form>
        </div>
        
        <script src="{{ asset('js/jquery.min.js') }}"></script>  
        <script src="{{ asset('js/matrix.login.js') }}"></script>
        <script src="{{ asset('js/backend_js/bootstrap.min.js') }}"></script>  
    </body>

</html>