@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>{{__('admin.member_info')}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content"> <br/>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content"> <br />
                            <form id="team-form" enctype="multipart/form-data" method="post"  class="form-horizontal form-label-left">
                                {{ csrf_field() }}
                                @if(isset($team->id))
                                <input name="team_id" type="hidden" value="{{$team->id}}" readonly>
                                @endif
                                <h5 id="success" align="center" style="color:#933f3f;"></h5>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('admin.Name') }} <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  name="name" value="@if(isset($team->name)) {{$team->name}} @endif"  class="form-control col-md-7 col-xs-12">
                                        <h5 id="name" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{ __('admin.Name') }} in Arabic <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  name="ar_name" value="@if(isset($team->ar_name)) {{$team->ar_name}} @endif"  class="form-control col-md-7 col-xs-12">
                                        <h5 id="ar_name" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{__('admin.designation')}}<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  name="designation" value="@if(isset($team->designation)) {{$team->designation}} @endif"  class="form-control col-md-7 col-xs-12">
                                        <h5 id="designation" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{__('admin.ar_designation')}}<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  name="ar_designation" value="@if(isset($team->ar_designation)) {{$team->ar_designation}} @endif"  class="form-control col-md-7 col-xs-12">
                                        <h5 id="ar_designation" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{__('admin.linked')}}<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  name="linkedin" value="@if(isset($team->linkedin)) {{$team->linkedin}} @endif"  class="form-control col-md-7 col-xs-12">
                                        <h5 id="linkedin" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{__('admin.image')}}<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <input class="form-control col-md-7 col-xs-12" type="file" accept="image/*" name="image">
                                        <h5 id="image" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{__('admin.description')}}<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control col-md-7 col-xs-12" name="description" placeholder="Team description">
                                  @if(isset($team->description)) {{$team->description}} @endif
                                        </textarea>
                                        <h5 id="description" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{__('admin.ar_description')}}<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="ar_description" class="form-control col-md-7 col-xs-12" placeholder="Team description">
                                        @if(isset($team->ar_description)) {{$team->ar_description}} @endif
                                        </textarea>
                                        <h5 id="ar_description" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="{{ url('manage/team') }}" class="btn btn-primary">{{ __('admin.Cancel') }}</a>
                                        @if(isset($team))
                                            <button type="submit" id="update_btn" class="btn btn-success">{{ __('admin.Update') }}</button>
                                            @else
                                        <button type="submit" id="submit_btn" class="btn btn-success">{{ __('admin.Submit') }}</button>
                                    @endif
                                    </div>
                                </div>
                            </form>
                            <script>
                                $(function(){
                                    $("#submit_btn").click(function(event){
                                        event.preventDefault();
                                        var form = $("#team-form")[0];
                                        var formData = new FormData(form);
                                        $.ajax({
                                            url:'<?php echo url('/submit/member'); ?>',
                                            data:formData,
                                            async:false,
                                            type:'POST',
                                            processData: false,
                                            contentType: false,
                                            success:function(response){
                                                var obj = JSON.parse(response);
                                                if (obj.status==true){

                                                        document.getElementById('team-form').reset();
                                                        $('#success').html(obj.message);
                                                    setTimeout(function(){ window.location = "<?php echo url('/manage/team'); ?>" }, 3000);
                                                }
                                                else {
                                                    if (obj['errors'].hasOwnProperty('name')){
                                                         $("#name").html(obj['errors'].name[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('ar_name')){
                                                        $("#ar_name").html(obj['errors'].ar_name[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('image')){
                                                        $("#image").html(obj['errors'].image[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('designation')){
                                                        $("#designation").html(obj['errors'].designation[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('ar_designation')){
                                                        $("#ar_designation").html(obj['errors'].ar_designation[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('linkedin')){
                                                        $("#linkedin").html(obj['errors'].linkedin[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('description')){
                                                        $("#description").html(obj['errors'].description[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('ar_description')){
                                                        $("#ar_description").html(obj['errors'].ar_description[0]);
                                                    }
//
                                                }

                                            },
                                        });

                                    });

                                    $("#update_btn").click(function(event){
                                        event.preventDefault();
                                        var form = $("#team-form")[0];
                                        var formData = new FormData(form);
                                        $.ajax({
                                            url:'<?php echo url('/update/member'); ?>',
                                            data:formData,
                                            async:false,
                                            type:'POST',
                                            processData: false,
                                            contentType: false,
                                            success:function(response){
                                                var obj = JSON.parse(response);
                                                if (obj.status==true){
                                                    $('#success').html(obj.message);
                                                    setTimeout(function(){ window.location = "<?php echo url('/manage/team'); ?>" }, 3000);
                                                }
                                                else {
                                                    if (obj['errors'].hasOwnProperty('name')){
                                                        $("#name").html(obj['errors'].name[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('ar_name')){
                                                        $("#ar_name").html(obj['errors'].ar_name[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('image')){
                                                        $("#image").html(obj['errors'].image[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('designation')){
                                                        $("#designation").html(obj['errors'].designation[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('ar_designation')){
                                                        $("#ar_designation").html(obj['errors'].ar_designation[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('linkedin')){
                                                        $("#linkedin").html(obj['errors'].linkedin[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('description')){
                                                        $("#description").html(obj['errors'].description[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('ar_description')){
                                                        $("#ar_description").html(obj['errors'].ar_description[0]);
                                                    }
//
                                                }

                                            },
                                        });

                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include ('include/footer_admin')
