@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{ __('admin.Categories') }} </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content"> <br/>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_content"> <br />
                <form id="qouts-form" enctype="multipart/form-data" method="post" data-parsley-validate action="{{ url('post/qouts')}}" class="form-horizontal form-label-left">
                  {{ csrf_field() }}
                    <h5 id="success" align="center" style="color:#933f3f;">{{__('admin.success')}}</h5>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('admin.title') }} <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="title" name="title" value="{{ old('title') }}"  class="form-control col-md-7 col-xs-12">
                        <h5 id="title_required" align="center" style="color:#933f3f;">{{__('admin.title_required')}}</h5>
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('admin.ar_title') }} <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="ar_title" name="ar_title" value="{{ old('ar_title') }}" class="form-control col-md-7 col-xs-12">
                        <h5 id="ar_title_required" align="center" style="color:#933f3f;">{{__('admin.ar_title_required')}}</h5>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('admin.description') }} <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea class="form-control"  name="description" id="description"  rows="3"></textarea>
                        <h5 id="description_required" align="center" style="color:#933f3f;">{{__('admin.description_required')}}</h5>
                        <h5 id="description_limit" align="center" style="color:#933f3f;">{{__('admin.description_limit')}}</h5>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('admin.ar_description') }} <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea class="form-control"  name="ar_description" id="ar_description"  rows="3"></textarea>
                        <h5 id="ar_description_required" align="center" style="color:#933f3f;">{{__('admin.ar_description_required')}}</h5>
                        <h5 id="ar_description_limit" align="center" style="color:#933f3f;">{{__('admin.ar_description_limit')}}</h5>
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('admin.image') }} <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="file" id="qouts_image" name="qouts_image" value="jas.jpg"  class="form-control col-md-7 col-xs-12">
                        <h5 id="image_type" align="center" style="color:#933f3f;">{{__('admin.image_type')}}</h5>
                        <h5 id="image_valid" align="center" style="color:#933f3f;">{{__('admin.image_valid')}}</h5>
                        <h5 id="image_size" align="center" style="color:#933f3f;">{{__('admin.image_size')}}</h5>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <a href="{{ url('manage_qouts') }}" class="btn btn-primary">{{ __('admin.Cancel') }}</a>
                      <button type="submit" id="submit_btn" class="btn btn-success">{{ __('admin.Submit') }}</button>
                    </div>
                  </div>
                </form>
                 <script>
                    function hide(){
                        $('#image_type').hide();
                        $('#image_valid').hide();
                        $('#image_size').hide();
                        $('#title_required').hide();
                        $('#ar_title_required').hide();
                        $('#wrong').hide();
                        $('#description_required').hide();
                        $('#ar_description_required').hide();
                        $('#description_limit').hide();
                        $('#ar_description_limit').hide();
                        $('#success').hide();
                    }
                    $(function(){
                        hide();
                        $("#submit_btn").click(function(event){
                          event.preventDefault();
                          var form = $("#qouts-form")[0];
                          var formData = new FormData(form);
                            $.ajax({
                                url:'<?php echo url('/post/qouts'); ?>',
                                data:formData,
                                async:false,
                                type:'POST',
                                processData: false,
                                contentType: false,
                                success:function(response){
                                    var obj = JSON.parse(response);
                                    if (obj.status==true){
                                        if(obj.success=='You have add Qouts Successfully'){
                                            document.getElementById('qouts-form').reset();
                                            $('#success').show();
                                        }
                                        setTimeout(function(){ window.location = "<?php echo url('/manage_qouts'); ?>" }, 3000);
                                    }
                                    else {
                                        $.each(obj['errors'], function( index, value ){
                                            if (value=='Write qouts title in english!'){
                                                $('#title_required').show();
                                            }
                                            if (value=='Write qouts title in arabic!'){
                                                $('#ar_title_required').show();
                                            }
                                            if (value=='Write qouts description in english'){
                                                $('#description_required').show();
                                            }
                                            if (value=='Write qouts description in arabic'){
                                                $('#ar_description_required').show();
                                            }
                                            if (value=='Your description should be more than 10 character'){
                                                $('#description_limit').show();
                                            }
                                            if (value=='Your description should be more than 10 character'){
                                                $('#ar_description_required').show();
                                            }
                                            if (value=='image type should be jpeg,jpg,png,gif'){
                                                $('#image_type').show();
                                            }
                                            if (value=='Your input type is not image'){
                                                $('#image_valid').show();
                                            }
                                            if (value=='your image size is large'){
                                                $('#image_valid').show();
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
