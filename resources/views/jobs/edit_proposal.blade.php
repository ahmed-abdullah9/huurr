<?php     if(Session::get('user_role')=='client')      {       ?>
@include ('include/header_cl')
  <?php }else{ ?>
@include ('include/header_fr')
  <?php } ?>

<div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">
	<div class="clientdashboardarea">
      <div class="">
        <div class="row clienttoprow">
          <div class="col-md-12 col-sm-12">
            <a href="{{url('/joblist')}}" class="btn btn-round btn-color"><i class="fa fa-arrow-left"></i> Go Back</a>
            <h3 style="padding-bottom: 15px;display: inline;margin-left: 30%;" align="center" class="main-form-title">Send offer</h3>
          </div>
          @if($errors->any())
            <h4 style="color: red;">{{$errors->first()}}</h4>
          @endif
        </div>
<style type="text/css">
  .color
  {
    color: #000;
  }
</style>
        <div class="clearfix"></div>
        <div class="row">
          <form action="<?php echo url('/pay/freelancer/payfort/'.Crypt::encrypt($proposals->proposal_id))  ?>" method="post">
            {{ csrf_field() }}
          <div class="col-md-12 col-sm-12 ">
            <div class="panel panel-default">
              <div class="panel-heading table-header-colums-title"><h4>{{ $jobs->job_title }}</h4></div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-7 col-xs-12 bordered-right">
                    <input value='{{ $jobs->job_id }}' disabled="" type="hidden"  name="job_id" class="form-control color c-form has-form-message  text-right" >
                    <p style="padding: 10px;color: #666666;" class="table-header-title">{{ $jobs->job_description }}
                     </p>
                    <a class="btn btn-color" target="_blank"
                       href="{{ url('/job/proposal/') }}/<?php echo \Crypt::encryptString($jobs->job_id) ?>">View Job Post</a>
                  </div>
                  <div class="col-md-5 col-xs-12">
                    <table class="table table-hover text-justify">
                       <thead class="table-header-colums-title">
                       <th>Job Type</th>
                       <th>Start Date:</th>
                       </thead>
                      <tbody class="table-header-title">
                      <td>
                        {{$jobs->job_time_type}}
                      </td>
                      <td>
                        <span class="fa fa-calendar " aria-hidden="true"></span> &nbsp;{{ date("F d Y", strtotime($jobs->created_at)) }}
                      </td>
                      </tbody>
                    </table>
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
              <div style="color: #666666;" class="panel-heading table-heading">Terms <small class='pull-right'>@if($jobs->job_time_type=='fixed')Client's budget: {{Config::get('constants.constant.currency')}}{{ $jobs->budget }} @else /hr @endif</small></div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-9">
                    <h4 class="form-label-color">What amount you bid for this job?</h4>
                    <div class="form-group bordered-form" >
                      <div class="row">
                        <div style="margin-top: 10px;" class="col-md-7">
                          <span class="form-label-color">
                            (<font>Bid</font>)  Total amount the client will be charged
                          </span>
                        </div>
                        <div class="col-md-4 col-md-offset-1 field-outside">

                          <span class="currency_icon">{{Config::get('constants.constant.currency')}}</span>

                          <input style="display: inline;width: 140px;" value='@if($jobs->job_time_type=='fixed'){{ $jobs->budget }}@else{{$proposals->bid_amount}} @endif' id="hourly_rate" type="text" name="bid_amount" class="form-control color c-form has-form-message  text-right" required>
                          @if($jobs->job_time_type=='hourly') /hr @endif
                        </div>

                      </div>
                    </div>

                    <div class="form-group bordered-form" >
                      <div class="row">
                        <div class="col-md-7">
                          <h4 class="table-header-colums-title">Vat Fee<i class="fa fa-question-circle" data-toggle="tooltip" title="Vat fee that you will pay."></i> </h4>
                        </div>
                        <div class="col-md-4 col-md-offset-1">

                          <span  class="currency_icon">{{Config::get('constants.constant.currency')}}</span>

                          <input style="display: inline;width: 140px;" value='%{{vat()}}' id="service_fee" readonly type="text" name="chargedAmount" class="form-control color c-form has-form-message field-outside text-right" >
                        </div>

                      </div>
                    </div>


                    <div class="form-group bordered-form" >
                      <div class="row">
                        <div class="col-md-7 table-header-title">
                          <h4>You'll be paid</h4>
                          <span>
                            The estimated amount you'll give after VAT fees.
                            <i class="fa fa-question-circle" data-toggle="tooltip" title="Amount may vary slightly due to rounding."></i> 
                          </span>
                        </div>
                        <div class="col-md-4 col-md-offset-1 field-outside">

                          <span class="currency_icon">{{Config::get('constants.constant.currency')}}</span>
                          <input type="hidden" value="{{$jobs->job_fee}}" id="job_charges" readonly>
                          <input style="display: inline;width: 140px;" id="will_be_paid" value="{{  $proposals->bid_amount+($proposals->bid_amount/100*vat()) }}" type="text"  name="pay_amount" class="form-control color c-form has-form-message  text-right client_amount" required readonly="readonly">
                          @if($jobs->job_time_type=='hourly') /hr @endif
                        </div>

                      </div>
                    </div>

                  </div>

                </div>
              </div>
            </div>
            <div class="form-group">
               @if(!empty($proposals->attachment_file))
                 @foreach($proposals->attachment_file as $attachment)
                <a target="_blank" href="{{url('/')}}/{{$attachment}}">View Proposal Detail</a>
                @endforeach
             @endif
            </div>
           <div class="form-group">
              <div class="panel-footer">
                <div class="">
                  <input type="submit" class="btn btn-primary btn-color" value="Send offer">
                 </div>
              </div>
           </div>
          </div>
        </form>

        </div>
      </div>
      <br>
      <br>
    </div>

    @include ('include/footer_fr')