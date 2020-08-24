<table id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>{{__('admin.name')}}</th>
        <th>{{__('admin.role')}}</th>
        <th>{{__('admin.register')}}</th>
        <th>{{__('freelancer.action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($jobs as $job)
        <tr>
            <th> {{ $job->user_nicename }}</th>
            <td>
               {{$job->user_role}}

            </td>
            <td>{{ date("Y M  d", strtotime($job->created_at)) }} <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans()}}</small></td>
            <td><a style="background-color: white;" href="{{url('user/detail')}}/{{encrypt($job->user_id)}}"><i class="fa fa-eye">VewDetail</i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<div calss="container">
    @if ($jobs->lastPage() > 1)
        <ul class="pagination">
            <li class="{{ ($jobs->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $jobs->url($jobs->currentPage()-1) }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $jobs->lastPage(); $i++)
                <li class="{{ ($jobs->currentPage() == $i) ? ' active' : '' }}">
                    <a href="{{ $jobs->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="{{ ($jobs->currentPage() == $jobs->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $jobs->url($jobs->currentPage()+1) }}" >Next</a>
            </li>
        </ul>
    @endif
</div>