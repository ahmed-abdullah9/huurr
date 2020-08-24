@include ('include/header_cl')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="table-heading">{{__('client.client_active_jobs')}} </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <br/>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead class="table-header-colums-title">
                <tr>
                    <th>{{__('client.job')}}</th>
                    <th>{{__('client.description')}}</th>
                    <th>{{__('client.date_pst')}}</th>

                </tr>
                </thead>
                <tbody class="table-header-title">
                @foreach($active_jobs as $job)
                    <tr>
                        <th><a class="table-header-title" href="{{ url('clmy/job/') }}/{{Crypt::encrypt($job->job_id)}}?tab=active"> {{ $job->job_title }}</a></th>
                        <td><?php echo $job->job_description; ?></td>
                        <td>{{ date("M d", strtotime($job->created_at)) }} <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans()}}</small></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include ('include/footer_cl')
