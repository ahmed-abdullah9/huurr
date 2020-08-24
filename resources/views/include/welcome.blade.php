@include( 'include/header' )
 <style>
	 .flex-direction-nav a{display:flex !important;
	 overflow: visible !important;
		 font-size: 18px !important;
	 }


 </style>
 
 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!-- box-intro -->
<?php $option = \DB::table('admin_option')->select('*')->first() ?>
<section class="box-intro bg-film" id="home_bg" style="background-image:url('<?php echo((isset($option->image) && $option->image!='') ? 'public/images/qouts/background_images/'.$option->image : 'new-design/assets/img/header_2.jpg') ?>');z-index:1!important;">
	<div class="table-cell">

		<h3 class="box-headline letters rotate-2">
                    <span class="box-words-wrapper">


                    </span>
                </h3>

		<div class="col-md-5 header_form">
			<h2>{{__('homepage.hire_freelancers')}}<br>{{__('homepage.make_things')}}</h2>
			<p style="padding: 5%;">{{__('homepage.grow_business')}}</p>
			<div class="row" >
				<div class="col-md-8 col-xs-12 pull-b-btn pull-b-field"><input style="padding: 4%;" id="autocomplete-ajax" placeholder="{{__('homepage.type_work')}}" type="search">
				</div><br>
				<input type="hidden" readonly id="autocomplete-ajax-id">
				<div  class="col-md-6  text-left"><button  class="btn started pull-b-btn pull-b-field" id="get-started-button" type="button">{{__('homepage.get_start')}}</button>
				</div>  <!-- data-toggle="modal" data-target="#myModal" -->

			</div>
		</div>
		<div class="col-md-6 freelancer_img hidden-xs">
		   <!-- <img class="img-responsive" src="<?php echo asset('/new-design/') ?>/assets/img/freelancer_work.png"> -->
		</div>
	</div>
</section>
<!-- end box-intro -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->

		<!-- What do you want done?-->
		<!--<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h1 class="modal-title">What do you want done?</h1>
				<p>We’ll help you start your job post so you can get quotes within hours after sign up. It’s free to post and get quotes from freelancers! </p>
			</div>
			<div class="modal-body">
				<div class="col-md-6">
					<div class="radio">
						<label><input type="radio" name="optradio"> Web, Mobile & Software Dev </label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Data Science & Analytics</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Design & Creative</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Translation</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio" >Admin Support</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Sales & Marketing</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="radio">
						<label><input type="radio" name="optradio"> IT & Networking </label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Engineering & Architecture</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Writing</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Legal</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio" >Customer Service</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio"> Accounting & Consulting</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Next</button>
			</div>
		</div> -->

		<!-- Category-->
		<!-- <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h1 class="modal-title">Category</h1>
				<p>Within Customer Service, what type of work do you need? </p>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<div class="radio">
						<label><input type="radio" name="optradio"> Customer Service </label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Other - Customer Service</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio"> Technical Support</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" ng-click="vm.goBack()">back</button> <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Next</button>
			</div>
		</div> -->

		<!-- Skills-->
	<!--	<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h1 class="modal-title">Skills</h1>
				<p>Within Other - Customer Service, what skills are needed to complete this project?</p>
			</div>
			<div class="modal-body">
				<div class="col-md-6">
					<div class="checkbox">
						<label><input type="checkbox" value="">Customer Service</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="">Customer Support</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="">Telephone Handling</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="">Phone Support</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="">Internet Research</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="checkbox">
						<label><input type="checkbox" value="">Data Entry</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="">Email Handling</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="">Virtual Assistant</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="">Administrative Support</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value=""> Microsoft Excel</label>
					</div>
				</div>
				<div class="col-md-12">
				    <input type="text" class="form-control" placeholder="Don't see the skill needed? Type it here.">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" ng-click="vm.goBack()">back</button><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div> -->
		
		<!-- Project duration-->
	<!--	<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h1 class="modal-title">Project duration</h1>
				<p>How long do you expect this project to last?</p>
			</div>
			<div class="modal-body">
			    <div class="col-md-12">
					<div class="radio">
						<label><input type="radio" name="optradio"> More than 6 months</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">3 to 6 months</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">1 to 3 months</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Less than 1 month</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Less than 1 week</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">I'll decide later</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" ng-click="vm.goBack()">back</button><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div> -->
		
		<!-- Time commitment-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h1 class="modal-title">Time commitment</h1>
				<p>What time commitment is needed for this project?</p>
			</div>
			<div class="modal-body">
			    <div class="col-md-12">
					<div class="radio">
						<label><input type="radio" value="1" class="time_availbility" name="time_availbility"> More than 30 hrs/week</label>
					</div>
					<div class="radio">
						<label><input type="radio" value="2" class="time_availbility"  name="time_availbility">Less than 30 hrs/week</label>
					</div>
					<div class="radio">
						<label><input type="radio" value="3" class="time_availbility"  name="time_availbility">I'll decide later</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<!-- data-dismiss="modal"<button type="button" class="btn btn-default pull-left" ng-click="vm.goBack()">back</button> --> <button type="button" style="background-color: #C33; color: white;" id="find-freelancer-next" class="btn started">Next</button>
			</div>
		</div>
		


	</div>
</div>
<!-- Experience -->
<!-- <div id="myModal2" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h1 class="modal-title">Experience</h1>
				<p>What is your desired experience level?</p>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<div class="radio">
						<label><input type="radio" name="optradio">Entry level - Looking for lowest rates</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Intermediate - A mix of experience and value</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio">Expert - Willing to pay the highest rates for the most experience</label>
					</div>
					<div class="radio">
						<label><input type="radio" name="optradio"> I'll decide later</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" ng-click="vm.goBack()">back</button><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>   -->
<!-- HISTORY OF AGENCY -->
<section id="about" class="about mt-150 mb-50">
	<div class="container">
		<div class="row center">
			<div class="col-md-8 col-md-offset-2">
				<img src="<?php echo asset('/new-design/') ?>/assets/img/logo.png" alt="" width="190" height="133">
				<div class="km-space"></div>
				<h5 class="lead">{{ __('homepage.aboutHuurr') }}</h5>
			</div>
		</div>
		<!-- description text -->
	</div>
</section>

<!-- FACTS  -->
<div id="facts" class="facts mt-100 mbr-box mbr-section mbr-section--relative">
	<div class="container">
		<div class="row text-center">
			<div class="col-xs-12 col-lg-3 col-md-3">
				<div class="count-item">
					<i class="lnr lnr-clock"></i>
					<div class="count-name-intro">{{ __('homepage.Hours') }}</div>
				</div>
			</div>
			<div class="col-xs-12  col-lg-3 col-md-3">
				<div class="count-item">
					<i class="lnr lnr-rocket"></i>
					<div class="count-name-intro">{{ __('homepage.Projects') }} ({{ $jobs }})</div>
				</div>
			</div>
			<div class="col-xs-12  col-lg-3 col-md-3">
				<div class="count-item">
					<i class="lnr lnr-users"></i>
					<div class="count-name-intro">{{ __('homepage.Client') }} ({{ $client }})</div>
				</div>
			</div>
			<div class="col-xs-12 col-lg-3 col-md-3">
				<div class="count-item">
					<i class="lnr lnr-user"></i>
					<div class="count-name-intro">{{ __('homepage.Freelancer') }} ({{ $freelancer }})</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- TEAM -->
<section id="team" class="team mbr-box mbr-section mbr-section--relative">
	<svg preserveAspectRatio="none" viewBox="0 0 100 102" height="100" width="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">
		<path d="M0 0 L50 100 L100 0 Z" fill="#c33" stroke="#c33"></path>
	</svg>
	<div id="skills" class="container">
		<div class="col-md-8 col-md-offset-2 col-sm-12">
			<div class="row center mb-100">
				<div class="section-title-parralax">
					<div class="process-numbers">01</div>
					<h2>{{ __('homepage.skill') }}</h2>
					<p class="module-subtitle">{{ __('homepage.skillDescription') }}
					</p>
				</div>
			</div>
		</div>

		<div class="row center features" style="padding-bottom:20px;">
			@foreach($main_skills as $m_s)
				<div class="feature-item box-featur">
					<div class="col-md-3 col-sm-6">
						<h4>
							@if(Lang::locale()=='en')
								{{ $m_s->freelancer_skill }}</h4>
						@else
						{{ $m_s->ar_freelancer_skill }}</h4>
						@endif
						@foreach($skills as $s)
							@if($s->parent_id==$m_s->id)
								<h6 class="item-style">   <a class="item-style" href="{{url('find/freelancer?find=')}}{{ urlencode($s->freelancer_skill) }}">
										@if(Lang::locale()=='en')
											{{ $s->freelancer_skill }}
										@else
											{{ $s->ar_freelancer_skill }}
										@endif
									</a></h6>
							@endif
						@endforeach
					</div>
				</div>
		@endforeach

		<!-- End features-item -->

			<!-- End features-item -->
		</div>
		<div style="padding-left:120px;">
			<a href="<?php echo url('/MoreSkills') ?>" class="default-btn"> {{ __('homepage.SeeMore') }}<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
		</div>
	</div>
</section>
	<!-- SERVICES PARALAX -->
	<section id="services" class="services mbr-box mbr-section mbr-section--relative mbr-section--fixed-size mbr-section--full-height mbr-section--bg-adapted mbr-parallax-background" style="background-image: url(<?php echo asset('/new-design/') ?>/assets/img/services.jpg);">
		<div class="section-overlay"></div>
		<div class="container">
			<div class="row center">
				<div class="col-md-8 col-md-offset-2 col-sm-12">
					<div class="section-title-parralax">
						<br/>
						<br/>
						<div class="process-numbers">02</div>
						<h2>{{ __('homepage.HOWitWORKS') }}</h2>

					</div>
				</div>
			</div>

			<div class="row text-center">
				<div class="col-xs-12 col-lg-3 col-md-3">
					<div class="count-item">
						<img src="<?php echo asset('/new-design/') ?>/assets/img/find.png" width="70" height="60"/>
						<div class="count-name-intro">
							<h6>{{ __('homepage.POST') }}</h6>
						</div>
					</div>
				</div>
				<div class="col-xs-12  col-lg-3 col-md-3">
					<div class="count-item">
						<img src="<?php echo asset('/new-design/') ?>/assets/img/hire.png" width="70" height="60"/>
						<div class="count-name-intro">
							<h6>{{ __('homepage.HIRE') }}</h6>
						</div>
					</div>
				</div>
				<div class="col-xs-12  col-lg-3 col-md-3">
					<div class="count-item">
						<img src="<?php echo asset('/new-design/') ?>/assets/img/work.png" width="70" height="60"/>
						<div class="count-name-intro">
							<h6>{{ __('homepage.WORK') }}</h6>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-lg-3 col-md-3">
					<div class="count-item">
						<img src="<?php echo asset('/new-design/') ?>/assets/img/pay.png" width="70" height="60"/>
						<div class="count-name-intro">
							<h6>{{ __('homepage.PAY') }}</h6>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

	<!-- PORTFOLIO -->
	<section class="portfolio">
		<div class="top-right-separator hidden-xs"></div>
		<div class="container">
			<div class="col-md-8 col-md-offset-2 col-sm-12">
				<div class="row center">
					<div class="section-title mb-100">
						<div class="process-numbers">03</div>
						<h2>{{ __('homepage.PORTFOLIO') }}</h2>
						<p class="module-subtitle">{{ __('homepage.portfolioDescription') }}</p>
					</div>
				</div>
			</div>
			<!-- categories  -->
			<div class="col-md-3">
				<div class="row categories-grid">
					<nav class="categories">
						<ul class="portfolio_filter">
							<li><a href="" class="active" data-filter="*">{{ __('homepage.all') }}</a>
							</li>
							<li><a href="" data-filter=".PHOTOGRAPHY">{{ __('homepage.PHOTOGRAPHY') }}</a>
							</li>
							<li><a href="" data-filter=".WEBDESIGN">{{ __('homepage.web') }}</a>
							</li>
							<li><a href="" data-filter=".LOGO">{{ __('homepage.logo') }}</a>
							</li>
							<li><a href="" data-filter=".GRAPHICS">{{ __('homepage.graphics') }}</a>
							</li>
							<li><a href="" data-filter=".ADVERTISING">{{ __('homepage.ads') }}</a>
							</li>

						</ul>
					</nav>
				</div>
			</div>

			<!-- all works -->
			<div class="col-md-9">
				<div class="row portfolio_container potfolio-small">
					<!-- single work -->

					<!-- end single work -->

					<!-- single work -->
					@foreach($portfolios as $portfolio)
					<div class="col-md-4 col-xs-12 fashion port-rtl mbl-skill {{$portfolio->skill}}">
						<a href="{{$portfolio->profile_link}}" class="portfolio_item work-grid">
                              <img src="{{asset('public/portfolio/small')}}/{{$portfolio->image}}" alt="image">
                              <div class="portfolio_item_hover">
                                  <div class="item_info">
                                      <span>
										  @if(Lang::locale()=='en')
											  {{$portfolio->name}}
										  @else
											  {{$portfolio->ar_name}}
										  @endif
									  </span>
									  <br>
                                      <em>
										  @if(Lang::locale()=='en')
											  {{$portfolio->skill}}
										  @else
											  {{$portfolio->ar_skill}}
										  @endif
									  </em>
                                  </div>
                              </div>
                          </a>

					</div>
					@endforeach
					<!-- end single work -->
				</div>
				<!-- end row -->
			</div>
			<!-- all works end -->
		</div>
		<!-- end container -->
	</section>
	<!-- portfolio -->

	<!-- CLIENTS -->
	<div id="clients" class="clients mt-100 mbr-box mbr-section mbr-section--relative">
		<svg preserveAspectRatio="none" viewBox="0 0 100 102" height="100" width="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">
			<path d="M0 0 L50 100 L100 0 Z" fill="#fff" stroke="#fff"></path>
		</svg>

	</div>

	<!-- PRICING -->
	<section id="pricing" class="pricing mbr-box mbr-section mbr-section--relative mbr-section--full-height mbr-section--bg-adapted">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 col-sm-12">
					<div class="row center">
						<div class="section-title mb-100">
							<div class="process-numbers">04</div>
							<h2>{{ __('homepage.we_are_huur') }}</h2>

						</div>
					</div>
				</div>
			</div>

			<div class="row center">
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="pricing_plan">
						<div class="plan_title">
							<h6>{{ __('homepage.Safer') }}</h6>
						</div>
						<div class="plan_price">
							<i class="fa fa-clock-o" aria-hidden="true"></i>

						</div>
						<ul class="list" style="height: 135px">
							<li>{{ __('homepage.SaferDescription') }}
								<br/>
								<br/>
								<br/>
							</li>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="pricing_plan">
						<div class="plan_title">
							<h6>{{ __('homepage.Fast') }}</h6>
						</div>
						<div class="plan_price">
							<i class="fa fa-check" aria-hidden="true"></i>

						</div>
						<ul class="list" style="height: 135px">
							<li>{{ __('homepage.FastDescription') }}
								<br/>
								<br/>
							</li>
						</ul>

					</div>
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="pricing_plan">
						<div class="plan_title">
							<h6>{{ __('homepage.Professionally') }}</h6>
						</div>
						<div class="plan_price">
							<i class="fa fa-user" aria-hidden="true"></i>

						</div>
						<ul class="list" style="height: 135px">
							<li>{{ __('homepage.ProfessionallyDescription') }}
								<br/>
								<br/>
								<br/>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Testimonials -->
<section id="testimonials" class="testimonials mt-100 mb-100 mbr-box mbr-section mbr-section--relative mbr-section--fixed-size mbr-section--bg-adapted mbr-parallax-background" style="background-image: url(<?php echo asset('/new-design/') ?>/assets/img/testimonials.jpg);">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="flexslider">
					<ul class="slides">
                        <?php
                        if ( app()->getLocale() == 'ar' ) {
                        ?> @foreach($qouts as $qouts)
							<li>
								<div class="avatar"><img src="{{url('public/images/qouts')}}/{{$qouts->image}}" alt="Sedna Testimonial Avatar">
								</div>
								<h5>"{{ $qouts->ar_title  }}"</h5>
								<p class="author">{{ $qouts->ar_description }}</p>
							</li>
						@endforeach
                        <?php } else { ?> @foreach($qouts as $qouts)

							<li>
								<div class="avatar"><img src="{{url('public/images/qouts')}}/{{$qouts->image}}" alt="Sedna Testimonial Avatar">
								</div>
								<h5>"{{ $qouts->title  }}"</h5>
								<p class="author">{{ $qouts->description }}</p>
							</li>
						@endforeach
                        <?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

	<!-- Contact -->
	<section id="contact" class="contact mbr-box mbr-section mbr-section--relative mbr-section--bg-adapted">
		<div class="container">
			<div class="col-md-6 col-sm-12">
				<div class="row">
					<h4> {{ __('homepage.WorkTogether') }}</h4>
					<p class="libre-text mt-50">
						{{ __('homepage.WorkTogetherDescription') }}
					</p>

					<a href="<?php echo url('/contact_us'); ?>" class="default-btn"> {{ __('homepage.InTouch') }} <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				</div>
			</div>

			<!-- Subscribe block -->
			<div class=" col-md-offset-1 col-md-5 col-sm-12">
				<div class="row center">
					<div class="newsletter">
						<h4>{{ __('homepage.SUBSCRIBE') }}</h4>
						<p class="libre-text mb-50">
							{{ __('homepage.SUBSCRIBEdescription') }}
						</p>
						<p class="alert-success" style="background-color: white;" id="success_subscription">{{ __('auth.subscription_successfully') }}</p>

						<form id="subcription_detail" method="post">
							{{csrf_field()}}
							<div class="input_1">
								<input type="text" name="subcriber_email">
								<span>{{ __('homepage.email') }}</span>
							</div>
							<p class="alert-danger" style="background-color: white;" id="email_required">{{ __('auth.email_required') }}</p>
							<p class="alert-danger" style="background-color: white;" id="email_valid">{{ __('auth.email_valid') }}</p>
							<p class="alert-danger" style="background-color: white;" id="already_subscribed">{{ __('auth.already_subscribed') }}</p>
							<p class="alert-danger" style="background-color: white;" id="wrong">{{ __('auth.wrong') }}</p>
							<button id="submit_btn" class="default-btn"> {{ __('homepage.send') }} <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
						</form>
						<script>
							function hide() {
								$( '#success_subscription' ).hide();
								$( '#email_required' ).hide();
								$( '#email_valid' ).hide();
								$( '#already_subscribed' ).hide();
								$( '#wrong' ).hide();
							}
							$( function () {
								hide();
								$( "#submit_btn" ).click( function ( event ) {
									$.ajaxSetup( {
										headers: {
											'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
										}
									} );

									event.preventDefault();
									$.post( "<?php echo url('/subcription'); ?>", $( "#subcription_detail" ).serialize(), function ( data ) {
										var ht = "";
										if ( data[ 'status' ] == true ) {
											document.getElementById( 'subcription_detail' ).reset();
											if ( data[ 'success' ] == 'You have Subscribe Suucessfully' ) {
												$( '#success_subscription' ).show();
												setTimeout( function () {
													$( ".alert-success" ).slideUp( 'slow' );
												}, 5000 );
											}
										} else {
											$.each( data[ 'errors' ], function ( index, value ) {
												if ( value == 'Email is Required' ) {
													$( '#email_required' ).show();
												}
												if ( value == 'Please Enter Valid Email Address' ) {
													$( '#email_valid' ).show();
												}
												if ( value == 'Your have already subscribed' ) {
													$( '#already_subscribed' ).show();
												}
												if ( value == 'Something going wrong' ) {
													$( '#wrong' ).show();
												}
											} );
											setTimeout( function () {
												$( ".alert-danger" ).slideUp( 'slow' );
											}, 5000 );
										}
									}, 'json' );

								} );
							} );
						</script>
					</div>
				</div>
			</div>
		</div>
	</section>
	@include ('include/footer')