<h3 class="skills__d" style="color: #666666;padding-bottom: 10px !important;display: inline;" data-toggle="modal" data-target="#Overview" >{{ __('freelancer.Overview') }} <a href="javascript:;"><i style="color: #666666;" class="fa fa-pencil-square-o edite" aria-hidden="true"></i></a>
   <br>
    <small>@if(!empty($profile_data)){{ $profile_data->overview }}@endif</small>
  </h3>


<!-- POP up modal for overview -->

<div style="border-top:1px solid black;" class="modal fade" id="Overview" role="dialog">
    <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ url('/profileupdate') }}/{{ $user_data->user_id }}">
          {{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style=" color: #666666;" class="modal-title table-header-colums-title">{{ __('freelancer.Overview') }}</h4>
        </div>
        <div class="modal-body">
          <h4>{{ __('freelancer.OverviewMSG') }}</h4>
    		  <ul class="user_overview_list">
    		  <li>{{ __('freelancer.OverviewMSG1') }} </li>
    		  <li>{{ __('freelancer.OverviewMSG2') }}</li>
    		  <li>{{ __('freelancer.OverviewMSG3') }} </li>
    		  </ul>

		    <div class="text-area">
        <textarea class="overview_textArea" name="overview" placeholder="">@if(!empty($profile_data)){{ $profile_data->overview }}@endif</textarea>
       </div>		 
		  
        </div>
        <div class="modal-footer">
            <a href="" class="btn-btn-default btn" data-dismiss="modal">{{ __('freelancer.Cancel') }}</a>
          <button type="submit" class="btn btn-default btn-color">{{ __('freelancer.Save') }}</button>

        </div>
      </div>
      </form>
    </div>
  </div>