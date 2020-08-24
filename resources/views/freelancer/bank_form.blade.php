@include('include.header_fr')
<div class="container">
    <div class="row">
        <div  class="col-md-offset-1 col-md-8 col-xs-12">
            <h1 class="table-heading" style="padding: 5%;" align="center">{{__('freelancer.fr_bank_info')}}</h1>
            <form method="post" class="form-horizontal" action="{{url('fr/bank_info_update')}}">
                <div class="form-group">
                        <input type="text" value="@if(isset($bank_info->first_name)){{$bank_info->first_name}}@endif" class="form-control" name="first_name"  placeholder="First Name">
                    {{ $errors->add_bank_info->first('first_name') }}
                </div>
                <div class="form-group">
                        <input type="text" value="@if(isset($bank_info->last_name)){{$bank_info->last_name}}@endif" class="form-control" name="last_name" placeholder="Last Name">
                    {{ $errors->add_bank_info->first('last_name') }}
                </div>
                <div class="form-group">
                    <input type="text" value="@if(isset($bank_info->birth_place)){{$bank_info->birth_place}}@endif" class="form-control" name="birth_place" placeholder="Enter Birthplace">
                    {{ $errors->add_bank_info->first('birth_place') }}
                </div>
                <div class="form-group">
                    <input type="email" value="@if(isset($bank_info->fr_email)){{$bank_info->fr_email}}@endif" name="email" class="form-control" id="email" placeholder="Enter email">
                    {{ $errors->add_bank_info->first('email') }}
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="bank_name" value="@if(isset($bank_info->bank_name)){{$bank_info->bank_name}} @endif" placeholder="bank name">
                    {{ $errors->add_bank_info->first('bank_name') }}
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="@if(isset($bank_info->bank_address)){{$bank_info->bank_address}}@endif" name="bank_address"  placeholder="bank address">
                    {{ $errors->add_bank_info->first('bank_address') }}
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" value="@if(isset($bank_info->bank_account_no)){{$bank_info->bank_account_no}}@endif" name="acount_no"  placeholder="Enter bank account #">
                    {{ $errors->add_bank_info->first('acount_no') }}
                </div>
                <div class="form-group">
                        <button type="submit" class="btn btn-default pull-right btn-color">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('include.footer_fr')