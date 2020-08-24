@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>{{__('admin.ManageTeam')}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="qouts_btn"> <a href="{{ url('/add_member') }}">
                    <button class="btn btn-default btn-round">{{__('admin.add_team')}}</button>
                </a> </div>
            <br/>
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                @if(Session::has('message'))
                    <h5 class="message" align="center" style="color:#933f3f;">{{Session::get('message')}}</h5>
                @endif
                <thead>
                <tr>
                    <th>{{ __('admin.Name') }}</th>
                    <th>{{ __('admin.designation') }}</th>
                    <th>{{ __('admin.Action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teams as $team)
                    <tr>
                        @if(app()->getLocale()=='en')
                            <td><a href="{{ url('edit')}}/{{$team->id}}/team"><span>{{$team->name}}</span></a></td>
                        @else
                            <td><a href="{{ url('edit')}}/{{$team->id}}/team"><span>{{$team->ar_name}}</span></a></td>
                        @endif
                        <td>
                            @if ( app()->getLocale() == 'ar' )   {{$team->ar_designation}}  @else     {{$team->designation}}     @endif
                        </td>
                        <td>
                            <a href="{{url('del')}}/{{$team->id}}/member" class="btn btn-danger btn-sm">{{ __('admin.Delete') }}</a>

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
