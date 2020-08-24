<!DOCTYPE html>
<html>
<body>
<div style="width:60%;margin:10%;">
    <p style="font-size:160%;font-weight:bold;font-family:Lato;">Heros
    </p>
    <p style="font-size:140%;text-align:justify;font-family:Lato Light;">Kindly check this Freelancer Category and approve or reject.</p>
    <p><label style="font-weight:bold;font-size:large;">Freelancer Name:</label> <span>{{$name}}</span></p>
    <p><label style="font-weight:bold;font-size:large;">Email:</label> <span>{{$email}}</span></p>
    <p><label style="font-weight:bold;font-size:large;">Category:</label> <span>{{$skill}}</span></p>
    <p><label style="font-weight:bold;font-size:large;">Sub Category:</label> <span>{{$sub_skill}}</span></p>
    <p><label style="font-weight:bold;font-size:large;">Total freelancer in Sub Category:</label> <span>{{$total}}</span></p>
    <p><label style="font-weight:bold;font-size:large;">Registration Date:</label> <span>{{$created_at}}</span></p>
    <div style="width:40%;">

       <a href="{{url('/reject_freelancer')}}/{{$id}}" style="border-radius:20px;margin:4%;background-color:red;color:white;padding:5%;display: block;"> Reject..!  </a>
        <a href="{{url('/aprove_freelancer')}}/{{$id}}" style="border-radius:20px;margin:4%;background-color:blue;color:white;padding:5%;display: block;"> Aproved..!  </a>

    </div>
</div>
</body>
</html>

