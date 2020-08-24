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
                      <div class="col-md-6 col-lg-3"> <span class="table-header-title">{{Config::get('constants.constant.currency')}}<?php echo (isset($freelncr->earn)?$freelncr->earn:''); ?>+ earned</span> </div>
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
                          <button  class="btn btn-primary btn-color"   >Message</button>
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
                   <div calss="container hire_freelancer">
                   <?php
                   $url=url('find/freelancer/hired_freelancers');
                   ?>
      
                      @if ($hired_freelancers->lastPage() > 1)
                        <ul class="pagination">
                            <li class="{{ ($hired_freelancers->currentPage() == 1) ? 'disabled' : '' }}">
                                <a href="{{ $url}}{{ $hired_freelancers->url(1) }}">Previous</a>
                            </li>
                        
                            @for ($i = 1; $i <= $hired_freelancers->lastPage(); $i++)
                      
                                <li class="{{ ($hired_freelancers->currentPage() == $i) ? 'active' : '' }}">
                                    <a href="{{ $url}}{{ $hired_freelancers->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($hired_freelancers->currentPage() == $hired_freelancers->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $hired_freelancers->url($hired_freelancers->currentPage()+1) }}" >Next</a>
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