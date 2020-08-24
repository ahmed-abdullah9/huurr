@include ('include/header_admin')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{ __('admin.Clients') }}</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content"> <br/>
        @if (session('status'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('status') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
                    @endif
                    <br>
            <form class="navbar-form" action="<?php url('/manage/client') ?>" id ="filterdata"method="get">
                <div class="input-group add-on" style="width: 100%;">
                <input class="form-control float_right" style="width: 60%; color: #000;border-radius: 10px;" value="<?php echo (isset($_REQUEST['search_keyword'])?$_REQUEST['search_keyword']:'') ?>"
                <input class="form-control float_right" id= "search" style="width: 60%; color: #000;border-radius: 10px;" value="<?php echo (isset($_REQUEST['search_keyword'])?$_REQUEST['search_keyword']:'') ?>"
                style="color:#000;" placeholder="search by name" name="search_keyword" id="search_keyword" type="text">
               
                <button class="btn btn-round pull-left btn-postion-abs btn-color" type="submit">{{ __('freelancer.Search') }}</button>
                </div>
          </form>
        <div id="response">
            <table id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>{{ __('admin.Name') }}</th>
                <th>{{ __('admin.Type') }}</th>
                <th>{{ __('admin.Email') }}</th>
                <th>{{ __('admin.MemberSince') }}</th>
                <th>{{ __('admin.Action') }}</th>
                </tr>
            </thead>
            <tbody>
                <?php
                                    if(!empty($clients))
                                    {
                                        foreach ($clients as $client) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $client->name; ?></td>
                                                    <td><?php echo $client->user_role; ?></td>
                                                    <td><?php echo $client->email; ?></td>
                                                    <td><?php echo date('M d,Y',strtotime($client->created_at)); ?></td>
                                                    <td>
                                                        <?php if($client->account_suspended==0) { ?><a href="<?php echo url('/suspend/user/'.$client->user_id) ?>">{{ __('admin.SuspendedAccount') }}</a><?php } ?>
                                                        <?php if($client->account_suspended==1) { ?><a href="<?php echo url('activate/suspend/user/'.$client->user_id) ?>">{{ __('admin.ActivateSuspendedAccount') }}</a><?php } ?>
                                                            | <a class="btn btn-primary" data-toggle="modal" data-target="#confirmModal" href="#" onclick="delUser({{$client->user_id}})">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
            </tbody>
            </table>
            @if(sizeof($clients)>0)
                  <div calss="container ">
                  <?php
                   $url=url('manage/client');
                   ?>
                    @if ($clients->lastPage() > 1)
                        <ul class="pagination clients">
                            <li class="{{ ($clients->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $clients->url(($clients->currentPage()-1)) }}">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $clients->lastPage(); $i++)
                                <li   id="clients-{{$i}}" data-id="{{$i}}" class="{{ ($clients->currentPage() == $i) ? ' active' : '' }}">
                                    <a href="{{ $url}}{{ $clients->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($clients->currentPage() == $clients->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $clients->url($clients->currentPage()+1) }}" >Next</a>
                            </li>
                        </ul>
                    @endif
                  </div>
                  @else
                  <h2 align="center">No data available</h2>
             @endif
        </div>  
      </div>
    </div>
  </div>
<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="font-size: 18px;" class="modal-body">
                Are You Sure? You Want to delete it...!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>
    function delUser(user_id){
           var html='';
           html+='<a href="'+BASE_URL+'/delete/user/'+user_id+'" class="btn btn-primary">Yes</a>';

           $('.modal-footer').append(html);
    }

$(document).ready(function()
{
  $(document).on('click', '.pagination a', function(e) {
             e.preventDefault(); 
              $(".freelancer.pagination li").removeClass('active');
              var url = $(this).attr('href');
              $(this).parent().addClass('active');
              var search=$("#search").val();
              url=url+"&search_keyword="+search;
              getData(url);
            
            window.history.pushState("", "", url);
        });
        function getData(url){
            $.ajax({
                url :url,
                type:"POST",
                data:$("#filterdata").serialize(),
            }).done(function (data) {
                $('#response').show().html(data);
            }).fail(function () {
                console.log('could not be loaded.');
            });
        }
})
</script>
@include ('include/footer_admin')
