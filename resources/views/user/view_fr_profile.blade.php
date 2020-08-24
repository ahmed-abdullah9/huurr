@include ('include/header_cl')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/select.css') }}">
<!-- google web font css --><link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">


    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">

            <div class="x_title">

                <div class="row">
                    <div class="col-md-3">
                    <a href="{{url('find/freelancer')}}" class="btn btn-color btn-round"><i class="fa fa-arrow-left"></i>Go Back</a>
                    </div>
                    <div class="col-md-3">
                        <h2 style="padding-bottom: 20px;" class="table-heading">{{ $user_data->name }} {{ $user_data->last_name }}</h2>
                    </div>
                    <div class="col-md-6">
                        <p class="font-color" style="float:right;padding-top: 10px;"> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo (isset($profile_data->city)?$profile_data->city:'').', '.(isset($profile_data->country)?$profile_data->country:'') ?> - <?php
                            date_default_timezone_set('Asia/Riyadh');
                            echo date('h:i:a') ?> local time</p>


                    </div>

                </div>


                <div class="clearfix"></div>

            </div>

            <div class="freelancer_info">
                <div class="col-md-8 col-sm-8 col-lg-8">
                    <div class="profile_pic m-t" style="background: none;border: none;padding-bottom: 22px;display: inline;"> <img class="rounded" style="border-radius: 50%;width: 100%;" src="<?php if(isset($profile_data->profile_image)){ echo asset($profile_data->profile_image); }else
                        { echo asset('images/profile-pic.png'); } ?>" alt="profile-pic">
                  </div>
                    <div style="display: inline;padding: 40px;">
                        <h3 style="color:#666666 !important;font-weight: normal;border-bottom: none;padding-top: 40px !important;font-size: 24px;" data-toggle="modal" data-target="#Education">{{ __('freelancer.Education') }}
                        </h3>
                        <ul style="margin-top: 20px;">
                            @if(!empty($all_education))
                                @foreach($all_education as $education)
                                    <li style="padding-left: 30px;">
                                        <a class="edit-education" educatoin_id="{{ $education->id }}" href="">{{ $education->degree }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <form action="{{url('send/freelancer/message')}}" method="post">
                            <input type="text" name="message" style="padding: 10px;border-radius: 4px;margin-top: 10px;display: inline;" placeholder="Say hi">
                            <input type="hidden" name="user_id" value="{{$user_data->user_id}}" readonly>
                            <button style="display: inline;padding: 10px;border-radius: 4px;" class="btn btn-color">Send</button>
                        </form>
                    </div>

                    <div class="freelancer_name">
                        <h3 style="color:#666666 !important;padding-bottom: 20px;font-size: 24px;" class="skills__d" >
                            <font>
                                Job Title
                            </font>
                            <font class="pull-right">
                            @if(!empty($profile_data->job_title))
                                {{ $profile_data->job_title }} @else No Job Information
                            @endif
                            </font>
                        </h3>
                    </div>
                    <div class="skills">
                        <div class="skil_contaner skills__d">
                            <h3 style="color:#666666 !important;padding-bottom: 20px !important; display: inline;font-size: 24px;" >{{ __('freelancer.ProfessionalSkills') }}
                            </h3>
                            <?php
                                if(!empty($profile_data->profetional_skills2) && isset($profile_data->profetional_skills2))
                                {

                                        foreach ($profile_data->profetional_skills2 as $profetional_skill) {
                                            echo '<div style="display: inline; float: right;" class="skil_box"><input type="hidden" name="profetional_skills[]" value="'.$profetional_skill->id.'">'.$profetional_skill->freelancer_skill.'</div>';
                                        }
                                }

                            ?>
                        </div>
                    </div>
                    <div class="Overview">
                        <h3 class="skills__d" style="color: #666666;padding-bottom: 10px !important;display: inline;" data-toggle="modal" data-target="#Overview" >{{ __('freelancer.Overview') }}
                            <br>
                            <small>@if(!empty($profile_data)){{ $profile_data->overview }}@endif</small>
                        </h3>
                    </div>
                    <div class="porfolio">
                        <h3 style="color: #666666;padding: 16px !important;" class="skills__d" >{{ __('freelancer.Porfolio') }}
                        </h3>
                        <?php if(!empty($all_portfolio))
                        {
                        foreach($all_portfolio as $portfolio)
                        {

                        ?>
                        <div  class="col-md-6 col-sm-6 col-lg-6 left-pad portfolio-image"  data-toggle="modal" data-target="#Porfolio_<?php echo $portfolio->portfolio_id?>">
                            <?php if(!empty($portfolio->thumb_image)){ ?>
                            <figure>
                                <img class="rounded" src="{{ asset('/')}}/{{$portfolio->thumb_image }}" style="height: 200px;margin-top: 16px;" alt="porfolio">
                                <figcaption> <h3><?php echo $portfolio->project_title; ?></h3></figcaption>
                            </figure>
                            <?php } ?>

                        </div>
                        <?php } } ?>
                        </form>
                       </div>
                </div>
                </form>
                <div class="col-md-4 col-sm-4 col-lg-4 left-bar">
                    <div class="Available">

                        <div class="col-md-12"> <span><?php echo (($percentage)?$percentage:0); ?>% profile Completed </span>

                            <div style="margin-top: 15px;" class="progress f-success">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo (($percentage)?$percentage:0); ?>" aria-valuemin="0" aria-valuemax="100" style="background-color: green;width: <?php echo (($percentage)?$percentage:0); ?>%;"> </div>
                            </div>

                        </div>
                        <h3  class="font-color font-weight">{{ __('freelancer.Availability') }}</h3>
                        <hr>
                        <ul class="Availablelity">
                            <li> @if(!empty($profile_data))
                                    @if(($profile_data->availability_type >=1) && empty($profile_data->not_available_text))
                                        <span class="font-weight" style="color: green;">{{ __('freelancer.Available') }}</span>
                                    @else
                                        <span class="font-weight" style="color: red;">{{ __('freelancer.NotAvailable') }}</span>
                                    @endif
                                @endif </li>
                            <li style="padding: 10px;"> @if(!empty($profile_data))
                                    @if($profile_data->availability_type ==1)
                                        More than 30 hrs/week
                                    @elseif($profile_data->availability_type ==2)
                                        Less than 30 hrs/week
                                    @elseif($profile_data->availability_type ==3)
                                        As Needed - Open to Offers
                                    @endif
                                @endif
                                @if(!empty($profile_data->not_available_text)){{ $profile_data->not_available_text }}@endif
                            </li>
                        </ul>
                        <hr>
                        <div class="Languages">
                            <h3 class="font-color font-weight"  >{{ __('freelancer.Languages') }}</h3>

                            <ul class="Availablelity">
                                @foreach($all_languages as $lang)
                                    <li style="padding: 10px;"><a href="javascript:;"><b>{{ $lang->lang_name }}:</b> {{ $lang->lang_skill }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <hr>
                        <div class="phone-number">
                            <h1  class="font-color font-weight">{{ __('freelancer.Verifications') }} </h1>
                            <ul style="padding: 10px;" class="Availablelity">
                                <li><a href=""><b>{{ __('freelancer.EmailAddress') }}</b><i class="fa fa-check" aria-hidden="true"></i>{{ __('freelancer.Verified') }} </a> </li>
                            </ul>
                        </div>
                        <hr>
                        <div class="phone-number">
                            <h1  class="font-color font-weight">Hourly Rate</h1>
                            <p style="padding: 10px;"><i class="fa fa-clock-o" aria-hidden="true"></i>{{Config::get('constants.constant.currency')}}
                                <?= (isset($profile_data->hourly_rate)?$profile_data->hourly_rate:'') ?>
                                /hr</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both;margin-bottom: 40px;">

        @include ('include/footer_cl')


