<?php     if(Session::get('user_role')=='client')      {       ?>
@include ('include/header_cl')
  <?php }else{ ?>
@include ('include/header_fr')
  <?php } ?>
<div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">
  <div class="clientdashboardarea">
  <div class="">
  <div class="row">
    <div class="col-xs-12">
      <form action="<?php echo url('/pay/freelancer/payfort') ?>" method="post">
      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="panel-title">
            <div class="row">
              <div class="col-xs-6">
                <button type="button" class="btn btn-primary btn-sm btn-lg pull-left" onclick="window.location.href='<?php echo url('/clmy-job') ?>'">
                  <span class="glyphicon glyphicon-arrow-left"></span> Back To Previous
                </button>
              </div>
              <div class="col-xs-6">

              </div>
            </div>
          </div>
        </div>
        <?php 
        $paid_amount = [];
       if(!empty($payfort) && is_array($payfort))
       {
        foreach ($payfort as $payforts) {
            if (!is_object($payforts)) {
                $paid_amount[]=$payforts;
            }
            else{
                $paid_amount[] = $payforts->amount;
            }


        }
       } 
        ?>
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-2">
              <h5 class="product-name"><strong>Job Title</strong></h5><h5><small><?php echo $jobs->job_title ?></small></h5>
            </div>
            <div class="col-xs-10">
              <div class="col-xs-3 text-left">
                <h5 class="product-name"><strong>Freelancer</strong></h5><h5><small><?php echo $user->name ?></small></h5>
              </div>
              <div class="col-xs-2 text-left">
                <h5 class="product-name"><strong>Contract Amount</strong></h5><h5><small>{{Config::get('constants.constant.currency')}} <?php echo $proposals->bid_amount .' +VAT Fee '.$proposals->bid_amount*$vat/100 ; ?>@if($hours!='if_not')/hr @endif</small></h5>
              </div>
              <div class="col-xs-2 text-left">
                <h5 class="product-name"><strong>Paid Amount</strong></h5><h5><small>{{Config::get('constants.constant.currency')}} <?php echo array_sum($paid_amount); ?></small></h5>
              </div>
              <div class="col-xs-2 text-left">
                <h5 class="product-name"><strong>Need To Pay</strong></h5><h5><small>{{Config::get('constants.constant.currency')}} <?php echo ($proposals->bid_amount+$proposals->bid_amount*$vat/100)-array_sum($paid_amount); ?>@if($hours!='if_not')* {{$hours->hours}}={{Config::get('constants.constant.currency')}}{{($proposals->bid_amount+$proposals->bid_amount*$vat/100)*$hours->hours}} @endif</small></h5>
              </div>
              <div class="col-xs-3">
                 <h5 class="product-name"><strong>Please Enter Amount to pay</strong></h5>
                <input type="number" @if($hours!='if_not') value="{{($proposals->bid_amount+$proposals->bid_amount*$vat/100)*$hours->hours}}" readonly required @else value="{{$proposals->bid_amount+$proposals->bid_amount*$vat/100}}" readonly required  @endif class="form-control input-sm" name="payable_amount" id="payable_amount" style="color: #000; border: 1px solid #000;" >
                @if($hours!='if_not')
                <input type="hidden" value="{{$hours->hours}}" class="form-control input-sm" name="hours" id="hours" >
                @endif
                  <input name="job_bid_amount"  type="hidden" @if($hours!='if_not') value="{{$proposals->bid_amount*$hours->hours}}" readonly required @else value="{{$proposals->bid_amount}}" readonly required  @endif class="form-control input-sm">
              </div>
              
            </div>
          </div>          
          <hr>          
        </div>
        <div class="panel-footer">
          <div class="row text-center">
            <div class="col-xs-9">
             <input type="hidden" name="proposal_id" value="<?php echo $proposals->proposal_id ?>">
             <input type="hidden" name="job_id" value="<?php echo $jobs->job_id ?>">
             <input type="hidden" name="user_id" value="<?php echo $proposals->user_id ?>">
            </div>
            <div class="col-xs-3">
              <?php 
                if($proposals->bid_amount-array_sum($paid_amount)>0)
                {
              ?>
              <button type="submit" class="btn btn-success btn-block">
                Click to Continue
              </button>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
</div>

@include ('include/footer_fr')

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(document).on('keyup', '#payable_amount', function(event) {
      event.preventDefault();
      var amount = '<?php  if($hours=='if_not'){ echo ($proposals->bid_amount-array_sum($paid_amount));}else{echo $proposals->bid_amount*$hours->hours;} ?>';
      if ($(this).val()>amount) {
        alert('please do not enter greater then $'+amount);
        $(this).val('');
        return false;
      }
    });
  });
</script>