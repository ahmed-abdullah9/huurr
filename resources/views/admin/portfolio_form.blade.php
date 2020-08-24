@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>{{__('admin.portfolio_info')}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content"> <br/>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content"> <br />
                            <form id="portfolio-form" enctype="multipart/form-data" method="post"  class="form-horizontal form-label-left">
                                {{ csrf_field() }}
                                @if(isset($portfolio->id))
                                    <input name="portfolio_id" type="hidden" value="{{$portfolio->id}}" readonly>
                                @endif
                                <h5 id="success" align="center" style="color:#933f3f;"></h5>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('admin.Name') }} <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  name="name" value="@if(isset($portfolio->name)) {{$portfolio->name}} @endif"  class="form-control col-md-7 col-xs-12">
                                        <h5 id="name" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{ __('admin.Name') }} in Arabic <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  name="ar_name" value="@if(isset($portfolio->ar_name)) {{$portfolio->ar_name}} @endif"  class="form-control col-md-7 col-xs-12">
                                        <h5 id="ar_name" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{__('admin.portfolio_skill')}}<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <select name="skill" class="form-control col-md-7 col-xs-12">
                                         <option value="">{{__('admin.select_skill')}}</option>
                                          <option value="PHOTOGRAPHY" @if(isset($portfolio->skill)&&$portfolio->skill=='PHOTOGRAPHY') selected @endif>PHOTOGRAPHY</option>
                                          <option value="WEBDESIGN" @if(isset($portfolio->skill)&&$portfolio->skill=='WEBDESIGN') selected @endif>WEBDESIGN</option>
                                          <option value="LOGO" @if(isset($portfolio->skill)&&$portfolio->skill=='LOGO') selected @endif>LOGO</option>
                                          <option value="GRAPHICS" @if(isset($portfolio->skill)&&$portfolio->skill=='GRAPHICS') selected @endif>GRAPHICS</option>
                                          <option value="ADVERTISING" @if(isset($portfolio->skill)&&$portfolio->skill=='ADVERTISING') selected @endif>ADVERTISING</option>
                                      </select>
                                        <h5 id="skill" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{__('admin.ar_portfolio_skill')}}<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="ar_skill" class="form-control col-md-7 col-xs-12">
                                            <option value="">{{__('admin.select_skill')}}</option>
                                            <option value="التصوير" @if(isset($portfolio->ar_skill)&&$portfolio->ar_skill=='التصوير') selected @endif>التصوير</option>
                                            <option value="تصميم الويب" @if(isset($portfolio->ar_skill)&&$portfolio->ar_skill=='تصميم الويب') selected @endif>تصميم الويب</option>
                                            <option value="شعار" @if(isset($portfolio->ar_skill)&&$portfolio->ar_skill=='شعار') selected @endif>شعار</option>
                                            <option value="الرسومات" @if(isset($portfolio->ar_skill)&&$portfolio->ar_skill=='الرسومات') selected @endif>الرسومات</option>
                                            <option value="إعلان" @if(isset($portfolio->ar_skill)&&$portfolio->ar_skill=='إعلان') selected @endif>إعلان</option>
                                        </select>
                                        <h5 id="ar_skill" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{__('admin.profile_link')}}</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" type="text" value="@if(isset($portfolio->profile_link)){{$portfolio->profile_link}} @endif"  name="profile_link">
                                        <h5 id="profile_link" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title"> {{__('admin.image_demension')}}<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <select name="demension" class="form-control col-md-7 col-xs-12">
                                           <option value="">
                                               {{__('admin.select_demension')}}
                                           </option>
                                           <option value="0" @if(isset($portfolio->demension)&&$portfolio->demension==0)selected @endif>
                                               {{__('admin.small')}}
                                           </option>
                                           <option value="1" @if(isset($portfolio->demension)&&$portfolio->demension==1)selected @endif>
                                               {{__('admin.large')}}
                                           </option>
                                       </select>
                                        <h5 id="demension" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ar_title">{{__('admin.image')}}<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" type="file" accept="image/*" name="image">
                                        <h5 id="image" align="center" style="color:#933f3f;"></h5>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a href="{{ url('manage/portfolio') }}" class="btn btn-primary">{{ __('admin.Cancel') }}</a>
                                        @if(isset($portfolio))
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
                                        var form = $("#portfolio-form")[0];
                                        var formData = new FormData(form);
                                        $.ajax({
                                            url:'<?php echo url('/submit/portfolio'); ?>',
                                            data:formData,
                                            async:false,
                                            type:'POST',
                                            processData: false,
                                            contentType: false,
                                            success:function(response){
                                                var obj = JSON.parse(response);
                                                if (obj.status==true){
                                                    document.getElementById('portfolio-form').reset();
                                                    $('#success').html(obj.message);
                                                    setTimeout(function(){ window.location = "<?php echo url('/manage/portfolio'); ?>" }, 3000);
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
                                                    if (obj['errors'].hasOwnProperty('skill')){
                                                        $("#skill").html(obj['errors'].skill[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('ar_skill')){
                                                        $("#ar_skill").html(obj['errors'].ar_skill[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('demension')){
                                                        $("#demension").html(obj['errors'].demension[0]);
                                                    }
                                                }

                                            },
                                        });

                                    });

                                    $("#update_btn").click(function(event){
                                        event.preventDefault();
                                        var form = $("#portfolio-form")[0];
                                        var formData = new FormData(form);
                                        $.ajax({
                                            url:'<?php echo url('/update/portfolio'); ?>',
                                            data:formData,
                                            async:false,
                                            type:'POST',
                                            processData: false,
                                            contentType: false,
                                            success:function(response){
                                                var obj = JSON.parse(response);
                                                if (obj.status==true){
                                                    $('#success').html(obj.message);
                                                    setTimeout(function(){ window.location = "<?php echo url('/manage/portfolio'); ?>" }, 3000);
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
                                                    if (obj['errors'].hasOwnProperty('skill')){
                                                        $("#skill").html(obj['errors'].skill[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('ar_skill')){
                                                        $("#ar_skill").html(obj['errors'].ar_skill[0]);
                                                    }
                                                    if (obj['errors'].hasOwnProperty('demension')){
                                                        $("#demension").html(obj['errors'].demension[0]);
                                                    }
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
