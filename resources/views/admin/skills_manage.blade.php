@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="float_right">{{__('admin.freelancerCategory')}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div> <a href="{{ url('/add_skills') }}">
                    <button class="btn btn-default btn-round">{{__('admin.add_category')}}</button>
                </a> </div>
            <br/>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                @if(Session::has('message'))
                    <h5 class="message" align="center" style="color:#933f3f;">{{ __('admin.del_skill') }}</h5>
                @endif
                <thead>
                <tr>
                    <th>{{ __('admin.Name') }}</th>
                    <th>{{ __('admin.manage_subCategory') }}</th>
                    <th>{{ __('admin.Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($all_qouts as $qouts)
                    <tr>
                        @if(app()->getLocale()=='en')
                        <td><a href="{{ url('/edit')}}/{{$qouts->id}}/skill"><span>{{$qouts->freelancer_skill}}</span></a></td>
                        @else
                            <td><a href="{{ url('/edit')}}/{{$qouts->id}}/skill"><span>{{$qouts->ar_freelancer_skill}}</span></a></td>
                        @endif
                            <td><a class="btn btn-danger" href="{{ url("/view")}}/{{$qouts->id}}/manage_subSkills">{{__('admin.view_sub_skill')}}<i style="font-size: large;" class="fa fa-eye"></i></a></td>
                        <td>
                            <a href="{{url('del')}}/{{$qouts->id}}/skills" class="btn btn-danger btn-sm">{{ __('admin.Delete') }}</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){
        setTimeout(function(){
            $(".message").slideUp('slow');
        }, 5000);
    });
</script>
@include ('include/footer_admin')
