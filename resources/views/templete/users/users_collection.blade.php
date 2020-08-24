<!doctype html>
<html>
<head>
    <!-- NAME: FOLLOW UP -->
    <!--[if gte mso 15]>
    <![endif]-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>


</head>
<body>
    <div style="width: 80%;margin: auto;padding: 20px;>
       <h2 align="center">Users Detail</h2>

        <table   border="1" style="margin: auto;text-align: justify;border-collapse: collapse;">
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Email</th>
                <th>Registration Date</th>
            </tr>
            @foreach($users as $user)
               <tr>
                  <td>{{$user->user_nicename}}</td>
                   <td>{{$user->user_role}}</td>
                   <td>{{$user->email}}</td>
                   <td>{{$user->created_at}}</td>
               </tr>
                @endforeach
        </table>
    </div>
</body>
</html>
