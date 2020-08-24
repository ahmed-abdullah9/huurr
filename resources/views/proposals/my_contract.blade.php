@include ('include/header_fr')
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>{{ __('freelancer.AllContracts') }} </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

      <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>{{ __('freelancer.ProjectName') }}</th>
            <th>{{ __('freelancer.Skills') }}</th>
            <th>{{ __('freelancer.StartDate') }}</th>
            <th>{{ __('freelancer.Content') }}</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(!empty($jobs))
          {
            foreach($jobs as $job)
            {
              $job_skills = App\Http\Controllers\HelperController::maybe_unserialize($job->job_skills);
              $job_skills = (is_array($job_skills)?implode('</span><span>',$job_skills):$job_skills);
             ?>
            <tr>
              <td><a href="{{ url('fr/view/proposal/') }}/<?php echo \Crypt::encryptString($job->job_id) ?>" ><?php echo $job->job_title; ?></a></td>
              <td><?php echo $job_skills ?></td>
              <td><?php echo date('M d, Y', strtotime($job->created_at)); ?></td>
              <td><?php echo $job->job_description; ?></td>
            </tr>
            <?php
              }
            }else
            {
              echo 'There is no job yet!!!';
            }
            ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
@include ('include/footer_fr')
