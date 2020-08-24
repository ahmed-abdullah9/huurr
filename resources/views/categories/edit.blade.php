@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{ __('admin.Categories') }} </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content"> <br/>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_content"> <br />
                <form id="demo-form2" method="post" data-parsley-validate action="{{ url('/categories') }}/{{ $category->category_id }}" class="form-horizontal form-label-left">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('admin.CategoryName') }} <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="name" name="name" value="{{ $category->name }}" required class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('admin.Select Parent') }}</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name="parent_id" id="parent_id" class="form-control">
                          <option value="0">{{ __('admin.--Select Parent--') }}</option>
                            @foreach($all_categories as $cat)
                              
                             
                            <option 
                                 @if($cat->category_id == $category->parent_id)
                                selected="selected"
                              @endif
                              value="{{ $cat->category_id }}">{{ $cat->name }}
                              </option>
                            @endforeach
                          </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('admin.Description') }} <span class="required">*</span> </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea class="form-control"  name="description" id="description"  rows="3">{{ $category->description }}</textarea>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <a href="{{ url('categories') }}" class="btn btn-primary">{{ __('admin.Cancel') }}</a>
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
