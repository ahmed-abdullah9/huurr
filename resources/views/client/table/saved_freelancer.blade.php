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
                    <button class="btn btn-secondary save_freelancer btn-color <?php if(isset($freelncrsedv->status) && $freelncrsedv->status == 1 ){ echo 'saved_job_active'; } ?>" data-ng_bind="<?php echo \Crypt::encryptString($freelncrsedv->user_id) ?>"><i class="fa fa-heart-o"></i>Unsave</button>
                  </div>
                </div>
                  <?php
                  }
                  }
                  ?>
              </div>
              @if(sizeof($saved_freelancers)>0)
              <div calss="container saved_freelancer">
                  <?php
                   $url=url('find/freelancer/savedfreelancer');
                   ?>
                    @if ($saved_freelancers->lastPage() > 1)
                        <ul class="pagination">
                            <li class="{{ ($saved_freelancers->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $saved_freelancers->url(1) }}">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $saved_freelancers->lastPage(); $i++)
                                <li class="{{ ($saved_freelancers->currentPage() == $i) ? ' active' : '' }}">
                                    <a href="{{ $url}}{{ $saved_freelancers->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($saved_freelancers->currentPage() == $saved_freelancers->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $saved_freelancers->url($saved_freelancers->currentPage()+1) }}" >Next</a>
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