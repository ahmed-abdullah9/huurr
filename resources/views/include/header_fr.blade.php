<!DOCTYPE html>

<html lang="en">

<head>
 <meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<title><?php echo (isset($title)?$title:'Home') ?> | Huurr</title>

<!-- Bootstrap core CSS -->

<link href="<?php echo asset('/admin_assets/'); ?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo asset('/admin_assets/'); ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo asset('/admin_assets/'); ?>/css/animate.min.css" rel="stylesheet">



    @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')

        <link href="<?php echo asset('/admin_assets') ?>/css/custom-rtl.css" rel="stylesheet">

    @else

        <link href="<?php echo asset('/cl_assets') ?>/css/custom.css" rel="stylesheet">

    @endif


<link href="<?php echo asset('/admin_assets') ?>/css/icheck/flat/green.css" rel="stylesheet">

<link href="<?php echo asset('/admin_assets') ?>/css/calendar/fullcalendar.css" rel="stylesheet">

<link href="<?php echo asset('/admin_assets') ?>/css/calendar/fullcalendar.print.css" rel="stylesheet" media="print">



<link href="<?php echo asset('/admin_assets') ?>/js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo asset('/admin_assets') ?>/js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo asset('/admin_assets') ?>/js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo asset('/admin_assets') ?>/js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo asset('/admin_assets') ?>/js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset('/cl_assets') ?>/css/custom-font-family.css" rel="stylesheet">
  @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')      
	  <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/bootstrap-rtl.min.css">   
  <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/rtl.css"> 
  
  @endif
  <script src="<?php echo asset('/fr_assets/'); ?>/js/jquery.min.js"></script>
<script>
    var BASE_URL ='<?php echo url('/');?>';
    var currency_symbol = '<?php echo Config::get('constants.constant.currency');?>';
</script>
    <link href="<?php echo asset('/cl_assets') ?>/css/custom-font-family.css" rel="stylesheet">
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('public/css/custom/custom_ar.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('public/css/custom/custom_en.css')}}">
    @endif
    <link href="<?php echo asset('/admin_assets/'); ?>/css/feed_back.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo asset('/admin_assets/'); ?>/js/feed_back.js" ></script>
    {{--//below for messaging templete--}}
    <meta name="robots" content="noindex">
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo asset('/new-design/') ?>/images/icons/favicon.ico"/>
    <link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <link rel="canonical" href="https://codepen.io/emilcarlsson/pen/ZOQZaV?limit=all&page=74&q=contact+" />
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>
    {{--<script src="https://use.typekit.net/hoy3lrg.js"></script>--}}
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'><link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
    <style class="cp-pen-styles">
        #frame {
            margin-bottom: 20px;
            min-width: 360px;
            max-width: 1200px;
            height: 92vh;
            min-height: 300px;
            max-height: 700px;
            background: #E6EAEA;
        }
        @media screen and (max-width: 360px) {
            #frame {
                width: 100%;
                height: 100vh;
            }
        }
        #frame #sidepanel {
            float: left;
            min-width: 280px;
            max-width: 340px;
            width: 40%;
            height: 100%;
            background: #2c3e50;
            color: #f5f5f5;
            overflow: hidden;
            position: relative;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel {
                width: 58px;
                min-width: 58px;
            }
        }
        #frame #sidepanel #profile {
            width: 80%;
            margin: 25px auto;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile {
                width: 100%;
                margin: 0 auto;
                padding: 5px 0 0 0;
                background: #32465a;
            }
        }
        #frame #sidepanel #profile.expanded .wrap {
            height: 210px;
            line-height: initial;
        }
        #frame #sidepanel #profile.expanded .wrap p {
            margin-top: 20px;
        }
        #frame #sidepanel #profile.expanded .wrap i.expand-button {
            -moz-transform: scaleY(-1);
            -o-transform: scaleY(-1);
            -webkit-transform: scaleY(-1);
            transform: scaleY(-1);
            filter: FlipH;
            -ms-filter: "FlipH";
        }
        #frame #sidepanel #profile .wrap {
            height: 60px;
            line-height: 60px;
            overflow: hidden;
            -moz-transition: 0.3s height ease;
            -o-transition: 0.3s height ease;
            -webkit-transition: 0.3s height ease;
            transition: 0.3s height ease;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap {
                height: 55px;
            }
        }
        #frame #sidepanel #profile .wrap img {
            width: 50px;
            border-radius: 50%;
            padding: 3px;
            border: 2px solid #e74c3c;
            height: auto;
            float: left;
            cursor: pointer;
            -moz-transition: 0.3s border ease;
            -o-transition: 0.3s border ease;
            -webkit-transition: 0.3s border ease;
            transition: 0.3s border ease;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap img {
                width: 40px;
                margin-left: 4px;
            }
        }
        #frame #sidepanel #profile .wrap img.online {
            border: 2px solid #2ecc71;
        }
        #frame #sidepanel #profile .wrap img.away {
            border: 2px solid #f1c40f;
        }
        #frame #sidepanel #profile .wrap img.busy {
            border: 2px solid #e74c3c;
        }
        #frame #sidepanel #profile .wrap img.offline {
            border: 2px solid #95a5a6;
        }
        #frame #sidepanel #profile .wrap p {
            float: left;
            margin-left: 15px;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap p {
                display: none;
            }
        }
        #frame #sidepanel #profile .wrap i.expand-button {
            float: right;
            margin-top: 23px;
            font-size: 0.8em;
            cursor: pointer;
            color: #435f7a;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap i.expand-button {
                display: none;
            }
        }
        #frame #sidepanel #profile .wrap #status-options {
            position: absolute;
            opacity: 0;
            visibility: hidden;
            width: 150px;
            margin: 70px 0 0 0;
            border-radius: 6px;
            z-index: 99;
            line-height: initial;
            background: #435f7a;
            -moz-transition: 0.3s all ease;
            -o-transition: 0.3s all ease;
            -webkit-transition: 0.3s all ease;
            transition: 0.3s all ease;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options {
                width: 58px;
                margin-top: 57px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options.active {
            opacity: 1;
            visibility: visible;
            margin: 75px 0 0 0;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options.active {
                margin-top: 62px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options:before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 8px solid #435f7a;
            margin: -8px 0 0 24px;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options:before {
                margin-left: 23px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options ul {
            overflow: hidden;
            border-radius: 6px;
        }
        #frame #sidepanel #profile .wrap #status-options ul li {
            padding: 15px 0 30px 18px;
            display: block;
            cursor: pointer;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li {
                padding: 15px 0 35px 22px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options ul li:hover {
            background: #496886;
        }
        #frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 5px 0 0 0;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li span.status-circle {
                width: 14px;
                height: 14px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
            content: '';
            position: absolute;
            width: 14px;
            height: 14px;
            margin: -3px 0 0 -3px;
            background: transparent;
            border-radius: 50%;
            z-index: 0;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li span.status-circle:before {
                height: 18px;
                width: 18px;
            }
        }
        #frame #sidepanel #profile .wrap #status-options ul li p {
            padding-left: 12px;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #profile .wrap #status-options ul li p {
                display: none;
            }
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-online span.status-circle {
            background: #2ecc71;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-online.active span.status-circle:before {
            border: 1px solid #2ecc71;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-away span.status-circle {
            background: #f1c40f;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-away.active span.status-circle:before {
            border: 1px solid #f1c40f;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-busy span.status-circle {
            background: #e74c3c;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-busy.active span.status-circle:before {
            border: 1px solid #e74c3c;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-offline span.status-circle {
            background: #95a5a6;
        }
        #frame #sidepanel #profile .wrap #status-options ul li#status-offline.active span.status-circle:before {
            border: 1px solid #95a5a6;
        }
        #frame #sidepanel #profile .wrap #expanded {
            padding: 100px 0 0 0;
            display: block;
            line-height: initial !important;
        }
        #frame #sidepanel #profile .wrap #expanded label {
            float: left;
            clear: both;
            margin: 0 8px 5px 0;
            padding: 5px 0;
        }
        #frame #sidepanel #profile .wrap #expanded input {
            border: none;
            margin-bottom: 6px;
            background: #32465a;
            border-radius: 3px;
            color: #f5f5f5;
            padding: 7px;
            width: calc(100% - 43px);
        }
        #frame #sidepanel #profile .wrap #expanded input:focus {
            outline: none;
            background: #435f7a;
        }
        #frame #sidepanel #search {
            border-top: 1px solid #32465a;
            border-bottom: 1px solid #32465a;
            font-weight: 300;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #search {
                display: none;
            }
        }
        #frame #sidepanel #search label {
            position: absolute;
            margin: 10px 0 0 20px;
        }
        #frame #sidepanel #search input {
            font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
            padding: 10px 0 10px 46px;
            width: calc(100% - 25px);
            border: none;
            background: #32465a;
            color: #f5f5f5;
        }
        #frame #sidepanel #search input:focus {
            outline: none;
            background: #435f7a;
        }
        #frame #sidepanel #search input::-webkit-input-placeholder {
            color: #f5f5f5;
        }
        #frame #sidepanel #search input::-moz-placeholder {
            color: #f5f5f5;
        }
        #frame #sidepanel #search input:-ms-input-placeholder {
            color: #f5f5f5;
        }
        #frame #sidepanel #search input:-moz-placeholder {
            color: #f5f5f5;
        }
        #frame #sidepanel #contacts {
            height: calc(100% - 177px);
            overflow-y: scroll;
            overflow-x: hidden;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts {
                height: calc(100% - 149px);
                overflow-y: scroll;
                overflow-x: hidden;
            }
            #frame #sidepanel #contacts::-webkit-scrollbar {
                display: none;
            }
        }
        #frame #sidepanel #contacts.expanded {
            height: calc(100% - 334px);
        }
        #frame #sidepanel #contacts::-webkit-scrollbar {
            width: 8px;
            background: #2c3e50;
        }
        #frame #sidepanel #contacts::-webkit-scrollbar-thumb {
            background-color: #243140;
        }
        #frame #sidepanel #contacts ul li.contact {
            position: relative;
            padding: 10px 0 15px 0;
            font-size: 0.9em;
            cursor: pointer;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts ul li.contact {
                padding: 6px 0 46px 8px;
            }
        }
        #frame #sidepanel #contacts ul li.contact:hover {
            background: #32465a;
        }
        #frame #sidepanel #contacts ul li.contact.active {
            background: #32465a;
            border-right: 5px solid #435f7a;
        }
        #frame #sidepanel #contacts ul li.contact.active span.contact-status {
            border: 2px solid #32465a !important;
        }
        #frame #sidepanel #contacts ul li.contact .wrap {
            width: 88%;
            margin: 0 auto;
            position: relative;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts ul li.contact .wrap {
                width: 100%;
            }
        }
        #frame #sidepanel #contacts ul li.contact .wrap span {
            position: absolute;
            left: 0;
            margin: -2px 0 0 -2px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 2px solid #2c3e50;
            background: #95a5a6;
        }
        #frame #sidepanel #contacts ul li.contact .wrap span.online {
            background: #2ecc71;
        }
        #frame #sidepanel #contacts ul li.contact .wrap span.away {
            background: #f1c40f;
        }
        #frame #sidepanel #contacts ul li.contact .wrap span.busy {
            background: #e74c3c;
        }
        #frame #sidepanel #contacts ul li.contact .wrap img {
            width: 40px;
            border-radius: 50%;
            float: left;
            margin-right: 10px;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts ul li.contact .wrap img {
                margin-right: 0px;
            }
        }
        #frame #sidepanel #contacts ul li.contact .wrap .meta {
            padding: 5px 0 0 0;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #contacts ul li.contact .wrap .meta {
                display: none;
            }
        }
        #frame #sidepanel #contacts ul li.contact .wrap .meta .name {
            font-weight: 600;
        }
        #frame #sidepanel #contacts ul li.contact .wrap .meta .preview {
            margin: 5px 0 0 0;
            padding: 0 0 1px;
            font-weight: 400;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            -moz-transition: 1s all ease;
            -o-transition: 1s all ease;
            -webkit-transition: 1s all ease;
            transition: 1s all ease;
        }
        #frame #sidepanel #contacts ul li.contact .wrap .meta .preview span {
            position: initial;
            border-radius: initial;
            background: none;
            border: none;
            padding: 0 2px 0 0;
            margin: 0 0 0 1px;
            opacity: .5;
        }
        #frame #sidepanel #bottom-bar {
            position: absolute;
            width: 100%;
            bottom: 0;
        }
        #frame #sidepanel #bottom-bar button {
            float: left;
            border: none;
            width: 50%;
            padding: 10px 0;
            background: #32465a;
            color: #f5f5f5;
            cursor: pointer;
            font-size: 0.85em;
            font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button {
                float: none;
                width: 100%;
                padding: 15px 0;
            }
        }
        #frame #sidepanel #bottom-bar button:focus {
            outline: none;
        }
        #frame #sidepanel #bottom-bar button:nth-child(1) {
            border-right: 1px solid #2c3e50;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button:nth-child(1) {
                border-right: none;
                border-bottom: 1px solid #2c3e50;
            }
        }
        #frame #sidepanel #bottom-bar button:hover {
            background: #435f7a;
        }
        #frame #sidepanel #bottom-bar button i {
            margin-right: 3px;
            font-size: 1em;
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button i {
                font-size: 1.3em;
            }
        }
        @media screen and (max-width: 735px) {
            #frame #sidepanel #bottom-bar button span {
                display: none;
            }
        }
        #frame .content {
            float: right;
            width: 60%;
            height: 100%;
            overflow: hidden;
            position: relative;
        }
        @media screen and (max-width: 735px) {
            #frame .content {
                width: calc(100% - 58px);
                min-width: 300px !important;
            }
        }
        @media screen and (min-width: 900px) {
            #frame .content {
                width: calc(100% - 340px);
            }
        }
        #frame .content .contact-profile {
            width: 100%;
            height: 60px;
            line-height: 60px;
            background: #f5f5f5;
        }
        #frame .content .contact-profile img {
            width: 40px;
            border-radius: 50%;
            float: left;
            margin: 9px 12px 0 9px;
        }
        #frame .content .contact-profile p {
            float: left;
        }
        #frame .content .contact-profile .social-media {
            float: right;
        }
        #frame .content .contact-profile .social-media i {
            margin-left: 14px;
            cursor: pointer;
        }
        #frame .content .contact-profile .social-media i:nth-last-child(1) {
            margin-right: 20px;
        }
        #frame .content .contact-profile .social-media i:hover {
            color: #435f7a;
        }
        #frame .content .messages {
            height: auto;
            min-height: calc(100% - 93px);
            max-height: calc(100% - 93px);
            overflow-y: scroll;
            overflow-x: hidden;
        }
        @media screen and (max-width: 735px) {
            #frame .content .messages {
                max-height: calc(100% - 105px);
            }
        }
        #frame .content .messages::-webkit-scrollbar {
            width: 8px;
            background: transparent;
        }
        #frame .content .messages::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.3);
        }
        #frame .content .messages ul li {
            display: inline-block;
            clear: both;
            float: left;
            margin: 15px 15px 5px 15px;
            width: calc(100% - 25px);
            font-size: 0.9em;
        }
        #frame .content .messages ul li:nth-last-child(1) {
            margin-bottom: 20px;
        }
        #frame .content .messages ul li.sent img {
            margin: 6px 8px 0 0;
        }
        #frame .content .messages ul li.sent p {
            background: #435f7a;
            color: #f5f5f5;
        }
        #frame .content .messages ul li.replies img {
            float: right;
            margin: 6px 0 0 8px;
        }
        #frame .content .messages ul li.replies p {
            background: #f5f5f5;
            float: right;
        }
        #frame .content .messages ul li img {
            width: 22px;
            border-radius: 50%;
            float: left;
        }
        #frame .content .messages ul li p {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 205px;
            line-height: 130%;
        }
        @media screen and (min-width: 735px) {
            #frame .content .messages ul li p {
                max-width: 300px;
            }
        }
        #frame .content .message-input {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 99;
        }
        #frame .content .message-input .wrap {
            position: relative;
        }
        #frame .content .message-input .wrap input {
            font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
            float: left;
            border: none;
            width: calc(100% - 90px);
            padding: 11px 32px 10px 8px;
            font-size: 0.8em;
            color: #32465a;
        }
        @media screen and (max-width: 735px) {
            #frame .content .message-input .wrap input {
                padding: 15px 32px 16px 8px;
            }
        }
        #frame .content .message-input .wrap input:focus {
            outline: none;
        }
        #frame .content .message-input .wrap .attachment {
            position: absolute;
            right: 60px;
            z-index: 4;
            margin-top: 10px;
            font-size: 1.1em;
            color: #435f7a;
            opacity: .5;
            cursor: pointer;
        }
        @media screen and (max-width: 735px) {
            #frame .content .message-input .wrap .attachment {
                margin-top: 17px;
                right: 65px;
            }
        }
        #frame .content .message-input .wrap .attachment:hover {
            opacity: 1;
        }
        #frame .content .message-input .wrap button {
            float: right;
            border: none;
            width: 50px;
            padding: 12px 0;
            cursor: pointer;
            background: #32465a;
            color: #f5f5f5;
        }
        @media screen and (max-width: 735px) {
            #frame .content .message-input .wrap button {
                padding: 16px 0;
            }
        }
        #frame .content .message-input .wrap button:hover {
            background: #435f7a;
        }
        #frame .content .message-input .wrap button:focus {
            outline: none;
        }
        .pace-inactive{
            display: none !important;
        }
        .pace{
            display: none !important;
        }
        @media screen and (min-width:768px) {
            .site_title {
                height: auto !important;
                padding-top:10px !important;
                width: 90% !important;
            }
            .profile{margin-top:40px !important;}
}
    </style>
     <script>
        var Lang= "<?php echo Lang::locale(); ?>";
     </script>

    {{--added by farhan--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
</head>


<body class="nav-md" style="font-family: Calibri;">

<div class="container body">

<div class="main_container">

<div class="col-md-3 left_col">

<div class="left_col scroll-view">

<div class="navbar nav_title" style="border: 0;"> <a href="<?php echo url('/fr/dashboard') ?>" class="site_title">
<img class=".img-responsive" src="<?php echo asset('/cl_assets') ?>/images/LOGO.png" width="170" height="40"></a> </div>

<div class="clearfix"></div>
<!-- menu prile quick info -->
<?php 
//$user_query = \DB::table('users')->where('user_id',Session::get('login_id'))->select('*')->first();
     //echo isset(Session::get('profile_image')) && !empty(Session::get('profile_image'))? url('/').'/'.Session::get('profile_image'):asset('/cl_assets/images/user.png'));
?>
<style>
    .upload_profile_image {
    position: relative !important;
    bottom: 0px;
    left: 38px;
    right: 0;
    margin: 0 auto;
    text-align: center;
    width: 100%;
    height: 24px;
    background:none  !important;
    padding: 2px  !important;
    top: -15px !important;
}
.img_icon{
    color:white !important;
}
.profile_image {
    position: relative !important;
    bottom: 0px;
    left: 38px;
    right: 0;
    margin: 0 auto;
    text-align: center;
    width: 100%;
    height: 24px;
    background: none !important;
    padding: 2px !important;
    top: -15px !important;

}
.img-circle.profile_img {
    width: 140px !important;
    padding: 0px !important;
    margin-left: 7% !important;
    height: 74px;
}
/*.site_title > img {*/
/*    width: 100px !important;*/
/*    height: 77px !important;*/
/*    position: relative !important;*/
/*    top: 10px !important;*/
/*}*/
.site_title {
    width: 100% !important;
}
</style>
<div class="profile">
  <div class="profile_pic">
  <a href="{{url('/edit/fr/profile')}}">
  <img src="<?php echo ((Session::get('profile_image') && !empty(Session::get('profile_image'))) ? url('/').'/'.Session::get('profile_image'):asset('/cl_assets/images/user.png')); ?>" alt="..." class="img-circle profile_img <?php echo  (Session::get('is_online')? 'online':'') ?> ">
  </a>
  </div>
  <div class="profile_info"> <span>{{ __('freelancer.Welcome') }}</span>
      <h2><?php echo  (Session::get('name')? Session::get('name'):'') ?> </h2>
      <a href="{{url('/edit/fr/profile')}}" class="profile_image"><i class="fa fa-pencil-square-o edite img_icon" style="padding-left: 35px;" aria-hidden="true"></i></a>
      <!--<a href="{{url('/edit/fr/profile')}}" class="upload_profile_image"><i class="fa fa-pencil-square-o edite img_icon" aria-hidden="true"></i></a>-->
      <input type="file" name="profile_image" id="profile_image" style="display: none;">
      <input type="hidden" id="profile_update_url" value="<?php echo url('/profileupdateImage/'); ?>">
  </div>
</div>
<!-- /menu prile quick info --> 

<br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
<div class="menu_section">

<ul class="nav side-menu" style="margin-top: 40%">
<?php   $user_data1=  \DB::table('users')->where('user_id',Session::get('login_id'))->first();
    $message_count=\DB::table('message')->where('receive_id',Session::get('login_id'))->where('receiver_seen',0)->count();
?>
<br/>
<li><a href="<?php echo url('/fr/dashboard'); ?>"><i class="fa fa-home"></i>{{ __('freelancer.Dashboard') }} </a></li>
  @if(!empty($user_data1->user_status)&&$user_data1->user_status==2||$user_data1->user_status==3)
    <!--<li><a href="<?php echo url('/edit/fr/profile')?>"><i class="fa fa-user"></i>{{ __('freelancer.Profile') }}</a></li>-->

    <li style="text-align: center; font-weight: bold; color: white">{{ __('freelancer.online/offline') }}</li>
    <li style="text-align: center">
      <label class="switch">
        <input type="checkbox" id="is_online_offline" name="is_online" value="1" <?php echo (Session::get('is_online')? 'checked':'') ?> >
        <span class="slider round"></span>
      </label>
    </li>
    <li><a href="<?php echo  url('logout') ?>"><i class="fa fa-sign-out pull-right"></i>{{ __('freelancer.LogOut') }}</a> </li>
  @else

    <li><a><i class="fa fa-desktop"></i>{{ __('freelancer.Works') }}  <span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu" style="display: none">
        <li><a href="<?php echo url('/find/work'); ?>">{{ __('freelancer.FindWork') }}</a> </li>
        <li><a href="<?php echo url('/saved/job'); ?>">{{ __('freelancer.SaveJobs') }}</a> </li>
        <li><a href="<?php echo url('/proposals'); ?>">{{ __('freelancer.Propossal') }}</a> </li>
        <li><a href="<?php echo url('my/job'); ?>">{{ __('freelancer.MyJobs') }}</a> </li>
      </ul>
    </li>
    <li><a><i class="fa fa-table"></i>{{ __('freelancer.Reports') }} <span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu" style="display: none">
        <li><a href="<?php echo url('/earning-by-client'); ?>">{{ __('freelancer.EarningsByClient') }}</a> </li>
         <li><a href="<?php echo url('/transaction-history'); ?>">{{ __('freelancer.History') }}</a> </li>
          <li><a href="<?php echo url('/fr_earning/by_client'); ?>">{{__('freelancer.fr_earning')}}</a> </li>
          <li><a href="<?php echo url('/fr_earning/report'); ?>">{{__('freelancer.report')}}</a> </li>
      </ul>
    </li>
    <!--<li><a href="<?php echo url('/edit/fr/profile')?>"><i class="fa fa-user"></i>{{ __('freelancer.Profile') }}</a></li>-->
        <li><a href="<?php echo url('/fr/bank_info')?>"><i class="fa fa-bank"></i>{{__('freelancer.bank')}}</a></li>
    <li><a href="<?php echo url('/frmessages') ?>"><i class="fa fa-envelope-o"></i>{{ __('freelancer.Messages') }} ({{$message_count}})</a> </li>
    <li style="text-align: center; font-weight: bold; color: white">{{ __('freelancer.online/offline') }} </li>
    <li style="text-align: center">
      <label class="switch">
        <input type="checkbox" id="is_online_offline" name="is_online" value="1" <?php echo (Session::get('is_online')? 'checked':'') ?> >
        <span class="slider round"></span>
      </label>
    </li>
    <li><a href="<?php echo  url('logout') ?>"><i class="fa fa-sign-out pull-right"></i>{{ __('freelancer.LogOut') }}</a> </li>



  @endif

</ul>
</div>
</div>
<!-- /sidebar menu --> 

</div>
</div>

<!-- top navigation -->

<div class="top_nav">
  <div class="nav_menu">
      @if(Session::has('message'))
          <script>
              jQuery(function(){
                  var ht='';
                  ht+="<p class='alert alert-success'><?php echo session('message');?></p>";
                  $('.common-messages').html('');
                  $('.common-messages').html(ht);
                  $("#common-messages").modal("show");
                  setTimeout(function(){
                      $('#common-messages').modal('hide')
                  }, 7000);
              });
          </script>
      @elseif(Session::has('info'))
          <script>
              jQuery(function(){
                  var ht='';
                  ht+="<p class='alert alert-danger'><?php echo session('info');?></p>";
                  $('.common-messages').html('');
                  $('.common-messages').html(ht);
                  $("#common-messages").modal("show");
                  setTimeout(function(){
                      $('#common-messages').modal('hide')
                  }, 7000);
              });
          </script>
      @endif


    <nav class="nav-md" role="navigation">
      <?php $lang = App::getLocale(); ?>
      <div class="nav toggle" <?php echo   (isset($lang) && $lang == 'ar') ? 'style="float:right"':'' ?>>  </div>


      <ul class="nav navbar-nav navbar-right" <?php echo  (isset($lang) && $lang == 'ar') ? 'style="float:left !important;width:13%"':'' ?>>
       
        <?php
        $notify = \DB::table('notifications')
                              ->join('users','users.user_id','=','notifications.sender_id')
                              ->where('notifications.receiver_id', Session::get('login_id'))
                              ->where('notifications.status',0)
                              ->select('notifications.message','notifications.id','users.name','notifications.created_at')
                                ->orderBy('id', 'DESC')
                              ->get()
                              ->toArray(); 
        ?>
        <li role="presentation" class="dropdown"> <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
		<i class="fa fa-bell"></i> <?php if(count($notify)>0){ ?><span class="badge bg-green"><?php echo count($notify); ?></span> <?php } ?> </a>
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
            <?php

            if(empty($notify))
            { ?>
              <li><a>There Is no Any Notification</a></li>
            <?php
            }
            else
            {
              foreach ($notify as $nt)
              {
                $datetime1 = new DateTime($nt->created_at);
                $datetime2 = new DateTime(date('Y-m-d h:i:s'));
                $interval = $datetime1->diff($datetime2);
                $time_act = (($interval->format('%y')!=0)?$interval->format('%y')." Year ":"");
                $time_act .= (($interval->format('%m')!=0)?$interval->format('%m')." Month ":"");
                $time_act .= (($interval->format('%d')!=0)?$interval->format('%d')." Days ":"");
                $time_act .= (($interval->format('%h')!=0)?$interval->format('%h')." Hours ":"");
                $time_act .= (($interval->format('%i')!=0)?$interval->format('%i')." Minutes":"");
                // echo '<li> <span> <span><b>'.$nt->name.'</b></span>&nbsp;&nbsp;&nbsp; <span class="time"><b>'.$time_act.'</b></span> </span><br> <span class="message"> '.$nt->message.' </span> <a class="delete_notify" style="text-align: right;cursor: pointer;font-size: 16px;" data-notify_id="'.$nt->id.'">X</a> </li>';
                echo '<li> <span> <span><b>'.$nt->name.'</b></span>&nbsp;&nbsp;&nbsp; </span><br> <span class="message"> '.$nt->message.' </span> <a class="delete_notify" style="text-align: right;cursor: pointer;font-size: 16px;" data-notify_id="'.$nt->id.'">X</a> </li>';
              }
            } ?>
          </ul>
        </li>
        
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
          
      </ul>


    </nav>
  </div>
</div>

<!-- Cropping modal -->
<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" type="button">&times;</button>
        <h4 class="modal-title" id="avatar-modal-label">{{ __('freelancer.ChangeAvatar') }}</h4>
      </div>
      <div class="modal-body">
        <div class="avatar-body">

          <!-- Upload image and data -->
          <div class="avatar-upload">
            <input class="avatar-src" name="avatar_src" type="hidden">
            <input class="avatar-data" name="avatar_data" type="hidden">
            <label for="avatarInput">{{ __('freelancer.LocalUpload') }}</label>
            <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
          </div>
                              </div>
      </div>
      <!-- <div class="modal-footer">
                              <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                            </div> -->
    </form>
  </div>
</div>
</div>
                  
                  
    <div class="modal fade" id="common-messages" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body common-messages">
                    <p>This is a small modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- /top navigation --> 

<!-- page content -->
<div class="right_col container-fluid" style="min-height: 339px;padding-bottom: 20px;" role="main">
<div class="">