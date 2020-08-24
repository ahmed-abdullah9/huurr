<?php     if(Session::get('user_role')=='client')      {       ?>
@include ('include/header_cl')
  <?php }else{ ?>
@include ('include/header_fr')
  <?php } ?>

<div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">
<section class="login-section register-section">
  <div class="">
    <div class="head_of_section new"> <a href="#" class="back-Proposal"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Proposal List</a>
      <h3>
      Create Notification
      </h3>
    </div>
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 left-side">
        <div class="job-post"><a href="{{ url('/job/proposal/') }}/<?php echo \Crypt::encryptString($jobs->job_id) ?>">{{ $jobs->job_title }} </a> <i class="fa fa-calendar" aria-hidden="true"></i> Posted <?php echo date('M d,Y', strtotime($jobs->created_at)); ?> - <a href="{{ url('/job/proposal/') }}/<?php echo \Crypt::encryptString($jobs->job_id) ?>">View Job Posting </a> </div>
        <div class="many-bondry">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left-side">
            <h4><i class="fa fa-ticket" aria-hidden="true"></i> Fixed Price</h4>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left-side">
            <h4><i class="fa fa-ticket" aria-hidden="true"></i> $<?php echo $jobs->budget; ?>  Budget</h4>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left-side">
            <h4><i class="fa fa-usd" aria-hidden="true"></i><i class="fa fa-usd" aria-hidden="true"></i> Intermediate level </h4>
          </div>
        </div>
        <div class="many-bondry">
          <h3> Details</h3>
          <p><?php echo $jobs->job_description; ?></p>
          <h3>Skills Required</h3>
          <ul class="skills_view">
            <?php
              if(!empty($jobs->job_skills))
              {
                foreach ($jobs->job_skills as $job_skills) {
                  echo '<li><a>'.$job_skills.'</a></li>';
                }
              }
             ?>
          </ul>
        </div>
        
        <!-- <div class="many-bondry">
          <h3> Original Message from Client</h3>
          <p>Hello!<br>
            I Want to create real time to notification for the website</p>
          <p>Top Noched Solution</p>
        </div> -->
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12  Invitation">
        <h3 class="text-right">Invitation to Interview</h3>
        <p>are you Intrested in  discussing this job ?</p>
        <button type="button" class="btn btn-primary" onclick="accept_for_interview(<?php echo $proposals->proposal_id; ?>, <?php echo $proposals->user_id; ?>)">Yes Accept Interview</button> <a onclick="decline_propsals(<?php echo $proposals->proposal_id; ?>, <?php echo $proposals->user_id; ?>)">Decline ?</a>
        <div class="abouttheclient">
          <h4><a href="#">About The Client <i class="fa fa-check" aria-hidden="true"></i></a></h4>
          <ul>
            <li><?php echo (!empty($profile)?$profile->city:''). ' '. (!empty($profile)?$profile->country:''); ?></li>
            <li><?php echo (!empty($job_count)?$job_count:0) ?> Jobs Posted</li>
            <li>$ <?php echo $spend; ?> Total Spend</li>
            <li><?php echo (!empty($hir_count)?$hir_count:0) ?> Hire</li>
            <li>Member Since : <?php echo (isset($client)?date('M d,Y', strtotime($client->created_at)):''); ?></li>
            <li>
              <h4><a href="#">About The Client </a></h4>
            </li>
            <li>Less Then 5 Proposals</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section

@include ('include/footer_cl')