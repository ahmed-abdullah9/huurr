<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Freelancer') }}</title>
<!--

Template 2080 Minimax

http://www.tooplate.com/view/2080-minimax

-->
<!-- stylesheet css -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/nivo-lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('css/nivo_themes/default/default.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/select.css') }}">
<!-- google web font css --><link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('web-fonts/Helvetica/styles.css') }}">
<link rel="stylesheet" href="{{ asset('web-fonts/BradleyHandITC/styles.css') }}">
<link rel="stylesheet" href="{{ asset('web-fonts/Krungthep/stylesheet.css') }}">
</head>
<body data-spy="scroll" data-target=".navbar-collapse">

<!-- navigation -->
<header>
  <div class="top-bar">
    <div class="container">
      <?php $option = \DB::table('admin_option')->select('*')->first() ?>
      <div class=" col-md-7 col-sm-7 col-lg-7 phone"> <a href="mailto:<?php echo ((isset($option->email))?$option->email:'') ?>"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo ((isset($option->email))?$option->email:'') ?></a> <a href="tell:<?php echo ((isset($option->phone))?$option->phone:'') ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo ((isset($option->phone))?$option->phone:'') ?></a> </div>
      <div class=" col-md-2 col-sm-2 col-lg-2 text-right">
        <div class="translatore">
          <select>
            <option> <img src="{{ asset('images/flag.jpg') }}"> English
            <option>
          </select>
        </div>
      </div>
      <div class=" col-md-3 col-sm-3 col-lg-3 text-right">
        <ul class="social">
          <li><a href="<?php echo ((isset($option->facebook))?$option->facebook:'') ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="<?php echo ((isset($option->twitter))?$option->twitter:'') ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="<?php echo ((isset($option->google))?$option->google:'') ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
          <li><a href="<?php echo ((isset($option->linkedin))?$option->linkedin:'') ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
  </div>
  @include('layouts/header_navbar')
</header>
@yield('content') 

<!-- footer section -->
<footer>
  <div class="container">
       
    <div class="row">
      <div class="container">
        <div class="col-md-8 col-sm-8 lg-8 translatored">
          <div class="translatore Footer-localeSelector-btn"> English </div>
        </div>
        <div class="col-md-4 col-sm-4 lg-4 text-right">
          <ul class="social">
            <li><a href="<?php echo ((isset($option->facebook))?$option->facebook:'') ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="<?php echo ((isset($option->twitter))?$option->twitter:'') ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="<?php echo ((isset($option->google))?$option->google:'') ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
          <li><a href="<?php echo ((isset($option->linkedin))?$option->linkedin:'') ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="container">
        <ul class="last-contry">
          <li><a href="#">South Arabia</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<!-- divider section -->
<div class="container">
  <div class="row">
    <div class="col-md-1 col-sm-1"></div>
    <div class="col-md-10 col-sm-10">
      <hr>
    </div>
    <div class="col-md-1 col-sm-1"></div>
  </div>
</div>

<!-- scrolltop section --> 
<a href="#top" class="go-top"><i class="fa fa-angle-up"></i></a> 

<!-- javascript js --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script src="{{ asset('js/jquery.js') }}"></script> 
<script src="{{ asset('js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('js/nivo-lightbox.min.js') }}"></script> 
<script src="{{ asset('js/smoothscroll.js') }}"></script> 
<script src="{{ asset('js/jquery.nav.js') }}"></script> 
<script src="{{ asset('js/isotope.js') }}"></script> 
<script src="{{ asset('js/imagesloaded.min.js') }}"></script> 
<script src="{{ asset('js/custom.js') }}"></script> 
<script src="http://cdn.jsdelivr.net/select2/3.4.8/select2.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/script.js') }}"></script> 

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

	


	

    
</script> 
</body>
</html>