@include ('include/header_fr')<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <font style="padding: 2px;" class="table-heading">{{__('freelancer.fr_jobs')}} </font>
            <div class="clearfix"></div>
        </div>    <div class="x_content">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead class="table-header-colums-title">
                <tr>
                    <th>{{ __('freelancer.ProjectName') }}</th>
                    <th>{{__('freelancer.amount')}} </th>
                    <th>{{ __('freelancer.Skills') }}</th>
                    <th>{{ __('freelancer.StartDate') }}</th>
                    <th>{{ __('freelancer.EndDate') }}</th>
                    <th>{{ __('freelancer.Content') }}</th>
                    <th>{{ __('freelancer.Feedback') }}</th>
                </tr>
                </thead>
        <tbody class="table-header-title">
          <?php
                if(!empty($jobs))
                {
                  foreach($jobs as $job)
                  {
                    $job_skills = App\Http\Controllers\HelperController::maybe_unserialize($job->job_skills);
                    $job_skills = (is_array($job_skills)?implode('</span><span>',$job_skills):$job_skills);
                   ?>
                  <tr>
                    <td><a class="table-header-title" href="{{ url('fr/view/proposal/') }}/<?php echo \Crypt::encryptString($job->job_id) ?>" ><?php echo $job->job_title; ?></a></td>
                    <td>{{Config::get('constants.constant.currency')}}{{$job->invoice_amount}}</td>
                      <td><?php echo $job_skills ?></td>
                    <td> <?php echo date('M d, Y', strtotime($job->job_created)); ?> </td>
                    <td> <?php echo date('M d, Y', strtotime($job->job_completed_date)); ?> </td>
                    <td><?php echo $job->job_description; ?></td>
                    <td><button class="btn btn-round btn-default btn-color" onclick="window.location.href='<?php echo url('/') ?>/give/fr/feedback/{{encrypt($job->job_id)}}'">{{ __('freelancer.Feedback') }}</button></td>
                  </tr>
                  <?php
                  }
                }
                ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

@include ('include/footer_fr')
