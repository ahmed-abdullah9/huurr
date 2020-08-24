<table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead class="table-header-colums-title">
          <tr>
            <th>{{ __('freelancer.ProjectName') }}</th>
              <th>{{__('freelancer.skills_required')}}</th>
              <th>{{__('freelancer.job_type')}}</th>
            <th>{{ __('freelancer.Budget') }}({{Config::get('constants.constant.currency')}})</th>
            <th>{{ __('freelancer.FreelancerNeeded') }}</th>
            <th>{{ __('freelancer.Posted') }}</th>
            <th>{{__('freelancer.action')}}</th>
          </tr>
        </thead>
        <tbody class=" table-header-title" style="color:#666666;">
        <?php
                     //print_r($searches);
                    //  exit;
                 
                  if(!empty($searches))
                  {
                    //   echo "<pre>";
                    echo '<pre>';
                    
                      
                  foreach($searches as $search)
                  { 
                
                      ?>

        <tr>
            <td><a  href="{{url('/job/proposal/')}}/{{Crypt::encryptString($search->job_id)}}" class="readmore table-header-title">{{$search->job_title}}</a></td>
            <td>{{$search->job_skills}}</td>
            <td>{{$search->pp_count->job_time_type}}</td>
            <td >{{$search->budget}}</td>
            <td>{{$search->pp_count->fl_number}}</td>
            <td>{{$search->created_at }} ago </td>
            <td>
            <a class="btn btn-round btn-default btn-color" target="_blank" href="{{url('/submit/proposal/')}}/{{Crypt::encryptString($search->job_id)}}">{{__("freelancer.submit_proposal")}}</a>
           <button class="btn btn-round btn-default save_job btn-color" data-ng_bind="{{Crypt::encryptString($search->job_id)}}">{{__("freelancer.save_project")}}</button>
            </td>
          
            
          </tr>
                <?php }
                    }?>
        </tbody>
      </table>
      @if(sizeof($searches)>0)
                  <div calss="container ">
                  <?php
                   $url=url('find/work');
                   ?>
                    @if ($searches->lastPage() >= 1)
                        <ul class="pagination searches">
                            <li class="{{ ($searches->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $searches->url($searches->currentPage()-1) }}">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $searches->lastPage(); $i++)
                                <li   id="searches-{{$i}}" data-id="{{$i}}" class="{{ ($searches->currentPage() == $i) ? ' active' : '' }}">
                                    <a href="{{ $url}}{{ $searches->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($searches->currentPage() == $searches->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $searches->url($searches->currentPage()+1) }}" >Next</a>
                            </li>
                        </ul>
                    @endif
                  </div>
                  @else
                  <h2 align="center">No data available</h2>
             @endif