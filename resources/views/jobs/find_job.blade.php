@include ('include/header_fr')
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2 class="table-heading" style="color:#666666;padding: 2px;">{{ __('freelancer.FindWork') }}</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <span id="site_url" data-site_href="<?php echo url('/find/search') ?>"></span>
      <form class="navbar-form" action="<?php url('/find/work') ?>" id ="filterdata"method="get">
            <div class="input-group add-on" style="width: 100%;">
              <input class="form-control float_right" id= "search" style="width: 60%; color: #000;border-radius: 10px;" value="<?php echo (isset($_REQUEST['search_keyword'])?$_REQUEST['search_keyword']:'') ?>"
			  style="color:#000;" placeholder="{{ __('freelancer.SearchMSG') }}" name="search_keyword" id="search_keyword" type="text">
              <input type="hidden" name="offset"  value="0">
              <button class="btn btn-round pull-left btn-postion-abs btn-color" type="submit">{{ __('freelancer.Search') }}</button>
            </div>
          </form>
          <div class="jobpost_job">
          <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead class="table-header-colums-title">
          <tr>
            <th>{{ __('freelancer.ProjectName') }}</th>
              <th>{{__('freelancer.skills_required')}}</th>
              <th>{{__('freelancer.job_type')}}</th>
            <th>{{ __('freelancer.Budget') }}({{Config::get('constants.constant.currency')}})</th>
            <th>{{ __('freelancer.Posted') }}</th>
            <th>{{__('freelancer.action')}}</th>
          </tr>
        </thead>
        <tbody class=" table-header-title" style="color:#666666;">
        <?php
                     //print_r($searches);
                    //  exit;
                 
                  if(!empty($searches))
                  {
                    //   echo "<pre>";
                    echo '<pre>';
                    
                      
                  foreach($searches as $search)
                  { 
                
                      ?>

        <tr>
            <td><a  href="{{url('/submit/proposal/')}}/{{Crypt::encryptString($search->job_id)}}" class="readmore table-header-title">{{$search->job_title}}</a></td>
            <td>{{$search->job_skills}}</td>
            <td>{{$search->pp_count->job_time_type}}</td>
            <td >{{$search->budget}}</td>
            <td>{{$search->created_at }} {{__('client.ago')}} </td>
            <td>
            <a class="btn btn-round btn-default btn-color" href="{{url('/submit/proposal/')}}/{{Crypt::encryptString($search->job_id)}}">{{__("freelancer.submit_proposal")}}</a>
           <button class="btn btn-round btn-default save_job btn-color" data-ng_bind="{{Crypt::encryptString($search->job_id)}}">{{__("freelancer.save_project")}}</button>
            </td>
          
            
          </tr>
                <?php }
                    }?>
        </tbody>
      </table>
      @if(sizeof($searches)>0)
                  <div calss="container ">
                  <?php
                   $url=url('find/work');
                   ?>
                    @if ($searches->lastPage() >= 1)
                        <ul class="pagination searches">
                            <li class="{{ ($searches->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $searches->url(($searches->currentPage()-1)) }}">{{__('client.previous')}}</a>
                            </li>
                            @for ($i = 1; $i <= $searches->lastPage(); $i++)
                                <li   id="searches-{{$i}}" data-id="{{$i}}" class="{{ ($searches->currentPage() == $i) ? ' active' : '' }}">
                                    <a href="{{ $url}}{{ $searches->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($searches->currentPage() == $searches->lastPage()) ? 'disabled' : '' }}">
                                <a  href="{{ $url}}{{ $searches->url($searches->currentPage()+1) }}"    >Next</a>
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
  <div class="loaderjob" style="display: none;">
  <img style="width: 200px;" src="<?php echo asset('public/images/loader.gif'); ?>" />
</div>
</div>
<script>
$(document).ready(function()
{
  $(document).on('click', '.pagination a', function(e) {
             e.preventDefault(); 
              $(".freelancer.pagination li").removeClass('active');
              var url = $(this).attr('href');
              $(this).parent().addClass('active');
              var search=$("#search").val();
              url=url+"&find="+search;
              getData(url);
            
            window.history.pushState("", "", url);
        });
        function getData(url){
            $.ajax({
                url :url,
                type:"POST",
                data:$("#filterdata").serialize(),
            }).done(function (data) {
              // console.log(data);
             // data = JSON.parse(data);
              // if(data.response=="freelancer"){
                $('.jobpost_job').show().html(data);
              // }
              // else if(data.response=="savedfreelancer"){ 
              //   $('#saved_freelancer').html(data.saved_freelancer);
              // }
              // else {
              //   $('#past_hired').html(data.hired_freelancer);
              // }
            }).fail(function () {
                console.log('could not be loaded.');
            });
        }
})
</script>
@include ('include/footer_fr')
<style type="text/css">
  .loaderjob{
    display: none;
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    background: #ffffff86;
    z-index: 99999;
}
.loaderjob img {
    width: 80px;
    height: 80px;
    margin: 150px auto;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
</style>