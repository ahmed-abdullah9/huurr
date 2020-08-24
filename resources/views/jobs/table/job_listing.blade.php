<div class="x_title">
        <h2 class="table-heading" style="display: inline;">{{__('client.job_mangmnt')}} </h2>
          <p class="text-muted font-13 m-b-30"><a class="btn btn-color btn-default btn-lg pull-right" href="{{ url('create/jobpost/new-job') }}">
                  {{__('client.job_pst')}}
              </a></p>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br/>
        <table  id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead class="table-header-colums-title">
            <tr>
              <th>{{__('client.Jobs')}}</th>
              <th>{{__('client.stuts')}}</th>
              <th>{{__('client.date_pst')}}</th>
              <th>{{__('client.pst_by')}}</th>
              <th>{{__('client.hirs')}}</th>
              <th>{{__('client.acton')}}</th>
            </tr>
          </thead>
          <tbody class="table-header-title">
            @foreach($jobs as $job)
                  <tr>
                    <th><a class="table-header-title" href="{{ url('clmy/job/') }}/{{Crypt::encrypt($job->job_id)}}"> {{ $job->job_title }}</a></th>
                    <td>
                      @if($job->is_open == 1)
                        <span class="label label-success">{{__('client.open')}}</span>
                        @elseif($job->progress==0&&$job->offers==1&&$job->accept_offer==1)
                            <a class="btn btn-round btn-round btn-color" href="{{url('clmy/job')}}/{{Crypt::encrypt($job->job_id)}}/?tab=active">{{__('client.satrt_contract')}} </a>
                      @elseif($job->is_draft==1)
                        <span class="label label-warning">{{__('client.draft')}}</span>
                      @elseif($job->progress==3)
                        <span class="label label-success">{{__('client.completed')}}</span>
                      @elseif($job->progress==1)
                        <span class="label label-success">{{__('client.in_progress')}}</span>
                      @elseif($job->progress==2)
                        <span class="label label-success">{{__('client.in_view')}}</span>
                      @elseif($job->progress==0)
                        <span class="label label-success">{{__('client.open')}}</span>
                        @elseif($job->progress==0)
                            <span class="label label-success">{{__('client.open')}}</span>
                      @endif
                      
                    </td>
                    <td>{{ date("M d", strtotime($job->created_at)) }} <small>{{\Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans()}}</small></td>
                    <td><?php echo $job->name; ?></td>
                    <td><i class='fa fa-check-circle-o'></i> {{$job->fl_number}} {{__('client.hirs')}} </td>
                    <td><a class="table-header-title" href="{{ url('jobpost') }}/{{Crypt::encrypt($job->job_id)}}/edit">{{__('client.edt')}}</a></td>
                  </tr>
                  @endforeach
          </tbody>
        </table>
      </div>
      @if(sizeof($jobs)>0)
                  <div calss="container ">
                  <?php
                   $url=url('joblist');
                   ?>
                    @if ($jobs->lastPage() > 1)
                        <ul class="pagination job">
                        <li class="{{ ($jobs->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $jobs->url(1) }}">{{__('client.first')}} </a>
                            </li>
                            <li class="{{ ($jobs->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $jobs->url($jobs->currentPage()-1) }}">{{__('client.previous')}}</a>
                            </li>
                            
                            @if($jobs->lastPage()>10)
                            <?php if ($jobs->currentPage()>5){
                               $x=$jobs->currentPage()-4;
                               $y =$jobs->currentPage()+5;
                            }
                            else{
                              $x =1;
                              $y =9;
                            }
                            
                            ?>
                            @for ($i =$x; $i <=$y ; $i++)

                            @if($i-1<$jobs->lastPage())
                                <li   id="jobs-{{$i}}" data-id="{{$i}}" class="{{ ($jobs->currentPage() == $i) ? ' active' : '' }}">
                                    <a href="{{ $url}}{{ $jobs->url($i) }}">{{ $i }}</a>
                                </li>
                                @endif
                            @endfor
                            @else
                            @for ($i =1; $i <= $jobs->lastPage(); $i++)

                            <li   id="jobs-{{$i}}" data-id="{{$i}}" class="{{ ($jobs->currentPage() == $i) ? ' active' : '' }}">
                             <a href="{{ $url}}{{ $jobs->url($i) }}">{{ $i }}</a>
                               </li>

                               @endfor
                

                            @endif
                            <li class="{{ ($jobs->currentPage() == $jobs->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $jobs->url($jobs->currentPage()+1) }}" >{{__('client.next')}}</a>
                            </li>
                            <li class="{{ ($jobs->currentPage() == $jobs->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $jobs->url($jobs->lastPage()) }}" >{{__('client.last')}}</a>
                            </li>
                        </ul>
                    @endif
                  </div>
                  @else
                  <h2 align="center">{{__('client.No_data_available')}}</h2>
             @endif