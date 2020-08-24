@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{ __('admin.Categories2') }} </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="qouts_btn"> <a href="{{ url('/qouts') }}">
          <button class="btn btn-default btn-lg">{{ __('admin.AddNewQouts') }}</button>
          </a> </div>
        <br/>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          @if(Session::has('message'))
            <h5 class="message" align="center" style="color:#933f3f;">{{ __('admin.del_qouts') }}</h5>
          @endif
          <thead>
            <tr>
              <th>{{ __('admin.title') }}</th>
              <th>{{ __('admin.image') }}</th>
              <th>{{ __('admin.Action') }}</th>
            </tr>
          </thead>
          <tbody>
          @foreach($all_qouts as $qouts)
              <tr>
                <td><a href="{{ url('/edit')}}/{{$qouts->id}}/qouts"><span>{{$qouts->title}}</span></a></td>
         <td>        <img src="{{url('public/images/qouts')}}/{{$qouts->image}}" style="width: 100px;height: 80px;" alt="image"/></td>
                <td>
                  <a href="{{url('del')}}/{{$qouts->id}}/qouts" class="btn btn-danger btn-sm">{{ __('admin.Delete') }}</a>

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
