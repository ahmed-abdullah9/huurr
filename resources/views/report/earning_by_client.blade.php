@include ('include/header_fr')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2 class="float_right">{{ __('freelancer.EarningByClient') }} </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
<?php
        $from_date = (isset($_REQUEST['from_date'])?$_REQUEST['from_date']:date('Y-m-d', strtotime('-30 days')));
        $to_date = (isset($_REQUEST['to_date'])?$_REQUEST['to_date']:date('Y-m-d'));

       ?>
        <form class="form-horizontal" action="" method="get">
          <fieldset>
            <div class="">
              <div class="">
                <div class="input-prepend input-group"> <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                  <input type="text" name="from_date" id="from_date" readonly="" value="<?php echo $from_date; ?>"> - <input readonly="" type="text" name="to_date" id="to_date" value="<?php echo $to_date ?>"> <button type="submit"><i class="fa fa-calendar" aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
      <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>{{ __('freelancer.Client') }}</th>
            <th>{{ __('freelancer.Job') }}</th>
            <th>{{ __('freelancer.TotalBilled') }}</th>
            {{--<th>{{ __('freelancer.FeedPaid') }}</th>--}}
          </tr>
        </thead>
        <tbody>

        @foreach($earning_client as $earn)
          <tr>
            <td>{{$earn->client_name}} </td>
            <td>{{$earn->job_title}}</td>
            <td>{{Config::get('constants.constant.currency')}}{{$earn->payamount}}</td>
            {{--<td>${{$earn->fee_paid}}</td>--}}
          </tr>
         @endforeach
        </tbody>
      </table>
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