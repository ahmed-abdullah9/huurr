@include ('include/header_cl')

<style>
    .tile-stats {
    border: 1px solid #666 !important;
    padding: 15px !important;
}
</style>
<div class="row top_tiles"  style="padding-top:45px; padding-bottom:300px;">
      <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a href="<?php echo url('/joblist'); ?>">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-caret-square-o-right"></i> </div>
          <div class="count table-heading"><?php echo (isset($all_job) && !empty($all_job)?$all_job:0); ?></div>
          <h3>{{__('client.pst_job')}}</h3>
        </div>
      </div>
      <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a href="<?php echo url('cl_completed/jobs'); ?>">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-comments-o"></i> </div>
          <div class="count table-heading"><?php echo (isset($completed_jobs) && !empty($completed_jobs)?$completed_jobs:0); ?></div>
          <h3>{{__('client.suces_job')}}</h3>
        </div>
      </div>
      <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a href="<?php echo url('/clmy-job'); ?>">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-sort-amount-desc"></i> </div>
          <div class="count table-heading"><?php echo (isset($faild_jobs) && !empty($faild_jobs)?$faild_jobs:0); ?></div>
          <h3>{{__('client.flair_job')}}</h3>
        </div>
      </div>
    </div>
@include ('include/footer_cl')