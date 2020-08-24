@include ('include/header_fr')

<!-- <?php if(Session::has('success')) { ?>
<script type="text/javascript">
$(document).ready(function(){
  swal({
    title: "Success",
    text: "<?php echo Session::get('success');?>",
    icon: "success",
    button: "OK"
  });
});
</script>
<?php } ?> -->

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2 class="table-heading"><i class="fa fa-bars"></i> {{ __('freelancer.Propossal') }}</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a class="table-header-colums-title" href="#tab_content1" id="Submitted-tab" role="tab" data-toggle="tab" aria-expanded="true">{{ __('freelancer.SubmittedProposal') }} (<?php echo count($proposals) ?>)</a> </li>
          <li role="presentation" class=""><a class="table-header-colums-title" href="#tab_content2" role="tab" id="Invitations-tab" data-toggle="tab" aria-expanded="false">{{ __('freelancer.Invitations') }} (<?php echo count($interview) ?>)</a> </li>
          <li role="presentation" class=""><a class="table-header-colums-title" href="#tab_content3" role="tab" id="Offers-tab" data-toggle="tab" aria-expanded="false">{{ __('freelancer.Offers') }} (<?php echo count($offers) ?>)</a> </li>
          <li role="presentation" class=""><a class="table-header-colums-title" href="#tab_content5" role="tab" id="active_job-tab" data-toggle="tab" aria-expanded="false">{{__('freelancer.active')}}(<?php echo count($active_jobs); ?>)</a> </li>
          <li role="presentation" class=""><a class="table-header-colums-title" href="#tab_content4" role="tab" id="Offers-tab" data-toggle="tab" aria-expanded="false"> {{ __('freelancer.completed') }} (<?php echo count($completed) ?>)</a> </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="Submitted-tab">
            <div class="x_panel">
              <div class="x_title">
                <h2 class="table-header-colums-title float_right">{{ __('freelancer.SubmittedProposal') }}</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead class="table-header-colums-title">
                    <tr>
                      <th>{{ __('freelancer.ProjectName') }}</th>
                      <th>{{ __('freelancer.Skills') }}</th>
                      <th>{{ __('freelancer.Posted') }}</th>
                      <th>{{ __('freelancer.Content') }}</th>
                    </tr>
                  </thead>
                  <tbody class="table-header-title">
                    <tr>
                    @if(!empty($proposals))
                      @foreach($proposals as $proposal)

                      <?php
                        $job_skills = App\Http\Controllers\HelperController::maybe_unserialize($proposal->job_skills);
                        $job_skills = (is_array($job_skills)?implode(' , ',$job_skills):$job_skills);
                       ?>
                      <td><a class="table-header-title" href="{{ url('fr/view/proposal/') }}/<?php echo \Crypt::encryptString($proposal->job_id) ?>" ><?php echo $proposal->job_title; ?></a></td>
                      <td><?php echo $job_skills ?></td>
                      <td><?php echo date('M d, Y', strtotime($proposal->received)); ?></td>
                      <td><?php echo $proposal->job_description; ?></td>
                    </tr>
                    @endforeach
                    @else

                     <tr><td cols="4"><h3 align="center">{{__("freelancer.no_proposal")}}</h3></td></tr>

                    @endif
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="Invitations-tab">
            <div class="x_panel">
              <div class="x_title">
                <h2 class="table-header-colums-title float_right">{{ __('freelancer.InvitationsToInterview') }}</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead class="table-header-colums-title">
                    <tr>
                      <th>{{ __('freelancer.ProjectName') }}</th>
                      <th>{{ __('freelancer.Skills') }}</th>
                      <th>{{ __('freelancer.Posted') }}</th>
                      <th>{{ __('freelancer.Invitations') }}</th>
                    </tr>
                  </thead>
                  <tbody class="table-header-title">
                  @if(!empty($interview))
                    @foreach($interview as $int)
                    <?php
                      $job_skills = App\Http\Controllers\HelperController::maybe_unserialize($int->job_skills);
                      $job_skills = (is_array($job_skills)?implode(' , ',$job_skills):$job_skills);
                     ?>
                    <tr>
                      <td><a class="table-header-title" href="{{ url('fr/view/proposal/') }}/<?php echo \Crypt::encryptString($int->job_id) ?>" ><?php echo $int->job_title; ?></a></td>
                      <td><?php echo $job_skills ?></td>
                      <td><?php echo date('M d, Y', strtotime($int->received)); ?></td>
                      <td>
                        <?php if($int->invitation_interview == 1 && $int->accept_interview == 0) { ?>
                        <a type="button"  class="btn btn-round btn-success" href="<?php echo url('/'); ?>/submit/proposal/<?php echo \Crypt::encryptString($int->job_id); ?>/<?php echo encrypt($int->proposal_id); ?>">{{ __('freelancer.AccpetInvitation') }}</a> <?php }
                        if($int->invitation_interview == 1 && $int->accept_interview ==  1  && $int->offers == 0) {
                           ?>
                            <button type="button" class="btn btn-round btn-success">{{ __('freelancer.InvitationMSG') }}</button>
                          <?php
                        } ?>
                        </td>
                    </tr>
                   @endforeach
                    @else

                    <tr><td colspan="4"><h3 align="center">{{__('freelancer.no_interview')}}</h3></td></tr>
                 @endif

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          {{--for active job tab--}}
          <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="active_job-tab">
            <div class="x_panel">
              <div class="x_title">
                <h2 class="table-header-colums-title float_right">{{__('freelancer.active_job')}}</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead class="table-header-colums-title">
                  <tr>
                    <th>{{ __('freelancer.ProjectName') }}</th>
                    <th>{{ __('freelancer.Skills') }}</th>
                    <th>{{ __('freelancer.Posted') }}</th>
                    <th>{{ __('freelancer.Content') }}</th>
                    <th>{{__('freelancer.action')}}</th>
                  </tr>
                  </thead>
                  <tbody class="table-header-title">
                  @if(!empty($active_jobs))
                  @foreach($active_jobs as $ofer)
                  <?php
                  $job_skills = App\Http\Controllers\HelperController::maybe_unserialize($ofer->job_skills);
                  $job_skills = (is_array($job_skills)?implode(' , ',$job_skills):$job_skills);
                  ?>
                  <tr>
                    <td><a class="table-header-title" href="{{ url('fr/view/proposal/') }}/<?php echo \Crypt::encryptString($ofer->job_id) ?>" ><?php echo $ofer->job_title; ?></a></td>
                    <td><?php echo $job_skills ?></td>
                    <td><?php echo date('M d, Y', strtotime($ofer->created_at)); ?></td>
                    <td><?php echo $ofer->job_description; ?></td>
                    <td>
                      @if($ofer->is_open==0&&$ofer->progress==1)
                        @if($ofer->is_claim==1)
                          @if($ofer->is_claim==1&&$ofer->is_removed==1)
                            <a href="{{url('fr_mark/complete/job')}}/{{$ofer->job_id}}"><button class="btn btn-round btn-color">{{__('freelancer.mark_complete')}}</button></a>
                            <button class="btn btn-round btn-default btn-color" onclick="window.location.href='<?php echo url('/') ?>/give/fr/feedback/{{encrypt($ofer->job_id)}}'">{{ __('freelancer.Feedback') }}</button>
                       @else
                            <button onclick="alert('Your job is Claimed By Client due to some reasons')" class="btn btn-round btn-round">{{__('freelancer.claim_job')}}</button>
                          @endif
                        @else
                          @if($ofer->is_open==0&&$ofer->progress==1)
                          <a href="{{url('fr_mark/complete/job')}}/{{$ofer->job_id}}"><button class="btn btn-round btn-round btn-color">{{__('freelancer.mark_complete')}}</button></a>
                             @if($ofer->job_time_type=='hourly')
                            <a class="btn btn-round btn-round btn-color" href="{{url('fr/request/hours')}}/{{encrypt($ofer->job_id)}}">Add Hours</a>
                            @endif
                          @endif
                            <button class="btn btn-round btn-default btn-color" onclick="window.location.href='<?php echo url('/') ?>/give/fr/feedback/{{encrypt($ofer->job_id)}}'">{{ __('freelancer.Feedback') }}</button>
                        @endif
                        @elseif($ofer->is_open==0&&$ofer->progress==2&&$ofer->is_claim==1&&$ofer->is_removed==0)
                        <button onclick="alert('Your job is Claimed By Client due to some reasons')" class="btn btn-round btn-color">{{__('freelancer.claim_job')}}</button>
                          @elseif($ofer->is_open==0&&$ofer->progress==2)
                         <button class="btn btn-color">{{__('freelancer.in_review')}}</button>
                         @endif
                    </td>
                  </tr>
                  @endforeach
                  @else
                      <tr><td colspan="5"><h3 align="center">{{__('freelancer.no_offer')}}</h3></td></tr>
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="Offers-tab">
            <div class="x_panel">
              <div class="x_title">
                <h2 class="table-header-colums-title float_right">{{ __('freelancer.Offer') }}</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead class="table-header-colums-title">
                    <tr>
                      <th>{{ __('freelancer.ProjectName') }}</th>
                      <th>{{ __('freelancer.Skills') }}</th>
                      <th>{{ __('freelancer.Posted') }}</th>
                      <th>{{ __('freelancer.Content') }}</th>
                      <th>{{ __('freelancer.Offers') }}</th>
                    </tr>
                  </thead>
                  <tbody class="table-header-title">
                  @if(!empty($offers))
                    @foreach($offers as $ofer)
                    <?php
                      $job_skills = App\Http\Controllers\HelperController::maybe_unserialize($ofer->job_skills);
                      $job_skills = (is_array($job_skills)?implode(' , ',$job_skills):$job_skills);
                     ?>
                    <tr>
                      <td><a class="table-header-title" href="{{ url('fr/view/proposal/') }}/<?php echo \Crypt::encryptString($ofer->job_id) ?>" ><?php echo $ofer->job_title; ?></a></td>
                      <td><?php echo $job_skills ?></td>
                      <td><?php echo date('M d, Y', strtotime($ofer->received)); ?></td>
                      <td><?php echo $ofer->job_description; ?></td>
                      <td>
                        <?php if($ofer->invitation_interview == 1 && $ofer->offers == 1 && $ofer->accept_offer == 0) { ?>
                        <button type="button" class="btn btn-round btn-primary btn-color" onclick="accept_offer(<?php echo $ofer->proposal_id; ?>, <?php echo $ofer->Proposal_user; ?>)">{{ __('freelancer.AcceptOffer') }}</button>
                        <a href="{{url('reject-proposal/'.$ofer->proposal_id)}}" class="btn btn-round btn-danger">{{ __('freelancer.RejectOffer') }}</a>
                        <?php } ?>
                      @if($ofer->offers==1&&$ofer->accept_offer==1&&$ofer->progress==0)
                        <button class="btn btn-color">Waiting Client Response</button>
                          @endif
                      </td>
                    </tr>
                  @endforeach
                    @else

                  <tr><td colspan="4"><h3 align="center">{{__('freelancer.no_offer')}}</h3></td></tr>

                 @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="archive-tab">
            <div class="x_panel">
              <div class="x_title">
                <h2 class="table-header-colums-title float_right">{{ __('freelancer.Archive') }}</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead class="table-header-colums-title">
                    <tr>
                      <th>{{ __('freelancer.ProjectName') }}</th>
                      <th>{{ __('freelancer.Skills') }}</th>
                      <th>{{ __('freelancer.Posted') }}</th>
                      <th>{{ __('freelancer.Content') }}</th>
                      <th>{{ __('freelancer.Feedback') }}</th>
                    </tr>
                  </thead>
                  <tbody class="table-header-title">
                  @if(!empty($completed))
                    @foreach($completed as $arch)
                    <?php
                      $job_skills = App\Http\Controllers\HelperController::maybe_unserialize($arch->job_skills);
                      $job_skills = (is_array($job_skills)?implode(' , ',$job_skills):$job_skills);
                     ?>
                    <tr>
                      <td><a class="table-header-title" href="{{ url('fr/view/proposal/') }}/<?php echo \Crypt::encryptString($arch->job_id) ?>" ><?php echo $arch->job_title; ?></a></td>
                      <td><?php echo $job_skills ?></td>
                      <td><?php echo date('M d, Y', strtotime($arch->received)); ?></td>
                      <td><?php echo $arch->job_description; ?></td>
                      <td><button class="btn btn-round btn-default btn-color" onclick="window.location.href='<?php echo url('/') ?>/give/fr/feedback/{{encrypt($arch->job_id)}}'">{{__('freelancer.Feedback') }}</button></td>
                    </tr>
                    @endforeach
                  @else

                 <tr><td colspan="4"><h3 align="center">{{__('freelancer.no_archive')}}</h3></td></tr>

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
</div>

@include ('include/footer_fr')
