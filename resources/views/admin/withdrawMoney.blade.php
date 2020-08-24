@include('include.header_admin')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h2 align="center">{{__('admin.with_drw')}}</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{__('admin.first_name')}}</th>
                    <th>{{__('admin.last_name')}}</th>
                    <th>{{__('admin.email')}}</th>
                    <th>{{__('admin.bank')}}#</th>
                    <th>{{__('admin.bank_name')}}</th>
                    <th>{{__('admin.bank_address')}}</th>
                    <th>{{__('admin.recipent')}}</th>
                    <th>{{__('admin.paid_on')}}</th>
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
                        <td>@if(isset($info->bank_rec))<a target="_blank" download="" href="{{asset('public/images/bankReceipent')}}/{{$info->bank_rec}}"><i class="fa fa-download"></i></a>@endif</td>
                        <td>{{$info->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('include.footer_admin')