<style type="text/css">
  .all_skills{
    float: right;
margin-right: 22%;
margin-top: 6px;
  }
  .skil_box{
    float: left;
padding: 0 5px;
background: #e3e3e3;
margin-right: 5px;
border-radius: 3px;
  }
</style>
<div class="skil_contaner skills__d">
    <h3 style="color:#666666 !important;padding-bottom: 20px !important; display: inline;font-size: 24px;"  data-toggle="modal" data-target="#skills">{{ __('freelancer.ProfessionalSkills') }} <a href="javascript:;"><i style="color:#666666 !important;" class="fa fa-pencil-square-o edite" aria-hidden="true"></i></a>
    </h3>
    <div class="all_skills">
        <?php

              if(!empty($profile_data->profetional_skills2))
              {
                //dd($profile_data->profetional_skills2);
                  foreach($profile_data->profetional_skills2 as $profetional_skill){

                    $skilll = $profetional_skill->freelancer_skill;
                    if(Lang::locale()=='ar'){
                      $skilll = $profetional_skill->ar_freelancer_skill;
                    }
                    //echo '<div class="skl">'.$profetional_skill->freelancer_skill.'</div>';
                    echo '<div style="display: inline;" class="skil_box"><input type="hidden" name="profetional_skills[]" value="'.$profetional_skill->id.'"><span>'.$skilll.'</span></div>';
                  }
                }

         ?>
         </div>
       </div>
@if(!empty($user_data->user_status)&&$user_data->user_status==3)
       <h3 style="color:#666666 !important;" class="table-header-colums-title"  data-toggle="modal" data-target="#freelancer_category">Change freelancer Category <a href="javascript:;"><i style="color:#666666 !important;" class="fa fa-pencil-square-o edite" aria-hidden="true"></i></a>
       </h3>
@endif
      <!-- Model pop up for skills -->
<div class="modal fade" id="freelancer_category" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 style="color:#666666 !important;" class="modal-title table-header-colums-title">Current Freelancer Category</h4>
         <h6 class="modal-title">Freelancer Parent Category  :  {{isset($freelancer_parent_category->freelancer_skill)?$freelancer_parent_category->freelancer_skill:''}}</h6>
 
       <h6 class="modal-title">Freelancer Sub Category  :  {{isset($freelancer_categry->freelancer_skill)?$freelancer_categry->freelancer_skill:''}}</h6>
          <h4 id="success" align="center"  class="alert-success"><b></b></h4>
          <h4 id="fail" align="center"  class="alert-danger"><b></b></h4>
      </div>
        <div class="skil_contaner"> 
        <div class="modal-body">

            @if(!empty($user_data->user_status)&&$user_data->user_status==1||$user_data->user_status==2)
            <h3>You are not able to Change category</h3> 
            @else
            <h3>Change Freelancer Category</h3>
        <form id="main-contact-form" action="" method="POST">
            <select  style="margin-bottom:10px;border-radius:20px;width: 30%; background-color: #e6e6e6;display:block;color:#666666; padding: 1%;" id="skills" onchange="sub_skills(this.value,'<?php echo $freelancer_categry->id; ?>')">
              @foreach ($main_category as $m_c)
                  @if($m_c->id==$freelancer_parent_category->id)
                        <option style="color:red;" value="{{$m_c->id}}">
                            {{$m_c->freelancer_skill}}
                        </option>
                    @endif
                @endforeach
                @foreach ($main_category as $m_c)
                @if($m_c->id!=$freelancer_parent_category->id)
               <option value="{{$m_c->id}}">
                  {{$m_c->freelancer_skill}}
                 </option>
                    @endif
              @endforeach
            </select>
            <span id="">
                <select id="sub_skil" name="sub_skill"  style="border-radius:20px;width: 30%; background-color: #e6e6e6;display:block;color:#666666; padding: 1%;">
                <option value="{{$freelancer_categry->id}}"  selected="selected">
                    {{$freelancer_categry->freelancer_skill}}
                </option>
                </select>
            </span>
            <input type="hidden" name="category_id" value="{{$freelancer_categry->id}}" >
            </form>

            @endif
       </div>
       <div class="modal-footer">
           @if(!empty($user_data->user_status)&&$user_data->user_status==3)
          <button id="submit_btn" type="submit" class="btn btn-default btn-color">{{ __('freelancer.Save') }}</button>
           @endif
          <a href="" class="btn-btn-default btn btn-color" data-dismiss="modal">{{ __('freelancer.Cancel') }}</a>
        </div>
     </div> 
    </div>
  </div>
</div>
<script>
    function  sub_skills(main_id,s_id) {


        $.getJSON('<?php echo url('check_sub_skills');   ?>/'+main_id,function(data) {
            var ht = '<option value="">Select Skill</option>';
            for (var i=0;i<data['data'].length;i++){
                var freelancer_skill=data['data'][i]['categorie'];
                var skill_id=data['data'][i]['skill_id'];
                if(s_id!=skill_id) {
                    ht += '<option  value=' + skill_id + ' selected="selected">' + freelancer_skill + '</option>';
                }

            }
            if(data['data'].length==0){
                ht+='<option style="color: red;">Sorry Record Not Found</option>';
            }
            $("#sub_skil").html(ht);
            $("#sub_skil").slideDown();
        });
    }
    $(function(){
        $("#success").hide();
        $("#submit_btn").click(function(event){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            $.post("<?php echo url('update/freelancer/category'); ?>",$("#main-contact-form").serialize(),function(data){
                if(data['status'] == true)
                {

                        $('#success').html(data['success']);

                    setTimeout(function(){
                        $("#success").slideUp('slow');
                        $('#freelancer_category').modal('toggle');
                        location.reload();
                    }, 5000);

                }
                else
                {

                    $("#fail").html(data['errors']);
                    setTimeout(function(){
                        $("#fail").slideUp('slow');
                    }, 5000);
                }
            },'json');

        });
    });
</script>
<!-- Model pop up for skills -->
<div class="modal fade" id="skills" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:#666666 !important;" class="modal-title">{{ __('freelancer.MySkills') }}</h4>
        </div>
        
        <form method="POST" action="{{ url('/profileupdate') }}/{{ $user_data->user_id }}">
          {{ csrf_field() }}
        <div class="modal-body">
          {{--<h4  style="float:left;width:100%;color:#666666 !important;margin-bottom: 15px;font-weight: bold;">{{ __('freelancer.EnterSkills') }}</h4>--}}
            <select style="width: 80%;padding: 10px;" id="fr_skills" name="profetional_skills[]" multiple="multiple">

                @foreach($user_possible_skills as $u_s)
                    @if(app()->getLocale()=='en')
                        @if(in_array($u_s->id,$selected_skills))
                            <option value="{{$u_s->id}}" selected>{{$u_s->freelancer_skill}}</option>
                            @else
                   <option value="{{$u_s->id}}">{{$u_s->freelancer_skill}}</option>
                     @endif
                    @else
                        @if(in_array($u_s->id,$selected_skills))
                            <option value="{{$u_s->id}}" selected>{{$u_s->ar_freelancer_skill}}</option>
                        @else
                            <option value="{{$u_s->id}}">{{$u_s->ar_freelancer_skill}}</option>
                        @endif
                    @endif
                   @endforeach

            </select>
          {{--<input class="lang_input" placeholder="hello" type="text" id="tags"/>--}}
            <br>
          <input type="hidden" name="user_id" value="{{ $user_data->user_id }}">
          <p class="Add-field">{{ __('freelancer.EnterSkillsUpToTen') }}</p>
        </div>
        <div class="modal-footer">
            <a href="" class="btn btn-default btn" data-dismiss="modal">{{ __('freelancer.Cancel') }}</a>
          <button type="submit" class="btn btn-default btn-color">{{ __('freelancer.Save') }}</button>

        </div>
        </form>
      </div>
    </div>
  </div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('#fr_skills').select2();
    });
</script>
