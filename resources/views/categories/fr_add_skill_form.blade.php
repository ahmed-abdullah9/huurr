@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            @if(isset($skills))
                <h2>Update Skill</h2>
                @else
            <h2>Skills Information</h2>
            @endif
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @if(Session::has('info'))
                        <h2 align="center" style="display: inline;display: block;" class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('info') }}
                        </h2>
                    @elseif(Session::has('message'))
                        <h2 align="center" style=" display: inline;display: block;" class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('message') }}
                        </h2>
                    @endif
                    <div class="x_panel">
                        <div class="x_content"> <br />
                            @if(isset($skills))
                                <form  method="post" data-parsley-validate action="{{ url('/update/fr/skills/')}}" class="form-horizontal form-label-left">
                                @else
                            <form  method="post" data-parsley-validate action="{{ url('/submit/fr/skills')}}" class="form-horizontal form-label-left">
                                @endif
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">title <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="name" name="name" value="@if(isset($skills)){{$skills->name}}@endif" required class="form-control col-md-7 col-xs-12">
                                    <input type="hidden" value="@if(isset($skills)){{$skills->category_id}}@else{{$category_id}}@endif" name="category_id">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-5 col-sm-6 col-xs-12  pull-right">
                                        <a href="{{ url()->previous() }}" class="btn btn-primary">{{ __('admin.Cancel') }}</a>
                                        <button type="submit" class="btn btn-success">{{ __('admin.Submit') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include ('include/footer_admin')
