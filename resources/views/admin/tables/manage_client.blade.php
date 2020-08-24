<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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