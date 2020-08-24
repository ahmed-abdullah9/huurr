@include ('include/header_admin')
    <div class="">
    <div class="page-title">

      @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">{{ __('admin.Go') }}</button>
            </span> </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="">
        <div class="x_panel">
          <div class="x_title">
            <h2>{{ __('admin.Admin') }} </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <br />
          <form enctype="multipart/form-data" class="form-horizontal form-label-left input_mask" action="<?php echo url('/'); ?>/update_option_new" method="post">
            <input type="hidden" name="option_id" value="<?php echo ((isset($option->option_id))?$option->option_id:'') ?>">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="twitter" placeholder="Twitter Url" value="<?php echo ((isset($option->twitter))?$option->twitter:'') ?>">
              <span class="fa fa-twitter form-control-feedback left" aria-hidden="true"></span> </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control" id="inputSuccess3" name="facebook" placeholder="Facebok Url" value="<?php echo ((isset($option->facebook))?$option->facebook:'') ?>">
              <span class="fa fa-facebook form-control-feedback right" aria-hidden="true"></span> </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="google" placeholder="Google Url" value="<?php echo ((isset($option->google))?$option->google:'') ?>">
              <span class="fa fa-google form-control-feedback left" aria-hidden="true"></span> </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control" id="inputSuccess5" name="linkedin" placeholder="Linked In" value="<?php echo ((isset($option->linkedin))?$option->linkedin:'') ?>">
              <span class="fa fa-linkedin form-control-feedback right" aria-hidden="true"></span> </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="phone" placeholder="Phone" value="<?php echo ((isset($option->phone))?$option->phone:'') ?>">
              <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span> </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control" name="email" placeholder="Email ID" value="<?php echo ((isset($option->email))?$option->email:'') ?>">
              <span class="fa fa-email form-control-feedback right" aria-hidden="true"></span> </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label>{{ __('admin.AttendedDateFrom') }}</label>
              <input type="number" class="form-control has-feedback-left" name="date_from" placeholder="Attended Date From" value="<?php echo ((isset($option->date_from))?$option->date_from:'') ?>">
              <span class="fa fa- form-control-feedback left" aria-hidden="true"></span> </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label>{{ __('admin.AttendedDateTo') }}</label>
              <input type="number" class="form-control" name="date_to" placeholder="Attended Date To" value="<?php echo ((isset($option->date_to))?$option->date_to:'') ?>">
              <span class="fa fa-email form-control-feedback right" aria-hidden="true"></span> </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label>{{ __('admin.image') }}</label>
              <input type="file" class="form-control" name="image">
              <span class="fa fa-email form-control-feedback right" aria-hidden="true"></span>

            </div>
            <div>
              <figure>
                <img src="{{url('public/images/qouts/background_images')}}/{{$option->image}}" width="100" height="100" alt="image"/>
                <figcaption>Background_image</figcaption>
              </figure>
             </div>
          <div class="form-group col-md-9 col-sm-9 col-xs-12">
            <label for="fee">Job Fee (%)</label>
            <input value="<?php echo ((isset($option->job_fee))?$option->job_fee:'') ?>" type="number" min="1" id="fee" class="form-control" name="job_fee">
          </div>
          <div class="form-group col-md-9 col-sm-9 col-xs-12">
            <label for="fee">VAT (%)</label>
            <input value="<?php echo ((isset($option->vat))?$option->vat:0) ?>" type="number" min="1" id="fee" class="form-control" name="vat">
          </div>
          <div class="form-group col-md-9 col-sm-9 col-xs-12">
            <label for="terms">Terms and Conditions</label>
            <textarea id="terms" class="form-control" name="terms">
                  <?php echo ((isset($option->terms))?$option->terms:'') ?>
            </textarea>
          </div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">{{ __('admin.Update') }}</button>
                
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
   
    <!-- /footer content --> 
  </div>

@include ('include/footer_admin')

