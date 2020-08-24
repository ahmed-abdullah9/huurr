@include ('include/header_cl')

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="table-heading x_title">
      <h2 class="float_right">{{__('admin.post_job')}}</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="form-group">
        <form action="{{ url('/select/type') }}" method="POST">
          {{ csrf_field() }}
            <section class="form-section">
              <h4 class="text-info">{{__('admin.what_type_job')}}</h4>
              <div class="checkbox">
                <label class="table-header-colums-title">
                  <input onclick="jobType(this.value)" class="c-radio" type="radio" name="job_type" value="new-job" required checked>
                  <span class="custom-radio"></span> {{__('admin.new_job')}} </label>
              </div>
              <?php if(!empty($jobs)){ ?>
              <div class="checkbox">
                <label class="table-header-title">
                  <input onclick="jobType(this.value)" class="c-radio" type="radio" name="job_type" value="re-usejobe" required>
                  <span class="custom-radio"></span> {{__('admin.prev_job')}} </label>
              </div>
              <div class="checkbox col-md-12">
              <select name="job_id" class="form-control col-md-4 previous_jobs float_right" style="color:#000;width:200px;display: none;">
                <option value="">{{__('admin.select_prev')}}</option>
              <?php foreach($jobs as $jobd){ ?>
                <option value="<?php echo $jobd->job_id ?>"><?php echo $jobd->job_title; ?></option>
                <?php } ?>
              </select>
              </div>
              <?php } ?>
              <button class="btn btn-info btn-color">{{__('admin.next')}}</button>
            </section>
          </form>
      </div>
    </div>
  </div>
</div>
<script>
  function jobType(job_type){
       if(job_type=='re-usejobe'){
          $(".previous_jobs").show();
       }
       else{
           $(".previous_jobs").hide();
       }
  }
</script>
@include ('include/footer_cl')
