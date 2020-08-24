@include ('include/header_fr')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/select.css') }}">
<style>
    ul.messages li .message_wrapper {
    margin-left: 75px;
 }
    
    ul.messages li .message_date {
    float: left;
    text-align: left;
    padding-left: 10px;
    padding-right: 20px;
}
</style>

<!-- google web font css --><link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="col-md-12 col-sm-12 col-xs-12" style="float: none; margin-top: 40px;">


<div class="col-md-12 col-sm-12 col-xs-12">

    <div class="x_panel">

      <div class="x_title">
          <div class="row">
              <div class="col-md-3">
                  <h2 style="padding-bottom: 20px;" class="table-heading">{{ $user_data->name }} {{ $user_data->last_name }}</h2>
              </div>
              <div class="col-md-9">
                  <p class="font-color" style="float:right;padding-top: 10px;"> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo (isset($profile_data->city)?$profile_data->city:'').', '.(isset($profile_data->country)?$profile_data->country:'') ?> - <?php
                      date_default_timezone_set('Asia/Riyadh');
                      echo date('h:i:a') ?> local time</p>


              </div>

          </div>


        <div class="clearfix"></div>

      </div>
      
      

    <div class="freelancer_info">
      <div class="col-md-8 col-sm-8 col-lg-8">
        <div class="profile_pic m-t" style="background: none; display:block;border: none;padding-bottom: 22px;"> 
        <img class="rounded" style="border-radius: 50%;width: 100%;" src="<?php if(isset($profile_data->profile_image)){ echo asset($profile_data->profile_image); }else
		{ echo asset('images/profile-pic.png'); } ?>" alt="profile-pic" id="display_profile_image">
		  <form enctype="multipart/form-data">
          <input type="file" name="profile_image" id="profile_image" style="display: none;">
          <input type="hidden" id="profile_update_url" value="<?php echo url('/profileupdateImage/'); ?>">
          <a href="javascript:void(0);" class="upload_profile_image"><i style="color:#666666 !important;" class="fa fa-pencil-square-o edite" aria-hidden="true"></i></a> 
          </form>
          </div>
        <div class="freelancer_name">
          <h3 style="color:#666666 !important;padding-bottom: 20px;font-size: 24px;" class="skills__d" data-toggle="modal" data-target="#edite"> @if(!empty($profile_data->job_title))
                {{ $profile_data->job_title }} @else Add Job Information
            @endif <i class="fa fa-pencil-square-o edite" aria-hidden="true"></i>
          </h3>
          <div class="Job-title-content"> @include('user.job_title') </div>

        </div>
        <div class="skills"> @include('user.professional') </div>
        <div class="Overview"> @include('user.overview') </div>
        
        <div class="porfolio"> @include('user.portfolio')
          @include('user.edit_portfolio') </div>
        <div class="Education"> @include('user.education') </div>
      </div>
      </form>
      
      
      <div class="col-md-4 col-sm-4 col-lg-4 left-bar">
        <div class="Available">

          <div class="col-md-12"> <span><?php echo (($percentage)?$percentage:0); ?>% profile Completed </span>

          <div style="margin-top: 15px;" class="progress f-success">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo (($percentage)?$percentage:0); ?>" aria-valuemin="0" aria-valuemax="100" style="background-color: green;width: <?php echo (($percentage)?$percentage:0); ?>%;"> </div>
          </div>



                        </div>
                        
                        
              <!-- start skills -->
              <!-- <h2 class="font-color font-weight" style="margin-bottom: 10px;margin-top: 20px;">{{ __('freelancer.Skills') }}</h2>
              <ul class="list-unstyled user_data">
              	<?php
              	if(!empty($profetionl_skills))
              	{
              		$ct = 0;
              		foreach ($profetionl_skills as $skills) {
              			$ct++;
              			?>
              			<li>
		                  <p class="font-color"><?php echo $skills->text ?></p>
		                  <div class="progress progress_sm">
		                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo $ct*10; ?>"></div>
		                  </div>
		                </li>
              			<?php
              		}
              	}
              	?>

              </ul> -->
              <!-- end of skills -->
              
              
                        
            <h3   data-toggle="modal" data-target="#Available" class="font-color font-weight">{{ __('freelancer.Availability') }} <a href="javascript:;"><i class="fa fa-pencil-square-o edite font-color font-weight" aria-hidden="true"></i></a> </h3>
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
            {{--response time ?--}}
            
            
            <form method="POST" action="{{ url('/profileupdate') }}/{{ $user_data->user_id }}">
              {{ csrf_field() }}
              <div class="modal fade" id="Available" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="table-heading">{{ __('freelancer.ChangeAvailability') }}</h4>
                    </div>
                    <div class="modal-body">
                      <div class="forms">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <p style="line-height: 0.75cm;">{{ __('freelancer.Info') }}</p>
                          <!--<p><a href="">{{ __('freelancer.Search') }}How do we use this info</a></p>-->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="p">
                            <b style="margin-bottom: 30px;" class="font-weight">{{ __('freelancer.IAmCurrently') }}</b><br>
                          </div>
                          <ul class="nav nav-tabs">
                            <li <?php if(empty($profile_data->not_available_text)) { ?> class="active" <?php } ?>>
							<a class="avail_unavail" data-toggle="tab" href="#homes">{{ __('freelancer.Available') }}</a></li>
                            <li <?php if(!empty($profile_data->not_available_text)) { ?> class="active" <?php } ?>>
							<a class="avail_unavail" data-toggle="tab" href="#menu2">{{ __('freelancer.NotAvailable') }}</a></li>
                          </ul>
                          <div class="tab-content">
                            <div id="homes" class="tab-pane fade <?php if(empty($profile_data->not_available_text)) { ?> in active <?php } ?>">
                              <div class="form-group">
                                 <br>
                                <span>
                                  <input name="availability_type" class="menu1" value="1" type="radio"
        @if(!empty($profile_data))
        @if($profile_data->
                                  availability_type == '1')
                                  checked
                                  @endif
                                  @endif
                                  > 
                                 {{ __('freelancer.Option1') }}  </span>
                              </div>
                              <div class="form-group">
                                <input name="availability_type" value="2" class="menu1" type="radio"
        @if(!empty($profile_data))
        @if($profile_data->
                                availability_type == '2')
                                checked
                                @endif
                                @endif
                                >  
                               {{ __('freelancer.Option2') }}  </div>
                              <div class="form-group">
                                <input name="availability_type" class="menu1" value="3" type="radio"
        @if(!empty($profile_data))
        @if($profile_data->
                                availability_type == '3')
                                checked
                                @endif
                                @endif
                                > 
                              {{ __('freelancer.Option3') }}  </div>
                            </div>
                            <div id="menu2" class="tab-pane fade <?php if(!empty($profile_data->not_available_text)) { ?> in active <?php } ?>">
                              <div class="form-group">
                                  <br>
                                <p>{{ __('freelancer.NotAvailableMSG') }}</p>
                                <input name="not_available_text" class="datepicker homes available_input" value="@if(!empty($profile_data)){{ $profile_data->not_available_text }}@endif" data-provide="datepicker">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <a href="" class="btn btn-default" data-dismiss="modal">{{ __('freelancer.Cancel') }}</a>
                        <button type="submit" class="btn btn-default btn-color">{{ __('freelancer.Update') }}</button>
                         </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </ul>
          
            <hr>
            
          <div class="Languages"> @include('user.language') </div>
          
          
            <hr>
          <div class="phone-number">
            <h1  class="font-color font-weight">{{ __('freelancer.Verifications') }} <!--<a href=""><i class="fa fa-pencil-square-o edite" aria-hidden="true"></i></a>--></h1>
            <ul style="padding: 10px;" class="Availablelity">
              <li><a href=""><b>{{ __('freelancer.EmailAddress') }}</b><i class="fa fa-check" aria-hidden="true"></i>{{ __('freelancer.Verified') }} </a> </li>
            </ul>
          </div>
            <hr>
            <div class="phone-number">
                <h1  class="font-color font-weight">Hourly Rate</h1>
                <p style="padding: 10px;"><i class="fa fa-clock-o" aria-hidden="true"></i> {{Config::get('constants.constant.currency')}}
                <?= (isset($profile_data->hourly_rate)?$profile_data->hourly_rate:'') ?>
                /hr</p>
            </div>
        </div>
      </div>
      
      
      
    </div>
    
    
<div class="" role="tabpanel" data-example-id="togglable-tabs" style="
    float: left;
    width: 100%;
    padding-bottom: 100px;
    padding-top: 30px;">
    <ul style="background: none;border-bottom:none !important;" id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
        <li role="presentation" class="active"><a class="table-header-colums-title" href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">{{ __('freelancer.RecentActivity') }}</a> </li>
        <li role="presentation" class=""><a class="table-header-colums-title" href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">{{ __('freelancer.ProjectsWorkedOn') }}</a> </li>
        {{--<li role="presentation" class=""><a class="table-header-colums-title" href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">{{ __('freelancer.Profile') }}</a> </li>--}}
    </ul>
    <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

            <!-- start recent activity -->
            <ul class="messages">
                <?php if(!empty($jobs))
                        {
                          $jbct = 1;
                          foreach ($jobs as $job) {

                          ?>
                <li> <img src="<?php echo asset('/fr_assets/') ?>/images/user.png" class="avatar" alt="Avatar">
                    <div class="message_date">
                        <h3 class="date text-info"><?php echo date('d', strtotime($job->created_at)); ?></h3>
                        <p class="month table-header-title"><?php echo date('M', strtotime($job->created_at)); ?></p>
                    </div>
                    <div class="message_wrapper">
                        <h4 class="heading table-header-colums-title"><?php echo $job->job_title; ?></h4>
                        <blockquote class="message table-header-title"><?php echo $job->name; ?>.</blockquote>
                        <br />

                    </div>
                </li>
                <?php
                        $jbct++;
                        } } ?>
            </ul>
            <!-- end recent activity -->

        </div>
        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

            <!-- start user projects -->
            <table class="data table table-striped no-margin">
                <thead class="table-header-colums-title">
                <tr>
                    <th>#</th>
                    <th>{{ __('freelancer.ProjectName') }}</th>
                    <th>{{ __('freelancer.ClientCompany') }}</th>
                    <th class="hidden-phone">{{ __('freelancer.HoursSpent') }}</th>
                    <th>{{ __('freelancer.Contribution') }}</th>
                </tr>
                </thead>
                <tbody class="table-header-title">
                <?php if(!empty($jobs))
                        {
                          $jbct = 1;
                          foreach ($jobs as $job) {

                          ?>
                <tr>
                    <td><?php echo $jbct; ?></td>
                    <td><?php echo $job->job_title; ?></td>
                    <td><?php echo $job->name; ?></td>
                    <td class="hidden-phone"><?php echo $job->job_duration; ?></td>
                    <td class="vertical-align-mid"><div class="progress">
                        <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                    </div></td>
                </tr>
                <?php
                        $jbct++;
                        } } ?>

            </table>
            <!-- end user projects -->

        </div>
        {{--<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">--}}
        {{--<p class="table-header-title">{{ __('freelancer.ProfileDescription') }}</p>--}}
        {{--</div>--}}
    </div>
</div>
    
</div>
</div>
<div style="clear: both;margin-bottom: 40px;">

 @include ('include/footer_fr')

 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script src="http://cdn.jsdelivr.net/select2/3.4.8/select2.js"></script> 

 <script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );
  $( function() {
    $( "#from_date" ).datepicker({ 
                dateFormat: 'yy-mm-dd',
                maxDate: new Date(),
                onSelect: function (dateText, inst) {
                    $("#to_date").datepicker({ minDate: new Date(dateText)})
                }
     });
  } );
    $( function() { 
    $( "#to_date" ).datepicker({ 
                      dateFormat: 'yy-mm-dd',
                      maxDate: new Date(),
                      onSelect: function (dateText, inst) {
                          $("#from_date").datepicker({ maxDate: new Date(dateText)})
                      }

     });
  } );
  $( function() {
    var availableTags = [
      <?php $skils = \DB::table('profetionls')->select('name')->get()->toArray();
      foreach ($skils as $skil) {
        echo '"'.$skil->name.'",';
      }
     ?>
           " "
    ];
    $( "#tags" ).autocomplete({
      source: availableTags,
      change: function( event, ui ) {
       $('.skil_contaner').append('<div class="skil_box"><input type="hidden" name="profetional_skills[]" value="'+event.target.value+'">'+event.target.value+'<a href="javascript:void(0);" class="remove_skil">X</a></div>');
        $('#tags').val('');
      },
      select: function( event, ui ) {
        $('.skil_contaner').append('<div class="skil_box"><input type="hidden" name="profetional_skills[]" value="'+event.toElement.innerText+'">'+event.toElement.innerText+'<a href="javascript:void(0);" class="remove_skil">X</a></div>');
        $('#tags').val('');
      }
    });
    $(document).on('click', '.avail_unavail', function(event) {
      var href_cls = $(this).attr('href');
      $('.tab-pane.fade').removeClass('active').removeClass('in');

      
      if(href_cls=='#homes')
      {
        $('.homes').val('');
      }
      if (href_cls=='#menu2') {

        $('.menu1').prop('checked',false);
      }
      $(href_cls).addClass('active').addClass('in');
    });
  } );
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 150) {
        $(".navbar").addClass("navbar-fixed-top");
    } else {
        $(".navbar").removeClass("navbar-fixed-top");
    }
});

/*
$(window).scroll(function() { 
$(".navbar").addClass("navbar-fixed-top");
alert('rrrr');   
    var scroll = $(window).scrollTop();    
    if (scroll <= 500) {
        $(".navbar").addClass("navbar-fixed-top");
  //$(".navbar").removeClass("navbar-fixed-top"); 
    }

}*/
</script> 
<script>
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 150) {
        $(".navbar").addClass("navbar-fixed-top");
    } else {
        $(".navbar").removeClass("navbar-fixed-top");
    }
});

/*
$(window).scroll(function() { 
$(".navbar").addClass("navbar-fixed-top");
alert('rrrr');   
    var scroll = $(window).scrollTop();    
    if (scroll <= 500) {
        $(".navbar").addClass("navbar-fixed-top");
  //$(".navbar").removeClass("navbar-fixed-top"); 
    }

}*/

  $('#placeSelect').select2({
    width: '100%',
    allowClear: true,
    multiple: true,
    maximumSelectionSize: 20,
    placeholder: "Click here and start typing to search.",
    data: /*[
            { id: 1, text: "HTML"     },
            { id: 2, text: "CSS"    },
            { id: 3, text: "JavaScript" },
            { id: 4, text: "Responsive"   }
          ] */
          <?php echo json_encode($profetionl_skills); ?>   
});


  
/*$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});*/
</script>