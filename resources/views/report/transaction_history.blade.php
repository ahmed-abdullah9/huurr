@include ('include/header_fr')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 class="float_right"> {{ __('freelancer.History') }} </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <?php
        $from_date = (isset($_REQUEST['from_date'])?$_REQUEST['from_date']:date('Y-m-d', strtotime('-30 days')));
        $to_date = (isset($_REQUEST['to_date'])?$_REQUEST['to_date']:date('Y-m-d'));

       ?>
        <form class="form-horizontal">
          <fieldset>
            <div class="">
              <div class="">
                <div class="input-prepend input-group"> <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                  <input type="text" name="from_date" id="from_date" readonly="" value="<?php echo $from_date; ?>"> - <input readonly type="text" name="to_date" id="to_date" value="<?php echo $to_date ?>"> <button type="submit"><i class="fa fa-calendar" aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
      <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr>
              <th>#</th>
              <th>{{ __('freelancer.Amount/Balance') }}</th>
              <th>{{ __('freelancer.Date') }}</th>
              <th>{{__('freelancer.action')}}</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $amount=[];
        ?>
        @foreach($transaction as $tras)
            <?php $amount[]=$tras->amount_request;  ?>
            <tr>
              <td>{{$tras->id}}</td>
                <td>{{Config::get('constants.constant.currency')}}{{$tras->amount_request}}</td>
                <td>{{$tras->created_at}}</td>
                <td><a target="_blank" href="{{asset('public/imagesbankReceipent')}}/{{$tras->bank_rec}}" download=""><i class="fa fa-download"></i></a></td>
            </tr>

            @endforeach

        </tbody>
      </table>
      <br/>
      <br/>
      <div class="row"> 
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead"></p>
          <img src="" alt=""> <img src="" alt=""> <img src="" alt=""> <img src="" alt=""> </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead"> {{ __('freelancer.StatementPeriod') }} <?php echo $from_date; ?> {{__('freelancer.to')}} <?php echo $to_date; ?></p>
          <div class="table-responsive">
            <table class="table">

              <tbody>
              <tr>
              <td>{{__('freelancer.BeginnigBalance')}}</td>
              <td>{{Config::get('constants.constant.currency')}}{{ $beginnamount=isset($user_balance->amount)?$user_balance->amount:0}}</td>
              </tr>

          <tr>
               <td>{{ __('freelancer.TotalCredits') }}  </td>
               <td>{{Config::get('constants.constant.currency')}}{{$credit=sizeof($amount)>0?array_sum($amount):0}}</td>
            </tr>
         </tbody>
      <tfoot>
            <tr>
               <td class = "Client"><strong>{{ __('freelancer.EndingBalance') }} </strong></td>             
            <td class = "Client"><strong>{{Config::get('constants.constant.currency')}}{{$beginnamount-$credit}}</strong></td>
            </tr>
         </tfoot>
            </table>
          </div>
        </div>
        <!-- /.col --> 
      </div>
    </div>
  </div>
@include ('include/footer_fr')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );
  $( function() {
    $( "#from_date" ).datepicker({ 
                dateFormat: 'yy-mm-dd',
                maxDate: new Date(),
                onSelect: function (dateText, inst) {
                    $("#to_date").datepicker({ minDate: new Date(dateText)})
                }
     });
  } );
    $( function() { 
    $( "#to_date" ).datepicker({ 
                      dateFormat: 'yy-mm-dd',
                      maxDate: new Date(),
                      onSelect: function (dateText, inst) {
                          $("#from_date").datepicker({ maxDate: new Date(dateText)})
                      }

     });
  } );
  
</script>