<?php     if(Session::get('user_role')=='client')      {       ?>
@include ('include/header_cl')
  <?php }else{ ?>
@include ('include/header_fr')
  <?php } ?>
<style>
  label {
    font-weight: normal !important;
  }
</style>
<div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">
<div class="clientdashboardarea">
  <div class="">
    <div style="padding-bottom: 20px;" class="row clienttoprow">
      <div class="col-md-12 col-sm-12" >
        <a class="btn btn-round btn-color" href="{{url('/joblist')}}"><i class="fa fa-arrow-circle-left"></i> Go Back</a>
      </div>
      <div class="col-md-12 col-sm-12">
        <h3 class="main-form-title">Post a Job</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="clientjobfeed">         
           <div class="col-xs-12 with-border freelancer-list">
      <div class="f-image">
        <div class="f-image-inner"> <i class="fa fa-user table-header-colums-title"></i> <span class="f-availability f-invisible"></span> </div>
      </div>
      <div class="f-info">
        <label class="table-header-colums-title"><?php echo (isset($user_data->name)?$user_data->name:''); ?></label>
        <div class="f-professional table-header-title"><?php echo (isset($user_profile->job_title)?$user_profile->job_title:''); ?></div>
        <div class="row">
          <div class="col-md-6 col-lg-3"> <span class="table-header-title">$<?php echo (isset($user_profile->hourly_rate)?$user_profile->hourly_rate:''); ?> / hr</span> </div>
          
          <div class="col-md-6 col-lg-3"> <span class="table-header-title"><?php echo (!empty($score)?$score:0); ?>% job success</span>
            <div class="progress f-success">
              <div class="progress-bar " role="progressbar" aria-valuenow="<?php echo (isset($score)?$score:0) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (isset($score)?$score:0) ?>%;">  </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3"> <span class="table-header-title"><i class="fa fa-map-marker"></i><?php echo (isset($user_profile->country)?$user_profile->country:''); ?></span> </div>
          <div class="projecttags inline">
            @foreach($user_profile_skill as $skill)
                        <span style="color: #666666;">{{$skill->freelancer_skill}}</span>
          @endforeach
          </div>
          <div class="col-xs-12 f-short-desc"><?php ?></div>
        </div>
      </div>
    </div>
          <form id="jobpost_invite" action="{{ url('createinvitepostjob') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="invited_user_id" value="<?php echo $user_data->user_id; ?>">
          <input type="hidden" value="1" name="job_type" />
          {{ csrf_field() }}
            <div class="newjob">
              <section class="form-section">
                <div class="form-group">
                  <label for="job_title" class="control-label"> <h4 class="form-label-color">Job title<span class="red">*</span></h4></label>
                  <input name="job_title" id="job_title" class="form-control c-form" type="text" placeholder="Example: Need help developing a powerpoint presentation" required/>
                  <p class="red">{{ $errors->jobPost->first('job_title') }} </p>
                </div>

                <div class="form-group">
                  <h4 class="form-label-color">Job Category <span class="red">*</span></h4>
                  <select name="category_id" onchange="view_skills(this.value)" class="form-control  c-form" required style="color:#000;">
                    <option value="">Select Category</option>

                    @if(sizeof($categories) > 0)
                      @foreach($categories as $cat)

                        <option value="{{ $cat->id }}">{{ $cat->freelancer_skill }}</option>

                      @endforeach
                    @endif

                  </select>
                  <p class="red">{{ $errors->jobPost->first('category_id') }} </p>
                </div>
                <div class="form-group">
                  <h4 class="">Enter skills needed (Optional)</h4>
                  <div class="addskillbox">
                    <select style="width: 100% !important;" id="job_skills" name="job_skills[]" multiple="multiple">
                      <option value="" disabled>Select Job Category first</option>

                    </select>
                    {{--<div class="addskilone">--}}
                    {{--<input name="job_skills[]" class="form-control c-form" type="text" placeholder="Type here" />--}}
                    {{--</div>--}}
                  </div>
                </div>
                <div class="form-group">
                  <h4 class="form-label-color">Job Type <span class="red">*</span></h4>
                  <select id="job_time_type" onchange="job_category(this.value)" name="job_time_type" class="form-control  c-form" required style="color:#000;">
                    <option value="">Select type</option>
                    <option value="hourly">hourly</option>
                    <option value="fixed">fixed</option>
                  </select>
                  <p class="red">{{ $errors->jobPost->first('job_time_type') }} </p>
                </div>
                <div style="display: none;" class="job-rate form-group">
                  <h4 class="form-label-color">Per week hour<span class="red">*</span></h4>
                  <select  name="job_hour_limit" class="form-control  c-form" required style="color:#000;">
                    <option value="">Select hour</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                  </select>
                  <input style="margin-top: 20px;" type="number" class="form-control  c-form" name="per_hour_amount" placeholder="bid amount per hour" required>
                </div>
                <div style="display: none;" class="budget form-group">
                  <h4 class="form-label-color">Budget <span class="red">*</span></h4>
                  <input name="budget" class="form-control c-form" type="text" id="budget" placeholder="Example: SAR-25"/>
                  <p class="red">{{ $errors->jobPost->first('budget') }} </p>
                </div>
                <div class="form-group">
                  <h4 class="form-label-color">Describe the work to be done <span class="red">*</span></h4>
                  <textarea name="job_description" class="form-control c-form"
                            placeholder="Example: Need help developing a powerpoint presentation Need help developing a powerpoint presentation  Need help developing a powerpoint presentation  Need help developing a powerpoint presentation" required></textarea>
                  <p class="red">{{ $errors->jobPost->first('job_description') }} </p>
                </div>
                <div class="form-group">
                  <h4 class="form-label-color">Job for Specific countries</h4>
                  <select style="width: 30% !important;" class="js-example-basic-multiple" name="countries[]" multiple="multiple">
                    <option value="" disabled>Select Country</option>
                    @foreach($countries as $country)
                      <option value="{{$country}}">{{$country}}</option>
                    @endforeach
                  </select>
                </div>
                <script>
                    function view_skills(val){
                        $.ajax({
                            url: BASE_URL+'/job/skills',
                            type: 'POST',
                            data: {'category_id':val},
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                        })
                            .done(function(data) {
                                var data=JSON.parse(data);
                                var ht="";
                                $.each(data, function( index, value ) {
                                    var title=value.freelancer_skill;
                                    var category_id=value.id;
                                    ht+='<option value='+title+'> '+title+'</option>';
                                });
                                $("#job_skills").html('');
                                $("#job_skills").append(ht);
                            })
                            .fail(function(error) {
                                console.log(error);
                            });
                    }
                    $(document).ready(function() {
                        $('.js-example-basic-multiple').select2();
                    });
                </script>
                <div class="form-group">
                  <h4 class="form-label-color">Attachments</h4>
                  <!-- temporary upload html -->
                  <div class="flag-upload form-control c-form click_event" style="width: 30%;">Click to upload project here</div>
                  <small>You may attach up to 5 files under 100mb</small>
                  <input type="file" id="attachments" class="attchmentd" multiple name="attachments[]" style="display: none;">
                  <img id="image_preview" src="" style="width: 150px;height;15Opx; display: none;" alt="your image" />
                </div>
                <div class="form-group">
                  <h4 class="form-label-color">What type of project do you have? <span class="red">*</span></h4>
                  <div class="checkbox">
                    <label class="label-color">
                      <input class="c-radio" type="radio" name="project_type" value="1" required />
                      <span class="custom-radio"></span> One-time project </label>
                  </div>
                  <div class="checkbox">
                    <label class="label-color">
                      <input class="c-radio" type="radio" name="project_type" value="2" required />
                      <span class="custom-radio"></span> Ongoing project </label>
                  </div>
                  <div class="checkbox">
                    <label class="label-color">
                      <input class="c-radio" type="radio" name="project_type" value="3" required />
                      <span class="custom-radio"></span> i am not sure </label>
                  </div>
                  <p class="red">{{ $errors->jobPost->first('project_type') }} </p>
                </div>
                <div class="form-group">
                  <h4 class="form-label-color">How many freelancers do you need to hire for this job? <span class="red">*</span></h4>
                  <div class="checkbox">
                    <label class="label-color">
                      <input class="c-radio sl_name_1" type="radio" name="sl_name" required="" checked="checked">
                      <span class="custom-radio"></span> I want to hire one freelancer </label>
                  </div>
                  <div class="checkbox">
                    <label class="label-color">
                      <input class="c-radio sl_name_2" type="radio" name="sl_name" />
                      <span class="custom-radio"></span> I need to hire more than one freelancer </label>
                  </div>
                  <div class="checkbox input_check_box_text" style="display: none">
                    <label>
                      <input class="form-control  c-form" type="text" value="1" name="fl_number" required placeholder="Please Enter no of freelancer" />
                  </div>
                  <p class="red">{{ $errors->jobPost->first('sl_name') }} </p>
                </div>
                <div class="form-group">
                  <h4 class="form-label-color">Desired Experience Level <span class="red">*</span></h4>
                  <div class="radio_blocks_outer row">
                    <div class="col-md-8 col-sm-12">
                      <div class="block_md ">
                        <div class="custom-control custom-radio col-md-4 col-sm-12">
                          <input type="radio" class="custom-control-input" id="defaultUnchecked" name="experience_level" value="1" selected required/>
                          <label class="label-color custom-control-label" for="defaultUnchecked"><span>&#36</span> Entry Level</label>
                        </div>
                        <div class="custom-control custom-radio col-md-4 col-sm-12">
                          <input type="radio" class="custom-control-input" id="defaultUnchecked" name="experience_level" value="2" selected required/>
                          <label class="label-color custom-control-label" for="defaultUnchecked"><span>&#36 &#36</span> Intermediate</label>
                        </div>
                        <div class="custom-control custom-radio col-md-4 col-sm-12">
                          <input type="radio" class="custom-control-input" id="defaultUnchecked" name="experience_level" value="3" selected required/>
                          <label class="label-color custom-control-label" for="defaultUnchecked"><span>&#36 &#36 &#36</span> Expert</label>
                        </div>
                      </div>
                      <p class="red">{{ $errors->jobPost->first('experience_level') }} </p>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <h4 class="form-label-color">How long do you expect this job to last? <span class="red">*</span></h4>
                  <div class="radio_blocks_outer row">
                    <div class="col-md-12 col-sm-12">
                      <div class="block_md ">
                        <div class="radio_block col-md-3 col-sm-6">
                          <input type="radio" name="job_duration" value="1" required/>
                          <div  class="checkbox-inline block_inner label-color"> <span><i class="fa fa-calendar"></i></span>
                            <label>More then 6 months</label>
                          </div>
                        </div>
                        <div class="radio_block col-md-2 col-sm-6">
                          <input type="radio" name="job_duration" value="2" required/>
                          <div  class="checkbox-inline block_inner label-color"> <span><i class="fa fa-calendar"></i></span>
                            <label>3 to 6 months</label>
                          </div>
                        </div>
                        <div class="radio_block col-md-2 col-sm-12">
                          <input type="radio" name="job_duration" value="3" required/>
                          <div  class="checkbox-inline block_inner label-color"> <span><i class="fa fa-calendar"></i></span>
                            <label>1 to 3 months</label>
                          </div>
                        </div>
                        <div class="radio_block col-md-3 col-sm-6">
                          <input type="radio" name="job_duration" value="4" required/>
                          <div class="checkbox-inline block_inner label-color"> <span><i class="fa fa-calendar"></i></span>
                            <label>Less then 1 months</label>
                          </div>
                        </div>
                        <div class="radio_block col-md-2 col-sm-6">
                          <input type="radio" name="job_duration" value="5" required/>
                          <div style="width:70%;display: inline;"  class="block_inner label-color"> <span><i class="fa fa-calendar"></i></span>
                            <label>Less then 1 week</label>
                          </div>
                        </div>
                      </div>
                      <p class="red">{{ $errors->jobPost->first('job_duration') }} </p>
                    </div>
                  </div>

                </div>
                <div class="form-group">
                  <h4 class="form-label-color">What time commitment is required for this job? <span class="red">*</span></h4>
                  <div class="radio_blocks_outer row">
                    <div class="col-md-8 col-sm-12">
                      <div class="block_md ">
                        <div class="radio_block col-md-4 col-sm-12">
                          <input type="radio" name="job_time" value="1" required/>
                          <div class="checkbox-inline block_inner label-color"> <span><i class='fa fa-clock-o'></i></span>
                            <label>More then 30 hrs/week</label>
                          </div>
                        </div>
                        <div class="radio_block col-md-4 col-sm-12">
                          <input type="radio" name="job_time" value="2" required/>
                          <div class=" checkbox-inline block_inner label-color"> <span><i class='fa fa-clock-o'></i></span>
                            <label>Less then 30 hrs/week</label>
                          </div>
                        </div>
                        <div class="radio_block col-md-4 col-sm-12">
                          <input type="radio" name="job_time" value="3" required/>
                          <div class="checkbox-inline block_inner label-color"> <span><i class='fa fa-clock-o'></i></span>
                            <label>I don't know yet</label>
                          </div>
                        </div>
                      </div>
                      <p class="red">{{ $errors->jobPost->first('job_time') }} </p>
                    </div>
                  </div>
                </div>
              </section>
              <section class="form-section form-label-color">
                <h4 class="form-label-color">Freelancer Preferences</h4>
                <div class="form-group form-with-icon">
                  <h4 style="font-weight: bolder;padding-top: 10px;padding-bottom: 10px;"><i class='fa fa-comments-o'></i>Screening Questions</h4>
                  <label>Add a few questions you'd like your candidates to answer when they applying your job.</label>
                  <!--mahdi-->

                  <div id='TextBoxesGroup'>
                    <div id="TextBoxDiv1">
                      <input type='textbox' id='textbox1' name="job_questions[]" class="form-control c-form" >
                    </div>
                  </div>
                  <input class="btn btn-info btn-color" type='button' value='Add another question' id='addButton' style="float-left">
                  <input type='button' value='&#8211;' id='removeButton'>
                  <!--mahdi-->
                </div>
                <div class="form-group form-with-icon">
                  <h4 class="label-color"><i class="fa fa-file-text-o"></i> Cover Letter</h4>
                  <label>Ask applicant to write a cover letter introducing themselves</label>
                  <div class="checkbox">
                    <label>
                      <input name="job_cover_letter" class="c-checkbox" checked type="checkbox" value="1">
                      <span class="custom-checkbox"></span> Yes, require a cover letter </label>
                  </div>
                </div>
              </section>
              <section class="form-section highlighted">

              </section>
              <section class="form-section highlighted label-color">
                <div class="form-group form-with-icon form-label-color">
                  <h4><i class='fa fa-bolt'></i> Boost your job's visibility</h4>
                  <div class="checkbox">
                    <label>
                      <input name="job_boost" class="c-checkbox" type="checkbox" value="1">
                      <span class="custom-checkbox"></span> Tell me how can i reach more freelancers and hire in less time </label>
                  </div>
                </div>
              </section>
              {{--<section>--}}
                {{--<div class="form-group form-with-icon ">--}}
                  {{--<label>Job Status</label>--}}
                  {{--<select name="status" class="form-control">--}}
                    {{--<option value="1">Open</option>--}}
                    {{--<option value="2">Filled</option>--}}
                  {{--</select>--}}
                {{--</div>--}}
                {{--<p class="red">{{ $errors->jobPost->first('status') }} </p>--}}
              {{--</section>--}}
            </div>
            <div class="footer-btn">
              <input type="hidden" name="action" id="action" value="">
                   <input type="button" class='btn btn-primary btn-color' onclick="value_sub('publish')" value='Submit' />
                   <a href="{{url('/joblist')}}" class='btn btn-link' >Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>
</div>
  <script>
      function job_category(j_type){
          if(j_type=='hourly'){
              $('.budget').hide();
              $('.job-rate').show();
          }
          else if(j_type=='fixed'){
              $('.job-rate').hide();
              $('.budget').show();
          }
          else{
              $('.budget').hide();
              $('.job-rate').hide();
          }
      }
      //for specific countries
      $(document).ready(function() {
          $('.js-example-basic-multiple').select2();
          $('#job_skills').select2();
      });
      //validation
      $( document ).ready( function () {
          $("#jobpost_invite").validate({
              rules: {
                  job_title:"required",
                  category_id:"required",
                  job_time_type:"required",
                  job_description:"required",
                  project_type:"required",
                  sl_name:"required",
                  experience_level:"required",
                  job_duration:"required",
                  job_time:"required",
                  status:{
                      required:true,
                      digits: true,
                  },
              },
              messages: {
                  job_title: '{{__('client.job_title')}}',
                  category_id:'{{__('client.job_category')}}',
                  job_time_type:'{{__('client.job_time_type')}}',
                  job_description:'{{__('client.job_description')}}',
                  project_type:"{{__('client.project_type')}}",
                  experience_level:"{{__('client.experience_level')}}",
                  job_duration:"{{__('client.job_duration')}}",
                  job_time:"{{__('client.job_time')}}",
                  status:{
                      required:'{{__('client.cover_letter_status')}}',
                      digit:'{{__('client.cover_letter_status_type')}}'
                  },
              },
              errorElement: "em",
              errorPlacement: function (error, element) {
                  // Add the `help-block` class to the error element
                  error.addClass("help-block");
                  if ( element.prop( "type" ) === "radio" ) {
                      $(element).parents('.has-error').children('h4').css('display','inline');
                      $(element).parents('.has-error').children('h4').after(error);
                      $(element).parents('.has-error').children('h4').next().css({"display":"inline", "margin-left":"20px"});
                  } else {
                      error.insertAfter( element );
                  }
              },
              highlight: function (element, errorClass, validClass) {
                  $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
              },
              unhighlight: function (element, errorClass, validClass) {
                  $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
              }
          });
      });

  </script>
@include ('include/footer_cl')