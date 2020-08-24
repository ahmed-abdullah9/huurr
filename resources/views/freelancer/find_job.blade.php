@include ('include/header_fr')
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2 class="table-heading">{{ __('freelancer.FindWork') }}</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <span id="site_url" data-site_href="<?php echo url('/find/search') ?>"></span>
      <form class="navbar-form" action="<?php url('/find/work') ?>" method="get">
            <div class="input-group add-on" style="width: 100%;">
              <input class="form-control" style="width: 100%; color: #000" value="<?php echo (isset($_REQUEST['search_keyword'])?$_REQUEST['search_keyword']:'') ?>"
			  style="color:#000;" placeholder="{{ __('freelancer.SearchMSG') }}" name="search_keyword" id="search_keyword" type="text">
              <input type="hidden" name="offset" value="0">
              <button class="btn btn-round btn-default btn-color" type="submit">{{ __('freelancer.Search') }}</button>
            </div>
          </form>
      <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead class="table-header-colums-title">
          <tr>
            <th>{{ __('freelancer.ProjectName') }}</th>
            <th>{{ __('freelancer.Budget') }}</th>
            <th>{{ __('freelancer.FreelancerNeeded') }}</th>
            <th>{{ __('freelancer.Posted') }}</th>
            <th>{{ __('freelancer.SeeMore') }}</th>
            <th>{{ __('freelancer.Work') }}</th>
            <th>{{ __('freelancer.Save') }}</th>
          </tr>
        </thead>
        <tbody class="jobpost_job">
                  
        </tbody>
      </table>
    </div>
  </div>
  <div class="loaderjob" style="display: none;">
  <img style="width: 200px;" src="<?php echo asset('public/images/loader.gif'); ?>" />
</div>
</div>
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