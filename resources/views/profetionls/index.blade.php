@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{ __('admin.Professionals') }} </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div > <a href="{{ url('/profetionls') }}/create">
          <button class="btn btn-default btn-lg">{{ __('admin.AddNewProfessionals') }}</button>
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
					<td><a href="{{ url('/profetionls') }}/{{ $cat->profetional_id }}/edit">{{ $cat->name }}</a></td>
					<td>{{ $cat->description }}</td>
					<td>
					<form method="POST" action="{{ url('/profetionls') }}/{{ $cat->profetional_id }}">

						{{ csrf_field() }}
						{{ method_field('DELETE') }}

							<button type="submit" class="btn btn-danger btn-sm">{{ __('admin.Delete') }}</button>
						
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

