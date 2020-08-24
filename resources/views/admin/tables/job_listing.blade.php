<table id="data" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                @if($job->status == 1)
                    <span class="label label-success">Open</span>
                @elseif($job->status==-1)
                    <span class="label label-warning">Draft</span>
                @elseif($job->progress==0)
                    <span class="label label-success">Open</span>
                @elseif($job->progress==1)
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
<div calss="container">
    @if ($jobs->lastPage() > 1)
        <ul class="pagination">
            <li class="{{ ($jobs->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $jobs->url(1) }}">Previous</a>
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