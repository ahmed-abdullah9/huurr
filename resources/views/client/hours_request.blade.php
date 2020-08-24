@include('include.header_cl')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead class="table-header-colums-title">
                <tr>
                    <th>
                        Freelancer
                    </th>
                    <th>
                        Job
                    </th>
                    <th>
                        hours
                    </th>
                    <th>
                        From
                    </th>
                    <th>
                        To
                    </th>
                    <th>
                        Request at
                    </th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table-header-title">
                   @foreach($request_info as $req)
                       <tr>
                           <td>
                               {{$req->freelancer_name}}
                           </td>
                           <td>
                               {{$req->job_title}}
                           </td>
                           <td>
                               {{$req->hours}}
                           </td>
                           <td>
                               {{ date("d M Y", strtotime($req->request_from)) }}
                           </td>
                           <td>
                               {{ date("d M Y", strtotime($req->request_to)) }}

                           </td>
                           <td>
                               {{ date("d M Y", strtotime($req->created_at)) }}
                           </td>
                           <td>
                               @if($req->is_accept==0)
                               <button type="button" class="btn btn-primary btn-color" onclick="window.location.href='<?php echo url('/verifyCheckout/'); ?>/<?php echo $req->proposal_id; ?>/<?php echo $req->freelancer_id; ?>'">Accept</button>
                               @else
                                   Accepted
                               @endif
                           </td>
                       </tr>
                       @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('include.footer_cl')