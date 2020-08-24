@include ('include/header_cl')
<link rel="stylesheet" href="{{ asset('css/select.css') }}">
<!-- google web font css --><link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">

    <div class="heading">
      <h3>My Profile</h3>
    </div>
    <div class="freelancer_info">
      <div class="col-md-8 col-sm-8 col-lg-8">
        <div class="profile_pic"> <img src="<?php if(isset($profile_data->profile_image)){ echo asset($profile_data->profile_image); }else { echo asset('images/profile-pic.png'); } ?>" alt="profile-pic" id="display_profile_image">
          <input type="file" name="profile_image" id="profile_image" style="display: none;">
          <input type="hidden" id="profile_update_url" value="<?php echo url('/profileupdateImage/'); ?>">
          <a href="javascript:void(0);" class="upload_profile_image">Change Image</a> </div>
        <div class="freelancer_name">
          <h2>{{ $user_data->name }} {{ $user_data->last_name }}</h2>
          <h4 data-toggle="modal" data-target="#edite"> @if(!empty($profile_data))
            {{ $profile_data->job_title }} 
            @endif <i class="fa fa-pencil-square-o edite" aria-hidden="true"></i> </h4>
          
          <!-- Trigger the modal with a button --> 
          <!-- Modal -->
          <div class="Job-title-content"> @include('user.job_title') </div>
          <p> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo (isset($profile_data->city)?$profile_data->city:'').', '.(isset($profile_data->country)?$profile_data->country:'') ?> - <?php echo date('h:i:a') ?> local time</p>
          <p><i class="fa fa-clock-o" aria-hidden="true"></i> $
            <?= (isset($profile_data->hourly_rate)?$profile_data->hourly_rate:'') ?>
            /hr</p>
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
          <h3   data-toggle="modal" data-target="#Available">Availability <a href="javascript:;"><i class="fa fa-pencil-square-o edite" aria-hidden="true"></i></a> </h3>
          <div class="col-md-12"> <span><?php echo (($percentage)?$percentage:0); ?>% profile Completed </span>
                          
          <div class="progress f-success">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo (($percentage)?$percentage:0); ?>" aria-valuemin="0" aria-valuemax="100" style="background-color: green;width: <?php echo (($percentage)?$percentage:0); ?>%;"> </div>
                          </div>

                        </div>
          <ul class="Availablelity">
            <li> @if(!empty($profile_data))
              @if(($profile_data->availability_type >=1) && empty($profile_data->not_available_text))
              <span style="color: green;">Available</span>
              @else
              <span style="color: red;">Not Available</span>
              @endif
              @endif </li>
            <li> @if(!empty($profile_data))
              @if($profile_data->availability_type ==1)
              More than 30 hrs/week
              @elseif($profile_data->availability_type ==2)
              Less than 30 hrs/week
              @elseif($profile_data->availability_type ==3)
              As Needed - Open to Offers
              @endif
              @endif
              @if(!empty($profile_data->not_available_text)){{ $profile_data->not_available_text }}@endif </li>
            response time ?
            <form method="POST" action="{{ url('/profileupdate') }}/{{ $user_data->user_id }}">
              {{ csrf_field() }}
              <div class="modal fade" id="Available" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Change Availability</h4>
                    </div>
                    <div class="modal-body">
                      <div class="forms">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                          <p><a href="">How do we use this info</a></p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <p><b>I am currently</b></p>
                          <ul class="nav nav-tabs">
                            <li <?php if(empty($profile_data->not_available_text)) { ?> class="active" <?php } ?>><a class="avail_unavail" data-toggle="tab" href="#homes">Available</a></li>
                            <li <?php if(!empty($profile_data->not_available_text)) { ?> class="active" <?php } ?>><a class="avail_unavail" data-toggle="tab" href="#menu1">Not Available</a></li>
                          </ul>
                          <div class="tab-content">
                            <div id="homes" class="tab-pane fade <?php if(empty($profile_data->not_available_text)) { ?> in active <?php } ?>">
                              <p>
                                <label>
                                  <input name="availability_type" class="menu1" value="1" type="radio"
        @if(!empty($profile_data))
        @if($profile_data->
                                  availability_type == '1')
                                  checked
                                  @endif
                                  @endif
                                  > 
                                  More than 30 hrs/week </label>
                              </p>
                              <p>
                                <input name="availability_type" value="2" class="menu1" type="radio"
        @if(!empty($profile_data))
        @if($profile_data->
                                availability_type == '2')
                                checked
                                @endif
                                @endif
                                >  
                                Less than 30 hrs/week </p>
                              <p>
                                <input name="availability_type" class="menu1" value="3" type="radio"
        @if(!empty($profile_data))
        @if($profile_data->
                                availability_type == '3')
                                checked
                                @endif
                                @endif
                                > 
                                As Needed - Open to Offers</p>
                            </div>
                            <div id="menu1" class="tab-pane fade <?php if(!empty($profile_data->not_available_text)) { ?> in active <?php } ?>">
                              <p>
                                <label>When do you expect to be ready for new work?</label>
                                <input name="not_available_text" class="datepicker homes" value="@if(!empty($profile_data)){{ $profile_data->not_available_text }}@endif" data-provide="datepicker">
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Update</button>
                        <a href="" class="btn-btn-default" data-dismiss="modal">Cancel</a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </ul>
          <div class="Languages"> @include('user.language') </div>
          <div class="phone-number">
            <h3>Verifications <!--<a href=""><i class="fa fa-pencil-square-o edite" aria-hidden="true"></i></a>--></h3>
            <ul class="Availablelity">
              <li><a href=""><b>Email Address:</b><i class="fa fa-check" aria-hidden="true"></i> Verified</a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div><div style="clear: both;">
@include ('include/footer_cl')
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
     
      if(href_cls=='#homes')
      {
        $('.homes').val('');
      }
      if (href_cls=='#menu1') {
        $('.menu1').prop('checked',false);
      }
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