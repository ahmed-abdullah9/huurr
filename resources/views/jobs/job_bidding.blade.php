    @if(Session::get('user_role')=='client')
@include ('include/header_cl')
   @elseif(Session::get('user_role')=='freelancer')
@include ('include/header_fr')
@else
      @include('include/header_admin')
 @endif
    <?php
    $job_skills = (is_array($jobs->job_skills)?implode(' , ',$jobs->job_skills):$jobs->job_skills);
    ?>
      <div style="padding-bottom: 100px;" class="container text-justify">
        <div class="col-md-8">
          <h1>@if(!empty($jobs->job_title)) <h2 style="padding-bottom: 20px;" class="main-form-title">{{$jobs->job_title}}</h2> @endif</h1>
          <h2><div class="project-info-bar">
              <div style="padding-bottom: 20px;">
                <button class="btn badge btn-color">{{ $jobs->category_id }}</button> <small>Posted {{\Carbon\Carbon::createFromTimeStamp(strtotime($jobs->created_at))->diffForHumans()}}</small>
              </div>
            </div></h2>
          <h3 style="padding-bottom: 10px;" class="form-label-color">Project Detail</h3>
          <p style="padding-bottom: 10px;" class="table-header-title">@if(!empty($jobs->job_description)){{ $jobs->job_description }} @endif</p>
          <table class="table table-hover">
            <tbody class="table-font-color">
            <tr>
              <td  style="color:#666666;font-weight: bold;">Project Files Download</td>
              <td class="text-muted">
                @if(!empty($jobs->attachments))
                <ul style="list-style: none;">
                 @foreach($jobs->attachments as $attachment)
                 @php
                 $img = explode('/',$attachment);
                
                 @endphp
                  <li>
                    <a target="_blank" href="{{url('/')}}/{{$attachment}}" tabindex="-1"><strong><i class="fa fa-paperclip" aria-hidden="true" style="margin-right:3px"></i><span style="color:#2aa1c9">{{$img['5']}}</span></strong></a>
                  </li>
                   @endforeach
                </ul>
                  @else
                  Not Available
                @endif

              </td>
            </tr>
            <tr>
              <td  style="color:#666666;font-weight: bold;">Project Type</td>
              <td class="text-muted">{{ $jobs->job_time_type }}</td>
            </tr>
            @if($jobs->job_time_type=='fixed')
            <tr>
              <td style="color:#666666;font-weight: bold;">Budget <i  class="fa fa-money"></i></td>
              <td>
                @if($jobs->budget > 0)
                  <small class="text-muted">: {{Config::get('constants.constant.currency')}}{{ $jobs->budget }}</small>
                @endif
              </td>
            </tr>
            @endif
            <tr>
              <td style="color:#666666;font-weight: bold;">Freelancer Experience Required</td>
              <td class="text-muted">@if($jobs->experience_level == 1)
                  <div class="pull-left ">
                    $
                  </div>

                  <div class="pull-left">
                    <p><small>Entry Level</small></p>
                  </div>

                @elseif($jobs->experience_level == 2)
                  <div class="pull-left ">
                    $$
                  </div>

                  <div class="pull-left">
                    <p><small>Intermediate Level</small></p>
                  </div>

                @elseif($jobs->experience_level == 3)
                  <div class="pull-left ">
                    $$$
                  </div>

                  <div class="pull-lef">
                    <p><small>Expert Level</small></p>
                  </div>

                @endif</td>
            </tr>
            <tr>
              <td style="color:#666666;font-weight: bold;">
                <i class="fa fa-calendar"></i> Start Date
              </td>
              <td>
                <small class="text-muted">{{ date("F d Y", strtotime($jobs->created_at)) }}</small>
              </td>
            </tr>
            <tr>
              <td style="color:#666666;font-weight: bold;">Project Stage</td>
              <td class="text-muted">
                @if(!empty($jobs->project_type))
                  @if($jobs->project_type == 1)
                    One-time project
                  @endif
                  @if($jobs->project_type == 2)
                    Ongoing project
                  @endif
                  @if($jobs->project_type == 3)
                    I am not sure
                  @endif

                @endif
              </td>
            </tr>
            <tr>
              <td style="color:#666666;font-weight: bold;">
                Skills Required:
              </td>
              <td class="text-muted">
                  <?php echo $job_skills ?>
              </td>
            </tr>
            <tr>
              <td>
                <h3 style="color:#666666;font-weight: bold;">Preferred Qualifications</h3>
              </td>
              <td class="text-muted">
               N/A
              </td>
            </tr>
            <tr>
              <td style="color:#666666;font-weight: bold;">
                Job Success Score:
              </td>
              <td class="text-muted">
                At least <?php echo (isset($percentChange)?$percentChange:0); ?>%
              </td>

            </tr>
            <tr>
              <td>
                <h3 style="color:#666666;font-weight: bold;">Activatity On this Job</h3>
              </td>
              <td class="text-muted">
                N/A
              </td>
            </tr>
            <tr>
              <td style="color:#666666;font-weight: bold;">
                Proposals
              </td>
              <td class="text-muted">
                  <?php echo ($proposals?$proposals:0) ?>

                <i class="fa fa-question-circle"
                   data-toggle="tooltip"
                   title="This range includes relevant proposals, but does not include proposals that are withdrawn, declined, or archived. Please note that all proposals are accessible to clients on their applicants page."
                   data-placement="bottom"
                ></i>
              </td>
            </tr>
            <tr>
              <td style="color:#666666;font-weight: bold;">
                Interviewing
              </td>
              <td class="text-muted">
                  <?php echo (!empty($interview)?$interview:0); ?>
              </td>
            </tr>
            <tr>
              <td style="color:#666666;font-weight: bold;">
                Invites Sent:
              </td>
              <td class="text-muted">
                  <?php echo (!empty($offer)?$offer:0); ?>
              </td>
            </tr>
            <tr>
              <td style="color:#666666;font-weight: bold;">
                Unanswered Invites:
              </td>
              <td class="text-muted">
                  <?php echo (!empty($unanserder)?$unanserder:0); ?>
              </td>
            </tr>
            <tr>
              <td>
                <h3 style="color:#666666;font-weight: bold;">Client's Work History and Feedback (<?php if(is_array($comments)){ echo count($comments); }else { echo 0; } ?>)</h3>
              </td>
              <td class="text-muted">
                  <?php if(!empty($comments)) {
                  foreach ($comments as $comment)
                  {
                  ?>
                <div class="client-history">
                  <h4><a href="#"><?php echo $comment->job_title ?></a></h4>
                  <div class="row">
                    <div class="col-md-8">
                      <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                          <?php echo $comment->comment; ?>.</p>
                      <p>
                        <small>
                          To Freelancer: <a ><?php echo $comment->name ?>.<i class="fa fa-star"></i><i class="fa fa-star"></i></a>
                        </small>
                      </p>
                    </div>
                    <div class="col-md-4">
                      <ul class="feedback_meta">
                        <li><?php echo $comment->created_at ?></li><!--
                      <li>13 hrs @ $25.00/hr</li> -->
                        <li>Billed: {{Config::get('constants.constant.currency')}}<?php echo $comment->budget; ?></li>
                      </ul>
                    </div>
                  </div>
                </div>
                  <?php
                  }
                  } ?>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12">
          {{--<div style="margin-bottom: 5%;" class="header">--}}
          {{--<a href="#">Flag as inappropriate</a>--}}
          {{--</div>--}}
          @if(Session::get('user_role')=='freelancer')
            <?php
            if(\App\Http\Controllers\ProfileController::profile_percentage(Session::get('login_id'))<80)
            {
            ?>
          <a onClick="return confirm('Please Complete Your profile to bid on this job')" class="btn btn-primary btn-block m-md-bottom">Submit a Proposal</a>
            <?php
            }else
            {
            ?>
          <a href="{{ url('submit/proposal/') }}/<?php echo \Crypt::encryptString($jobs->job_id) ?>" class="btn btn-primary btn-block m-md-bottom btn-color">Submit a Proposal</a>
            <?php
            }
            ?>

          <a class="btn btn-color btn-secondary btn-block m-md-bottom save_job <?php if(isset($saved_job->status) && $saved_job->status == 1 ){ echo 'saved_job_active'; } ?>" data-ng_bind="<?php echo \Crypt::encryptString($jobs->job_id) ?>">Save Job</a>
        <!--  <p>Connects to submit a proposal: <?php echo (isset($proposal_user)?($proposal_user*2):0) ?>
                <i class="fa fa-question-circle" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="This is the number of Connects required to submit a proposal for this job."></i></p>

              <p>Available Connects: <?php echo (isset($proposal_user)?70-($proposal_user*2):0) ?> </p> -->

          <hr/>
          <small class="table-header-colums-title">About Client</small>
          <hr/>
         <table class="table table-responsive">
           <tr>
             <td>
               <label class="form-label-color"><?php echo (!empty($profile_data)?$profile_data->city.' '.$profile_data->country:''); ?></label>
               <p class="form-label-color">Sunnyvale 01:11 PM
               </p>
             </td>
           </tr>
           <tr>
             <td>
               <label class="form-label-color">{{$total__active_jobs}} <small>Jobs Posted </small></label>
               <p class="form-label-color">{{$percentChange}}% Hire Rate, {{$open_jobs}} Open Job
               </p>
             </td>
           </tr>
           <tr>
             <td class="form-label-color">
                 <?php
                 $total_spent = [];
                 if(!empty($spent_hire))
                 {
                     foreach ($spent_hire as $spend) {
                         $total_spent[] = $spend->bid_amount;
                     }
                 }

                 ?>
               <label>{{Config::get('constants.constant.currency')}}{{$total_client_amount/1000}}k+ Total Spent </label>
               <p>{{$hired_freelancer}} Hires, {{$client__active_jobs}} Active
               </p>
             </td>
           </tr>
           <tr>
             <td class="form-label-color">
               <p>Member Since <?php echo (!empty($client_created)?date('M d,Y', strtotime($client_created)):''); ?>
               </p>
             </td>
           </tr>
         </table>
          <hr/>

          <hr/>
          @endif
        </div>

      </div>


    @if(Session::get('user_role')=='client')
      @include ('include/footer_cl')
    @elseif(Session::get('user_role')=='freelancer')
      @include ('include/footer_fr')
    @else
      @include ('include/footer_admin')
    @endif

