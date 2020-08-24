@include ('include/header_admin')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{ __('admin.Professionals') }} </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content"> <br/>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_content"> <br />
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"  method="POST" action="{{ url('/profetionls') }}">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('admin.ProfessionalsName') }}<span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text"  id="name" name="name" value="{{ old('name') }}" required class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('admin.SelectParent') }}</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name="category_id" id="category_id" class="form-control" required>
                          <option value="">{{ __('admin.--SelectCategory--') }}</option>
                            @foreach($all_categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('admin.Description') }} <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <a href="{{ url('profetionls') }}" class="btn btn-primary">{{ __('admin.Cancel') }}Cancel</a>
                      <button type="submit" class="btn btn-success">{{ __('admin.Submit') }}Submit</button>
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
