@include ('include/header_fr')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="float_right"> {{ __('freelancer.up_History') }} </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form class="form-horizontal">
                <fieldset>
                    <div class="">
                        <div class="">
                            <div class="input-prepend input-group"> <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                <input type="text" name="from_date" id="from_date" readonly="" placeholder="{{__('admin.from_date')}}"> - <input readonly type="text" name="to_date" id="to_date" placeholder="{{__('admin.to_date')}}"> <button type="submit"><i class="fa fa-calendar" aria-hidden="true"></i></button>
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
                <th>{{__('freelancer.job_type')}}</th>
                <th>{{ __('freelancer.Description') }}</th>

                <th>{{ __('freelancer.Amount/Balance') }}</th>
                <th>{{ __('freelancer.RefID') }}</th>
                <th>{{__('freelancer.action')}}</th>
            </tr>
            </thead>
            <tbody>
            <?php $amount=[];  ?>
               @foreach($jobs as $job)
            <tr>
                <td>{{$job->client_name}}  </td>
                <td>{{$job->job_title}}</td>
                <td>{{$job->job_description}} </td>
                <td>{{Config::get('constants.constant.currency')}}{{$job->amount}}</td>
                <td>{{$job->payfort_key}}</td>
                <td><a target="_blank" href="{{url('download/receipent')}}/{{encrypt($job->id)}}" download=""><i class="fa fa-download"></i></a></td>
            </tr>
                   <?php    $amount[]=$job->amount;           ?>
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
                <p class="lead"> {{ __('freelancer.StatementPeriod') }}</p>
                <p>{{__('freelancer.total_earn')}}    :   <b>{{Config::get('constants.constant.currency')}}<?php echo array_sum($amount);  ?> </b></p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>{{ __('freelancer.TotalCredits') }}  </td>
                            <td>{{Config::get('constants.constant.currency')}}0</td>
                        </tr>
                        <tr>
                            <td>{{ __('freelancer.TotalChanges') }}  </td>
                            <td>{{Config::get('constants.constant.currency')}}0</td>
                        </tr>

                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class = "Client"><strong>{{ __('freelancer.EndingBalance') }} </strong></td>
                            <td class = "Client"><strong>{{Config::get('constants.constant.currency')}}0</strong></td>
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