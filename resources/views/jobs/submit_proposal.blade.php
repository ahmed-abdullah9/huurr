    @if(Session::get('user_role')=='client')
@include ('include/header_cl')
  @else
@include ('include/header_fr')
  @endif

<div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">
<form action="{{ url('createproposal') }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
	<div class="clientdashboardarea">
      <div class="">
        <div class="row clienttoprow">
          <div class="col-md-12 col-sm-12">
            <h3 style="padding-bottom: 15px;" class="main-form-title">{{ __('freelancer.SubmitPropsal') }}</h3>
          </div>
          @if($errors->any())
            <h4 style="color: red;">{{$errors->first()}}</h4>
          @elseif($error_msg!='')
          <h4 style="color: red;">{{$error_msg}}</h4>
          @endif
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 ">
            <div class="panel panel-default">
              <div class="panel-heading table-header-colums-title"><h4>{{ $jobs->job_title }}</h4></div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12 bordered-right">
                    <div class="col-md-4 bordered-right">
                      <input value='{{ $jobs->job_id }}' type="hidden"  name="job_id" class="form-control c-form has-form-message  text-right" >
                      <input value='{{ $proposal_id }}' type="hidden"  name="proposal_id">
  
                    <p>{{$jobs->job_description}}</p>
                  </div>
                </div>

              </div>
            </div>


            <!--<div class="panel panel-default">
              <div class="panel-heading">Connects</div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">

                    <p>This proposal requires <b>2 Connects</b> 
                      <i class="fa fa-question-circle" data-toggle="tooltip" title="This is the number of Connects that will be deducted from your balance when you submit proposal." data-placement="bottom"></i>
                    </p>

                    <p>When you submit a proposal, you'll have 68 Connects remaining. Your Connects reset on November, 25.</p>

                  </div>

                </div>

              </div>
            </div>-->


            <div class="panel panel-default">
              <div class="panel-heading">{{ __('freelancer.Terms') }} <small class='pull-right'>@if(!empty($jobs->budget)){{ __('freelancer.ClientBudget') }}  {{Config::get('constants.constant.currency')}}{{ $jobs->budget }}@endif</small></div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-9">
                    <h4 class="section-title form-label-color">{{ __('freelancer.AmountBid') }}</h4>
                    <div class="form-group bordered-form" >
                      <div class="row">
                        <div style="margin-top: 10px;" class="col-md-7">
                          <span class="table-header-title">
                            <font style="font-weight: bolder;">({{ __('freelancer.Bid') }})</font>
                            {{ __('freelancer.TotalAmount') }}
                          </span>
                        </div>
                        <div class="col-md-4 col-md-offset-1 field-outside">

                          <span class="currency_icon">{{Config::get('constants.constant.currency')}}</span>

                          <input value='{{ $jobs->budget }}' type="text" id="hourly_rate" style="display: inline;width: 160px;"  name="bid_amount" class="form-control c-form has-form-message  text-right" required="required" >@if($jobs->job_time_type=='hourly') /hr @endif
                        </div>

                      </div>
                    </div>

                    <div class="form-group bordered-form" >
                      <div class="row">
                        <div class="col-md-7">
                          <h4 style="font-weight: bolder;" class="form-label-color">{{ __('freelancer.ServiceFee') }} {{$jobs->job_fee}}%, <i class="fa fa-question-circle" data-toggle="tooltip" title="this is a hour fee"></i> </h4>
                        </div>
                        <div class="col-md-4 col-md-offset-1">

                          <span class="currency_icon">{{Config::get('constants.constant.currency')}}</span>

                          <input value='%{{$jobs->job_fee}}' readonly type="text" id="service_fee"  name="chargedAmount" style="display: inline;width: 160px;" class="form-control c-form has-form-message field-outside text-right">
                        <input type="hidden" value="{{$jobs->job_fee}}" id="job_charges" readonly>
                        </div>

                      </div>
                    </div>


                    <div class="form-group bordered-form" >
                      <div class="row">
                        <div class="col-md-7">
                          <h4 class="form-label-color">{{ __('freelancer.Paid') }}</h4>
                          <span class="table-header-title">{{ __('freelancer.Estimated') }}
                            <i class="fa fa-question-circle" data-toggle="tooltip" title="Amount may vary slightly due to rounding."></i> 
                          </span>
                        </div>
                        <div class="col-md-4 col-md-offset-1 field-outside">

                          <span class="currency_icon">{{Config::get('constants.constant.currency')}}</span>

                          <input style="display: inline;width: 160px;" value="{{ $jobs->budget - $jobs->budget*$jobs->job_fee/100 }}" id="will_be_paid" type="text"  name="pay_amount" class="form-control c-form has-form-message  text-right" readonly required="required">@if($jobs->job_time_type=='hourly') /hr @endif
                        </div>

                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>
             <div class="panel panel-default">
              <div class="panel-footer">
                <div class="">
                  <?php
                if(\App\Http\Controllers\ProfileController::profile_percentage(Session::get('login_id'))<80)
                {
                  ?>
                  <a onClick="return confirm('Please Complete Your profile to bid on this job')" class="btn btn-primary btn-color">{{ __('freelancer.SubmitProposal') }}</a>
                  <?php
                }else
                {
                  ?>
                  <input type="submit" class="btn btn-primary btn-color" value="{{ __('freelancer.submit_propsal') }}">
                  <?php
                }
             ?>
                   <a href="{{url('find/work')}}" class="btn btn-link">{{ __('freelancer.Cancel') }}</a>
                 </div>
              </div>
             </div>
          </div>
        </div>
      </div>
      <br>
      <br>
    </div>
  </form>
@include ('include/footer_fr')