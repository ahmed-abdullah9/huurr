@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="float_right">{{__('admin.fr_skills')}}</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div>

                <a href="{{ url('/add_sub_skills') }}/{{$id}}">
                    <button class="btn btn-default btn-round">{{__('admin.add_sub_skill')}}</button>
                </a>

            </div>
            <br/>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                @if(Session::has('message'))
                    <h5 class="message" align="center" style="color:#933f3f;">{{ __('admin.del_skill') }}</h5>
                @endif
                <thead>
                <tr>
                    <th>{{ __('admin.sub_Skill') }}</th>

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
                            <td>
                            <a href="{{url('del')}}/{{$qouts->id}}/sub_skills" class="btn btn-danger btn-sm">{{ __('admin.Delete') }}</a>

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
