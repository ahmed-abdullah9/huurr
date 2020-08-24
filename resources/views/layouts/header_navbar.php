<div id="site_loader"><img src="<?php echo asset('images/loader.gif'); ?>" class="loader_image"></div>
<base href="<?php echo url('/'); ?>">
<div class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon icon-bar"></span> <span class="icon icon-bar"></span> <span class="icon icon-bar"></span> </button>
    <a href="<?php echo url('/') ?>" class="navbar-brand smoothScroll"> <img src="<?php echo asset('images/logo.jpg'); ?>" alt="Company Logo"> </a> </div>
  <div class="collapse navbar-collapse">
    <div class="box">
      <?php if(Session::get('user_role') == 'client'){ ?>
      <form class="navbar-form" action="<?php echo url('find/freelancer') ?>" method="get">
        <div class="container-2"> <span class="icon"><i class="fa fa-search"></i></span>
          <input type="hidden" name="offset" value="0">
          <input type="text" name="find" value="<?php echo (isset($_REQUEST['find'])?$_REQUEST['find']:'') ?>" placeholder="Find Freelancer">
        </div>
      </form>
      <?php }else { ?>
      <form class="navbar-form" action="<?php echo url('/find/work') ?>" method="get">
        <div class="container-2"> <span class="icon"><i class="fa fa-search"></i></span>
          <input type="hidden" name="offset" value="0">
          <input type="text" name="search_keyword" value="<?php echo (isset($_REQUEST['search_keyword'])?$_REQUEST['search_keyword']:'') ?>" placeholder="Find Jobs">
        </div>
      </form>
      <?php } ?>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo url('/find/work'); ?>" class="smoothScroll">BROWSE </a></li>
      <li><a href="<?php echo url('/question'); ?> " class="smoothScroll">Common Question</a></li>
      <?php if(!Session::get('login_id')){ ?>
      <li class="register"><a href="<?php echo url('register'); ?>" class="smoothScroll ">SIGN UP</a></li>
      <li class="login"><a href="<?php echo url('login'); ?>" class="smoothScroll">LOGIN</a></li>
      <?php 	  }	  if(Session::get('login_id'))	  {	  ?>
      <?php			if(Session::get('user_role')=='admin')			{				?>
      <li> <a href="<?php echo url('dashboard'); ?>" class="smoothScroll">Dashboard</a> </li>
      <?php			}			if(Session::get('user_role') == 'client' || Session::get('user_role')=='admin')			{				?>
      <li class=" login_submenu"> <a href="<?php echo url('/clmy/job'); ?>" class="smoothScroll">Jobs </a>
        <ul class="drop_downmenu">
          <li> <a href="<?php echo url('/clmy-job'); ?>" class="smoothScroll">My Jobs</a> </li>
          <li> <a href="<?php echo url('joblist') ?>" class="smoothScroll">JOB LIST </a> </li>
          <li> <a href="<?php echo url('create/jobpost') ?>" class="smoothScroll">POST JOB </a> </li>
        </ul>
      </li>
      <li class=" login_submenu"> <a href="<?php echo url('find/freelancer') ?>" class="smoothScroll">Freelancer </a>
        <ul class="drop_downmenu">
          <li> <a href="<?php echo url('find/freelancer') ?>" class="smoothScroll">Find Freelancer </a> </li>
        </ul>
      </li>
      <li><a href="<?php echo url('/clmessages') ?>" class="smoothScroll">Messages</a></li>
      <?php			}			if((Session::get('user_role') == 'freelancer' || Session::get('user_role') == 'admin'))			{				?>
      <li class=" login_submenu"> <a href="#" class="smoothScroll">MY Jobs </a>
        <ul class="drop_downmenu">
          <li><a href="<?php echo url('my/job'); ?>">My Jobs</a></li>
          <li><a href="<?php echo url('my/contract'); ?>">All Contracts</a></li>
        </ul>
      </li>
      <li class=" login_submenu"> <a href="<?php echo url('/earning-by-client'); ?>" class="smoothScroll">Reports</a>
        <ul class="drop_downmenu">
          <li><a href="<?php echo url('/earning-by-client'); ?>">Earnings by Client</a></li>
          <!-- <li><a href="<?php echo url('/lifetime-billing'); ?>">Lifetime Billings by Client</a></li> -->
          <li><a href="<?php echo url('/transaction-history'); ?>">Transaction History</a></li>
        </ul>
      </li>
      <li class=" login_submenu"> <a href="<?php echo url('/find/work'); ?>" class="smoothScroll">Find Works </a>
        <ul class="drop_downmenu">
          <li><a href="<?php echo url('/find/work'); ?>">Find Work</a></li>
          <li><a href="<?php echo url('/saved/job'); ?>">Saved Job</a></li>
          <li><a href="<?php echo url('/proposals'); ?>">Proposal</a></li>
          
          <li><a href="#">My Stats</a></li>
          <!-- <li><a href="#">Test</a></li> -->
        </ul>
      </li>
      <?php if(Session::get('user_role') != 'admin'){ ?>
      <li><a href="<?php echo url('/frmessages') ?>" class="smoothScroll">Messages</a></li>
      <li><a href="<?php echo url('/profile')?>">Profile</a></li>
      <?php } ?>
      <?php			}
      $notify = \DB::table('notifications')->where('receiver_id', Session::get('login_id'))->where('status',0)->select('message','id')->get()->toArray(); ?>
      <li class=" login_submenu"> <a class="notyficatio_error"><i class="fa fa-bell-o" aria-hidden="true"></i> </a>
        <ul class="drop_downmenu right">
          <?php if(empty($notify)) { ?>
            <li><a>There Is no Any Notification</a></li>
          <?php }else {
            foreach ($notify as $nt) {
             echo '<li class="noty_p">'.$nt->message.'<a class="delete_notify" data-notify_id="'.$nt->id.'">X</a></li>';
            }
          } ?>
          
        </ul>        
      </li>
      <li> <a href="<?php echo  url('logout') ?>" class="smoothScroll">LOGOUT</a></li>
      <?php	  }	  ?>
    </ul>
    <?php if(!Session::get('login_id')){ ?>
    <div class="freelancer-btn"> <a href="<?php echo url('register-freelancer') ?>">Become a Freelancer</a> </div>
    <?php } ?>
  </div>
</div>
<div class="container-2">
  <?php if(Session::get('account_suspended')==1){?>
  <div data-o-smf=""><!---->
    <div ng-repeat="message in messages" class="alert alert-dismissible alert-danger" role="alert" style=""> <span aria-hidden="true" class="glyphicon air-icon-exclamation" ng-hide="message.severity=='notification'" ng-class="{'air-icon-rating-activated' : message.severity=='info', 'air-icon-complete' : message.severity=='success', 'air-icon-exclamation' : message.severity=='warning' || message.severity=='danger' || message.severity===undefined}"></span> <!---->
      <div ng-bind-html="message.content">Your account has been suspended. Please <a href="https://support.upwork.com/login" target="_blank">contact customer support.</a></div>
    </div>
    <!----></div>
  <?php } ?>
</div>
