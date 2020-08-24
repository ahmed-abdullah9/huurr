@include ('include/header_admin')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 style="display: inline;">Successfull Completed Jobs </h2>
            @if(Session::has('info'))
                <div style="display: inline;float: right;" class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('info') }}
                </div>
            @elseif(Session::has('message'))
                <div style="display: inline;float: right;" class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <p class="text-muted font-13 m-b-30">  {{__('client.all_f_jobs')}} </p>
            <br/>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Job</th>
                    <th>Status</th>
                    <th>Date Posted</th>
                    <th>Posted By</th>
                    <th>Hires</th>
                </tr>
                </thead>
                <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <th> {{ $job->job_title }}</th>
                        <td>
                            @if($job->progress == 1)
                                <span class="label label-success">In Progress</span>
                            @elseif($job->progress==2)
                                <span class="label label-success">In Review</span>
                            @elseif($job->progress==3)
                                <span class="label label-success">Completed</span>
                            @endif

                        </td>
                        <td>{{ date("M d", strtotime($job->created_at)) }} <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans()}}</small></td>
                        <td><?php echo $job->name; ?></td>
                        <td><i class='fa fa-check-circle-o'></i> <?php echo $job->hired; ?> Hire</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include ('include/footer_admin')
