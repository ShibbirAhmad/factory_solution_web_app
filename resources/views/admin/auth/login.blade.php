<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Production Software | Login </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets') }}/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('admin/bootstrap') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets') }}/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets') }}/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets') }}/css/forms/switches.css">
</head>
<body class="form">


<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="">Log In to <br> <a href="#"><span class="brand-name">MI. Production Software v1</span></a></h1>
    {{--                  `  <p class="signup-link">New Here? <a href="auth_register.html">Create an account</a></p>`--}}
                    {{ Form::open(['route'=>'login','method'=>'post','class'=>'text-left']) }}
                        <div class="form">
                            <div id="username-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                {{ Form::text('email',null,['class'=>'form-control'. ($errors->has('email') ? ' is-invalid' : null),'placeholder'=>'Ex. Email@gmail.com']) }}
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                {{ Form::password('password',null,['class'=>'form-control','placeholder'=>'Ex. Password','id'=>'password']) }}
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    {{ Form::button('Log in ',['type'=>'submit','class'=>'btn btn-primary']) }}
                                </div>
                            </div>

                            <div class="field-wrapper">
                                <a href="#" class="forgot-pass-link">Forgot Password?</a>
                            </div>
                        </div>
                    {{ Form::close() }}
                    <p class="terms-conditions">© {{ Date('Y') }} All Rights Reserved. <a href="https://mit.mohasagor.com" target="_blank">Mohasagor.com</a> is a product of Designreset.
                        <a href="javascript:void(0);">Cookie Preferences</a>, <a href="javascript:void(0);">Privacy</a>, and <a href="javascript:void(0);">Terms</a>.</p>

                </div>
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-image">
        </div>
    </div>
</div>


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('admin/assets') }}/js/libs/jquery-3.1.1.min.js"></script>
<script src="{{ asset('admin/bootstrap') }}/js/popper.min.js"></script>
<script src="{{ asset('admin/bootstrap') }}/js/bootstrap.min.js"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('admin/assets') }}/js/authentication/form-1.js"></script>

</body>
</html>
