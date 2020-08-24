@include ('include/header')
  

    <section class="contact_brick">
        <div class="container mt-100">
            <div class="row center" style="margin-top: 50px;">
                <div class="col-md-8 col-md-offset-2 col-sm-12">
                    <div class="section-title">
                        <h2 class="mb-50">{{__('homepage.get_touch')}}</h2>
                        <p class="module-subtitle">{{__('homepage.get_touch_des')}}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-100">
                    <!--location-->
                    <div class="col-md-4 col-sm-4 text-center wow slideInLeft">
                        <div class="detail">
                            <i class="lnr lnr-map-marker"></i>
                            <h4><span>{{__('homepage.location')}}</span></h4>
                            <h3>{{__('homepage.locations')}}</h3>
                                <p>
                                    {{__('homepage.address')}}
                                </p>
                        </div>
                    </div>
                    <!--end location-->

                    <!--contact info-->
                    <div class="col-md-4 col-sm-4 text-center wow slideInUp">
                        <div class="detail">
                            <i class="lnr lnr-phone"></i>
                            <h4><span>{{__('homepage.contact_us')}}</span></h4>
                            <h3>{{__('homepage.contacts')}}</h3>
                            <p>
                                <abbr title="Email">E:</abbr> info@huurr.com
                            </p>
                        </div>
                    </div>
                    <!--end contact info-->

                    <!--contact info-->
                    <div class="col-md-4 col-sm-4 text-center wow slideInRight">
                        <div class="detail">
                            <i class="lnr lnr-clock"></i>
                            <h4><span>{{__('homepage.work_on')}}</span></h4>
                            <h3>{{__('homepage.schedule')}}</h3>
                            <p>
                                {{__('homepage.timing')}}
                            </p>
                        </div>
                    </div>
                    <!--end contact info-->
                </div>
            <!-- CONTACT FORM -->
            <div class="contact-form bottom">
                <form id="main-contact-form" name="contact-form" method="post" action="sendemail.php">
                    <p class="alert-success" style="background-color: white;" id="success">{{ __('auth.success') }}</p>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control" required="required" placeholder="{{__('homepage.name')}}">
                        <p class="alert-danger" style="background-color: white;" id="name1">{{ __('auth.name') }}</p>
                    </div>
                    <div class="form-group">
                        <input type="text" name="company" id="company" class="form-control" required="required" placeholder="{{__('homepage.company')}}">
                        <p class="alert-danger" style="background-color: white;" id="company1">{{ __('auth.company') }}</p>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control" required="required" placeholder="{{__('homepage.email_id')}}">
                        <p class="alert-danger" style="background-color: white;" id="email_required">{{ __('auth.email_required') }}</p>
                        <p class="alert-danger" style="background-color: white;" id="email_valid">{{ __('auth.email_valid') }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="{{__('homepage.text_here')}}"></textarea>
                        <p class="alert-danger" style="background-color: white;" id="message1">{{ __('auth.message') }}</p>
                    </div>
                    <div class="form-group">
                        <button id="submit_btn" class="default-btn gray-btn"> {{ __('homepage.send') }} <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                    </div>
                    <p class="alert-danger" style="background-color: white;" id="wrong">{{ __('auth.wrong') }}</p>
                </div>
                </form>
                <script>
                    function hide(){
                        $('#email_required').hide();
                        $('#email_valid').hide();
                        $('#name1').hide();
                        $('#company1').hide();
                        $('#message1').hide();
                        $('#wrong').hide();
                        $('#success').hide();
                    }
                    $(function(){
                         hide();
                        $("#submit_btn").click(function(event){
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            event.preventDefault();
                            $.post("<?php echo url('/contact_submit'); ?>",$("#main-contact-form").serialize(),function(data){
                                if(data['status'] == true)
                                {
                                    document.getElementById('main-contact-form').reset();
                                    if (data['success']=='Thanx for Contact with Huurr.com'){
                                       $('#success').show();
                                    }
                                    setTimeout(function(){
                                        $(".alert-success").slideUp('slow');
                                    }, 5000);

                                }
                                else
                                {
                                    $.each(data['errors'], function( index, value ){
                                        if (value=='Email is Required'){
                                          $('#email_required').show();
                                        }
                                        if (value=='Please Enter Valid Email Address'){
                                            $('#email_valid').show();
                                        }
                                        if (value=='Please Write Your good Name!'){
                                          $('#name1').show();
                                        }
                                        if (value=='Please write Company Name'){
                                            $('#company1').show();
                                        }
                                        if (value=='Please Write Message!'){
                                            $('#message1').show();
                                        }
                                        if (value=='Something going wrong'){
                                            $('#wrong').show();
                                        }
                                    });
                                    setTimeout(function(){
                                        $(".alert-danger").slideUp('slow');
                                    }, 5000);
                                }
                            },'json');

                        });
                    });
                </script>
            </div>
        </div><!-- end container -->
    </section>
@include ('include/footer')