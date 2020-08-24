<!DOCTYPE html>
<html>
<body>
<div style="width:60%;margin:10%;">
    <p style="font-size:140%;text-align:justify;font-family:Lato Light;">Kindly check this Client Claim Job.</p>
    <p><label style="font-weight:bold;font-size:large;">Client Name:</label> <span>{{$cname}}</span></p>
    <p><label style="font-weight:bold;font-size:large;">Client Email:</label> <span>{{$email}}</span></p>
    <p><label style="font-weight:bold;font-size:large;">Job Title:</label> <span>{{$j_title}}</span></p>
    <p><label style="font-weight:bold;font-size:large;">Claim Amount:</label> <span>{{$c_amount}}</span></p>
    <p><label style="font-weight:bold;font-size:large;">Claim Reason:</label> <span>{{$reason}}</span></p>
    {{--<p><label style="font-weight:bold;font-size:large;">Registration Date:</label> <span>{{"date"}}</span></p>--}}
    <div style="width:40%;">

        <a href="{{url('/reject_claim')}}/{{$r_id}}/{{$hire_free_id}}" style="border-radius:20px;margin:4%;background-color:red;color:white;padding:5%;display: block;"> Reject..!  </a>
        <a href="{{url('/aprove_claim')}}/{{$r_id}}/{{$hire_free_id}}" style="border-radius:20px;margin:4%;background-color:blue;color:white;padding:5%;display: block;"> Aproved..!  </a>

    </div>
</div>
</body>
</html>

