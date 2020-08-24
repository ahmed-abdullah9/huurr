<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo (isset($title)?$title:'Home') ?> | Huurr</title>

<base href="<?php echo url('/'); ?>">
<!-- Bootstrap core CSS -->
    <script>
        var BASE_URL ='<?php echo url('/');?>';
        var Lang= "<?php echo Lang::locale(); ?>";
    </script>
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
<script src="<?php echo asset('/cl_assets') ?>/js/jquery.min.js"></script>


<link href="<?php echo asset('/admin_assets') ?>/js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo asset('/admin_assets') ?>/js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo asset('/admin_assets') ?>/js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo asset('/admin_assets') ?>/js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo asset('/admin_assets') ?>/js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

  @if(LaravelLocalization::getCurrentLocaleDirection() == 'rtl')      
	  <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/bootstrap-rtl.min.css">   
  <link rel="stylesheet" href="<?php echo asset('/rtl_design/') ?>/assets/css/rtl.css"> 
  
  @endif
    {{--by farham--}}
    <link href="<?php echo asset('/cl_assets') ?>/css/custom-font-family.css" rel="stylesheet">
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('public/css/custom/custom_ar.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('public/css/custom/custom_en.css')}}">
    @endif

    <script src="<?php echo asset('/cl_assets') ?>/js/moment/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <style>
        .thumb {
            height: 75px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
        }
        @media screen and (min-width:768px) {
            .site_title {
                height: auto !important;
                padding-top:10px !important;
                width: 90% !important;
                margin-left: auto !important;
            }
            .profile{margin-top:40px !important;}
        }
    </style>
</head>


<body class="nav-md" style="font-family: Calibri;">

<div class="container body">

<div class="main_container">

<div class="col-md-3 left_col">

<div class="left_col scroll-view">

<div class="navbar nav_title" style="border: 0;"> <a href="<?php echo url('/dashboard') ?>" class="site_title">
<img class="img-responsive" src="<?php echo asset('/cl_assets') ?>/images/LOGO.png" width="170" height="40" style="padding-left:30px;"></a> </div>

<div class="clearfix"></div>

  <?php 
$user_query = \DB::table('users')->where('user_id',Session::get('login_id'))->select('*')->first();
$user_profile = \DB::table('user_profile')->where('user_id',Session::get('login_id'))->select('*')->first();
?>

<!-- menu prile quick info -->
<div class="profile">
  <div class="profile_pic">
  <img src="<?php echo ((isset($user_profile->profile_image) && !empty($user_profile->profile_image))?url('/').'/'.$user_profile->profile_image:asset('/fr_assets/images/user.png')); ?>" alt="..." class="img-circle profile_img"> </div>
  <div class="profile_info"> <span>{{ __('admin.Welcome') }}</span>
    <h2 class="margin_r30"><?php echo ((isset($user_query->name) && !empty($user_query->name))?$user_query->name:''); ?></h2>
	<span>{{ __('admin.General') }}</span>
  </div>
</div>
<!-- /menu prile quick info --> 

<br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
<div class="menu_section">
<ul class="nav side-menu">
<li><a  href="<?php echo url('/dashboard')?>"><i class="fa fa-home"></i>{{ __('admin.Dashboard') }}</a></li>
{{--<li><a href="{{ url('categories') }}"><i class="fa fa-file"></i>{{ __('admin.ManageCategory') }}</a></li>--}}
{{--<li><a href="{{ url('profetionls') }}"><i class="fa fa-file"></i>{{ __('admin.ManageProfessionals') }}</a></li>--}}
    <li><a href="{{ url('manage_skills') }}"><i class="fa fa-file"></i>{{ __('admin.ManageCategory') }}</a> </li>
    {{--<li><a href="{{ url('testmail') }}"><i class="fa fa-user"></i>testmail</a></li>--}}
<li><a href="{{ url('manage_qouts') }}"><i class="fa fa-file"></i>{{ __('admin.Manageqouts') }}</a> </li>
    <li><a href="{{ url('detail/allUsers') }}"><i class="fa fa-user"></i>{{__('admin.users_detail')}}</a></li>
<li><a href="{{ url('manage/client') }}"><i class="fa fa-user"></i>{{ __('admin.ManageClient') }}</a></li>
<li><a href="{{ url('manage/freelancer') }}"><i class="fa fa-user"></i>{{ __('admin.ManageFreelancer') }}</a> </li>
    <li><a href="{{ url('manage/team') }}"><i class="fa fa-user"></i>{{ __('admin.ManageTeam') }}</a> </li>
    <li><a href="{{ url('manage/portfolio') }}"><i class="fa fa-file"></i>{{ __('admin.ManagePortfolio') }}</a> </li>
    <li><a href="{{ url('jobs/claimjobs') }}"><i class="fa fa-file"></i>{{__('admin.claim_jobs')}}</a> </li>
    <li><a href="{{ url('jobs/invoices') }}"><i class="fa fa-file"></i>{{__('admin.total_job_invoices')}}</a> </li>
    <li><a href="{{ url('withdraw/requests') }}"><i class="fa fa-file"></i>{{__('admin.withdraw_request')}}</a> </li>
    <li><a href="{{ url('withdraw/money') }}"><i class="fa fa-file"></i>{{__('admin.withdraw_money')}}</a> </li>
<li><a href="{{ url('update/option') }}"><i class="fa fa-cogs"></i>{{ __('admin.AdminOption') }}</a></li>

  <li><a href="<?php echo  url('logout') ?>"><i class="fa fa-sign-out"></i>{{ __('admin.LogOut') }}</a> </li>
</div>
</div>
<!-- /sidebar menu --> 

<!-- /menu footer buttons -->
</div>
</div>

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">

    <nav class="" role="navigation">

      <div style="display: none;" class="nav toggle"> <a id="menu_toggle"><i class="fa fa-bars"></i></a>
</div>
      <ul class="nav navbar-nav left">

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

        <li role="presentation" class="dropdown">
		<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
		<i class="fa fa-bell fa-5x"></i> <?php if(count($notify)>0){ ?><span class="badge bg-green"><?php echo count($notify); ?></span> <?php } ?> </a>

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

                echo '<li> <span> <span><b>'.$nt->name.'</b></span>&nbsp;&nbsp;&nbsp; <span class="time"><b>'.$time_act.'</b></span> </span><br> <span class="message"> '.$nt->message.' </span> <a class="delete_notify" style="text-align: right;cursor: pointer;font-size: 16px;" data-notify_id="'.$nt->id.'">X</a> </li>';

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
<!-- /top navigation --> 

<!-- page content -->
<div class="right_col container-fluid" style="padding-bottom: 30px;" role="main" >
  <div class=""> 
  