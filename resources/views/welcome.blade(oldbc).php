@extends('layouts.app')

@section('content')
<!-- home section -->
<div id="home">
<div class="container">
    <div class="row">
        <div class=" col-md-12 col-sm-12 col-lg-12">
            <h1>The FREE way to find the world’s best remote </h1>
            <p>Hubstaff Talent is a 100% free resource for companies looking to find remote talent <br>
across the globe. No fees, no markups, no middlemen.</p>
             
             <div class="serchfield">
             <form class="navbar-form" action="<?php echo url('/find/work'); ?>" method="get" role="search">
<div class="input-group add-on">
    <input type="hidden" name="offset" value="0">
  <input class="form-control" placeholder="Search by keywords (PHP, .NET, graphic design, etc.)" name="search_keyword" id="srch-term" type="text">
    <button class="btn-default submit" type="submit">Search</button>
</div>
</form>
             </div>
             
            <!-- <a href="<?php echo url('/register') ?>" class="btn btn-default smoothScroll">Start a profile</a> -->
            <a href="<?php echo url('/find/work'); ?>" class="btn btn-default smoothScroll">Browse jobs</a>
            <div class="btn-clear">
            <!-- <a href="#service">Why we are free</a>  -->
        </div>
        </div>
    </div>
</div>
</div>

<!-- service section -->
<div id="service">
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h2>Browse By Skill</h2>
        </div>
        <div class="col-md-3 col-sm-3 col-lg-3 Browse">
            <a href=""><img src="<?php echo asset('/') ?>images/icon1.png"></a>
            <h3>Development</h3>
            <p>
            <ul>
            <li><a href="">HTML</a></li>
            <li><a href="">CSS</a></li>
            <li><a href="">Javascript</a></li>
            <li><a href="">Web Development</a></li>
            <li><a href="">PHP</a></li>
            
            </ul>
            </p>
            <a href="<?php echo url('/skills') ?>" class="view-more"> View all skills</a>
        </div>
        <div class="col-md-3 col-sm-3 col-lg-3 Browse">
            <a href=""><img src="<?php echo asset('/') ?>images/icon2.jpg"></a>
            <h3>Marketing & Sales</h3>
            <p>
            <ul>
            <li><a href="">Social Media Marketing</a></li>
            <li><a href="">Email Marketing</a></li>
            <li><a href="">Facebook Advertising</a></li>
            <li><a href="">SEO(Search Engine Optimization)</a></li>
            <li><a href="">Content Marketing</a></li>
            
            
            </ul>
            </p>
            <a href="<?php echo url('/skills') ?>" class="view-more"> View all skills</a>
        </div>
                    <div class="col-md-3 col-sm-3 col-lg-3 Browse">
            <a href=""><img src="<?php echo asset('/') ?>images/icon3.jpg"></a>
            <h3> Design & Multimedia</h3>
            <p>
            <ul>
            <li><a href="">Photoshop</a></li>
            <li><a href="">Graphic Design</a></li>
            <li><a href="">Web Design</a></li>
            <li><a href="">Photography &Photo Editing</a></li>
            <li><a href="">Logo Design</a></li>
            
            </ul>
            </p>
            <a href="<?php echo url('/skills') ?>" class="view-more"> View all skills</a>
        </div>
                    <div class="col-md-3 col-sm-3 col-lg-3 Browse">
            <a href=""><img src="<?php echo asset('/') ?>images/icon4.jpg"></a>
            <h3>Writing & Content</h3>
            <p>
            <ul>
            <li><a href="">Writing</a></li>
            <li><a href="">Editing &Proofreading </a></li>
            <li><a href="">WordPress</a></li>
            <li><a href="">Blog Posts</a></li>
            <li><a href="">Web Content</a></li>
            
            </ul>
            </p>
            <a href="<?php echo url('/skills') ?>" class="view-more"> View all skills</a>
        </div>
        
        <div class="all-view"><a href="<?php echo url('/skills') ?>"> View All</a></div>
    </div>
</div>
</div>

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


<!-- pricing section -->
<div id="how-it-works">
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h4>How it works</h4>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
            <div class="plan">
                <div class="plan-title">
                <span><img src="<?php echo asset('/') ?>images/img1.png"></span>
                    <h3>FIND</h3>
                    <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
                </div>
            

            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
            <div class="plan">
                <div class="plan-title">
                <span><img src="<?php echo asset('/') ?>images/img2.png"></span>
                    <h3>HIRE</h3>
                    <p>Browse profiles, reviews, and proposals then interview top candidates. Hire a favorite and begin your project.</p>
                </div>
            

            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
            <div class="plan">
                <div class="plan-title">
                <span><img src="<?php echo asset('/') ?>images/img3.png"></span>
                    <h3>WORK</h3>
                    <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
                </div>
            

            </div>
        </div>			
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
            <div class="plan">
                <div class="plan-title">
                <span> <img src="<?php echo asset('/') ?>images/img4.png"></span>
                    <h3>PAY</h3>
                    <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
                </div>
            

            </div>
        </div>		
    </div>
</div>
</div>


<!-- pricing section -->
<div id="pricing">
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h3><img src="<?php echo asset('/') ?>images/why-head.jpg"></h3>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
            <div class="plan">
                <div class="plan-title">
                <span  class="last-porsen">D</span>
                    <h3>Do it fast</h3>
                    <p>We connect you with professional freelancers whom can support you very fast implement your job with short notice</p>
                </div>
            

            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
            <div class="plan">
                <div class="plan-title">
                <span  class="last-porsen">D</span>
                    <h3>Do it Safer</h3>
                    <p>We grantee you a safe payment method and you always can get your money back if you could not get what you are looking for!</p>
                </div>
            

            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
            <div class="plan">
                <div class="plan-title">
                <span  class="last-porsen">D</span>
                    <h3>Do it professionally</h3>
                    <p> We insure that you will be connected to the professional people in the field you are looking to <br>get the support in</p>
                </div>
            

            </div>
        </div>			
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
            <div class="plan">
                <div class="plan-title">
                <span  class="last-porsen">D</span>
                    <h3>Do it cheape</h3>
                    <p>We can offer you best prices which will match your budget and close you target within awesome<br> Quilty</p>
                </div>
            

            </div>
        </div>		
    </div>
</div>
</div>

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

@endsection