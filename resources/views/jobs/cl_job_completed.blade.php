@include ('include/header_cl')<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">    <div class="x_title">
            <h2 class="table-heading">Client Completed Jobs</h2>
            <div class="clearfix"></div>    </div>    <div class="x_content">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead class="table-header-colums-title">
                <tr>            <th>{{ __('freelancer.ProjectName') }}</th>
                    <th>{{__('client.amount_paid')}}</th>
                    <th>{{__('client.frelncer')}}</th>
                    <th>{{ __('freelancer.EndDate') }}</th>
                    <th>{{ __('freelancer.action') }}</th>
                </tr>        </thead>
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
                    <td><a class="table-header-title" href="{{ url('clmy/job') }}/<?php echo($job->job_id) ?>" ><?php echo $job->job_title; ?></a></td>
                    <td>{{Config::get('constants.constant.currency')}}<?php echo $job->total_amount; ?></td>
                    <td><?php echo $job->freelancer_name; ?></td>
                    <td> <?php echo date('M d, Y', strtotime($job->start_date)); ?> </td>
                    <td><button class="btn btn-round btn-default btn-color" onclick="window.location.href='<?php echo url('/') ?>/give/cl/feedback/{{encrypt($job->job_id)}}'">{{ __('freelancer.Feedback') }}</button>
                    <a class="btn btn-round btn-default btn-color"  href="{{url('download/receipent')}}/{{encrypt($job->id)}}" target="_blank"><i class="fa fa-download"></i></a>
                    </td>
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

@include ('include/footer_cl')
