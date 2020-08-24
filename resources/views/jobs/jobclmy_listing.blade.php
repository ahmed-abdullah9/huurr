@include ('include/header_cl')
<div style="padding-bottom: 20px;" class="row">
  <div class="col-md-12 col-sm-12" >
    <a class="btn btn-round btn-color" href="{{url('/joblist')}}"><i class="fa fa-arrow-circle-left"></i> Go Back</a>
  </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">

  <div class="clearfix"></div>
  <ul class="nav nav-tabs my_navs table-heading" role="tablist">
    <li role="presentation" <?php if(isset($_REQUEST['tab']) && $_REQUEST['tab']=='all') { echo 'class="active "';}elseif(!isset($_REQUEST['tab'])) { echo 'class="active"';} ?> ><a class="table-heading" href="<?php echo url('/clmy/job/'.Crypt::encrypt($job_id).'/') ?>?tab=all">Proposals (<?php echo count($jobs) ?>)</a></li>
    <li role="presentation" <?php if(isset($_REQUEST['tab']) && $_REQUEST['tab']=='invited') { echo 'class="active"';} ?>><a class="table-heading" href="<?php echo url('/clmy/job/'.Crypt::encrypt($job_id).'/') ?>?tab=invited">Invited for Interview (<?php echo count($invited_user) ?>)</a></li>
    <li role="presentation" <?php if(isset($_REQUEST['tab']) && $_REQUEST['tab']=='active') { echo 'class="active"';} ?>><a class="table-heading" href="<?php echo url('/clmy/job/'.Crypt::encrypt($job_id).'/') ?>?tab=active">Active Job (<?php echo count($active_job) ?>)</a></li>
    <li role="presentation" <?php if(isset($_REQUEST['tab']) && $_REQUEST['tab']=='filled') { echo 'class="active"';} ?>><a class="table-heading" href="<?php echo url('/clmy/job/'.Crypt::encrypt($job_id).'/') ?>?tab=filled"> Completed Job (<?php echo count($completed_job) ?>)</a></li>
  </ul>

  <div class="row">
    <div class="col-md-12 col-sm-12 ">
      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane <?php if(isset($_REQUEST['tab']) && $_REQUEST['tab']=='all') { echo 'active';}elseif(!isset($_REQUEST['tab'])) { echo 'active';} ?>" id="sub_proposal">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <table class="table">
                  <thead class="table-header-colums-title">
                  <tr>
                    <th>Job</th>
                    <th>Date Posted</th>
                    <th>Posted By</th>
                    <th>Bid Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="table-header-title">
                  @if(sizeof($jobs)>0)
                    @php
                      $is_hired=false;
                    @endphp
                    @foreach($jobs as $job)
                      @php
                        if($job->offers == 1 && $job->accept_offer == 1){
                                            $is_hired=true;
                        }
                      @endphp
                      <tr>
                      <!-- <th><a target="_blank" href="{{ url('jobpost') }}/{{$job->job_id}}/edit"> {{ $job->job_title }}</a></th>  -->
                        <th> {{ $job->job_title }}</th>
                        <td>{{ date("M d", strtotime($job->created_at)) }} <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans()}}</small></td>
                        <td><a href="{{url('user/detail')}}/{{encrypt($job->freelancer_id)}}"><?php echo $job->name; ?></a></td>
                        <td>{{Config::get('constants.constant.currency')}}<?php echo $job->bid_amount; ?><?php if($job->job_time_type=='hourly') echo '/hr'; ?></td>
                        <td>
                          <a class="btn-color btn" href="<?php echo url('view/proposal/'.Crypt::encrypt($job->proposal_id)); ?>">View Details</a>
                            <?php  if($job->invitation_interview == 0 && $job->accept_interview==0  && $job->offers == 0 && $job->accept_offer == 0 && $job->hired==0 && $job->progress==0&&$is_hired==false){ ?>
                          <a class="btn btn-color btn-primary"  href="<?php echo url('edit/proposal/'.Crypt::encrypt($job->proposal_id)); ?>" >Hire </a>
                            <?php }elseif($job->invitation_interview == 1 && $job->accept_interview == 1  && $job->offers == 1 && $job->accept_offer == 0 && $job->hired==0)
                            {
                                echo '<a class="btn btn-color btn-primary" >Hire Request Sent</a>';
                            }elseif($job->invitation_interview == 1 && $job->accept_interview == 1  && $job->offers == 1 && $job->accept_offer == 1) {
                                echo '<a class="btn btn-color btn-primary" >Hired</a>';
                            } ?>
                          @if($job->invitation_interview==1&&$job->accept_interview==1&&$job->offers==0&&$job->accept_offer==0&&$job->progress==0)

                            <a class="btn btn-color btn-primary"  href="<?php echo url('edit/proposal/'.$job->proposal_id); ?>" >Hire </a>
                          @endif
                          <button type="button" class="btn btn-primary btn-color" data-toggle="modal" data-target="#invitePopup_<?php echo $job->proposal_id?>">Message</button>
                          <div class="modal fade" id="invitePopup_<?php echo $job->proposal_id ?>" style="z-index: 9999999;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <div class=" freelancer-list">
                                    <div class="f-image">
                                      <div class="f-image-inner"> <i class="fa fa-user"></i> Client to Freelancer </div>
                                    </div>
                                  </div>
                                  <button style="position: absolute;right: 4px;top: 4px;" type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <form action="<?php echo url('/'); ?>/send/freelancer/message" method="post" >
                                  <div class="modal-body">

                                    <input type="hidden" name="user_id" value="<?php echo $job->Proposal_user; ?>">
                                    <div class="form-group">
                                      <h4>Message</h4>
                                      <textarea name="message" rows="4" class="form-control c-form" placeholder="Enter Message" ></textarea>
                                    </div>

                                  </div>
                                  <div class="modal-footer">

                                    <button type="submit" id="" class="btn btn-primary btn-color">Send</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr> <td colspan="4" class="red center"> <h2 align="center">There is no Proposal against this Job</h2></td></tr>
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div role="tabpanel" class="tab-pane <?php if(isset($_REQUEST['tab']) && $_REQUEST['tab']=='invited') { echo 'active';} ?> " id="inter__invitation">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <table class="table">
                  <thead class="table-header-colums-title">
                  <tr>
                    <th>Job</th>
                    <th>Date Posted</th>
                    <th>Posted By</th>
                    <th>Bid Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="table-header-title">
                  @if(sizeof($invited_user)>0)
                    @foreach($invited_user as $user)

                      <tr>
                        <th>{{ $user->job_title }}</th>
                        <td>{{ date("M d", strtotime($user->created_at)) }} <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($user->created_at))->diffForHumans()}}</small></td>
                        <td><?php echo $user->name; ?></td>
                        <td>{{Config::get('constants.constant.currency')}}<?php echo $user->bid_amount; ?></td>
                        <td>
                          <a class="btn btn-color" href="<?php echo url('view/proposal/'.Crypt::encrypt($user->proposal_id)); ?>">View Details</a>
                            <?php if($user->invitation_interview == 1 && $user->accept_interview == 1 && $user->offers == 0) { ?>
                          <button type="button" class="btn btn-primary btn-color" onclick="Offer_job(<?php echo $user->proposal_id; ?>, <?php echo $user->Proposal_user; ?>)">Offer Job</button>
                            <?php }if($user->invitation_interview == 1 && $user->accept_interview == 0)
                            {
                            ?>
                          <button type="button" class="btn btn-success btn-color">Wait For accept interview</button>
                            <?php
                            } ?>
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr> <td colspan="4" class="red center"> <h2 align="center">There is nobody Invited</h2></td></tr>
                  @endif

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane <?php if(isset($_REQUEST['tab']) && $_REQUEST['tab']=='active') { echo 'active';} ?> " id="Offers">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <table class="table">
                  <thead class="table-header-colums-title">
                  <tr>
                    <th>Job</th>
                    <th>Date Posted</th>
                    <th>Posted By</th>
                    <th>Bid Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="table-header-title">
                  @if(sizeof($active_job)>0)
                    @foreach($active_job as $job)

                      <tr>
                        <th> {{ $job->job_title }}</th>
                        <td>{{ date("M d", strtotime($job->created_at)) }} <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans()}}</small></td>
                        <td>{{ $job->name}}</td>
                        <td>{{Config::get('constants.constant.currency')}}{{ $job->bid_amount}} <?php if($job->job_time_type=='hourly') echo '/hr'; ?></td>
                        <td>
                          <a class="btn btn-round btn-color" href="<?php echo url('view/proposal/'.Crypt::encrypt($job->proposal_id)); ?>">View Details</a>

                          @if($job->offers == 1 && $job->accept_offer == 1&&$job->job_is_open==0&&$job->contracted==1&&$job->job_progress==2)
                            @if($job->is_claim==0)
                              <button type="button" class="btn btn-round btn-primary btn-color" onclick="post_to_complete(<?php echo $job->proposal_id; ?>, <?php echo $job->Proposal_user; ?>)">Mark To Complete</button>
                              <button class="btn btn-round btn-default btn-color" onclick="window.location.href='<?php echo url('/') ?>/give/cl/feedback/{{encrypt($job->job_id)}}'">{{ __('freelancer.Feedback') }}</button>
                              <button data-toggle="modal" data-target="#claimModal" class="btn btn-round btn-color" href="#">Claim Job</button>
                            @elseif($job->is_claim==1)
                              @if($job->is_claim==1&&$job->is_removed==1)
                                <button type="button" class="btn btn-round btn-primary btn-color" onclick="post_to_complete(<?php echo $job->proposal_id; ?>, <?php echo $job->Proposal_user; ?>)">Mark To Complete</button>
                                <button class="btn btn-round btn-default btn-color" onclick="window.location.href='<?php echo url('/') ?>/give/cl/feedback/{{encrypt($job->job_id)}}'">{{ __('freelancer.Feedback') }}</button>
                              @else
                                <button onclick="disClaim('<?php echo $job->job_id; ?>','<?php echo $job->proposal_id; ?>')" class="btn btn-round btn-color">DisClaim</button>
                              @endif
                            @endif
                          @elseif($job->offers == 1 && $job->accept_offer == 1&&$job->job_is_open==0&&$job->contracted==0)
                            @if($job->job_time_type=='hourly')
                              <button type="button" class="btn btn-primary btn-color" onclick="window.location.href='<?php echo url('/start/job/tasks'); ?>/<?php echo $job->proposal_id; ?>/<?php echo $job->Proposal_user; ?>'">Satrt Contract</button>
                            @else
                              <button type="button" class="btn btn-primary btn-color" onclick="window.location.href='<?php echo url('/verifyCheckout/'); ?>/<?php echo $job->proposal_id; ?>/<?php echo $job->Proposal_user; ?>'">Pay Now/Satrt Contract</button>
                            @endif
                          @elseif($job->offers == 1 && $job->accept_offer == 1&&$job->job_is_open==0&&$job->contracted==-1&&$job->job_progress==3)

                          @elseif($job->offers == 1 && $job->accept_offer == 1&&$job->job_is_open==0&&$job->contracted==1&&$job->job_progress==1)
                            <button type="button" class="btn btn-primary btn-color">In Progress</button>
                            @if($job->is_claim==0)
                              {{--<button data-toggle="modal" data-target="#claimModal" class="btn btn-round" href="#">Claim Job</button>--}}
                            @elseif($job->is_claim==1)
                              @if($job->is_claim==1&&$job->is_removed==1&&$job->job_is_open==0&&$job->contracted==1&&$job->job_progress==2)
                                <button type="button" class="btn btn-round btn-primary btn-color" onclick="post_to_complete(<?php echo $job->proposal_id; ?>, <?php echo $job->Proposal_user; ?>)">Mark To Complete</button>
                                <button class="btn btn-round btn-default btn-color" onclick="window.location.href='<?php echo url('/') ?>/give/cl/feedback/{{encrypt($job->job_id)}}'">{{ __('freelancer.Feedback') }}</button>
                              @elseif($job->is_removed==0)
                                <button onclick="disClaim('<?php echo $job->job_id; ?>','<?php echo $job->proposal_id; ?>')" class="btn btn-round btn-color">DisClaim</button>
                              @endif
                            @endif
                          @endif

                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr> <td colspan="4" class="red center"> <h2 align="center">Job is not active</h2></td></tr>
                  @endif


                  </tbody>
                </table>
                {{--//claim modal--}}
                @if(!empty($active_job))
                  <div class="modal fade" id="claimModal" role="dialog">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 style="color: red;" class="claim-common-messages"></h3>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Claim Job <br><small>{{$active_job[0]->job_title}}</small></h4>
                        </div>
                        <div class="modal-body">
                          <form id="claimJob">
                            <select style="height: 30px;border-radius: 20px;"  name="reason">
                              <option value="">Select Reason</option>
                              <option value="1">Work is not Completed</option>
                              <option value="2">Freelancer is not Responding</option>
                            </select>
                            <input type="hidden" value="{{$active_job[0]->hire_free_id}}" name="hire_free_id">
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-round btn-color" data-dismiss="modal">Close</button>
                          <button type="button" onclick="claimJob()" class="btn btn-default btn-round btn-color">Claim</button>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane <?php if(isset($_REQUEST['tab']) && $_REQUEST['tab']=='filled') { echo 'active';} ?> " id="archioved_proposal">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <table class="table">
                  <thead class="table-header-colums-title">
                  <tr>
                    <th>Job</th>
                    <th>Date Posted</th>
                    <th>Posted By</th>
                    <th>Bid Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="table-header-title">
                  @if(sizeof($completed_job)>0)
                    @foreach($completed_job as $job)

                      <tr>
                        <th>{{ $job->job_title }}</th>
                        <td>{{ date("M d", strtotime($job->created_at)) }} <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans()}}</small></td>
                        <td><?php echo $job->name; ?></td>
                        <td>{{Config::get('constants.constant.currency')}}<?php echo $job->bid_amount; ?></td>
                        <td>
                          <a class="btn btn-color btn-round" href="<?php echo url('view/proposal/'.Crypt::encrypt($job->proposal_id)); ?>">View Details</a>
                          <button class="btn btn-round btn-default btn-color" onclick="window.location.href='<?php echo url('/') ?>/give/cl/feedback/{{encrypt($job->job_id)}}'">{{ __('freelancer.Feedback') }}</button>
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr> <td colspan="4" class="red center"> <h2 align="center">Yet Job is not Completed</h2></td></tr>
                  @endif

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@include ('include/footer_cl')