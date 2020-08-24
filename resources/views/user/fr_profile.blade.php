@include ('include/header_fr')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/select.css') }}">
<!-- google web font css --><link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">


<div class="col-md-12 col-sm-12 col-xs-12">

<div class="x_panel">

<div class="x_title">

<div class="row">
<div class="col-md-3">
<h2 style="padding-bottom: 20px;" class="table-heading"><?php echo (isset($user_data->user_nicename)?$user_data->user_nicename:''); ?></h2>
</div>
<div class="col-md-9">
<p class="font-color" style="float:right;padding-top: 10px;"> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo (isset($profile_data->city)?$profile_data->city:'').', '.(isset($profile_data->country)?$profile_data->country:'') ?> - <?php
date_default_timezone_set('Asia/Riyadh');
echo date('h:i:a') ?> local time</p>


</div>

</div>

<div class="clearfix"></div>

</div>
<div class="x_content">
<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
<div id="crop-avatar">
<!-- Current avatar -->
<div style="margin-bottom: 20px;box-shadow: none !important;" class="avatar-view" title="Change the avatar">
<?php
if (isset($profile_data->profile_image) && !empty($profile_data->profile_image)) {
?>
<img style="border-radius: 50%;"  src="<?php echo asset('/'.$profile_data->profile_image) ?>" alt="Avatar">
<?php
}else {
?>
<img src="<?php echo asset('/fr_assets/') ?>/images/user.png" alt="Avatar">
<?php
} ?>
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
<!-- /.modal -->

<!-- Loading state -->
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</div>
<!-- end of image cropping -->

<?php
$loc = [];
if (isset($profile_data->city) && !empty($profile_data->city)) {
$loc[] = $profile_data->city;
}
if (isset($profile_data->state) && !empty($profile_data->state)) {
$loc[] = $profile_data->state;
}
if (isset($profile_data->country) && !empty($profile_data->country)) {
$loc[] = $profile_data->country;
}
?>
{{--<ul style="padding: 15px;" class="list-unstyled user_data table-header-title">--}}
{{--<li class="m-top-xs"> <i class="fa fa-external-link user-profile-icon"></i> <a class="table-header-title" href="" target="_blank">{{ __('freelancer.Website') }}</a> </li>--}}
{{--</ul>--}}
<?php
if($user_data->is_verify == 0) {
echo '<button class="btn btn-secondary btn-color"><i class="fa fa-thumbs-down"></i>&nbsp;Need Verification</button>';
} elseif($user_data->is_verify == 1) {
echo '<button class="btn btn-secondary btn-color"><i class="fa fa-thumbs-up"></i>&nbsp;Verified</button>';
}
?>
<a class="btn btn-default btn-color" href="<?php echo url('/edit/fr/profile') ?>"><i class="fa fa-edit m-right-xs"></i>{{ __('freelancer.EditProfile') }}</a> <br />

<!-- start skills -->
<h2 class="font-color font-weight" style="margin-bottom: 10px;margin-top: 20px;">{{ __('freelancer.Skills') }}</h2>
<ul class="list-unstyled user_data">
<?php
if(!empty($profetionl_skills))
{
$ct = 0;
foreach ($profetionl_skills as $skills) {
$ct++;
?>
<li>
<p class="font-color"><?php echo $skills->text ?></p>
<div class="progress progress_sm">
<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $ct*10; ?>"></div>
</div>
</li>
<?php
}
}
?>

</ul>
<!-- end of skills -->

</div>
<div class="col-md-9 col-sm-9 col-xs-12">
<!-- <div class="profile_title">
<div class="col-md-6">
<h2>{{ __('freelancer.UserActivityReport') }}</h2>
</div>
<div class="col-md-6">
<div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">				  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i> <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b> </div>
</div>
</div>

<div id="graph_bar" style="width:100%; height:280px;"></div>-->
<!-- end of user-activity-graph -->

<div class="" role="tabpanel" data-example-id="togglable-tabs">
<ul style="background: none;border-bottom:none !important;" id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
<li role="presentation" class="active"><a class="table-header-colums-title" href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">{{ __('freelancer.RecentActivity') }}</a> </li>
<li role="presentation" class=""><a class="table-header-colums-title" href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">{{ __('freelancer.ProjectsWorkedOn') }}</a> </li>
{{--<li role="presentation" class=""><a class="table-header-colums-title" href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">{{ __('freelancer.Profile') }}</a> </li>--}}
</ul>
<div id="myTabContent" class="tab-content">
<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

<!-- start recent activity -->
<ul class="messages">
<?php if(!empty($jobs))
{
$jbct = 1;
foreach ($jobs as $job) {

?>
<li> <img src="<?php echo asset('/fr_assets/') ?>/images/user.png" class="avatar" alt="Avatar">
<div class="message_date">
<h3 class="date text-info"><?php echo date('d', strtotime($job->created_at)); ?></h3>
<p class="month table-header-title"><?php echo date('M', strtotime($job->created_at)); ?></p>
</div>
<div class="message_wrapper">
<h4 class="heading table-header-colums-title"><?php echo $job->job_title; ?></h4>
<blockquote class="message table-header-title"><?php echo $job->name; ?>.</blockquote>
<br />

</div>
</li>
<?php
$jbct++;
} } ?>
</ul>
<!-- end recent activity -->

</div>
<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

<!-- start user projects -->
<table class="data table table-striped no-margin">
<thead class="table-header-colums-title">
<tr>
<th>#</th>
<th>{{ __('freelancer.ProjectName') }}</th>
<th>{{ __('freelancer.ClientCompany') }}</th>
<th class="hidden-phone">{{ __('freelancer.HoursSpent') }}</th>
<th>{{ __('freelancer.Contribution') }}</th>
</tr>
</thead>
<tbody class="table-header-title">
<?php if(!empty($jobs))
{
$jbct = 1;
foreach ($jobs as $job) {

?>
<tr>
<td><?php echo $jbct; ?></td>
<td><?php echo $job->job_title; ?></td>
<td><?php echo $job->name; ?></td>
<td class="hidden-phone"><?php echo $job->job_duration; ?></td>
<td class="vertical-align-mid"><div class="progress">
<div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
</div></td>
</tr>
<?php
$jbct++;
} } ?>

</table>
<!-- end user projects -->

</div>
{{--<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">--}}
{{--<p class="table-header-title">{{ __('freelancer.ProfileDescription') }}</p>--}}
{{--</div>--}}
</div>
</div>
</div>
</div>
</div>
</div>

@include ('include/footer_fr')
