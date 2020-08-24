@include ('include/header_cl')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
          <h2 class="table-heading" style="display: inline;">Jobs Management </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <br>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead class="table-header-colums-title">
            <tr>
              <th>{{__('client.Jobs')}}</th>
              <th>{{__('client.Status')}}</th>
              <th>{{__('client.Date Posted')}}</th>
              <th>{{__('client.pst_by')}}</th>
              <th>{{__('client.Hire')}}</th>
            </tr>
          </thead>
          <tbody class="table-header-title">
            @foreach($jobs as $job)
              <tr>
                <th><a class="table-header-title" href="{{ url('clmy/job/') }}/{{$job->job_id}}"> {{ $job->job_title }}</a></th>
                <td>
                  @if($job->status == 1)
                    <span class="label label-success">{{__('client.Open')}}</span>
                  @elseif($job->status==-1)
                    <span class="label label-danger">{{__('client.Draft')}}</span>
                    @else
                    <span class="label label-warning">{{__('client.Filled')}}</span>
                  @endif
                  
                </td>
                <td>{{ date("M d", strtotime($job->created_at)) }} <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans()}}</small></td>
                <td><?php echo $job->name; ?></td>
                <td><i class='fa fa-check-circle-o'></i> <?php echo $job->hired; ?>{{__('client.Hire')}}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@include ('include/footer_cl')
