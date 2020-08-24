@include ('include/header_fr')
<?php
$lang = App::getLocale();
if(isset($lang) && $lang == 'ar') { ?>
<style> .tile-stats .icon { right: 154px;}</style>
<?php } ?>
<div class="row top_tiles">
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a style="text-decoration-line:none" href="<?php echo url('/my/job') ?>"> <div class="tile-stats">
      <div class="icon"><i class="fa fa-check"></i> </div>
      <div class="count"><?php echo (isset($completed_jobs) && !empty($completed_jobs)?$completed_jobs:0); ?></div>
        <h3 href="">{{ __('freelancer.FinishedWork') }}</h3>
      </div></a>
  </div>
  <div  class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
  <a style="text-decoration-line:none" href="<?php echo url('/proposals') ?>"><div class="tile-stats">
      <div class="icon"><i class="fa fa-file"></i> </div>
    <div class="count">  <?php echo (isset($all_job) && !empty($all_job)?$all_job:0); ?></div>
      <h3 href="">{{ __('freelancer.Propossal') }}</h3>
     </div></a>
  </div>
  <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a style="text-decoration-line:none" href="<?php echo url('/saved/job') ?>"> <div class="tile-stats">
      <div class="icon"><i class="fa fa-folder-open"></i> </div>
      <div class="count"><?php echo (isset($job_saved) && !empty($job_saved)?$job_saved:0); ?></div>
      <h3 href="">{{ __('freelancer.SaveJobs') }}</h3>
      </div></a>
  </div>
</div>
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h2 style="font-size: 30px;"> {{ __('freelancer.Calender') }} <small> {{ __('freelancer.CalenderDescription') }} </small> </h2>
    </div>
    <div class="title_right">
      <!--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
          <button class="btn btn-default" type="button">{{ __('freelancer.Go') }}</button>
          </span> </div>
      </div> -->
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12" style="z-index: 0">
      <div class="x_panel">
        <div class="x_title">
          <h2>{{ __('freelancer.CalenderEvents') }}</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>
           
            <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div id='calendar'></div>
        </div>
      </div>
    </div>
  </div>
</div>
@include ('include/footer_fr')