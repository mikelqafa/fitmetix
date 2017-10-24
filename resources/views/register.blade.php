<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{!! csrf_token() !!}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <meta property="og:image" content="{!! url($setting['logo']) !!}" />
    <meta property="og:title" content="{!! $setting['site_title'] !!}" />
    <meta property="og:type" content="Social Network" />
    <meta name="keywords" content="{!! $setting['meta_keywords'] !!}">
    <meta name="description" content="{!! $setting['meta_description'] !!}">
    <link rel="icon" type="image/x-icon" href="{!! url($setting['favicon']) !!}">
    <title>Register | {!! $setting['site_title'] !!}</title>
    <link href="{!! url('themes/default/assets/css/custom.css') !!}" rel="stylesheet">
    <link media="all" type="text/css" rel="stylesheet" href="{!! url('themes/default/assets/css/style.d843a54abab569eaede4ed3a69a9b943.css') !!}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js does not work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        function SP_source() {
            return "{!! url('/') !!}/";
        }
        var base_url = "{!! url('/') !!}/";
        var theme_url = "{!! url('themes/default/assets/') !!}";
    </script>
    <link href="http://fitmetix.com/themes/default/assets/css/flag-icon.css" rel="stylesheet">
    <script src="{!! url('themes/default/assets/js/main.7e099de1c2d4b4d95065cb1d66b3cb74.js') !!}"></script>
    <script src="{!! url('js/slider.min.js') !!}"></script>
    <style>
        .navbar.socialite { background: transparent;border: 1px solid transparent;margin-top: 40px;box-shadow: none !important; }
        .overlay { position:absolute;height:290px;background:#FFF;opacity:0.45;width:100%; }
        .bose { height: 100vh; }.logos { background:none !important; }
        @media (max-width: 499px) { .overlay{ height:550px; }.bose { height: 770px;}.logos { max-height:50px;background-image:none; } }
        @media (min-width: 500px) and (max-width: 970px) { .overlay{ height: 750px; }.bose { height: 820px;}.logos { max-height:50px;background-image:none; } }
        .navbar a { color: #fff !important; }
        @media (min-width: 970px) { .navbar-brand{ margin-right: 100px; }.bose-holder img { width: 100% !important; } }
        label, .conrol-label { color: #000 !important; }
        ::-webkit-input-placeholder {
            color: #0c000c;
        }
        :-moz-placeholder {
            color:    #0c000c;
            opacity:  1;
        }
        ::-moz-placeholder {
            color:    #0c000c;
            opacity:  1;
        }
        :-ms-input-placeholder {
            color:    #0c000c;
        }
        ::-ms-input-placeholder {
            color:    #0c000c;
        }
.footer-description .socialite-terms:nth-child(1) { border-top: 0px !important; }
    </style>
</head>
<body >
<div class="">
    <div class="bose">
        <nav class="navbar socialite navbar-default no-bg guest-nav">
            <div class="overlay"></div>
            <div class="container" style="position: relative !important;">
                <div class="col-sm-12 col-md-6">
                    <p class="text-center">
                        <a class="socialite" href="{!! url('/') !!}">
                            <img style="margin: 0 auto;" class="img-responsive logos" src="{!! url('setting/'.$setting['logo']) !!}" alt="Fitmetix" title="Fitmetix">
                        </a>
                    </p>
                    
                    <p class="text-center hidden-xs" style="font-size: 20px;">
                        <a href="{!! url('login') !!}">
                            Already have an account? Sign in
                        </a>
                    </p>
                    <p class="text-center visible-xs">
                        <a href="{!! url('login') !!}">
                            Already have an account? Sign in
                        </a>
                    </p>
                </div>
                <div class="col-sm-12 col-md-6" style="padding:5px 40px;">
                    <form method="POST" class="signup-form" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group required {{ $errors->has('name') ? ' has-error' : '' }}">
                                    {{ Form::text('name', NULL, ['class' => 'form-control', 'id' => 'name', 'placeholder'=> trans('auth.name')]) }}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            {{ $errors->first('name') }}
                                        </span>
                                    @endif
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group required {{ $errors->has('username') ? ' has-error' : '' }}">
                                    {{ Form::text('username', NULL, ['class' => 'form-control', 'id' => 'username', 'placeholder'=> trans('common.username')]) }}
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            {{ $errors->first('username') }}
                                        </span>
                                    @endif
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            @if(Setting::get('birthday') == "on")
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <div class="input-group date datepicker">
                                            <span class="input-group-addon addon-left calendar-addon">
                                              <span class="fa fa-calendar"></span>
                                            </span>
                                            {{ Form::text('birthday', NULL, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'datepicker1', 'placeholder' => 'Birthdate']) }}
                                            <span class="input-group-addon addon-right angle-addon">
                                              <span class="fa fa-angle-down"></span>
                                            </span>
                                        </div>
                                    </fieldset>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <fieldset class="form-group required {{ $errors->has('email') ? ' has-error' : '' }}">
                                    {{ Form::text('email', NULL, ['class' => 'form-control', 'id' => 'email', 'placeholder'=> 'email address']) }}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group required {{ $errors->has('gender') ? ' has-error' : '' }}">
                                    {{ Form::select('gender', array('female' => 'Female', 'male' => 'Male'), null, ['placeholder' => trans('auth.select_gender'), 'class' => 'form-control']) }}
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                            {{ $errors->first('gender') }}
                                        </span>
                                    @endif
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group required {{ $errors->has('password') ? ' has-error' : '' }}">
                                    {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder'=> trans('auth.password')]) }}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </fieldset>
                            </div>
                        </div>

                        <div class="row">
                            @if(Setting::get('city') == "on")
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        {{ Form::text('city', NULL, ['class' => 'form-control', 'placeholder' => trans('common.current_city')]) }}
                                    </fieldset>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @if(Setting::get('captcha') == "on")
                                <div class="col-md-12">
                                    <fieldset class="form-group{{ $errors->has('captcha_error') ? ' has-error' : '' }}">
                                        {!! app('captcha')->display() !!}
                                        @if ($errors->has('captcha_error'))
                                            <span class="help-block">
                    {{ $errors->first('captcha_error') }}
                  </span>
                                        @endif
                                    </fieldset>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <fieldset class="form-group{{ $errors->has('affiliate') ? ' has-error' : '' }}">
                                    @if(isset($_GET['affiliate']))
                                        {{ Form::text('affiliate', $_GET['affiliate'], ['class' => 'form-control', 'id' => 'affiliate', 'disabled' =>'disabled']) }}
                                        {{ Form::hidden('affiliate', $_GET['affiliate']) }}
                                    @else
                                        {{ Form::text('affiliate', NULL, ['class' => 'form-control', 'id' => 'affiliate', 'placeholder'=> trans('auth.affiliate_code')]) }}
                                    @endif

                                    @if ($errors->has('affiliate'))
                                        <span class="help-block">
                                            {{ $errors->first('affiliate') }}
                                        </span>
                                    @endif
                                </fieldset>
                            </div>
                        </div>

                        <p class="text-center">{{ Form::button(trans('auth.create'), ['type' => 'submit','class' => 'btn btn-success btn-submit']) }}</p>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </nav>
    </div>

    <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel">
        <div class="modal-dialog modal-likes" role="document">
            <div class="modal-content">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="margin-top: -110px;">
        <div class="footer-description">
            <div class="socialite-terms text-center">
                <a href="{!! url('/') !!}/login">LOGIN </a> 
               <!-- <a href="{!! url('/') !!}/register">Register</a>-->
               <!-- <a href="{!! url('/') !!}/page/about">about</a>-->
                <a href="{!! url('/') !!}/page/privacy"> - PRIVACY</a>
                <!--<a href="{!! url('/') !!}/page/disclaimer">disclaimer</a>-->
                <a href="{!! url('/') !!}/page/terms"> - TERMS</a>
                <a href="{!! url('/') !!}/contact"> - HELP</a>
                <span class="dropup pull-right">
			<a href="#" class="dropdown-toggle no-padding" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<span class="user-name"><span class="flag-icon flag-icon-us"></span></span> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
					<ul class="dropdown-menu">
						<li class=""><a href="#" class="switch-language" data-language="en">
																					<span class="flag-icon flag-icon-us"></span>English</a></li>
						<li class=""><a href="#" class="switch-language" data-language="fr">
																					<span class="flag-icon flag-icon-fr"></span>French</a></li>
						<li class=""><a href="#" class="switch-language" data-language="es">
																					<span class="flag-icon flag-icon-es"></span>Spanish</a></li>
						<li class=""><a href="#" class="switch-language" data-language="it">
																					<span class="flag-icon flag-icon-it"></span>Italian</a></li>
						<li class=""><a href="#" class="switch-language" data-language="tr">
																					<span class="flag-icon flag-icon-tr"></span>Turkish</a></li>
						<li class=""><a href="#" class="switch-language" data-language="de">
																					<span class="flag-icon flag-icon-de"></span>German</a></li>
					</ul>
		</span>
            </div>

            <div class="socialite-terms text-center">
                Copyright &copy; 2017 {!! $setting['site_name'] !!}. All Rights Reserved
            </div>
        </div>
    </div>

    <script src="{!! url('themes/default/assets/js/app.js') !!}"></script>
    <script>
        $(".bose").bose({
            images : [ "{!! url('images/4.jpg') !!}", "{!! url('images/3.jpeg') !!}", "{!! url('images/2.jpeg') !!}"],
            startIndex   : 0,
            transition   : 'fade',
            autofit      : true
        });
    </script>
</body>
</html>