@include('include/header_guest')
<div  class="limiter">
  <div  class="container-login100">
    <div style="padding-top: 70px;"  class="img-padding wrap-login100 row">
          <span style="margin-top: -24px;text-align: center;line-height: 1.5em;" class="error" id="test-common-error">
          </span>
      <div class="login100-pic js-tilt col-md-5"  data-tilt>
        <figure>
          <img src="<?php echo asset('/new-design/') ?>/images/LOGO.png" alt="IMG" style="padding-top:70px; padding-left:90px;">
        <figcaption  style="color:#390E0E;text-align: center;justify-content: center;padding-top: 17px;font-family:GE-SS-TWO-BOLD !important;">
           {{__('auth.huurr_moto')}}
        </figcaption>
        </figure>
      </div>
        <div class="col-md-offset-2 col-md-5">
      <form style="line-height:0px;" class="login100-form validate-form" method="post">
        {{ csrf_field() }}
        <span class="login100-form-title">
            {{ __('auth.MemmberRegister') }}
          </span>
        <div class="hide_form">
          <div class="wrap-input100 validate-input">
            <input  class="registerinput input_val" type="text" name="name" id="first_name" value="{{ old('name') }}" placeholder="{{ __('auth.first_name') }}">
            <input type="hidden" name="language" value="{{ app()->getLocale() }}">
              <span class="focus-input100"></span>
            <span  class="symbol-input100">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>

          </div>
            <div style="padding-bottom: 10px;">
                <span class="error" style="margin-left: 40px;" id="first_name-error">{{ __('auth.errorMSGFirstName') }}</span>
            </div>

          <div class="wrap-input100 validate-input">
            <input class="registerinput input_val" type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder=" {{ __('auth.LastName') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
          </div>
            <div style="padding-bottom: 10px;">
                <span class="error" style="margin-left: 40px;" id="last_name-error">{{ __('auth.errorMSGLastName') }}</span>
            </div>
          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input  class="registerinput input_val" type="text" name="email" id="email" value="{{ old('email') }}" placeholder=" {{ __('auth.Email') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>
            <div style="padding-bottom: 10px;">
                <span class="error" style="margin-left: 40px;" id="email-error">{{ __('auth.errorMSGEmail') }}</span>
                <span class="error" style="margin-left: 40px;" id="email_valid-error">{{ __('auth.invalid_email') }}</span>
            </div>
          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input class="registerinput input_val" type="password" id="password" name="password" placeholder=" {{ __('auth.Password') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>

          </div>
            <div style="padding-bottom: 10px;">
                <span class="error" style="margin-left: 40px;" id="password-error">{{ __('auth.errorMSGPassword') }}</span>
            </div>
          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input class="registerinput input_val" type="password" name="password_confirmation" id="password_confirm" placeholder=" {{ __('auth.ConfirmPassword') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>

          </div>
            <div style="padding-bottom: 10px;">
                <span class="error" style="margin-left: 40px;" id="password_confirm-error">{{ __('auth.errorMSGConfirmPassword') }}</span>
            </div>
            <div  class="wrap-input100 validate-input">
                <select id="user_role" name="user_role"  onchange="check_freelancer()"  class="registerinput input_val" required="required">
                    <option  value="">{{__('auth.user_role')}}</option>
                    <option id="freelancer" value="freelancer">{{__('auth.freelancer')}}</option>
                    <option id="client" value="client">{{__('auth.client')}}</option>
                </select>
            </div>
            <div>
                <span class="error" id="user_role-error"  style="margin-left: 40px;">{{ __('auth.user_role') }}</span>
            </div>
            <div  style="margin-top: 20px;"   class="wrap-input100 validate-input">

                            <select name="skill" id="skill"  class="input100"  onchange="sub_skills(this.value)">
                            <option  value="">{{__('auth.select_skills')}}</option>
                                @foreach($skills as $main_skill)
                                <option value="{{$main_skill->id}}">
                                  <?php
                                   if(Lang::locale()=='ar'){
                                    echo $main_skill->ar_freelancer_skill;
                                   }
                                   else{
                                    echo $main_skill->freelancer_skill;
                                   }
                                  ?></option>
                            @endforeach
                            </select>
            </div>
            <div  id="main_skill-error"  style="padding-bottom: 10px;">
                <span   style="margin-left: 40px;color: red;" >{{ __('auth.errorSkill12') }}</span>
            </div>
            <div style="margin-top: 20px;" class="wrap-input100 validate-input" data-validate = "Password is required">
                <span id="sub_skills">

                </span>
            </div>
            <div   id="main_skill2"  style="padding-bottom: 10px;">
                <span    style="margin-left: 40px;color: red;">{{ __('auth.errorSkill12') }}</span>
            </div>
<script type="text/javascript">
    function check_freelancer(){
        var t=$("#user_role").val();
        if (t=='freelancer') {
            $("#skill").show();
            $("#sub_skills").hide();
        }
        else{
            $("#skill").hide();
            $("#sub_skills").hide();
        }
    }
   function  sub_skills(skill_id) {

       $.getJSON('<?php echo url('check_sub_skills');   ?>/'+skill_id,function(data) {
           var ht = '<select id="skill2" name="sub_skill" class="input100"><option value="">{{__('auth.select_skills')}}</option></selec>';
           var lang = '<?php echo Lang::locale();?>';
           for(var i=0;i<data['data'].length;i++){
                var freelancer_skill=data['data'][i]['categorie'];
               if(lang=="ar"){
                freelancer_skill=data['data'][i]['ar_categorie'];
               }
               var skill_id=data['data'][i]['skill_id'];
               ht+='<option value='+skill_id+'>'+freelancer_skill+'</option>';
           }
           if(data['data'].length==0){
               ht+='<option style="color: red;">Sorry Record Not Found</option>';
           }
           $("#sub_skills").html(ht);
           $("#sub_skills").slideDown();
       });
   }

</script>

            <div style="margin-top: 20px;"    class="wrap-input100 validate-input">
                <select id="user_gender" name="user_gender"  class="input_val registerinput" required="required">
                    <option  value="">{{__('auth.user_gender')}}</option>
                    <option  value="male" selected>{{__('auth.male')}}</option>
                    <option  value="female">{{__('auth.female')}}</option>
                </select>
            </div>
            <div style="padding-bottom: 10px;">
                <span class="error" style="margin-left: 40px;" id="user_gender-error">{{ __('auth.user_gender') }}</span>
            </div>
            <div  class="wrap-input100 validate-input">
                <label for="terms_conditions">
                    <input type="checkbox" id="terms_conditions" class="input_val" name="terms_conditions" value="Yes">
                    {{ __('auth.agree') }} <a href="terms" id="termsCondition">{{ __('auth.termsCondition') }}</a>
                </label>
                <br>
            </div>
            <div style="padding-bottom: 10px;">
                <span class="error" style="margin-left: 40px;" id="terms_conditions-error">{{ __('auth.termsCondition') }}</span>
            </div>
        </div>
          <div class="common-error">
          <span style="padding-top: 10px;padding-bottom: 20px;" class="error" id="common-error">
          </span>
          </div>
        <div style="margin-top: 10px;" class="wrap-input100">
          <button type="button" class="login100-form-btn start_registration">
            {{ __('auth.Register') }}
          </button>
            {{--<span style="margin-top: -60px;line-height: 1.5em;" class="error" id="test-common-error">--}}
          {{--</span>--}}
            <br>
        </div>
          <div style="margin-top: 10%;"  class="link wrap-input100 validate-input">
              <a class="txt2" style="float:left;color: #933f3f;font-size:20px;" href="{{ url('') }}">
                  <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
                  {{ __('auth.home') }}
              </a>
              <a class="txt2" style="float:right;padding-right:20%;color: #933f3f;font-size:20px;" href="{{ url('login') }}">
                  {{ __('auth.Login') }}
                  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
              </a>
          </div>
      </form>
        </div>
    </div>
  </div>
</div>
@include('include/footer_guest')
<script type="text/javascript">
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }

   jQuery(document).ready(function($) {
       $("#main_skill2").hide();
       $("#main_skill-error").hide();
       $(".common-error").hide();
       check_freelancer();
        $(document).on('click', '.start_registration', function(event) {
            $("#site_loader").fadeIn();
            var error_check = false;
            $('.error').css('display','none');
            $('#common-error').html('').css('font-size','16px');

            var emailaddress = $("#email").val();
            $.each($('.input_val'), function(index, val) {
                if($(this).val()=='')
                {
                    var id = $(this).attr('id');
                    console.log(id);
                    $('#'+id+'-error').css('display','block');
                    error_check = true;
                }
                else  if( !validateEmail(emailaddress)) {
                    $('#email_valid'+'-error').css('display','block');
                    error_check = true;


                }
                if(document.getElementById("terms_conditions").checked === false) {
                    $('#terms_conditions-error').css('display','block');
                    error_check = true;
                }
            });
            if(error_check==true)
            {
                $("#site_loader").fadeOut();
                return false;
            }
            if($('.input_val:checked').length==0)
            {
                $('#user_role-error').css('display','block');
                return false;
            }
            var dataString = $(this).closest('form').serialize();
            var url = $('base').attr('href');
            $.ajax({
                url: '<?php echo url('/register'); ?>',
                type: 'POST',
                data: dataString,
            })
                .done(function(data) {
                    $("#site_loader").fadeOut();
                    var result = $.parseJSON(data);
                    if(result.status==true)
                    {

                        $('.login100-pic').css('display', 'none');
                        $('.login100-form-title').css('display','none');
                        $('.hide_form, .start_registration,.link').hide('fast');
                        $('#test-common-error').css('display','block').css('font-size','20px').css('color','rgb(0, 128, 7)').html(result.message);
                        $('#test-common-error').append('<br><div style="margin-top:30px;font-size:18px;"><a href="<?php echo url('/'); ?>">Home</a>  <span style="color:#9C9C9C;margin-top: 1px;position: relative;top: 2px;">|</span>  <a href="<?php echo url('/login'); ?>">Login</a></div>');
                        $('.login-form')[0].reset();
                        return false;
                    }
                    if(result.status==3){
                        $("#main_skill-error").show();
                    }
                    if(result.status==4){
                        $("#main_skill-error").hide();
                        $("#main_skill2").show();
                    }
                    else {
                        $(".common-error").show();
                        $('#common-error').css('display','block').css('color','red').css('margin-bottom','20px').html(result.message);
                        return false;
                    }

                })
                .fail(function(error) {
                    $("#site_loader").fadeOut();
                    console.log(error);
                });

        });
    });
</script>
