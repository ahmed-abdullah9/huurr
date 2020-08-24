<?php     if(Session::get('user_role')=='client')      {       ?>
@include ('include/header_cl')
  <?php }else{ ?>
@include ('include/header_fr')
  <?php } ?>

<?php
/*echo '<prE>';
print_r($proposals);
echo '</pre>';*/
?>
<div class="">
    <div class="page-title">
      <div class="title_left">

        <a href="{{url()->previous()}}" class="btn btn-round btn-color pull-left" style="display: inline;"><i class="glyphicon glyphicon-arrow-left"></i>Go Back</a>
      </div>
      <!-- <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
            </span> </div>
        </div>
      </div> -->
    </div>

    <div class="row">
      <h2 class="table-header-title" style="padding-left: 2%;"> Submited  Propsal </h2>
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 class="table-heading">{{ $jobs->job_title }}</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="col-md-6 col-sm-8 col-xs-12  table-responsive">
              <table class="table table-hover">
                <thead class="table-header-colums-title">
                  <tr>
                    <th>Price</th>
                    <th>Start Date</th>
                  </tr>
                </thead>
                <tbody class="table-header-title">
                <tr>
                  <td> {{Config::get('constants.constant.currency')}}{{$proposals->bid_amount }}</td>
                  <td>{{ date("F d Y", strtotime($jobs->created_at)) }}</td>
                </tr>
                </tbody>
              </table>
              @if(Session::get('user_role')=='client')
                @include('jobs.cl_view_proposal')
                @else
              @include('jobs.fr_view_proposal')
                @endif
            </div>
            <?php
                    if(isset($jobs->attachments)){
            $jobs_attachment=App\Http\Controllers\HelperController::maybe_unserialize($jobs->attachments);
            }
            ?>
            <!-- start project-detail sidebar -->
            <div class="col-md-offset-1 col-md-3 col-sm-3 col-xs-12">
              <section class="panel">
                <div class="x_title">
                  <h2 class="table-header-colums-title">Project Description</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                  <h3 class="green table-header-title"><i class="fa fa-file-o"></i> Details</h3>
                  <p class="table-header-title">
                @if(isset($jobs_attachment))
                  @foreach($jobs_attachment as $attach)
                   <a target="_blank" href="{{asset('/')}}/{{$attach}}">
                     <figure>
                       <figcaption>
                         {{ $jobs->job_description }}
                       </figcaption>
                     </figure>

                   </a>

                      @endforeach
                @endif

                  </p>
                  <br />
                  <div class="project_detail">
                  <p>{{$jobs->job_description}}</p>
                    <p class="title table-header-title">Required Skills </p>
                    <p><?php echo $job_skills; ?></p>
                  </div>
                  <br />
                </div>
              </section>
            </div>
            <!-- end project-detail sidebar --> 
            
          </div>
        </div>
      </div>
    </div>
  </div>

@include ('include/footer_fr')
