<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
             @if(Session::has('message'))
                <h5 class="message" align="center" style="color:#933f3f;">{{ session('message') }}</h5>
            @endif
          <thead>
            <tr>
              <th>{{ __('admin.Name') }}</th>
              <th>{{ __('admin.Type') }}</th>
              <th>{{ __('admin.Email') }}</th>
              <th>{{ __('admin.MemberSince') }}</th>
              <th>Account Verification</th>
              <th>{{ __('admin.Action') }}</th>
              <th>Approve Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($freelancer)) {
                foreach ($freelancer as $client) {
                    ?>
                        <tr>
                            <td><?php echo $client->name; ?></td>
                            <td><?php echo $client->user_role; ?></td>
                            <td><?php echo $client->email; ?></td>
                            <td><?php echo date('M d,Y', strtotime($client->created_at)); ?></td>

                            <td>
                                <?php if ($client->is_verify==0) {
                        ?><a href="<?php echo url('/verify/user/'.$client->user_id) ?>">Verify Account</a><?php
                    } ?>
                                <?php if ($client->is_verify==1) {
                        ?><a href="<?php echo url('unverify/user/'.$client->user_id) ?>">Unverify Account</a><?php
                    } ?>
                            </td>

                            <td>
                                <?php if ($client->user_status==0) {
                        ?><a href="<?php echo url('/approve/user/'.$client->user_id) ?>">{{ __('admin.ApproveAccount') }}</a><?php
                    } ?>
                                <?php if ($client->account_suspended==0) {
                        ?><a href="<?php echo url('/suspend/user/'.$client->user_id) ?>">{{ __('admin.SuspendedAccount') }}</a><?php
                    } ?>
                                <?php if ($client->account_suspended==1) {
                        ?><a href="<?php echo url('activate/suspend/user/'.$client->user_id) ?>">{{ __('admin.ActivateSuspendedAccount') }}</a><?php
                    }if($client->user_status==2){ ?>
                    
                     <a href="{{url('/reject_freelancer')}}/<?php echo encrypt($client->user_id); ?>" > Reject..!  </a>
        <a href="{{url('/aprove_freelancer')}}/<?php echo encrypt($client->user_id); ?>"> Aproved..!  </a>
                    <?php
                        
                    }
                    ?>
                                 |   <a class="btn btn-primary" data-toggle="modal" data-target="#confirmModal" href="#" onclick="delUser({{$client->user_id}})">Delete</a>
                            </td>


                            <td>
                                <?php if ($client->user_status==1) {
                        ?><i class="fa fa-thumbs-up" aria-hidden="true"></i><?php
                    } ?>
                                <?php if ($client->user_status==0||$client->user_status==3||$client->user_status==2) {
                        ?><i class="fa fa-thumbs-down" aria-hidden="true"></i><?php
                    } ?>
                            </td>
                        </tr>
                    <?php
                }
            }
            ?>
          </tbody>
        </table>
        @if(sizeof($freelancer)>0)
              <div calss="container">
                  <?php
                   $url=url('manage/freelancer');
                   ?>
                    @if ($freelancer->lastPage() > 1)
                        <ul class="pagination">
                            <li class="{{ ($freelancer->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $freelancer->url($freelancer->currentPage()-1) }}">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $freelancer->lastPage(); $i++)
                                <li class="{{ ($freelancer->currentPage() == $i) ? ' active' : '' }}">
                                    <a href="{{ $url}}{{ $freelancer->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($freelancer->currentPage() == $freelancer->lastPage()) ? ' disabled' : '' }}">
                                <a href="{{ $url}}{{ $freelancer->url($freelancer->currentPage()+1) }}" >Next</a>
                            </li>
                        </ul>
                    @endif
                  </div>
                  @else
                  <h2 align="center">No data available</h2>
             @endif