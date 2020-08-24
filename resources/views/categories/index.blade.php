@include ('include/header_admin')

<?php if(isset($language) && $language=='ar') { ?>
  <style>
    .x_title h2{
        float:right !important;
    }
  </style>
<?php } ?>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{ __('admin.Categories') }} </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div style=""> <a href="{{ url('/categories/create') }}">
          <button class="btn btn-default btn-lg">{{ __('admin.AddNewCategory') }}</button>
          </a> </div>
        <br/>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>{{ __('admin.Name') }}</th>
              <th>{{ __('admin.Description') }}</th>
              <th>{{ __('admin.Action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($all_categories as $cat)
							<tr>
								<td><a href="{{ url('/categories')}}/{{ $cat->category_id }}/edit">{{ $cat->name }}</a></td>
								<td>{{ $cat->description }}</td>
								<td>
								<form method="POST" action="{{ url('/categories')}}/{{ $cat->category_id }}">

									{{ csrf_field() }}
									{{ method_field('DELETE') }}

										<button type="submit" class="btn btn-round  btn-sm">{{ __('admin.Delete') }}</button>
									<a href="{{url('add/fr/skills')}}/{{encrypt($cat->category_id)}}" class="btn btn-round btn-sm">{{ __('admin.add_skills') }}</a>
                                    <a href="{{url('view/fr/skills')}}/{{encrypt($cat->category_id)}}" class="btn btn-round  btn-sm">{{ __('admin.view_skills') }}</a>
									</form>	
								</td>
							</tr>
						@endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@include ('include/footer_admin')
