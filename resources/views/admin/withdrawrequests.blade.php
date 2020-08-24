@include('include.header_admin')
<div class="container">
    <div class="row">
        @if(Session::has('info'))
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        @endif
        <div class="col-md-12 col-xs-12">
            <h2 align="center">{{__('admin.fr_withdraw_req')}}</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{__('admin.first_name')}}</th>
                    <th>{{__('admin.last_name')}}</th>
                    <th>{{__('admin.email')}}</th>
                    <th>{{__('admin.bank')}}#</th>
                    <th>{{__('admin.bank_name')}}</th>
                    <th>{{__('admin.bank_address')}}</th>
                    <th>{{__('freelancer.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($request_info as $info)
                <tr>
                    <td>{{$info->first_name}}</td>
                    <td>{{$info->last_name}}</td>
                    <td>{{$info->email}}</td>
                    <td>{{$info->account_no}}</td>
                    <td>{{$info->bank_name}}</td>
                    <td>{{$info->bank_address}}</td>
                    <td>@if($info->is_paid==0)<a href="{{url('amount/tranfer/to_fr')}}/{{encrypt($info->id)}}" class="btn">{{__('admin.pay_now')}}(${{$info->amount_request}})</a>@else  <button class="btn btn-info">{{__('admin.paid')}}</button>  @endif</td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('include.footer_admin')