<?php     if(Session::get('user_role')=='client')      {       ?>
@include ('include/header_cl')
  <?php }else{ ?>
@include ('include/header_fr')
  <?php } ?>

<div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">
<div class="clientdashboardarea">
  <div class="">
  <div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
        <br><br> <h2 style="color:#ed1c24">Cancel</h2>
        <h3>Dear, <?php echo $client->name; ?></h3>
        <p style="font-size:20px;color:#5C5C5C;">Your payment send to freelancer is not successfully submitted. Please try after some time.</p>
    <br><br>
        </div>
        
  </div>
</div>
</div>

@include ('include/footer_fr')