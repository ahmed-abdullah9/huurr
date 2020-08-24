@include ('include/header_cl')
<style>
  .table-header-title {
    padding-left: 20px !important;
  }
  .break_line{
    height:1px;
    background-color:#666666;
    margin-top: 10px;
    margin-bottom: 10px;
  }
  .invite_btn{
    padding: 8px !important;
    position: relative;
    top: -2px;
  }
  .pagination{
    margin:20px;
  }
  label {
    margin-bottom: 4px;
  } 
  #amount {
      border:0;
      color:#f6931f;
      font-weight:bold;
      height: 20px;
    }

</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">

  <div class="clearfix"></div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs my_navs" role="tablist">
    <li role="presentation" <?php if(empty($tab)){ ?> class="active"<?php } ?>><a  class="table-heading" href="#search_freelancer" role="tab" aria-controls="response" data-toggle="tab">{{__('client.serch')}}</a></li>
    <li role="presentation"><a class="table-heading" href="#past_hired" aria-controls="past_hired" role="tab" data-toggle="tab">{{__('client.pst_hirs')}}</a></li>
    <li role="presentation" <?php if(!empty($tab) && $tab=='saved'){ ?> class="active"<?php } ?>><a class="table-heading" href="#saved_freelancer" aria-controls="past_hired" role="tab" data-toggle="tab">{{__('client.svd_frelncr')}}</a></li>
  </ul>
  <div class="row">
    <div class="col-md-12 col-sm-12 ">

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane <?php if(empty($tab)){ ?> active<?php } ?>" id="search_freelancer">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
              <input type="hidden" class="form-control  c-form" value="freelancer" name="type" />

                <form  id = "filterdata">
                  <div class="col-md-3">

                    <div style="display: inline;" class="input-group input-group-search">
                    <label for="skill">{{__('client.Search')}}:</label>
                      <input style="width:100%;" type="search" id = "search" class="form-control  c-form" value="<?php echo (isset($_REQUEST['find'])?$_REQUEST['find']:''); ?>" name="find" placeholder="{{__('client.srch_frelncr')}}"/>
                    </div>
                  </div>
                  <div class="col-md-2">
                  <div class="input-group input-group-skill">
                  <label for="skill">{{__('client.skills')}}:</label>
                       <select class="form-control js-example-basic-multiple" name="skill[]" id="skill"  multiple="multiple">
                       <option value="" disabled>
                        {{__('client.select_skill')}}
                       </option>
                      @foreach($skills as $value)
                       <option value ="{{$value->id}}">{{$value->freelancer_skill}}</option>
                      @endforeach
                       </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                  <p>
                  <label for="amount">{{__('client.price_range')}}:</label>
                  <input type="text" class="form-control" id="amount" name = "range" readonly >
                </p>
                
                <div id="slider-range"></div>
                
                  </div>   
                  <div class="col-md-2">
                  <div class="input-group input-group-countries">
                       <label for="skill">{{__('client.specific_location')}}:</label>
                       <select class="form-control" name="country" id="country">
                       <option value="">
                        {{__('client.select_country')}}
                       </option>
                      @foreach($countries as $value)
                       <option value ="{{$value}}">{{$value}}</option>
                      @endforeach
                       </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                  <label for="skill">{{__('client.rating')}}:</label>
                    <div id="rating">
     
                    </div>
                     <input type="hidden" id="rate" name="rating" value="">
                  </div>
                  <!-- <button class="btn btn-secondry">Find me <i class="fa fa-map-marker" aria-hidden="true"></i></button> -->
                  
                </form>
              </div>
            </div>
            <div class="panel-body">
              <div class="row tab-pane" id="response" role="tabpanel">


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
                      <div class="col-md-6 col-lg-3"> <span class="table-header-title">$<?php echo (isset($freelncr->earn)?$freelncr->earn:''); ?>+ {{__('client.earned')}}</span> </div>
                        <?php } ?>
                      <div class="col-md-6 col-lg-3"> <span class="table-header-title"><?php echo (isset($freelncr->score)?$freelncr->score:0) ?>% {{__('client.jb_suces')}}</span>
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
                            <h4 class="form-label-color p-b">{{__('client.Message')}}</h4>
                            <textarea name="message" rows="4" class="form-control c-form" placeholder="Enter Message" ></textarea>
                          </div>
                          {{--<div class="form-group">--}}
                          {{--<h4 class="form-label-color">Price</h4>--}}
                          {{--<input type="number" name="price" class="form-control c-form" placeholder="Enter Price" />--}}
                          {{--</div>--}}
                          <div class="form-group">
                            <h4 class="form-label-color  p-b">{{__('client.Choose_job')}}</h4>
                            <select name="job_id" class="c-form form-control">
                              <option value="">{{__('client.SelectJob')}}</option>

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
                          <button type="button" class="btn btn-secondary btn-color" onClick="window.location.href='<?php echo url('postjob/to/invite/'.$freelncr->user_id) ?>'" data-dismiss="modal">{{__('client.CreateaNewJobInvite')}}</button>
                          <button type="button" id="" class="btn btn-primary invite_send_freelancer btn-color">{{__('client.send_invitation')}}</button>
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
                  <div calss="container ">
                  <?php
                   $url=url('find/freelancer/freelancer');
                   ?>
                    @if ($freelancer->lastPage() > 1)
                        <ul class="pagination freelancer">
                            <li class="{{ ($freelancer->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $freelancer->url(1) }}">{{__('client.previous')}}</a>
                            </li>
                            @for ($i = 1; $i <= $freelancer->lastPage(); $i++)
                                <li   id="freelancer-{{$i}}" data-id="{{$i}}" class="{{ ($freelancer->currentPage() == $i) ? ' active' : '' }}">
                                    <a href="{{ $url}}{{ $freelancer->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($freelancer->currentPage() == $freelancer->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $freelancer->url($freelancer->currentPage()+1) }}" >{{__('client.next')}}</a>
                            </li>
                        </ul>
                    @endif
                  </div>
                  @else
                  <h2 align="center">{{__('client.No_data_available')}}</h2>
             @endif
              </div>
            </div>
          </div>
        </div>
    

        <div role="tabpanel" class="tab-pane " id="past_hired">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                  <?php

                  if(!empty($hired_freelancers))
                  {
                  foreach($hired_freelancers as $freelncrsedv)
                  {

                  ?>
                <div class="col-xs-12 with-border freelancer-list">
                    <?php if(!empty($freelncrsedv->profile->profile_image)) { ?>
                  <div class="f-image">
                    <div class="f-image-inner form-label-color"><a href="{{url('view/fr_profile')}}/{{encrypt($freelncrsedv->user_id)}}" class="btn btn-primary btn-color" style="border-radius: 50%;width: 100px;background: none;"  >
                        <img style="border-radius: 50%;width: 100px;" src="{{asset('/')}}/<?php echo (isset($freelncrsedv->profile->profile_image))?$freelncrsedv->profile->profile_image:''; ?>" /></a> <span class="f-availability f-invisible"></span> </div>
                  </div>
                    <?php } ?>
                  {{--<div class="f-image">--}}
                    {{--<div class="f-image-inner table-header-colums-title"> <i class="fa fa-user"></i> <span class="f-availability f-invisible"></span> </div>--}}
                  {{--</div>--}}
                  <div class="f-info">
                    <label style="padding-left:25px;" class="table-header-colums-title"><?php echo (isset($freelncrsedv->name)?$freelncrsedv->name:''); ?></label>
                    <div class="f-professional table-header-title"><?php echo (isset($freelncrsedv->profile->job_title)?$freelncrsedv->profile->job_title:''); ?></div>
                    <div class="row">
                      <div class="col-md-6 col-lg-3"> <span class="table-header-title">{{Config::get('constants.constant.currency')}}<?php echo (isset($freelncrsedv->profile->hourly_rate)?$freelncrsedv->profile->hourly_rate:0); ?> / hr</span> </div>
                        <?php if(isset($freelncr->earn) && $freelncr->earn > 0) { ?>
                      <div class="col-md-6 col-lg-3"> <span class="table-header-title">{{Config::get('constants.constant.currency')}}<?php echo (isset($freelncr->earn)?$freelncr->earn:''); ?>+ {{__('client.earned')}}</span> </div>
                        <?php } ?>
                      <div class="col-md-6 col-lg-3"> <span class="table-header-title"><?php echo (isset($freelncrsedv->score)?$freelncrsedv->score:0) ?>% {{__('client.jb_suces')}}</span>
                        <div class="progress f-success">
                          <div class="progress-bar " role="progressbar" aria-valuenow="<?php echo (isset($freelncrsedv->score)?$freelncrsedv->score:0) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (isset($freelncrsedv->score)?$freelncrsedv->score:0) ?>%;"> </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-3"> <span class="table-header-title"><i class="fa fa-map-marker"></i><?php echo (isset($freelncrsedv->profile->country)?$freelncrsedv->profile->country:''); ?></span> </div>
                    </div>
                  </div>
                      <div class="f_buttons">
                        {{--<a href="{{url('view/fr_profile')}}/{{encrypt($freelncr->user_id)}}" class="btn btn-primary btn-color" style="margin-bottom: 20px;"  >Profile</a>--}}
                        <form style="display: inline;" action="{{url('send/freelancer/message')}}" method="post">
                          <input type="hidden" name="user_id" value="{{$freelncrsedv->user_id}}">
                          <input type="hidden" name="message" value="hi" readonly>
                          <button  class="btn btn-primary btn-color"   >{{__('client.Message')}}</button>
                        </form>
                          <?php /*if($freelncr->hired==0){ ?>
                     <a class="btn btn-primary hire_freelancer_for_job" style="margin-bottom: 20px;" data-freelancer_id="<?php echo $freelncr->user_id; ?>" >Hire freelancer</a>
                     <?php }else {
                      echo '<a class="btn btn-primary" >Hired</a>';
                     }*/ ?><br>
                      </div>
                </div>
                  <?php
                  }
                  }
                  ?>
                  @if(sizeof($hired_freelancers)>0)
                   <div calss="container ">
                   <?php
                   $url=url('find/freelancer/hired_freelancers');
                   ?>
      
                      @if ($hired_freelancers->lastPage() > 1)
                        <ul class="pagination hire_freelancer">
                            <li class="{{ ($hired_freelancers->currentPage() == 1) ? 'disabled' : '' }}">
                                <a href="{{ $url}}{{ $hired_freelancers->url(1) }}">{{__('client.previous')}}</a>
                            </li>
                        
                            @for ($i = 1; $i <= $hired_freelancers->lastPage(); $i++)
                      
                                <li  id="hire-{{$i}}" data-id="{{$i}}" class="{{ ($hired_freelancers->currentPage() == $i) ? 'active' : '' }}">
                                    <a href="{{ $url}}{{ $hired_freelancers->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($hired_freelancers->currentPage() == $hired_freelancers->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $hired_freelancers->url($hired_freelancers->currentPage()+1) }}" >{{__('client.next')}}</a>
                            </li>
                        </ul>
                     @endif
                    </div> 
                    @else
                  <h2 align="center">No data available</h2>
             @endif
              </div>
            </div>
          </div>
           
        </div>
        <div role="tabpanel" class="tab-pane <?php if(!empty($tab) && $tab=='saved'){ ?> active<?php } ?>" id="saved_freelancer">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                  <?php
                  if(!empty($saved_freelancers))
                  {
                  foreach($saved_freelancers as $freelncrsedv)
                  {

                  ?>
                <div class="col-xs-12 with-border freelancer-list">
                  <div class="f-image">
                    <div class="f-image-inner table-header-colums-title"> <i class="fa fa-user"></i> <span class="f-availability f-invisible"></span> </div>
                  </div>
                  <div class="f-info">
                    <label class="table-header-colums-title"><?php echo (isset($freelncrsedv->name)?$freelncrsedv->name:''); ?></label>
                    <div class="f-professional table-header-title"><?php echo (isset($freelncrsedv->profile->job_title)?$freelncrsedv->profile->job_title:''); ?></div>
                    <div class="row">
                      <div class="col-md-6 col-lg-3"> <span class="table-header-title">{{Config::get('constants.constant.currency')}}<?php echo (isset($freelncrsedv->profile->hourly_rate)?$freelncrsedv->profile->hourly_rate:0); ?> / hr</span> </div>
                      <div class="col-md-6 col-lg-3"> <span class="table-header-title">{{Config::get('constants.constant.currency')}}<?php echo (isset($freelncrsedv->earn)?$freelncrsedv->earn:0); ?>+ earned</span> </div>
                      <div class="col-md-6 col-lg-3"> <span class="table-header-title"><?php echo (isset($freelncrsedv->score)?$freelncrsedv->score:0) ?>% {{__('client.jb_suces')}}</span>
                        <div class="progress f-success">
                          <div class="progress-bar " role="progressbar" aria-valuenow="<?php echo (isset($freelncrsedv->score)?$freelncrsedv->score:0) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (isset($freelncrsedv->score)?$freelncrsedv->score:0) ?>%;"> </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-3"> <span class="table-header-title"><i class="fa fa-map-marker"></i><?php echo (isset($freelncrsedv->profile->country)?$freelncrsedv->profile->country:''); ?></span> </div>
                    </div>
                  </div>
                  <div class="f_buttons"> <a class="btn btn-primary btn-color" href="<?php echo url('postjob/to/invite/'.$freelncrsedv->user_id) ?>" style="margin-bottom: 20px;" target="_blank">Invite</a><br>
                    <button class="btn btn-secondary save_freelancer btn-color <?php if(isset($freelncrsedv->status) && $freelncrsedv->status == 1 ){ echo 'saved_job_active'; } ?>" data-ng_bind="<?php echo \Crypt::encryptString($freelncrsedv->user_id) ?>"><i class="fa fa-heart-o"></i>{{__('client.previous')}}</button>
                  </div>
                </div>
                  <?php
                  }
                  }
                  ?>
              </div>
              @if(sizeof($saved_freelancers)>0)
              <div calss="container ">
                  <?php
                   $url=url('find/freelancer/savedfreelancer');
                   ?>
                    @if ($saved_freelancers->lastPage() > 1)
                        <ul class="pagination saved_freelancer">
                            <li class="{{ ($saved_freelancers->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $saved_freelancers->url(1) }}">{{__('client.previous')}}</a>
                            </li>
                            @for ($i = 1; $i <= $saved_freelancers->lastPage(); $i++)
                                <li id="saved-{{$i}}" data-id="{{$i}}" class="{{ ($saved_freelancers->currentPage() == $i) ? ' active' : '' }}">
                                    <a  href="{{ $url}}{{ $saved_freelancers->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($saved_freelancers->currentPage() == $saved_freelancers->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $saved_freelancers->url($saved_freelancers->currentPage()+1) }}" >{{__('client.next')}}</a>
                            </li>
                        </ul>
                    @endif
                  </div>
                  @else
                  <h2 align="center">No data available</h2>
              @endif
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="reportAbuseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="float: left; font-size: 16px; font-weight: bold;">Report Freelancer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-success" id="msg_success" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Success!</strong>
          </div>
          <form action="#" method="post" id="frmReportAbuse" name="frmReportAbuse" onsubmit="return addReportAbuse();">
            <input type="hidden" id="client_id" name="client_id" value=""/>
            <input type="hidden" id="freelancer_id" name="freelancer_id" value=""/>
            <div class="form-group">
              <label for="description">Description:</label>
              <textarea class="form-control" rows="5" id="description" name="description" required="required"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/jscript">
      function reportAbuse(client_id, freelancer_id, description) {
        $('#reportAbuseModal').modal('show');
        $('#client_id').val(client_id);
        $('#freelancer_id').val(freelancer_id);
        $('#description').val(description);
      }
      function addReportAbuse() {
        $.ajax({
          type: "GET",
          url: "report/freelancer/",
          data: $('#frmReportAbuse').serialize(),
          success: function(data) {
            $('#msg_success').show();
            $('#frmReportAbuse')[0].reset();
            setTimeout(function(){
              window.location.href = window.location;
            }, 1000);
          }
        });
        return false;
      }
    </script>
    <script>

$(document).ready(function()
{  
  $('.js-example-basic-multiple').select2();
  $( function() {
             var maxValue=5;
                var totalStars=5;
                var $experience = $("#rating").rateYo({
                    numStars: totalStars,
                    maxValue: maxValue,
                    readOnly: false,
                    rating:'0'
                }).on("rateyo.change", function (e, data) {
                    var rating = data.rating;
                    $('#rate').val(rating);
                    $(this).next().text(rating);
                });

    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 100,
      values: [ 0, 99 ],
      slide: function( event, ui ) {
        $( "#amount" ).val(  + ui.values[ 0 ] + " -" + ui.values[ 1 ] );
        searchRequest();
      }
    });
    $( "#amount" ).val( + $( "#slider-range" ).slider( "values", 0 ) +
      " - " + $( "#slider-range" ).slider( "values", 1 ) );
 });
  $(document).on('click', '.pagination a', function(e) {
             e.preventDefault(); 
            if($('.pagination').hasClass('freelancer')){
              $(".freelancer.pagination li").removeClass('active');
            }
            else if($('.pagination').hasClass('hire_freelancer')){
              $(".hire_freelancer .pagination li").removeClass('active');
            }
            else if($('.pagination').hasClass('saved_freelancer')){
              $(". saved_freelancer.pagination li").removeClass('active');
            }
           
            var url = $(this).attr('href');
        
            $(this).parent().addClass('active');
            var search=$("#search").val();
            url=url+"&find="+search;
            getData(url);
           // window.history.pushState("", "", url);
     });
      
        $("#filterdata").on("keyup", function(e) {
            e.preventDefault();
            searchRequest();
        });  
        $("#filterdata").on("change", function(e) {
            e.preventDefault();
            searchRequest();
        });  
        $("#rating").on("click", function(e) {
            e.preventDefault();
            searchRequest();
        });         
});
function searchRequest(page=false){
      var url ="<?php echo url('serach/freelancer/')?>";
            $.ajax({
                url:url,
                type:"POST",
                data:$("#filterdata").serialize(),

            }).done(function (data) {
              $('#response').html(data);
            }).fail(function () {
                console.log('Articles could not be loaded.');
            });
}
function getData(url){
            $.ajax({
                url :url,
               // type:"POST",
                data:$("#filterdata").serialize(),
            }).done(function (data) {
              data = JSON.parse(data);
              if(data.response=="freelancer"){
                $('#response').html(data.freelancer);
              }
              else if(data.response=="savedfreelancer"){ 
                $('#saved_freelancer').html(data.saved_freelancer);
              }
              else {
                $('#past_hired').html(data.hired_freelancer);
              }
            }).fail(function () {
                console.log('could not be loaded.');
              });
 }

  </script>
@include ('include/footer_cl')
