@include ('include/header_admin')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">    <div class="x_title">
            <h2 class="float_right">{{__('admin.claim_job_listing')}} </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>{{__('admin.client_name')}}</th>
                    <th>{{__('admin.fr_name')}}</th>
                    <th>{{__('admin.project_title')}}</th>
                    <th>{{__('admin.claim_reason')}}</th>
                    <th>{{__('freelancer.amount')}}</th>
                    <th>{{__('admin.date')}}</th> </tr>
                </thead>
             <tbody>
             @foreach($jobs as $job)
             <tr>
                 <td>{{$job->client_name}}</td>
                 <td>{{$job->freelancer_name}}</td>
                 <td>{{$job->job_title}}</td>
                 <td>
                     @if($job->reason==1)
                         Work is Not Completed
                         @elseif($job->reason==2)
                          Freelancer is not responding
                         @endif
                 </td>
                 <td>{{Config::get('constants.constant.currency')}}{{$job->amount}}</td>
                 <td>{{$job->job_claim_date}}</td>
             </tr>
                 @endforeach
             </tbody>
            </table>
        </div>
        <h2 align="center">{{__('admin.total_pending_amount')}}   {{$pending}}</h2>
    </div>
</div>

@include ('include/footer_admin')
