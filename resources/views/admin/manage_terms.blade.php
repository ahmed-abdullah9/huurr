@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Terms & Conditions</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content"> <br/>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_content"> <br />
                <form id="demo-form2" method="get" data-parsley-validate action="{{ url('save/terms')}}" class="form-horizontal form-label-left">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('admin.Description') }} <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea class="form-control" style="width: 1px; height: 8px; border: medium none; resize: none; opacity: 0;"></textarea>
                      <textarea class="jqte-test form-control" name="terms_conditions" id="terms_conditions" rows="3" required="required">
                        {!! $terms !!}
                      </textarea>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <a href="{{ url('manage/terms') }}" class="btn btn-primary">{{ __('admin.Cancel') }}</a>
                      <button type="submit" class="btn btn-success">{{ __('admin.Submit') }}</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@include ('include/footer_admin')

<link rel="stylesheet" href="<?php echo asset('/cl_assets'); ?>/css/jquery-te-1.4.0.css"/>
<script type="text/javascript" src="<?php echo asset('/cl_assets') ?>/js/jquery-te-1.4.0.min.js"></script>
<script type="text/javascript">
	$('.jqte-test').jqte();
	var jqteStatus = true;
	$(".status").click(function() {
		jqteStatus = jqteStatus ? false : true;
		$('.jqte-test').jqte({"status" : jqteStatus})
	});
</script>
