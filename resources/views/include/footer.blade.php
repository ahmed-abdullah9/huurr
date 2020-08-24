<?php $option = \DB::table('admin_option')->select('*')->first() ?>
  <!-- Footer -->
  <footer class="main-footer">
    <svg preserveAspectRatio="none" viewBox="0 0 100 102" height="100" width="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <path d="M0 0 L50 100 L100 0 Z" fill="#fff" stroke="#fff"></path>
    </svg>
            <div class="container">
                <div class="row mt-100 mb-50 footer-widgets">

                    <!-- Start Contact Widget -->
                    <div class="col-md-6 col-xs-12">
                        <div class="footer-widget contact-widget">
                            <img src="<?php echo asset('/new-design/') ?>/assets/img/footerlogo.png" class="logo-footer img-responsive" alt="Footer Logo" />

                            <ul class="social-icons">
                                <li>
                                    <a target="_blank" class="facebook" href="<?php echo ((isset($option->facebook) && $option->facebook!='')?$option->facebook:'') ?>"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" class="twitter" href="<?php echo ((isset($option->twitter) && $option->twitter!='')?$option->twitter:'') ?>"><i class="fa fa-twitter"></i></a>
                                </li>
                               <!-- <li>
                                    <a class="google" href="<?php echo ((isset($option->google) && $option->google!='')?$option->google:'') ?>"><i class="fa fa-google-plus"></i></a>
                                </li> -->
                                <li>
                                    <a target="_blank" class="linkdin" href="<?php echo ((isset($option->linkedin) && $option->linkedin!='')?$option->linkedin:'') ?>"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" class="linkdin" href="<?php echo ((isset($option->instagram) && $option->instagram!='')?$option->instagram:'') ?>"><i class="fa fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .col-md-3 -->
                    <!-- End Contact Widget -->

                    <!-- Start Twitter Widget -->
                    <div class="col-md-3 col-xs-12">
                        <div class="footer-widget twitter-widget">
                            {{--<h4>{{__('homepage.twitter')}}</h4>--}}
                            {{__('homepage.twitter_email')}} <?php echo ((isset($option->email))?$option->email:'') ?> <br>
                            {{__('homepage.twitter_phone')}} <?php echo ((isset($option->phone))?$option->phone:'') ?>
                        </div>
                    </div><!-- .col-md-3 -->
                    <!-- End Twitter Widget -->

                    <!-- Start Flickr Widget -->
                    <div class="col-md-3 col-xs-12">
                        <div class="footer-widget company-links">
              <ul class="footer-links">
                <li><a href="#about">{{__('homepage.about')}}</a></li>
                <li><a href="#skills">{{__('homepage.skills')}}</a></li>

                <li><a href="#pricing">{{__('homepage.why_huurr')}}</a></li>
                <li><a href="{{url('/team')}}">{{__('homepage.team')}}</a></li>
              </ul>
                        </div>
                    </div><!-- .col-md-3 -->
                    <!-- End Flickr Widget -->
                </div><!-- .row -->

                <!-- Start Copyright -->
                <div class="copyright-section">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy; HUURR 2020</p>
                        </div><!-- .col-md-6 -->
                    </div><!-- .row -->
                </div>
                <!-- End Copyright -->
            </div>
  </footer>

  <!-- SCRIPTS -->
  {{--<script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/jquery-2.2.3.min.js"></script>--}}
<script type="text/javascript" src="<?php echo asset('/cl_assets/') ?>/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/animated-headline.js"></script>
  <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/menu.js"></script>
  <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/modernizr.js"></script>
  <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/isotope.pkgd.min.js"></script>
  <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/jquery.flexslider-min.js"></script>
  <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/jquery.animsition.min.js"></script>
 <!-- <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/init.js"></script> -->
  <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/main.js"></script>
  <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/smooth-scroll.js"></script>
  <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/numscroller.js"></script>
  <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/wow.min.js"></script>
  <script type="text/javascript" src="<?php echo asset('/new-design/') ?>/assets/js/owl.carousel.min.js"></script>

<script type="text/javascript" src="<?php echo asset('/cl_assets/') ?>/auto/scripts/jquery.mockjax.js"></script>
<script type="text/javascript" src="<?php echo asset('/cl_assets/') ?>/auto/src/jquery.autocomplete.js"></script>
<!--<script type="text/javascript" src="<?php echo asset('/cl_assets/') ?>/auto/scripts/demo.js"></script>-->

  <script type="text/javascript">
      $(function () {
          'use strict';
          // Initialize ajax autocomplete:
          $('#autocomplete-ajax').autocomplete({
              serviceUrl: '<?php echo url('/get_skills?lang=').Lang::locale() ; ?>',
              onSelect: function(suggestion) {
                  $("#autocomplete-ajax-id").val(suggestion.data);
                 $('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
              },
              onHint: function (hint) {
                  $('#autocomplete-ajax-x').val(hint);
              },
              onInvalidateSelection: function() {
                  $('#selction-ajax').html('You selected: none');
              }
          });
          $("#get-started-button").click(function(e){
              e.preventDefault();
              var FreelancerSkill = $("#autocomplete-ajax-id").val();
              if(FreelancerSkill !='')
              {
                  //$("#click-on-get-started").click();
                  $('#myModal').modal('show');
              }else {
                  return false;
              }
              //$('#myModal').modal('toggle');
              //$('#myModal').modal('show');
             // $('#myModal').modal('hide');
          });
          $("#find-freelancer-next").click(function(e){
              e.preventDefault();
              var selectedValue = $("input[name='time_availbility']:checked").val();
              if(selectedValue != '' && selectedValue != undefined)
              {
                  var FreelancerSkill = $("#autocomplete-ajax-id").val();
                  var post_data = "profetional_skills="+FreelancerSkill+"&availability_type="+selectedValue;
                  $.post("<?php echo url('get_started/freelancer'); ?>",post_data, function(data, status){
                        window.location = "<?php  echo url('find/freelancer');  ?>";
                  });
              }else
              {
                  return false;
              }


          });
      });
    $(window).load(function() {
        var prev='', next='';
        if(Lang=='en'){
               prev="Previous";
               next="Next";
        }
        else{
            prev="{{__('homepage.prev')}}";
            next="{{__('homepage.next')}}";
        }
      new WOW().init();

      // initialise flexslider
      $('.flexslider').flexslider({
        animation: "fade",
        directionNav: true,
        controlNav: false,
        keyboardNav: true,
        slideToStart: 0,
        animationLoop: true,
        pauseOnHover: false,
        slideshowSpeed: 10000,
          prevText:prev,
          nextText:next,
      });

      smoothScroll.init();

      // initialize isotope
      var $container = $('.portfolio_container');
      $container.isotope({
        filter: '.PHOTOGRAPHY',
      });

      $('.portfolio_filter a').click(function(){
        $('.portfolio_filter .active').removeClass('active');
        $(this).addClass('active');

        var selector = $(this).attr('data-filter');
        $container.isotope({
          filter: selector,
          animationOptions: {
            duration: 500,
            animationEngine : "jquery"
          }
        });
        return false;
      });
    });
  </script>
</body>
</html>
