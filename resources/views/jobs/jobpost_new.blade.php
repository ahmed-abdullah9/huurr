@include ('include/header_cl')
<style>
label {
font-weight: normal !important;
}
</style>
<div class="col-md-12 col-sm-9 col-xs-12 mbl-pstjob" style="float: none;">
    <div style="padding-bottom: 10px;" class="row clienttoprow">
        <div class="col-md-12 col-sm-12" >
            <a class="btn btn-round btn-color" href="{{url('/joblist')}}"><i class="fa fa-arrow-circle-left"></i>{{__('client.go_back')}}</a>
        </div>
        <div class="col-md-12 col-sm-12" >
            <h3 class="main-form-title">{{__('client.post_job')}}</h3>
        </div>
    </div>

    <div class="row form-label-color">
        <div class="col-md-12 col-sm-12 " style="float: none;">
            <div class="clientjobfeed">

                <form data-toggle="validator" role="form"  action="{{ url('createjob') }}" method="POST" id="postjobform" enctype="multipart/form-data">
                    <input type="hidden" value="1" name="job_type" />
                    <p class="red">{{ $errors->jobPost->first('job_type') }} </p>
                    {{ csrf_field() }}
                    <div class="newjob">
                        <section class="form-section">
                            <div class="form-group">
                                <label for="job_title"> <h4 class="">{{__('client.job_title')}} <span class="red">*</span></h4></label>
                                <input name="job_title" id="job_title" class="form-control c-form" type="text" placeholder="{{__('client.example_need')}}" required/>
                                <p class="red">{{ $errors->jobPost->first('job_title') }} </p>
                            </div>


<div class="row form-label-color">
<div class="col-md-12 col-sm-12 " style="float: none;">
<div class="clientjobfeed">

<form data-toggle="validator" role="form"  action="{{ url('createjob') }}" method="POST" id="postjobform" enctype="multipart/form-data">
<input type="hidden" value="1" name="job_type" />
<p class="red">{{ $errors->jobPost->first('job_type') }} </p>
{{ csrf_field() }}
<div class="newjob">
<section class="form-section">


<div class="form-group">
    <h4 class="">{{__('client.job_category')}}<span class="red">*</span></h4>
    <select name="category_id" onchange="view_skills(this.value)" class="form-control  c-form" required style="color:#000;">
        <option value="">{{__('client.select_category')}}</option>

        @if(sizeof($categories) > 0)
            @foreach($categories as $cat)
                @if(Lang::locale()=='en')
                <option value="{{ $cat->id }}">{{ $cat->freelancer_skill }}</option>
                @elseif(isset($cat->ar_freelancer_skill))
                    <option value="{{ $cat->id }}">{{$cat->ar_freelancer_skill}}</option>
                @endif
            @endforeach
        @endif

    </select>
    <p class="red">{{ $errors->jobPost->first('category_id') }} </p>
</div>

<div class="form-group">
    <h4 class="">{{__('client.enter_skills')}}</h4>
    <div class="addskillbox">
        <select style="width: 100% !important;" id="job_skills" name="job_skills[]" multiple="multiple">
            <option value="" disabled>Select Job Category first</option>

        </select>
        {{--<div class="addskilone">--}}
        {{--<input name="job_skills[]" class="form-control c-form" type="text" placeholder="Type here" />--}}
        {{--</div>--}}
    </div>
</div>
{{-- <div class="form-group">
    <h4 class="">{{__('client.job_type')}} <span class="red">*</span></h4>
    <select id="job_time_type" onchange="job_category(this.value)" name="job_time_type" class="form-control  c-form" required style="color:#000;">
        <option value="">{{__('client.select_type')}}</option>
        <option value="hourly">{{__('client.hourly')}}</option>
        <option value="fixed">{{__('client.fixed')}}</option>
    </select>
    <p class="red">{{ $errors->jobPost->first('job_time_type') }} </p>
</div> --}}
{{-- <div style="display: none;" class="job-rate form-group">
    <h4 class="">{{__('client.pw_hour')}} <span class="red">*</span></h4>
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
</div> --}}
<div class="budget form-group">
    <h4 class="">{{__('client.Budget')}} <span class="red">*</span></h4>
    <input name="budget" class="form-control c-form" type="text" id="budget" placeholder="Example: SAR-25"/>
    <p class="red">{{ $errors->jobPost->first('budget') }} </p>
</div>
<div class="form-group">
    <h4 class="">{{__('client.describe_work')}} <span class="red">*</span></h4>
    <textarea name="job_description" class="form-control c-form"
              placeholder="{{__('client.help_developing')}}" required></textarea>
    <p class="red">{{ $errors->jobPost->first('job_description') }} </p>
</div>
{{-- <div class="form-group">
    <h4 class="">{{__('client.Job_specific')}}</h4>
    <select style="width: 30% !important;" class="js-example-basic-multiple" name="countries[]" multiple="multiple">
        <option value="" disabled>Select Country</option>
        @foreach($countries as $country)
            <option value="{{$country}}">{{$country}}</option>
        @endforeach
    </select>
</div> --}}
<div class="form-group">
    <h4 class="">{{__('client.attachments')}}</h4>
    <!-- temporary upload html -->
    <div class="flag-upload form-control c-form click_event" style="width: 30%;">{{__('client.upload_project')}}</div>
    <small>{{__('client.may_attach')}}</small>
    <input   type="file"   id="attachments" class="attchmentd" multiple name="attachments[]" style="display: none;">
    {{--<img id="image_preview" src="" style="width: 150px;height;15Opx; display: none;" alt="your image" />--}}
    <output class="pdf_priew" id="list"></output>
</div>
<script>
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
        if(evt.target.files[0].type=='application/pdf'){
            pdf_preview(evt.target.files[0]);
        }

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.   <p ><i class="fa fa-paperclip" aria-hidden="true" style="margin-right:3px"></i><span style="color:#2aa1c9">'+theFile.name+'</span></p>
                    var span = document.createElement('span');
                    span.innerHTML = ['<img style="width:150px;height:150px;" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('list').insertBefore(span, null);
                };
            })(f);

            reader.readAsDataURL(f);
        }
    }
    document.getElementById('attachments').addEventListener('change', handleFileSelect, false);
</script>
{{-- <div class="form-group">
    <h4 class="">{{__('client.what_type')}} <span class="red">*</span></h4>
    <div class="checkbox">
        <label class="">
            <input class="c-radio" type="radio" name="project_type" value="1" required />
            <span class="custom-radio"></span> {{__('client.one_time')}} </label>
    </div>
    <div class="checkbox">
        <label >
            <input class="c-radio" type="radio" name="project_type" value="2" required />
            <span class="custom-radio"></span> {{__('client.ongoing_pro')}} </label>
    </div>
    <div class="checkbox">
        <label>
            <input class="c-radio" type="radio" name="project_type" value="3" required />
            <span class="custom-radio"></span> {{__('client.not_sure')}} </label>
    </div>
    <p class="red">{{ $errors->jobPost->first('project_type') }} </p>
</div> --}}

<input name="sl_name" type="hidden" value="1">
<input type="hidden" name="fl_number" value="1">

<!-- <div class="form-group">
    <h4 >{{__('client.many_freelancers')}} <span class="red">*</span></h4>
    <div class="checkbox">
        <label>
            <input class="c-radio sl_name_1" type="radio" name="sl_name" required="" checked="checked">
            <span class="custom-radio"></span> {{__('client.want_hire')}} </label>
    </div>
    <div class="checkbox">
        <label class="">
            <input class="c-radio sl_name_2" type="radio" name="sl_name" />
            <span class="custom-radio"></span> {{__('client.need_hire')}} </label>
    </div>
    <div class="checkbox input_check_box_text" style="display: none">
        <label>
            <input class="form-control  c-form" type="text" value="1" name="fl_number" required placeholder="Please Enter no of freelancer" />
    </div>
    <p class="red">{{ $errors->jobPost->first('sl_name') }} </p>
</div> -->

{{-- <div class="form-group">
    <h4 class="">{{__('client.desired_experience')}} <span class="red">*</span></h4>
    <div class="radio_blocks_outer row">
        <div class="col-md-8 col-sm-12">
            <div class="block_md ">
                <div class="custom-control custom-radio col-md-4 col-sm-12">
                    <input type="radio" class="custom-control-input" id="defaultUnchecked" name="experience_level" value="1" selected required/>
                    <label class="custom-control-label form-label-color-options" for="defaultUnchecked"><span>&#36</span> {{__('client.entry_level')}}</label>
                </div>
                <div class="custom-control custom-radio col-md-4 col-sm-12 form-label-color-options">
                    <input type="radio" class="custom-control-input" id="defaultUnchecked" name="experience_level" value="2" selected required/>
                    <label class=" custom-control-label form-label-color-options" for="defaultUnchecked"><span>&#36 &#36</span> {{__('client.intermediate')}}</label>
                </div>
                <div class="custom-control custom-radio col-md-4 col-sm-12 form-label-color-options">
                    <input type="radio" class="custom-control-input" id="defaultUnchecked" name="experience_level" value="3" selected required/>
                    <label class=" custom-control-label form-label-color-options" for="defaultUnchecked"><span>&#36 &#36 &#36</span> {{__('client.expert')}}</label>
                </div>
            </div>
            <p class="red">{{ $errors->jobPost->first('experience_level') }} </p>
        </div>
    </div>
</div> --}}
{{-- <div class="form-group">
    <h4 class="form-label-color">{{__('client.how_long')}}<span class="red">*</span></h4>
    <div class="radio_blocks_outer row">
        <div class="col-md-12 col-sm-12">
            <div class="block_md ">
                <div class="radio_block col-md-3 col-sm-6 form-label-color-options">
                    <input type="radio" name="job_duration" value="1" required/>
                    <div  class="checkbox-inline block_inner "> <span><i class="fa fa-calendar"></i></span>
                        <label>{{__('client.six_months')}}</label>
                    </div>
                </div>
                <div class="radio_block col-md-2 col-sm-6 form-label-color-options">
                    <input type="radio" name="job_duration" value="2" required/>
                    <div  class="checkbox-inline block_inner "> <span><i class="fa fa-calendar"></i></span>
                        <label>{{__('client.three_six')}}</label>
                    </div>
                </div>
                <div class="radio_block col-md-2 col-sm-12 form-label-color-options">
                    <input type="radio" name="job_duration" value="3" required/>
                    <div  class="checkbox-inline block_inner "> <span><i class="fa fa-calendar"></i></span>
                        <label>{{__('client.one_three')}}</label>
                    </div>
                </div>
                <div class="radio_block col-md-3 col-sm-6 form-label-color-options">
                    <input type="radio" name="job_duration" value="4" required/>
                    <div class="checkbox-inline block_inner "> <span><i class="fa fa-calendar"></i></span>
                        <label>{{__('client.less_one')}}</label>
                    </div>
                </div>
                <div class="radio_block col-md-2 col-sm-6 form-label-color-options">
                    <input type="radio" name="job_duration" value="5" required/>
                    <div style="width:70%;display: inline;"  class="block_inner "> <span><i class="fa fa-calendar"></i></span>
                        <label class="form-label-color-options">{{__('client.less_week')}}</label>
                    </div>
                </div>
            </div>
            <p class="red">{{ $errors->jobPost->first('job_duration') }} </p>
        </div>
    </div>

</div> --}}
{{-- <div class="form-group">
    <h4 class="form-label-color">{{__('client.time_comitment')}} <span class="red">*</span></h4>
    <div class="radio_blocks_outer row">
        <div class="col-md-8 col-sm-12">
            <div class="block_md ">
                <div class="radio_block col-md-4 col-sm-12 form-label-color-options">
                    <input type="radio" name="job_time" value="1" required/>
                    <div class="checkbox-inline block_inner "> <span><i class='fa fa-clock-o'></i></span>
                        <label>{{__('client.more_hrs')}}</label>
                    </div>
                </div>
                <div class="radio_block col-md-4 col-sm-12 form-label-color-options">
                    <input type="radio" name="job_time" value="2" required/>
                    <div class=" checkbox-inline block_inner "> <span><i class='fa fa-clock-o'></i></span>
                        <label>{{__('client.less_hr')}}</label>
                    </div>
                </div>
                <div class="radio_block col-md-4 col-sm-12 form-label-color-options">
                    <input type="radio" name="job_time" value="3" required/>
                    <div class="checkbox-inline block_inner "> <span><i class='fa fa-clock-o'></i></span>
                        <label class="">{{__('client.know_yet')}}</label>
                    </div>
                </div>
            </div>
            <p class="red">{{ $errors->jobPost->first('job_time') }} </p>
        </div>
    </div>
</div> --}}
</section>
<section class="form-section ">
<h4 class="form-label-color">{{__('client.free_prefrence')}}</h4>
{{-- <div class="form-group form-with-icon">
    <h4 style="font-weight: bolder;padding-top: 10px;padding-bottom: 10px;"><i class='fa fa-comments-o'></i>{{__('client.screen_quiz')}}</h4>
    <label>{{__('client.add_few')}}</label>
    <!--mahdi-->

    <div id='TextBoxesGroup'>
        <div id="TextBoxDiv1">
            <input type='textbox' id='textbox1' name="job_questions[]" class="form-control c-form" >
        </div>
    </div>
    <input class="btn btn-info btn-color" type='button' value='{{__('client.other_question')}}' id='addButton' style="float-left">
    <input type='button' value='&#8211;' id='removeButton'>
    <!--mahdi-->
</div> --}}
<div class="form-group form-with-icon">
    <h4 class=""><i class="fa fa-file-text-o"></i> {{__('client.cvr_letter')}}</h4>
    <label>{{__('client.ask_applicant')}}</label>
    <div class="checkbox">
        <label>
            <input name="job_cover_letter" class="c-checkbox" checked type="checkbox" value="1">
            <span class="custom-checkbox"></span> {{__('client.requir_cover')}} </label>
    </div>
</div>
</section>
<section class="form-section highlighted">

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
<input type="button" class='btn btn-primary btn-color' onclick="value_sub('publish')" value='{{__('client.submit')}}' />
<button type="button" class='btn btn-info btn-color' onclick="value_sub('draft')" >{{__('client.save_draft')}}</button>
<a href="{{url('/joblist')}}" class='btn btn-link'  >{{__('client.cancel')}}</a>
</div>
</form>
</div>
</div>
</div>
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
                    if(Lang=="en"){
                        var title=value.freelancer_skill;
                    }
                    else{
                        var title=value.ar_freelancer_skill;
                    }
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
$( document ).ready( function () {
    $('.js-example-basic-multiple').select2();
    $('#job_skills').select2();
$("#postjobform").validate({
rules: {
job_title:"required",
category_id:"required",
// job_time_type:"required",
job_description:"required",
// project_type:"required",
// sl_name:"required",
// experience_level:"required",
// job_duration:"required",
// job_time:"required",
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
// project_type:"{{__('client.project_type')}}",
// experience_level:"{{__('client.experience_level')}}",
// job_duration:"{{__('client.job_duration')}}",
// job_time:"{{__('client.job_time')}}",
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
//$('#postjobform').validator();

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
jQuery(document).ready(function($) {
$(document).on('submit', '#postjobform', function(event) {
if($("#job_time_type").val()=='fixed'){
if ($('#budget').val()<10) {
alert('Please enter budget minimum 10');
event.preventDefault();
return false;
}
}
});
});
</script>