@include('include.header_fr')

<div class="container">

    @if(!empty($clcomment))
        <div class="row">
            <div style="z-index: 0;" class="col-md-offset-2 col-md-8">
                <h3 align="center">Client Given Feedback <small>on</small></h3>
                <h4 align="center">
                    @if(isset($frcomment->job_title))
                        {{$frcomment->job_title}}
                        @endif
                </h4>
                <p>I am Highly thankfull to you for spend time with us,please share your experience with me.</p>
                <hr>
                <h2>Comment</h2>
                <p>{{$clcomment->comment}}</p>
                <hr>
                <h3 style="font-size: 20px;">Over All Experience</h3>
                <div  id="experience2"></div>
                <label for="experience2">{{$clcomment->experience}}</label>
                <h3 style="font-size: 20px;">Response Time</h3>
                <div  id="timing_response2"></div>
                <label for="timing_response2">{{$clcomment->response_time}}</label>
                <h3 style="font-size: 20px;">Communication Experience</h3>
                <div  id="communication_experience2"></div>
                <label for="communication_experience2">{{$clcomment->com_experience}}</label>
                <h3 style="font-size: 20px;">Technical Skills</h3>
                <div  id="technical_skills2"></div>
                <label for="technical_skills2">{{$clcomment->tech_skills}}</label>
                <hr>
                <div>
                </div>
            </div>
        </div>
        <script>
            $(function () {
                var maxValue=5;
                var totalStars=5;
                var $experience = $("#experience2").rateYo({
                    numStars: totalStars,
                    maxValue: maxValue,
                    readOnly: true,
                    rating:'{{$clcomment->experience}}'
                }).on("rateyo.change", function (e, data) {
                    var rating = data.rating;
                    $(this).next().text(rating);
                });
                var $timing_response = $("#timing_response2").rateYo({
                    numStars: totalStars,
                    maxValue: maxValue,
                    readOnly: true,
                    rating:'{{$clcomment->response_time}}'
                }).on("rateyo.change", function (e, data) {
                    var rating = data.rating;
                    $(this).next().text(rating);
                });
                var $communication_experience = $("#communication_experience2").rateYo({
                    numStars: totalStars,
                    maxValue: maxValue,
                    readOnly: true,
                    rating: '{{$clcomment->com_experience}}',
                }).on("rateyo.change", function (e, data) {
                    var rating = data.rating;
                    $(this).next().text(rating);
                });
                var $technical_skills = $("#technical_skills2").rateYo({
                    numStars: totalStars,
                    maxValue: maxValue,
                    readOnly: true,
                    rating:'{{$clcomment->tech_skills}}'
                }).on("rateyo.change", function (e, data) {
                    var rating = data.rating;
                    $(this).next().text(rating);
                });

            });
        </script>
    @endif
    @if(empty($frcomment))
  <div class="row">
    <div style="padding-bottom: 10%;z-index: 0;" class="col-md-offset-2 col-md-8">
     <form style="width: 100%;" action="{{url('fr_feedback/fr/submit')}}" method="post">
         <input type="hidden" id="proposal_id" name="proposal_id" value="{{encrypt($for_feedback->proposal_id)}}">
         <input type="hidden" id="feedback_by" name="feedback_by" value="{{encrypt(2)}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" id="experience_value" name="experience">
         <input type="hidden" id="response_time" name="response_time">
         <input type="hidden" id="communication" name="communication">
         <input type="hidden" id="skills" name="skills">
         <h3 align="center">Please Give Feedback <small>on</small></h3>
         <h4 align="center">@if(isset($frcomment->job_title))
                 {{$frcomment->job_title}}
             @endif</h4>
       <p>I am Highly thankfull to you for spend time with us,please share your experience with me.</p>
        <h3 style="font-size: 20px;">Over All Experience</h3>
       <div  id="experience"></div>
       <label for="experience"></label>
       <h3 style="font-size: 20px;">Response Time</h3>
       <div  id="timing_response"></div>
       <label for="timing_response"></label>
       <h3 style="font-size: 20px;">Communication Experience</h3>
       <div  id="communication_experience"></div>
       <label for="communication_experience"></label>
       <h3 style="font-size: 20px;">Technical Skills</h3>
       <div  id="technical_skills"></div>
       <label for="technical_skills"></label>
       <h3>Message</h3>
       <textarea id="message" style="width: 100%;" name="message">

       </textarea>
         <hr>
         <button type="submit" id="submit_feedback" style="float: right;" class="block btn btn-lg btn-color">Send FeedBack</button>
     </form>
      <div>
      </div>
    </div>
  </div>
        @else
        <div class="row">
            <div style="padding-bottom: 10%;z-index: 0;" class="col-md-offset-2 col-md-8">
                    <h3 align="center">Your Given Feedback <small>on</small></h3>
                    <h4 align="center">@if(isset($frcomment->job_title))
                            {{$frcomment->job_title}}
                        @endif</h4>
                    <p>I am Highly thankfull to you for spend time with us,please share your experience with me.</p>
                   <hr>
                <h2>Comment</h2>
                <p>{{$frcomment->comment}}</p>
                <hr>
                   <h3 style="font-size: 20px;">Over All Experience</h3>
                    <div  id="experience1"></div>
                    <label for="experience1">{{$frcomment->experience}}</label>
                    <h3 style="font-size: 20px;">Response Time</h3>
                    <div  id="timing_response1"></div>
                    <label for="timing_response1">{{$frcomment->response_time}}</label>
                    <h3 style="font-size: 20px;">Communication Experience</h3>
                    <div  id="communication_experience1"></div>
                    <label for="communication_experience1">{{$frcomment->com_experience}}</label>
                    <h3 style="font-size: 20px;">Technical Skills</h3>
                    <div  id="technical_skills1"></div>
                    <label for="technical_skills1">{{$frcomment->tech_skills}}</label>
                    <hr>
                @if($frcomment->progress==1)
                <button class="btn btn-round btn-default btn-color" onclick="window.location.href='<?php echo url('/') ?>/fr_mark/complete/job/{{$frcomment->job_id}}'">End Contract</button>
                 @endif
                <div>
                </div>
            </div>
        </div>
        @endif
</div>
@if(empty($frcomment))
<script>
    $(function () {
        var maxValue=5;
        var totalStars=5;
        var $experience = $("#experience").rateYo({
            numStars: totalStars,
            maxValue: maxValue,
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).next().text(rating);
        });
        var $timing_response = $("#timing_response").rateYo({
            numStars: totalStars,
            maxValue: maxValue,
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).next().text(rating);
        });
        var $communication_experience = $("#communication_experience").rateYo({
            numStars: totalStars,
            maxValue: maxValue,
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).next().text(rating);
        });
        var $technical_skills = $("#technical_skills").rateYo({
            numStars: totalStars,
            maxValue: maxValue,
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).next().text(rating);
        });

   $("#submit_feedback").click(function(){
       var experience = $experience.rateYo("rating");
       var timing_response = $timing_response.rateYo("rating");
       var communication_experience = $communication_experience.rateYo("rating");
       var technical_skills = $technical_skills.rateYo("rating");
       $("#skills").val(technical_skills);
       $("#experience_value").val(experience);
       $("#response_time").val(timing_response);
       $("#communication").val(communication_experience);
   });
    });
</script>
@else
<script>
    $(function () {
        var maxValue=5;
        var totalStars=5;
        var $experience = $("#experience1").rateYo({
            numStars: totalStars,
            maxValue: maxValue,
            readOnly: true,
            rating:'{{$frcomment->experience}}'
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).next().text(rating);
        });
        var $timing_response = $("#timing_response1").rateYo({
            numStars: totalStars,
            maxValue: maxValue,
            readOnly: true,
            rating:'{{$frcomment->response_time}}'
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).next().text(rating);
        });
        var $communication_experience = $("#communication_experience1").rateYo({
            numStars: totalStars,
            maxValue: maxValue,
            readOnly: true,
            rating: '{{$frcomment->com_experience}}',
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).next().text(rating);
        });
        var $technical_skills = $("#technical_skills1").rateYo({
            numStars: totalStars,
            maxValue: maxValue,
            readOnly: true,
            rating:'{{$frcomment->tech_skills}}'
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).next().text(rating);
        });

    });
</script>
@endif
@include('include.footer_fr')