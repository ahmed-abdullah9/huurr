@include ('include/header_admin')

<div class="row top_tiles"  style="padding-top:200px; padding-bottom:300px;">
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
  <a href="{{url('/jobListing')}}">
<div class="tile-stats">
  <div class="icon"><i class="fa fa-caret-square-o-right"></i> </div>
  <div class="count"><?php echo (isset($all_job) && !empty($all_job)?$all_job:0); ?></div>
  <h3>{{__('client.post_job')}}</h3>
</div>
  </a>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
  <a href="{{url('/SuccessJobListing')}}">
<div class="tile-stats">
  <div class="icon"><i class="fa fa-comments-o"></i> </div>
  <div class="count"><?php echo (isset($completed_jobs) && !empty($completed_jobs)?$completed_jobs:0); ?></div>
  <h3>{{__('client.success_job')}}</h3>
</div>
  </a>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
  <a href="{{url('/faildJobs')}}">
<div class="tile-stats">
  <div class="icon"><i class="fa fa-sort-amount-desc"></i> </div>
  <div class="count"><?php echo (isset($faild_jobs) && !empty($faild_jobs)?$faild_jobs:0); ?></div>
  <h3>{{__('client.faild_job')}}</h3>
</div>
  </a>
</div>
</div>

@include ('include/footer_admin')
