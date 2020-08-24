@include ('include/header_admin')
<div class="col-md-12 col-sm-12 col-xs-12" id ="response">

    <form id="job_invoices" method="post" action="{{url('admin/paynow')}}">
        <div style="padding-bottom: 100px;" class="x_panel">    <div class="x_title">      <h2 style="display: inline;"> {{__('admin.complete_job_invoices')}} </h2>
                <button name="multiple_pay" value="multiple" id="paynow" style="display: inline;float: right;display: none;">PayNow</button>      <div class="clearfix"></div>    </div>    <div class="x_content">

                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">        <thead>
                    <tr>

                        {{--<th><input type="checkbox" id="checkAll"></th>     --}}
                        <th>{{__('admin.client_name')}}</th>
                        <th>{{__('admin.fr_name')}}</th>
                        <th>{{__('admin.project_title')}}</th>
                        <th>{{__('freelancer.amount')}}</th>
                        <th>Commission</th>
                        <th>{{__('admin.date')}}</th>
                        <th>Action</th>

                        {{--<td><input name="single_job_id" type="hidden" value="{{$job->job_id}}">--}}
                            {{--<input class="check"  name="job_id[]" value="{{$job->job_id}}" type="checkbox"></td>--}}

                        {{--<td><button name="single_pay" value="paid">{{__('admin.paynow')}}</button></td>--}}

                    </tr>
                    </thead>
                    <tbody id="invoices">
                    @foreach($jobs as $job)
                        @php
                        $commision=array();

                        $commision[]=$job->job_bid_amount-$job->amount_pay_to_freelancer;
                        @endphp

                        <tr>
                            {{--<td><input name="single_job_id" type="hidden" value="{{$job->job_id}}">--}}
                            {{--<input class="check"  name="job_id[]" value="{{$job->job_id}}" type="checkbox"></td>--}}
                            <td><a href="{{url('user/detail')}}/{{encrypt($job->client_id)}}" target="_blank">{{$job->client_name}}</a></td>
                            <td><a href="{{url('user/detail')}}/{{encrypt($job->freelancer_id)}}" target="_blank">{{$job->freelancer_name}}</a></td>
                            <td><a href="{{url('job/proposal')}}/{{Illuminate\Support\Facades\Crypt::encryptString($job->job_id)}}" target="_blank">{{$job->job_title}}</a></td>
                            <td>{{Config::get('constants.constant.currency')}}{{$job->amount}}</td>
                            <td>{{Config::get('constants.constant.currency')}}{{$job->job_bid_amount-$job->amount_pay_to_freelancer}}</td>
                            <td>{{$job->date}}</td>
                            <td>{{__('admin.freelancer')}} <a target="_blank" href="{{url('download/receipent')}}/{{encrypt($job->id)}}/freelancer"><i class="fa fa-download"></i></a> | {{__('admin.client')}} <a target="_blank" href="{{url('download/receipent')}}/{{encrypt($job->id)}}/client"><i class="fa fa-download"></i></a></td>
                            {{--<td><button name="single_pay" value="paid">{{__('admin.paynow')}}</button></td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>

      

            </div>

        </div>
       
    </form>
    @if(sizeof($jobs)>0)
                   <div calss="container ">
                   <?php
                   $url=url('jobs/invoices');
                   ?>
      
                      @if ($jobs->lastPage() > 1)
                        <ul class="pagination jobs">
                            <li class="{{ ($jobs->currentPage() == 1) ? 'disabled' : '' }}">
                                <a href="{{ $url}}{{ $jobs->url(1) }}">Previous</a>
                            </li>
                        
                            @for ($i = 1; $i <= $jobs->lastPage(); $i++)
                      
                                <li  id="jobs-{{$i}}" data-id="{{$i}}" class="{{ ($jobs->currentPage() == $i) ? 'active' : '' }}">
                                    <a href="{{ $url}}{{ $jobs->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($jobs->currentPage() == $jobs->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $jobs->url($jobs->currentPage()+1) }}" >Next</a>
                            </li>
                        </ul>
                     @endif
                    </div> 
                    @else
                  <h2 align="center">No data available</h2>
             @endif
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3 style="display: inline;padding-left: 10px;">{{__('admin.total_amount')}}  {{Config::get('constants.constant.currency')}}{{$total}}  </h3>

        </div>
        <div class="col-md-6">
            <h3 style="display: inline;padding-left: 10px;">{{__('admin.total_commission')}} {{Config::get('constants.constant.currency')}}{{array_sum($commision)}}    </h3>
        </div>
    </div>
</div>
<script>
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
        if($("#checkAll").is(':checked'))
            $("#paynow").show();
        else
            $("#paynow").hide();
    });
    $(function(){
        if($("#checkAll").is(':checked'))
            $("#paynow").show();
        else
            $("#paynow").hide();
    });

</script>
<script>
//  $(window).on('hashchange', function() {
//         if (window.location.hash) {
//             var page = window.location.hash.replace('#', '');
//             if (page == Number.NaN || page <= 0) {
//                 return false;
//             }else{
//                 getData(page);
//             }
//         }
//     });
$(document).ready(function()
{
  $(document).on('click', '.pagination a', function(e) {
             e.preventDefault(); 
            $(".freelancer.pagination li").removeClass('active');
            var url = $(this).attr('href');
        
            $(this).parent().addClass('active');
            // var search=$("#search").val();
            // url=url+"&find="+search;
            getData(url);
            
            window.history.pushState("", "", url);
        });
         
});
function getData(url){
            $.ajax({
                url :url,
                type:"POST",
                data:$("#job_invoices").serialize(),
            }).done(function (data) {
                $('#response').html(data);
            }).fail(function () {
                console.log('could not be loaded.');
            });
        }

  </script>
@include ('include/footer_admin')
