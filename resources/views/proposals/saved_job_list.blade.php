@include ('include/header_fr')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 class="table-heading">{{ __('freelancer.SaveJobs') }}</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
     
        <table id="datatable-responsive"
               class="table table-striped table-bordered dt-responsive nowrap"
               cellspacing="0" width="100%">
          <thead class="table-header-colums-title">
            <tr>
              <th>{{ __('freelancer.ProjectName') }}</th>
              <th>{{ __('freelancer.Skills') }}</th>
              <th>{{ __('freelancer.Budget') }}</th>
              <th>{{ __('freelancer.FreelancerNeeded') }}</th>
              <th>{{ __('freelancer.Posted') }}</th>
              <th>{{ __('freelancer.action') }}</th>
              {{--<th>{{ __('freelancer.Work') }}</th>--}}
            </tr>
          </thead>
          <tbody class="table-header-title">
            @if(!empty($saved_job))
              @foreach($saved_job as $job)
              <?php
                $job_skills = App\Http\Controllers\HelperController::maybe_unserialize($job->job_skills);
                $job_skills = (is_array($job_skills)?implode('</span><span>',$job_skills):$job_skills);
               ?>
              <tr>
                <td><a class="table-header-title" href="{{ url('/submit/proposal/') }}/<?php echo \Crypt::encryptString($job->job_id) ?>" ><?php echo $job->job_title; ?></a></td>
                <td><?php echo $job_skills ?></td>
                <td>{{Config::get('constants.constant.currency')}}<?php echo $job->budget ?></td>
                <td><?php echo (!empty($job->freelancer_needed)?$job->freelancer_needed:1); ?></td>
                <td><?php echo date('M d, Y', strtotime($job->created_at)); ?> </td>
                <td><a class="btn btn-round btn-default btn-color"  href="{{ url('/submit/proposal/') }}/<?php echo \Crypt::encryptString($job->job_id) ?>">{{ __('freelancer.view_detail') }}</a>
             <!--   <td><a class="btn btn-round btn-default" target="_blank" href="'.url('/submit/proposal/').'/'.Crypt::encryptString($job->job_id).'">{{ __('freelancer.SendProposal') }}</a></td>-->
              </tr>
             @endforeach
              @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @include ('include/footer_fr')