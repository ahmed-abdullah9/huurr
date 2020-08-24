@include('include.header_fr')
<div style="margin-top: 10%;" class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10 col-xs-12">
            <h2 style="padding-bottom: 10px;font-weight: bold;font-size: 30px;" class="table-heading">{{__('freelancer.fr_report')}}</h2>
<ul style="font-size: 150%;margin-top: 30px;" class="nav nav-tabs">
    <li class="active"><a class="table-header-colums-title" href="#progress">{{__('freelancer.progress')}} ({{Config::get('constants.constant.currency')}}{{$progress_amount_sum}})</a></li>
    <li><a class="table-header-colums-title" href="#review">{{__('freelancer.in_review')}}({{Config::get('constants.constant.currency')}}{{$review_amount_sum}})</a></li>
    <li><a class="table-header-colums-title" href="#pending">{{__('freelancer.pending')}} ({{Config::get('constants.constant.currency')}}{{$pending_amount_sum}})</a></li>
    <li><a class="table-header-colums-title" href="#availible">{{__('freelancer.availible')}} ({{Config::get('constants.constant.currency')}}{{$availible_amount_sum}})</a></li>
</ul>
<div style="margin-top: 30px;" class="tab-content">
    <div id="progress" class="tab-pane fade in active">
        <div class="table-responsive">
            <table style="padding-top: 10px;" class="table">
                <thead style="" class="table-header-title">
                <tr>

                    <th>{{__('freelancer.jobs')}}</th>
                    <th>{{__('freelancer.client')}}</th>
                    <th>{{__('freelancer.amount')}}</th>
                    <th>{{__('freelancer.action')}}</th>
                </tr>
                </thead>
                <tbody class="table-header-title">
                 @foreach($progress_amount as $progress)
                <tr>
                    <td> <a  href="{{url('/fr/request/hours')}}/{{encrypt($progress->job_id)}}">{{$progress->job_title}}</a></td>
                    <td>{{$progress->client_name}}</td>
                    <td>@if($progress->job_time_type=='hourly'){{Config::get('constants.constant.currency')}}{{$progress->pay_amount}}  /hr @else{{Config::get('constants.constant.currency')}} {{$progress->amount}}  @endif</td>
                    <td>
                        @if($progress->job_time_type=='fixed')
                        <button class="btn btn-color">{{__('freelancer.fixed_job')}}</button>
                            @else
                        <a class="btn btn-color" href="{{url('/fr/request/hours')}}/{{encrypt($progress->job_id)}}">{{__('freelancer.add_hours')}}</a>
                            @endif
                    </td>
                </tr>
                     @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="review" class="tab-pane fade">
        <div class="table-responsive">
            <table class="table">
                <thead class="table-header-title">
                <tr>

                    <th>{{__('freelancer.jobs')}}</th>
                    <th>{{__('freelancer.client')}}</th>
                    <th>{{__('freelancer.amount')}}</th>
                </tr>
                </thead>
                <tbody class="table-header-title">
                @foreach($review_amount as $r_amount)
                <tr>
                    <td>{{$r_amount->job_title}}</td>
                    <td>{{$r_amount->client_name}}</td>
                    <td>{{Config::get('constants.constant.currency')}}{{$r_amount->amount}}</td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="pending" class="tab-pane fade">
        <div class="table-responsive">
            <table class="table">
                <thead class="table-header-title">
                <tr>

                    <th>{{__('freelancer.jobs')}}</th>
                    <th>{{__('freelancer.client')}}</th>
                    <th>{{__('freelancer.amount')}}</th>
                </tr>
                </thead>
                <tbody class="table-header-title">
                @foreach($pending_amount as $pending)
                <tr>
                    <td>{{$pending->job_title}}</td>
                    <td>{{$pending->client_name}}</td>
                    <td>{{Config::get('constants.constant.currency')}}{{$pending->pending_amount}}</td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="availible" class="tab-pane fade">
        <div class="table-responsive">
            <table  class="table-hover">
                <tr style="color: black;font-size: 20px;">
                    <td>{{__('freelancer.progress_amount')}}  </td>
                    <td>{{Config::get('constants.constant.currency')}}{{$progress_amount_sum}}</td>
                </tr>
                <tr style="color: black;font-size: 20px;">
                    <td>{{__('freelancer.review_amount')}}</td>
                    <td>{{Config::get('constants.constant.currency')}}{{$review_amount_sum}}</td>
                </tr>
                <tr style="color: black;font-size: 20px;">
                    <td>{{__('freelancer.pending_amount')}}</td>
                    <td>{{Config::get('constants.constant.currency')}}{{$pending_amount_sum}}</td>
                </tr>
                <tr style="color: black;font-size: 20px;">
                    <td>{{__('freelancer.availible_amount')}}</td>
                    <td>{{Config::get('constants.constant.currency')}}{{$availible_amount_sum}}</td>
                </tr>

            </table>
            @if(!empty($bank_info))
            @if($availible_amount_sum>0)
            <a  class="center btn btn-color" href="{{url('fr/withDrawRequest')}}">Withdraw amount ${{$availible_amount_sum}}</a>
            @else
                @endif
                @else
             Yet You have not added Bank Detail Please add bank detail
             <a class="btn btn-color" href="{{url('fr/bank_info')}}"><i class="fa fa-bank"></i>Add Bank Info</a>
            @endif
        </div>
    </div>
</div>
</div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".nav-tabs a").click(function(){
            $(this).tab('show');
        });
    });
</script>
@include('include.footer_fr')