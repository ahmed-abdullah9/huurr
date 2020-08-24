@if(Session::get('user_role')=='admin')
@include ('include.header_admin')
@elseif(Session::get('user_role')=='client')
    @include ('include.header_cl')
    @else
    @include ('include.header_fr')
    @endif

@if($role=='freelancer')
<div class="container">
    <div style="width: 40%;margin: auto;">
    <figure>
        <img style="height: 150px;width: 230px;" class="img-thumbnail" src="{{url('/')}}/{{isset($profile->profile_image)?$profile->profile_image:''}}" alt="{{isset($profile->user_nicename)?$profile->user_nicename:'user image'}}">
        <figcaption style="font-size: 18px;">
            {{isset($profile->user_nicename)?$profile->user_nicename:''}} {<small>{{$role}}</small>}
        </figcaption>
    </figure>
        </div>

    <div style="margin-top: 20px;" class="row">
        <div class="col-md-4 col-xs-12">
            <h3 align="center">User Profile Info</h3>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>First Name</th>
                        <td>{{isset($profile->name)?$profile->name:''}}</td>

                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{isset($profile->last_name)?$profile->last_name:''}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{isset($profile->email)?$profile->email:''}}</td>
                    </tr>
                    <tr>
                        <th>Register Date</th>
                        <td>{{isset($profile->created_at)?$profile->created_at:''}}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>{{isset($profile->country)?$profile->country:''}}</td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td>{{isset($profile->state)?$profile->state:''}}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{isset($profile->city)?$profile->city:''}}</td>
                    </tr>
                    <tr>
                        <th>Freelancer Category</th>
                        <td>{{isset($profile->freelancer_skill)?$profile->freelancer_skill:''}}</td>
                    </tr>
                    {{--<tr>--}}
                        {{--<th>Professional Skills</th>--}}
                        {{--<td>{{isset($profile->profetional_skills)?$profile->profetional_skills:''}}</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <th>Hourly Rate</th>
                        <td>{{Config::get('constants.constant.currency')}}{{isset($profile->hourly_rate)?$profile->hourly_rate:''}}</td>
                    </tr>
                    <tr>
                        <th>Total Proposals</th>
                        <td>{{$total_purposal}}</td>
                    </tr>
                    <tr>
                        <th>Hire Times</th>
                        <td>
                            {{$hire_fre}}
                        </td>
                    </tr>
                    <tr>
                        <th>Completed_jobs</th>
                        <td>
                            {{$completed_jobs}}
                        </td>
                    </tr>
                    <tr>
                        <th>Claim jobs</th>
                        <td>
                            {{$claim_jobs}}
                        </td>
                    </tr>
                    <tr>
                        <th>Total Earning</th>
                        <td>{{Config::get('constants.constant.currency')}}{{$total_earnings}}</td>
                    </tr>
                    <tr>
                        <th>Claim amount</th>
                        <td>{{Config::get('constants.constant.currency')}}{{$total_calim}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <h3 align="center">Job Details</h3>
            <div class="table-responsive">
                <table class="table">
                   <thead>
                   <tr>
                   <th>Client Name</th>
                   <th>Email</th>
                   <th>Job Title</th>
                   <th>Job Skills</th>
                   <th>Amount</th>
                   <th>Hire Date</th>
                   <th>Job Completed</th>
                   </tr>
                   </thead>
              <tbody>
              @foreach($info as $info)
              <tr>
              <td>{{$info->client_name}}</td>
              <td>{{isset($info->email)?$info->email:''}}</td>
              <td>{{$info->job_title}}</td>
              <td>Skills</td>
              <td>{{Config::get('constants.constant.currency')}}{{$info->client_pay_to_admin}}</td>
              <td>{{isset($info->created_at)?$info->created_at:''}}</td>
              <td>{{isset($info->created_at)?$info->created_at:''}}</td>
              </tr>
                  @endforeach
             </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@else
    <div class="container">
        <div style="width: 40%;margin: auto;">
            <figure>
                <img style="height: 150px;width: 230px;" class="img-thumbnail" src="{{asset('public/images/images.jpg')}}">
                <figcaption style="font-size: 18px;">
                    {{isset($profile->user_nicename)?$profile->user_nicename:'user image'}} {<small>{{$role}}</small>}
                </figcaption>
            </figure>
        </div>

        <div style="margin-top: 20px;" class="row">
            <div class="col-md-4 col-xs-12">
                <h3 align="center">User Profile Info</h3>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>First Name</th>
                            <td>{{isset($profile->name)?$profile->name:''}}</td>

                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>{{isset($profile->last_name)?$profile->last_name:''}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$profile->email}}</td>
                        </tr>
                        <tr>
                            <th>Register Date</th>
                            <td>{{$profile->created_at}}</td>
                        </tr>

                        <tr>
                            <th>Hire Times</th>
                            <td>
                                {{$hire_fre}}
                            </td>
                        </tr>
                        <tr>
                            <th>Completed_jobs</th>
                            <td>
                                {{$completed_jobs}}
                            </td>
                        </tr>
                        <tr>
                            <th>Claim jobs</th>
                            <td>
                                {{$claim_jobs}}
                            </td>
                        </tr>
                        <tr>
                            <th>Total Spend</th>
                            <td>{{Config::get('constants.constant.currency')}}{{$total_earnings}}</td>
                        </tr>
                        <tr>
                            <th>Claim amount</th>
                            <td>{{Config::get('constants.constant.currency')}}{{$total_calim}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-8 col-xs-12">
                <h3 align="center">Job Details</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Freelancer Name</th>
                            <th>Email</th>
                            <th>Job Title</th>
                            <th>Job Skills</th>
                            <th>Amount</th>
                            <th>Hires</th>
                            <th>Hire Date</th>
                            <th>Job Completed</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($info as $info)
                            <tr>
                                <td>{{$info->freelancer_name}}</td>
                                <td>{{$info->freelancer_email}}</td>
                                <td>{{$info->job_title}}</td>
                                <td>Skills</td>
                                <td>{{Config::get('constants.constant.currency')}}{{$info->client_pay_to_admin}}</td>
                                <td>Hires</td>
                                <td>{{$info->created_at}}</td>
                                <td>{{$info->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
        @endif

@if(Session::get('user_role')=='admin')
    @include('include.footer_admin')
@elseif(Session::get('user_role')=='client')
    @include('include.footer_cl')
@else
    @include('include.footer_fr')
@endif
