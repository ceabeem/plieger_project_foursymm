<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title> Login </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('assets/global/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('assets/global/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ asset('assets/pages/css/login-2.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" /> </head>
    <!-- END HEAD -->

    <body class=" login" >
        <!-- BEGIN LOGO -->
        <div class="logo" style="padding-top: 0px;margin-top: 30px">
                <img src="{{ asset('aa.png') }}" style="height: 90px" alt="" />
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content" style=" background-color: white;
        width: 400px;
        border: 5px solid white;
        border-radius: 5px;
        padding: 50px;
        margin: auto;">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" method="POST" action="{{ route('admin.login.submit') }}">
            {{ csrf_field() }}
                <div class="form-title">
                    <span class="form-title"style="font-size: 30px;font-family:'Open Sans', sans-serif;color:black">Welcome.</span>
                    <span class="form-subtitle"style="font-size: 20px;color:black">Please login.</span>
                 </div>
  
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="control-label">Email</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="email" value="{{ old('email') }}" placeholder="email" name="email" /> 
                    
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password"  autocomplete="off" placeholder="Password" name="password" />
                    
                </div>
                @if (count($errors))
                     @foreach($errors->all() as $error)
                     <strong>{!! $error !!}</strong><br>
                     @endforeach
                @endif
                <div class="form-actions">
                    <button type="submit" class="btn red btn-block uppercase">Login</button>
                </div>
                <div class="form-actions">
                    <div class="pull-left">
                        <label class="rememberme mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" style="color:black" name="remember" {{ old('remember') ? 'checked' : '' }} /><label style="color:black"> Remember me</label>
                            <span></span>
                        </label>
                    </div>
                    <div class="pull-right forget-password-block">
                        <a href="{{ route('password.request') }}" id="forget-password" class="forget-password" ><p style="color:blue;font-family: 'Open Sans', sans-serif;">Forgot Password?</p></a>
                    </div>
                </div>
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            
        </div>
        
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ asset('assets/pages/scripts/login.min.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>