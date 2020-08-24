@include ('include/header_cl')
<style>
    label {
        font-weight: normal !important;
    }
</style>
<div class="col-md-12 col-sm-9 col-xs-9 mbl-jobedit" style="float: none;">

    <!-- Clientadmin dashboard section -->
    <form action="{{ url('createjob') }}" id="postjobform" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="is_jobRepost" value="1">
        <input type="hidden" name="job_type" value="1">
        <input type="hidden" name="job_id" value="0">
        {{ csrf_field() }}
        <div style="padding-bottom: 10px;" class="row clienttoprow">
            <div class="col-md-12 col-sm-12" >
                <a class="btn btn-round btn-color" href="{{url('/joblist')}}"><i class="fa fa-arrow-circle-left"></i> {{__('client.go_back')}}</a>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="clientjobfeed">

                    <section class="form-section">
                        <div class="form-group">
                            <h4 class="form-label-color">{{__('client.job_title')}} <span class="red">*</span></h4>
                            <input name="job_title" class="form-control c-form" type="text" placeholder="Example: Need help developing a powerpoint presentation" required
                                   value="@if(!empty($jobs->job_title)){{$jobs->job_title}}@endif"
                            />
                        </div>
                        <div class="form-group">
                            <h4 class="form-label-color">{{__('client.job_category')}}<span class="red">*</span></h4>
                            <select name="category_id" onchange="view_skills(this.value)" class="form-control" required style="color: #000;">
                                <option value="">{{__('client.select_category')}}</option>
                                @if(!empty($categories))
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                        @if($cat->id == $jobs->category_id)selected
                                    @endif
                                    > {{ $cat->freelancer_skill }}</option>
                                @endforeach
                                @endif
                            </select>
                            <p class="red">{{ $errors->jobPost->first('category_id') }} </p>
                        </div>
                        <?php
                        $job_skills = App\Http\Controllers\HelperController::maybe_unserialize($jobs->job_skills);
                        $job_skills = (is_array($job_skills)?implode(' , ',$job_skills):$job_skills);
                        $skills=explode(",",$job_skills);
                        ?>
                        <div class="form-group">
                            <h4 class="label-color">{{__('client.enter_skills')}}</h4>
                            <select style="width: 30% !important;" id="job_skills" name="job_skills[]" multiple="multiple">
                                <option value="" disabled>Select Job Skills</option>
                                @if(sizeof($skills)>0)
                                @foreach($skills as $skill)
                                <option value="{{$skill}}" selected>{{$skill}}</option>
                                @endforeach
                                @endif
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
                        </script>
                        <div class="form-group">
                            <h4 class="form-label-color">{{__('client.job_type')}} <span class="red">*</span></h4>
                            <select id="job_time_type" onchange="job_category(this.value)" name="job_time_type" class="form-control  c-form" required style="color:#000;">
                                <option value="">{{__('client.select_type')}}</option>
                                <option @if($jobs->job_time_type=='hourly') selected @endif value="hourly">hourly</option>
                                <option @if($jobs->job_time_type=='fixed') selected @endif value="fixed">fixed</option>
                            </select>
                            <p class="red">{{ $errors->jobPost->first('job_time_type') }} </p>
                        </div>
                        <div style="@if($jobs->job_time_type!='hourly') display:none; @endif" class="job-rate form-group">
                            <h4 class="label-color">Per week hour <span class="red">*</span></h4>
                            <select  name="job_hour_limit" class="form-control  c-form" required style="color:#000;">
                                <option value="{{$jobs->job_hour_limit}}" selected>Selected hours {{$jobs->job_hour_limit}}</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                            </select>
                        </div>
                        <div style="@if($jobs->job_time_type!='fixed') display:none; @endif" class="budget form-group">
                            <h4 class="form-label-color">Budget <span class="red">*</span></h4>
                            <input name="budget" class="form-control c-form" value="{{$jobs->budget}}" type="text" id="budget" placeholder="Example: SAR-25"/>
                            <p class="red">{{ $errors->jobPost->first('budget') }} </p>
                        </div>

                        <div class="form-group">
                            <h4 class="form-label-color">{{__('client.describe_work')}} <span class="red">*</span></h4>
                            <textarea name="job_description" class="form-control c-form"
                                      placeholder="Example: Need help developing a powerpoint presentation Need help developing a powerpoint presentation  Need help developing a powerpoint presentation  Need help developing a powerpoint presentation" required>@if(!empty($jobs->job_description)){{$jobs->job_description}}@endif</textarea>
                        </div>
                        <div class="form-group">
                            <h4 class="form-label-color">{{__('client.Job_specific')}}</h4>

                            <?php
                            if (!empty($countries)){
                                $slected= json_decode($jobs->countries);
                                if (!empty($slected)){
                                    $countries=array_diff( $countries, $slected );
                                }
                            }
                            ?>
                            <select style="width: 30% !important;" class="js-example-basic-multiple" name="countries[]" multiple="multiple">
                                <option value="" disabled>Select Country</option>
                                @if(!empty($slected))
                                @foreach($slected as $s)
                                <option selected value="{{$s}}">{{$s}}</option>
                                @endforeach
                                @endif
                                @foreach($countries as $country)
                                <option value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('.js-example-basic-multiple').select2();
                                $('#job_skills').select2();
                            });
                        </script>

                        <div class="form-group">
                            <h4 class="form-label-color">{{__('client.attachments')}}</h4>
                            <!-- temporary upload html -->
                            <div class="flag-upload form-control c-form click_event">{{__('client.upload_project')}}</div>
                            <small>{{__('client.may_attach')}}</small>
                            <input type="file" id="attachments" class="attchmentd" multiple name="attachments[]" style="display: none;">
                            <div class="col-md-12">
                                <?php
                                if(!empty($jobs->attachments))
                                {
                                    foreach ($jobs->attachments as $attachments) {
                                        if(!empty(strpos($attachments,"pdf"))){
                                            echo '<object width="250px" height="250px" data="'.url('/').'/'.$attachments.'"></object>';
                                        }
                                        else
                                            echo '<img src="'.url('/').'/'.$attachments.'" style="width:80px;height:80px;float:left;">';
                                    }
                                }
                                ?>
                            </div>
                            <img id="image_preview" src="" style="width: 80px;height;8Opx;display: none;" alt="your image" />
                        </div>

                        <div class="form-group" style="clear: both;">
                            <h4 class="form-label-color">{{__('client.what_type')}} <span class="red">*</span></h4>
                            <div class="checkbox">
                                <label class="label-color">
                                    <input @if($jobs->project_type == 1) checked @endif class="c-radio" type="radio" name="project_type" value="1" required />
                                    <span class="custom-radio"></span> {{__('client.one_time')}} </label>
                            </div>
                            <div class="checkbox">
                                <label class="label-color">
                                    <input @if($jobs->project_type == 2) checked @endif class="c-radio" type="radio" name="project_type" value="2" required />
                                    <span class="custom-radio"></span> {{__('client.ongoing_pro')}} </label>
                            </div>
                            <div class="checkbox">
                                <label class="label-color">
                                    <input @if($jobs->project_type == 3) checked @endif class="c-radio" type="radio" name="project_type" value="3" required />
                                    <span class="custom-radio"></span> {{__('client.not_sure')}} </label>
                            </div>
                            <p class="red">{{ $errors->jobPost->first('project_type') }} </p>
                        </div>

                        <div class="form-group">
                            <h4 class="form-label-color">{{__('client.many_freelancers')}} <span class="red">*</span></h4>
                            <div class="checkbox">
                                <label class="label-color">
                                    <input @if($jobs->fl_number == 1) checked @endif class="c-radio sl_name_1" type="radio" name="sl_name" required="">
                                    <span class="custom-radio"></span> {{__('client.want_hire')}} </label>
                            </div>
                            <div class="checkbox">
                                <label class="label-color">
                                    <input class="c-radio sl_name_2" type="radio" name="sl_name" />
                                    <span class="custom-radio"></span> {{__('client.need_hire')}} </label>
                            </div>
                            <div class="checkbox input_check_box_text" style="display: none">
                                <label>
                                    <input class="form-control  c-form" type="text" value="1" name="fl_number" required placeholder="Please Enter no of freelancer" />
                            </div>
                            <p class="red">{{ $errors->jobPost->first('sl_name') }} </p>
                        </div>
                        <div class="form-group">
                            <h4 class="form-label-color">{{__('client.desired_experience')}} <span class="red">*</span></h4>
                            <div class="radio_blocks_outer row">
                                <div class="col-md-8 col-sm-12">
                                    <div class="block_md ">
                                        <div class="custom-control custom-radio col-md-4 col-sm-12">
                                            <input @if($jobs->experience_level == 1) checked @endif type="radio" class="custom-control-input" id="defaultUnchecked" name="experience_level" value="1"  required/>
                                            <label class="label-color custom-control-label" for="defaultUnchecked"><span>&#36</span> {{__('client.entry_level')}}</label>
                                        </div>
                                        <div class="custom-control custom-radio col-md-4 col-sm-12">
                                            <input @if($jobs->experience_level == 2) checked @endif type="radio" class="custom-control-input" id="defaultUnchecked" name="experience_level" value="2" selected required/>
                                            <label class="label-color custom-control-label" for="defaultUnchecked"><span>&#36 &#36</span> {{__('client.intermediate')}}</label>
                                        </div>
                                        <div class="custom-control custom-radio col-md-4 col-sm-12">
                                            <input @if($jobs->experience_level == 3) checked @endif type="radio" class="custom-control-input" id="defaultUnchecked" name="experience_level" value="3" selected required/>
                                            <label class="label-color custom-control-label" for="defaultUnchecked"><span>&#36 &#36 &#36</span> {{__('client.expert')}}</label>
                                        </div>
                                    </div>
                                    <p class="red">{{ $errors->jobPost->first('experience_level') }} </p>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <h4 class="form-label-color">{{__('client.how_long')}} <span class="red">*</span></h4>
                            <div class="radio_blocks_outer row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="block_md ">
                                        <div class="radio_block col-md-3 col-sm-6">
                                            <input @if($jobs->job_duration == 1) checked @endif type="radio" name="job_duration" value="1" required/>
                                            <div  class="checkbox-inline block_inner label-color"> <span><i class="fa fa-calendar"></i></span>
                                                <label>{{__('client.six_months')}}</label>
                                            </div>
                                        </div>
                                        <div class="radio_block col-md-2 col-sm-6">
                                            <input @if($jobs->job_duration == 2) checked @endif type="radio" name="job_duration" value="2" required/>
                                            <div  class="checkbox-inline block_inner label-color"> <span><i class="fa fa-calendar"></i></span>
                                                <label>{{__('client.three_six')}}</label>
                                            </div>
                                        </div>
                                        <div class="radio_block col-md-2 col-sm-12">
                                            <input @if($jobs->job_duration == 3) checked @endif type="radio" name="job_duration" value="3" required/>
                                            <div  class="checkbox-inline block_inner label-color"> <span><i class="fa fa-calendar"></i></span>
                                                <label>{{__('client.one_three')}}</label>
                                            </div>
                                        </div>
                                        <div class="radio_block col-md-3 col-sm-6">
                                            <input @if($jobs->job_duration == 4) checked @endif type="radio" name="job_duration" value="4" required/>
                                            <div class="checkbox-inline block_inner label-color"> <span><i class="fa fa-calendar"></i></span>
                                                <label>{{__('client.less_one')}}</label>
                                            </div>
                                        </div>
                                        <div class="radio_block col-md-2 col-sm-6">
                                            <input @if($jobs->job_duration == 5) checked @endif type="radio" name="job_duration" value="5" required/>
                                            <div style="width:70%;display: inline;"  class="block_inner label-color"> <span><i class="fa fa-calendar"></i></span>
                                                <label>{{__('client.less_week')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="red">{{ $errors->jobPost->first('job_duration') }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="form-label-color">{{__('client.time_comitment')}} <span class="red">*</span></h4>
                            <div class="radio_blocks_outer row">
                                <div class="col-md-8 col-sm-12">
                                    <div class="block_md ">
                                        <div class="radio_block col-md-4 col-sm-12">
                                            <input @if($jobs->job_time == 1) checked @endif type="radio" name="job_time" value="1" required/>
                                            <div class="checkbox-inline block_inner label-color"> <span><i class='fa fa-clock-o'></i></span>
                                                <label>{{__('client.more_hrs')}}</label>
                                            </div>
                                        </div>
                                        <div class="radio_block col-md-4 col-sm-12">
                                            <input @if($jobs->job_time == 2) checked @endif type="radio" name="job_time" value="2" required/>
                                            <div class=" checkbox-inline block_inner label-color"> <span><i class='fa fa-clock-o'></i></span>
                                                <label>{{__('client.less_hr')}}</label>
                                            </div>
                                        </div>
                                        <div class="radio_block col-md-4 col-sm-12">
                                            <input @if($jobs->job_time == 3) checked @endif type="radio" name="job_time" value="3" required/>
                                            <div class="checkbox-inline block_inner label-color"> <span><i class='fa fa-clock-o'></i></span>
                                                <label>{{__('client.know_yet')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="red">{{ $errors->jobPost->first('job_time') }} </p>
                                </div>
                            </div>

                        </div>

                    </section>

                    <section class="form-label-color form-section">
                        <h4 class="form-label-color">{{__('client.free_prefrence')}}</h4>

                        <div class="form-group form-with-icon">
                            <h4 style="font-weight: bolder;padding-top: 10px;padding-bottom: 10px;"><i class='fa fa-comments-o'></i>{{__('client.screen_quiz')}}</h4>
                            <label>{{__('client.add_few')}}</label>

                            <div id='TextBoxesGroup'>
                                @if(!empty($job_questions))
                                <?php $i = 1; ?>
                                @foreach($job_questions as $question)

                                <div class="new_question">
                                    <input type='textbox' id='textbox{{$i}}' name="job_questions[]" class="form-control c-form" value="{{ $question }}" >
                                    <a class="remove_clsQ btn btn-primary">X</a>
                                </div>
                                <?php $i++ ?>
                                @endforeach
                                @endif
                            </div>

                            <input class="btn btn-info btn-color" type='button' value='{{__('client.other_question')}}' id='addButton' style="float-left">
                            <input type='button' value='&#8211;' id='removeButton'>
                        </div>

                        <div class="form-group form-with-icon">

                            <h4><i class="fa fa-file-text-o"></i> {{__('client.cvr_letter')}}</h4>
                            <label>{{__('client.ask_applicant')}}</label>
                            <div class="checkbox">
                                <label>
                                    <input name="job_cover_letter" class="c-checkbox" type="checkbox" value="1"
                                           @if($jobs->job_cover_letter == 1) checked @endif
                                    />
                                    <span class="custom-checkbox"></span>
                                    {{__('client.requir_cover')}}
                                </label>
                            </div>
                        </div>
                    </section>

                    <section class="form-section highlighted">


                        {{--<section>--}}
                            {{--<div class="form-group form-with-icon ">--}}
                                {{--<label>Job Status</label>--}}
                                {{--<select name="status" class="form-control">--}}
                                    {{--<option value="1" @if($jobs->status == 1) selected @endif>Open</option>--}}
                                    {{--<option value="2" @if($jobs->status == 2) selected @endif>Filled</option>--}}
                                    {{--</select> --}}
                                {{--</div>--}}
                            {{--</section>--}}

                    </section>

                    <div class="footer-btn">
                        <input type="hidden" name="action" id="action" value="">
                        <input type="button" class='btn btn-primary btn-color' onclick="value_sub('publish')" value='{{__('client.submit')}}' />
                        <button type="button" class='btn btn-info btn-color' onclick="value_sub('draft')" >{{__('client.save_draft')}}</button>
                        <a href="{{url('/joblist')}}" class='btn btn-link'  >{{__('client.cancel')}}</a>
                    </div>
                </div>

            </div>

        </div>

    </form>
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
        $( document ).ready( function () {
            $("#postjobform").validate({
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

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(document).on('submit', '#postjobform', function(event) {
            });
        });
    </script>
