<div class="row" id="response">
<?php
if(isset($freelancer) && !empty($freelancer)) {
foreach($freelancer as $freelncr) {
?>
<div class="col-xs-12 with-border freelancer-list">
  <?php if(!empty($freelncr->profile->profile_image)) { ?>
<div class="f-image">
  <div class="f-image-inner form-label-color"><a href="{{url('view/fr_profile')}}/{{encrypt($freelncr->user_id)}}" class="btn btn-primary btn-color" style="border-radius: 50%;width: 100px;background: none;"  >
      <img style="border-radius: 50%;width: 100px;" src="{{asset('/')}}/<?php echo (isset($freelncr->profile->profile_image))?$freelncr->profile->profile_image:''; ?>" /></a> <span class="f-availability f-invisible"></span> </div>
</div>
  <?php } ?>
<div class="f-info">
  <label class="form-label-color" style="padding-left: 20px;"><?php echo (isset($freelncr->name)?$freelncr->name:''); ?></label>
  <div class="f-professional table-header-title"><?php echo (isset($freelncr->profile->job_title)?$freelncr->profile->job_title:''); ?></div>
  <div class="row">
    <div class="col-md-6 col-lg-3"> <span class="table-header-title">{{Config::get('constants.constant.currency')}}<?php echo (isset($freelncr->profile->hourly_rate)?$freelncr->profile->hourly_rate:0); ?> / hr</span> </div>
      <?php if(isset($freelncr->earn) && $freelncr->earn> 0) { ?>
    <div class="col-md-6 col-lg-3"> <span class="table-header-title">$<?php echo (isset($freelncr->earn)?$freelncr->earn:''); ?>+ earned</span> </div>
      <?php } ?>
    <div class="col-md-6 col-lg-3"> <span class="table-header-title"><?php echo (isset($freelncr->score)?$freelncr->score:0) ?>% job success</span>
      <div class="progress f-success">
        <div class="progress-bar " role="progressbar" aria-valuenow="<?php echo (isset($freelncr->score)?$freelncr->score:0) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (isset($freelncr->score)?$freelncr->score:0) ?>%;"> </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3"> <span class="table-header-title"><i class="fa fa-map-marker"></i><?php echo (isset($freelncr->profile->country)?$freelncr->profile->country:''); ?></span> </div>
    {{--<div class="col-xs-12 f-short-desc table-header-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore m</div>--}}
  </div>
</div>
<div class="f_buttons">
  {{--<a href="{{url('view/fr_profile')}}/{{encrypt($freelncr->user_id)}}" class="btn btn-primary btn-color" style="margin-bottom: 20px;"  >Profile</a>--}}
  <a class="btn btn-primary btn-color invite_btn" style="margin-bottom: 20px;display: inline;padding:10px;" data-toggle="modal" data-target="#invitePopup_<?php echo $freelncr->user_id?>">{{__('client.invit')}}</a>

  <form style="display: inline;" action="{{url('send/freelancer/message')}}" method="post">
    <input type="hidden" name="user_id" value="{{$freelncr->user_id}}">
    <input type="hidden" name="message" value="hi" readonly>
    <button  class="btn btn-primary btn-color"   >{{__('client.mesg')}}</button>
  </form>
    <?php /*if($freelncr->hired==0){ ?>
   <a class="btn btn-primary hire_freelancer_for_job" style="margin-bottom: 20px;" data-freelancer_id="<?php echo $freelncr->user_id; ?>" >Hire freelancer</a>
   <?php }else {
    echo '<a class="btn btn-primary" >Hired</a>';
   }*/ ?><br>


    <?php
    if(isset($freelncr->report->description) && $freelncr->report->description != "") {
        $reportAbuse = $freelncr->report->description;
    } else {
        $reportAbuse = "";
    }
    ?>
  <button class="btn btn-secondary btn-color save_freelancer <?php if(isset($freelncr->status->status) && $freelncr->status->status == 1 ){ echo 'saved_job_active'; } ?>" data-ng_bind="<?php echo \Crypt::encryptString($freelncr->user_id) ?>"><i class="fa fa-heart-o"></i>&nbsp;{{__('client.save')}}</button>
  <button class="btn btn-secondary btn-color" onclick="reportAbuse(<?=$user_data->user_id;?>,<?=$freelncr->user_id;?>,'<?=$reportAbuse;?>')"><i class="fa fa-bug"></i>&nbsp;{{__('client.reprt_abus')}}</button>
    <?php
    if($freelncr->is_verify == 0) {
        echo '<button class="btn btn-secondary btn-color"><i class="fa fa-thumbs-down"></i>&nbsp;Need Verification</button>';
    } elseif($freelncr->is_verify == 1) {
        echo '<button class="btn btn-secondary btn-color"><i class="fa fa-thumbs-up"></i>&nbsp;Verified</button>';
    }
    ?>
</div>
<div class="break_line"></div>
</div>




<div class="modal fade" id="invitePopup_<?php echo $freelncr->user_id?>" style="z-index: 9999999; " tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <div class=" freelancer-list">
        <div class="f-image table-header-colums-title">
          <div class="f-image-inner"> <i class="fa fa-user"></i>  <label class="table-header-colums-title"><?php echo (isset($freelncr->name)?$freelncr->name:''); ?> (<?php echo (isset($freelncr->profile->job_title)?$freelncr->profile->job_title:''); ?>)</label> </div>
        </div>
      </div>
      <button style="position: absolute;right: 5px;top: 5px;" type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
    </div>
    <form action="<?php echo url('/'); ?>/hire/freelancer" method="post" >
      <div class="modal-body">

        <input type="hidden" name="user_id" value="<?php echo $freelncr->user_id; ?>">
        <div class="form-group">
          <h4 class="form-label-color p-b">Message</h4>
          <textarea name="message" rows="4" class="form-control c-form" placeholder="Enter Message" ></textarea>
        </div>
        {{--<div class="form-group">--}}
        {{--<h4 class="form-label-color">Price</h4>--}}
        {{--<input type="number" name="price" class="form-control c-form" placeholder="Enter Price" />--}}
        {{--</div>--}}
        <div class="form-group">
          <h4 class="form-label-color  p-b">Choose a job</h4>
          <select name="job_id" class="c-form form-control">
            <option value="">Select Job</option>

              <?php if (isset($all_job) && !empty($all_job)){
              foreach($all_job as $aljb)
              {
              ?>
            <option value="<?php echo $aljb->job_id; ?>"><?php echo $aljb->job_title; ?></option>
              <?php } } ?>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-color" onClick="window.location.href='<?php echo url('postjob/to/invite/'.$freelncr->user_id) ?>'" data-dismiss="modal">Create a new job invite</button>
        <button type="button" id="" class="btn btn-primary invite_send_freelancer btn-color">Send Invitation</button>
      </div>

    </form>
  </div>
</div>
</div>

<?php

}

}

?>


<?php //echo "wefewfewfew"; exit; ?>
                 @if(sizeof($freelancer)>0)
                  <div calss="container">
                  <?php
                   $url=url('find/freelancer/freelancer');
                   ?>
                    @if ($freelancer->lastPage() > 1)
                        <ul class="pagination freelancer">
                            <li class="{{ ($freelancer->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $freelancer->url(1) }}">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $freelancer->lastPage(); $i++)
                                <li class="{{ ($freelancer->currentPage() == $i) ? ' active' : '' }}">
                                    <a href="{{ $url}}{{ $freelancer->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($freelancer->currentPage() == $freelancer->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $freelancer->url($freelancer->currentPage()+1) }}" >Next</a>
                            </li>
                        </ul>
                    @endif
                  </div>
                  @else
                  <h2 align="center">No data available</h2>
             @endif
</div>