@include ('include/header_admin')
<div class="col-md-12 col-sm-12 col-xs-12">
    @if(Session::has('info'))
        <h2 align="center" style="display: inline;display: block;" class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('info') }}
        </h2>
    @elseif(Session::has('message'))
        <h2 align="center" style=" display: inline;display: block;" class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
        </h2>
    @endif
    <div class="x_panel">
        <div class="x_title">
            <h2>Skills Management </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div style=""> <a href="{{ url('/add/fr/skills/') }}/{{encrypt($parent_id)}}">
                    <button class="btn btn-round">{{ __('admin.AddNewCategory') }}</button>
                </a> </div>
            <br/>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>{{ __('admin.Name') }}</th>
                    <th>{{ __('admin.Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($skills as $skill)
                    <tr>
                        <td>{{$skill->name}}</td>
                        <td><a class="btn  btn-round" href="{{url('/edit/fr/skills')}}/{{encrypt($skill->category_id)}}">Edit</a>
                            <a class="btn  btn-round" href="{{url('/del/fr/skills')}}/{{encrypt($skill->category_id)}}">delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include ('include/footer_admin')
