@if(Session::get('login_id'))
  @if(Session::get('user_role')=='admin')
<?php
header('Location: dashboard');
exit;
?>
        @elseif(Session::get('user_role')=='client')
<?php
header('Location: cl/dashboard');
exit;
?>
@elseif(Session::get('user_role')=='freelancer')
<?php
header('Location: fr/dashboard');
exit;
?>
        @endif

        @endif
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo(isset($title) ? $title : __('homepage.huurr')); ?></title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo asset('/new-design/') ?>/images/icons/favicon.ico"/>

    <meta name="description" content="HUURR">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="<?php echo asset('/cl_assets') ?>/css/custom-font-family.css" rel="stylesheet">
    <!-- STYLES -->
    @if(LaravelLocalization::getCurrentLocaleDirection() == 'ltr')
        <link rel="stylesheet" href="<?php echo asset('/new-design/') ?>/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo asset('/new-design/') ?>/assets/css/flexslider.css">
        <link rel="stylesheet" href="<?php echo asset('/new-design/') ?>/assets/css/animsition.min.css">
        <link rel="stylesheet" href="<?php echo asset('/new-design/') ?>/assets/css/style.css">
        <link rel="stylesheet" href="<?php echo asset('/new-design/') ?>/assets/css/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo asset('/new-design/') ?>/assets/css/owl.theme.css">
    
    @else(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
        <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/flexslider.css">
        <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/animsition.min.css">
        <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/style.css">
        <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/owl.theme.css">
        <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/bootstrap-rtl.min.css">
        <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/rtl.css">
    @endif
     <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/jquery-2.2.3.min.js"></script>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="<?php echo asset('/cl_assets/') ?>/auto/content/styles.css">
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('public/css/custom/custom_ar.css')}}">
        @else
        <link rel="stylesheet" href="{{asset('public/css/custom/custom_en.css')}}">
    @endif
    <script>
        var Lang= "<?php echo Lang::locale(); ?>";
    </script>
    <style>
        .flex-next{
            font-size: 11px !important;
            padding-top: 10px !important;
        }
        .flex-prev{
            font-size: 11px !important;
            padding-top: 10px !important;
        }
    </style>
</head>

<body class="animsition">
<!-- Border -->
<span class="frame-line top-frame visible-lg"></span>
<span class="frame-line right-frame visible-lg"></span>
<span class="frame-line bottom-frame visible-lg"></span>
<span class="frame-line left-frame visible-lg"></span>
<!-- HEADER  -->
<header class="main-header"  style="z-index: 999;">
    <div class="container-fluid">
        <!-- box header -->
        <div class="box-header box-header-small" style="position: fixed;top: 30px;">
            <div class="row box-logo">
                <div class="col-md-3 col-lg-3 col-xs-3 col-sm-3">
                    <a href="<?php echo url('/') ?>/">
                        <img src="<?php echo asset('/new-design/') ?>/assets/img/logo.png" alt="Logo" style="padding-bottom:19px;" width="109" height="88"></a>
                </div>
                <div class="col-md-9 col-lg-9 col-xs-9 col-sm-9">
                    <ul class="pull list-inline" style="padding-top: 20px;">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if ($localeCode != LaravelLocalization::getCurrentLocale())
                                <li>
                                    <a rel="alternate" hreflang="{{ $localeCode }}"
                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        <li><a href="<?php echo url('/contact_us') ?>">{{ __('homepage.contact') }}</a></li>
                        <li>
                           <span class="pull-login-link">
                    @if(!Session::get('login_id'))
                                   <a href="<?php echo url('/login') ?>"><b>{{ __('homepage.login') }}</b></a>

                                   /
                                   <a href="<?php echo url('/register') ?>"> <b>{{ __('homepage.regsiter') }}</b> </a>
                               @else
                                   <a href="<?php echo url('/logout') ?>"> <b>{{ __('homepage.logout') }}</b></a>
                               @endif
                </span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- box-nav -->
            {{--<a class="box-primary-nav-trigger" href="javascript:void(0);">--}}
                {{--<span class="box-menu-icon"></span>--}}
            {{--</a>--}}
            <!-- box-primary-nav-trigger -->
        </div>
        <!-- end box header -->

        <!-- nav -->
        <nav>
            <ul class="box-primary-nav">
                <br/>



                <?php $option = \DB::table('admin_option')->select('*')->first() ?>
            </ul>
        </nav>
        <!-- end nav -->

    </div>
  
</header>