@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>{{__('admin.addcategory')}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content"> <br/>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content"> <br />
                            <form id="qouts-form" enctype="multipart/form-data" method="post" data-parsley-validate action="{{ url('post/qouts')}}" class="form-horizontal form-label-left">
                                {{ csrf_field() }}
                                <h5 id="success" align="center" style="color:#933f3f;">You have updated Skills Successfully</h5>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('admin.Name') }} <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="title" name="title" value="{{$skill_id->freelancer_skill}}"  class="form-control col-md-7 col-xs-12">
                                        <h5 id="title_required" align="center" style="color:#933f3f;display: none;"></h5>
                                    </div>
                                </div>
                                <input type="hidden" name="skill_id" value="{{$skill_id->id}}">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{ __('admin.Name') }} in Arabic <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="ar_title" name="ar_title" value="{{$skill_id->ar_freelancer_skill}}"  class="form-control col-md-7 col-xs-12">
                                        <h5 id="ar_title_required" align="center" style="color:#933f3f; display: none;"></h5>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="{{ url('manage_skills') }}" class="btn btn-primary">{{ __('admin.Cancel') }}</a>
                                        <button type="submit" id="submit_btn" class="btn btn-success">{{ __('admin.Submit') }}</button>
                                    </div>
                                </div>
                            </form>
                            <script>
                                function hide(){
                                    $('#title_required').hide();
                                    $('#success').hide();
                                }
                                $(function(){
                                    hide();
                                    $("#submit_btn").click(function(event){
                                        event.preventDefault();
                                        var form = $("#qouts-form")[0];
                                        var formData = new FormData(form);
                                        $.ajax({
                                            url:'<?php echo url('/edit_skill_post'); ?>',
                                            data:formData,
                                            async:false,
                                            type:'POST',
                                            processData: false,
                                            contentType: false,
                                            success:function(response){
                                                var obj = JSON.parse(response);
                                                if (obj.status==true){
                                                    if(obj.success=='You have add Skill Successfully'){
                                                        document.getElementById('qouts-form').reset();
                                                        $('#success').show();
                                                    }
                                                    setTimeout(function(){ window.location = "<?php echo url('/manage_skills'); ?>" }, 3000);
                                                }
                                                else {
                                                    $.each(obj['errors'], function( index, value ){
                                                        if (value=='Write Skills title in english!'){
                                                            $('#title_required').show();
                                                        }
                                                    });
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
