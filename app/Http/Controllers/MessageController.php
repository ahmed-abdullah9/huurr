<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;
use DateTime;
use Carbon\Carbon;
use App\MessageModel as message;
class MessageController extends Controller
{
     public function Apiclgetmessage(Request $request)
     {
          $user_id = Session::get('login_id');
          $result = message::get_new_message( $user_id );
          return view('message.message_view_cl',compact('result'));
     }
     public function Apifrgetmessage(Request $request)
     {
          $user_id = Session::get('login_id');
          $result = message::get_new_message( $user_id );
          return view('message.message_view_fr',compact('result'));
     }


     public function Apinewmessage(Request $request)
     {
          $user_id = Session::get('login_id');
          $retrieve = message::get_retrievemessage( $request->input('message_id') );
          $return_html = '';
          if(!empty($retrieve->message))
          {
              foreach ($retrieve->message as $chtMsg) 
              {
                    if($chtMsg->message_sender_id!=$user_id)
                    { 
                    $cls = 'rightside-left-chat';
                    }else
                    {
                    $cls = 'rightside-right-chat';
                    }
                       $return_html .='<li>
                         <div class="'.$cls.'"> 
                           <span><i class="fa fa-circle" aria-hidden="true"></i>'.$chtMsg->name.'<small>'.date('M d,Y',strtotime($chtMsg->message_created)).' '. date('h:i A',strtotime($chtMsg->message_time)) .'</small> </span>
                           <br>
                           <br>
                           <p>'.$chtMsg->message_content.'</p>
                         </div>
                       </li>';
               } 
          }
          $newlist = message::get_new_message( $user_id );
          $new_list = '';
          if(!empty($newlist))
          {
            foreach ($newlist as $msg) 
            {
              $count = [];
              if(!empty($msg->message))
              {
                  foreach ($msg->message as $message) 
                  {
                    if($message->message_sender_id!=$user_id && $message->receive_read==0)
                    {
                      $count[] = $message->message_content_id;
                    }
                  }
              }
              if($msg->sender_id == $user_id)
              {
               
               $new_list .='<li>
                  <div class="chat-left-detail open_chat_vindeo" data-ng_message_id="'.$msg->message_id .'">
                    <p class="col-md-8">'. $msg->receivename .'</p>
                    <span class="col-md-3">('.count($count) .') </span> </div>
                </li>'; 
               
              }else
              {
               
               $new_list .=' <li>
                  <div  class="chat-left-detail open_chat_vindeo" data-ng_message_id="'.$msg->message_id .'">
                    <p class="col-md-8">'.$msg->sendername .'</p>
                    <span class="col-md-3">('. count($count) .') </span> </div>
                </li> ';
                             
              }
            }
          }
          echo json_encode(array('newlist'=>$new_list,'return_html'=>$return_html));
     }

     public function Apisendmessage(Request $request)
     {
          $user_id = Session::get('login_id');
          $newRequest = $request->all();
          $newRequest['user_id'] = $user_id;
          message::get_sendmessage( $newRequest );
          $retrieve = message::get_retrievemessage( $request->input('message_id') );
          $return_html = '';
          if(!empty($retrieve->message))
          {
              foreach ($retrieve->message as $chtMsg) 
              {
                    if($chtMsg->message_sender_id!=$user_id)
                    { 
                    $cls = 'rightside-left-chat';
                    }else
                    {
                    $cls = 'rightside-right-chat';
                    }
                       $return_html .='<li>
                         <div class="'.$cls.'"> 
                           <span><i class="fa fa-circle" aria-hidden="true"></i>'.$chtMsg->name.'<small>'.date('M d,Y',strtotime($chtMsg->message_created)).' '. date('h:i A',strtotime($chtMsg->message_time)) .'</small> </span>
                           <br>
                           <br>
                           <p>'.$chtMsg->message_content.'</p>
                         </div>
                       </li>';
               } 
          }
          echo $return_html;
     }
     public function Apisinglemessage(Request $request)
     {
          $user_id = Session::get('login_id');
          $retrieve = message::get_retrievemessage( $request->input('message_id') );
          $return_html = '';
          if(!empty($retrieve->message))
          {
              foreach ($retrieve->message as $chtMsg) 
              {
                    if($chtMsg->message_sender_id!=$user_id)
                    { 
                    $cls = 'rightside-left-chat';
                    }else
                    {
                    $cls = 'rightside-right-chat';
                    }
                       $return_html .='<li>
                         <div class="'.$cls.'"> 
                           <span><i class="fa fa-circle" aria-hidden="true"></i>'.$chtMsg->name.'<small>'.date('M d,Y',strtotime($chtMsg->message_created)).' '. date('h:i A',strtotime($chtMsg->message_time)) .'</small> </span>
                           <br>
                           <br>
                           <p>'.$chtMsg->message_content.'</p>
                         </div>
                       </li>';
               } 
          }
          echo $return_html;
     }
     public function delete_chat(Request $request)
     {
          return message::delete_chat( $request->input("message_id") );
     } 

     public function delete_conversation(Request $request)
     {
          return message::delete_conversation( $request->input("message_id") );
     }  
    public function delete_notify(Request $request)
    {
        \DB::table('notifications')->where('id', $request->input('id'))->update(['status'=>1]);
    }
    public function getConversation(Request $request){
        $search=$request->input('search');
         $user_id = Session::get('login_id');
         $data=DB::table('conversation')->where('client_id',$user_id)->orderBy('created_at', 'DESC')->get()->toarray();
        $conversation=[];
        foreach($data as $con){
            $con->client_name=DB::table('users')->where('user_id',$con->client_id)->value('user_nicename');
            $con->freelancer_name=DB::table('users')->where('user_id',$con->freelancer_id)->value('user_nicename');
            $con->freelancer_online=DB::table('users')->where('user_id',$con->freelancer_id)->value('is_online');
            $con->freelancer_image=DB::table('user_profile')->where('user_id',$con->freelancer_id)->value('profile_image');
            $con->new_message=DB::table('message')->where('conversation_id',$con->conversation_id)->where('receive_id',$user_id)->where('receiver_seen',0)->count();
            $conversation[]=$con;
        }
       return response()->json($conversation,200);
    }
    public function getfrConversation(){
        $user_id = Session::get('login_id');
        $data=DB::table('conversation')->where('freelancer_id',$user_id)->orderBy('created_at', 'DESC')->get()->toarray();
        $conversation=[];
        foreach($data as $con){
            $con->client_name=DB::table('users')->where('user_id',$con->client_id)->value('user_nicename');
            $con->freelancer_name=DB::table('users')->where('user_id',$con->freelancer_id)->value('user_nicename');
            $con->freelancer_image=DB::table('user_profile')->where('user_id',$con->freelancer_id)->value('profile_image');
            $con->new_message=DB::table('message')->where('conversation_id',$con->conversation_id)->where('receive_id',$user_id)->where('receiver_seen',0)->count();
            $conversation[]=$con;
        }
        return response()->json($conversation,200);
    }
    public function get_frMessages(Request $request){
        $client_id = Session::get('login_id');
        $freelancer_id=$request->input('freelancer_id');
        $converstaion_id=DB::table('conversation')->where('client_id',$client_id)->where('freelancer_id',$freelancer_id)->value('conversation_id');
        $data=DB::table('message')
            ->join('conversation','message.conversation_id','=','conversation.conversation_id')
            ->where('message.conversation_id',$converstaion_id)
            ->get()->toarray();
        DB::table('message')->where('conversation_id',$converstaion_id)->where('receive_id',$client_id)->update(['receiver_seen'=>1]);
       $messages=[];
        foreach($data as $con){
            $con->client_name=DB::table('users')->where('user_id',$client_id)->value('user_nicename');
            $con->freelancer_name=DB::table('users')->where('user_id',$freelancer_id)->value('user_nicename');
            $con->freelancer_image=DB::table('user_profile')->where('user_id',$freelancer_id)->value('profile_image');
            $messages[]=$con;
        }
        return response()->json($messages,200);
    }
    public function get_clMessages(Request $request){
        $freelancer_id = Session::get('login_id');
        $client_id=$request->input('client_id');
        $converstaion_id=DB::table('conversation')->where('client_id',$client_id)->where('freelancer_id',$freelancer_id)->value('conversation_id');
        $data=DB::table('message')
            ->join('conversation','message.conversation_id','=','conversation.conversation_id')
            ->where('message.conversation_id',$converstaion_id)
            ->get()->toarray();
        DB::table('message')->where('conversation_id',$converstaion_id)->where('receive_id',$freelancer_id)->update(['receiver_seen'=>1]);
        $messages=[];
        foreach($data as $con){
            $con->client_name=DB::table('users')->where('user_id',$client_id)->value('user_nicename');
            $con->freelancer_name=DB::table('users')->where('user_id',$freelancer_id)->value('user_nicename');
            $con->freelancer_image=DB::table('user_profile')->where('user_id',$freelancer_id)->value('profile_image');
            $messages[]=$con;
        }
        return response()->json($messages,200);
    }
    public function getclnewMessages(Request $request){
        $client_id = Session::get('login_id');
        $freelancer_id=$request->input('freelancer_id');
        $converstaion_id=DB::table('conversation')->where('client_id',$client_id)->where('freelancer_id',$freelancer_id)->value('conversation_id');
        $data=DB::table('message')
            ->join('conversation','message.conversation_id','=','conversation.conversation_id')
            ->where('message.conversation_id',$converstaion_id)
            ->where('message.receive_id',$client_id)
            ->where('message.receiver_seen',0)
            ->get()->toarray();
        DB::table('message')->where('conversation_id',$converstaion_id)->where('receive_id',$client_id)->update(['receiver_seen'=>1]);
        $messages=[];
        foreach($data as $con){
            $con->client_name=DB::table('users')->where('user_id',$client_id)->value('user_nicename');
            $con->freelancer_name=DB::table('users')->where('user_id',$freelancer_id)->value('user_nicename');
            $con->freelancer_image=DB::table('user_profile')->where('user_id',$freelancer_id)->value('profile_image');
            $messages[]=$con;
        }
        return response()->json($messages,200);
    }
    public function clnewMessages(Request $request){
        $freelancer_id = Session::get('login_id');
        $client_id=$request->input('client_id');
        $converstaion_id=DB::table('conversation')->where('client_id',$client_id)->where('freelancer_id',$freelancer_id)->value('conversation_id');
        $data=DB::table('message')
            ->join('conversation','message.conversation_id','=','conversation.conversation_id')
            ->where('message.conversation_id',$converstaion_id)
            ->where('message.receiver_seen',0)
            ->where('message.receive_id',$freelancer_id)
            ->get()->toarray();
        DB::table('message')->where('conversation_id',$converstaion_id)->where('receive_id',$freelancer_id)->update(['receiver_seen'=>1]);
        $messages=[];
        foreach($data as $con){
            $con->client_name=DB::table('users')->where('user_id',$client_id)->value('user_nicename');
            $con->freelancer_name=DB::table('users')->where('user_id',$freelancer_id)->value('user_nicename');
            $con->freelancer_image=DB::table('user_profile')->where('user_id',$freelancer_id)->value('profile_image');
            $messages[]=$con;
        }
        return response()->json($messages,200);
    }
    public function cl_sendMessage(Request $request){
        $current_date_time = Carbon::now()->toDateTimeString();
        $client_id = Session::get('login_id');
        $freelancer_id=$request->input('freelancer_id');
        $message=$request->input('message');
        if(!empty($converstaion_id=DB::table('conversation')->where('client_id',$client_id)->where('freelancer_id',$freelancer_id)->value('conversation_id')))
        {
            DB::table('conversation')->where('conversation_id',$converstaion_id)->update(['updated_at'=>$current_date_time]);
            DB::table('message')->insert(['conversation_id'=>$converstaion_id,'sender_id'=>$client_id,'receive_id'=>$freelancer_id,'message_contents'=>$message]);
            $message_id=DB::getPdo()->lastInsertId();
            $data=DB::table('message')
               ->where('message_id',$message_id)
                ->where('sender_id',$client_id)
                ->where('sender_seen',0)
                ->get()->toarray();
            DB::table('message')->where('message_id',$message_id)->where('sender_id',$client_id)->update(['sender_seen'=>1]);
            $messages=[];
            foreach($data as $con){
                $con->client_name=DB::table('users')->where('user_id',$client_id)->value('user_nicename');
                $con->freelancer_name=DB::table('users')->where('user_id',$freelancer_id)->value('user_nicename');
                $con->freelancer_image=DB::table('user_profile')->where('user_id',$freelancer_id)->value('profile_image');
                $messages[]=$con;
            }
         }
        else{
            DB::table('conversation')->insert(['client_id'=>$client_id,'freelancer_id'=>$freelancer_id]);
            $conv_id=DB::getPdo()->lastInsertId();
            DB::table('conversation')->where('conversation_id',$conv_id)->update(['updated_at'=>$current_date_time]);
            DB::table('message')->insert(['conversation_id'=>$conv_id,'sender_id'=>$client_id,'receive_id'=>$freelancer_id,'message_contents'=>$message]);
            $message_id=DB::getPdo()->lastInsertId();
            $data=DB::table('message')
                ->where('message_id',$message_id)
                ->where('sender_id',$client_id)
                ->where('sender_seen',0)
                ->get()->toarray();
            DB::table('message')->where('message_id',$message_id)->where('sender_id',$client_id)->update(['sender_seen'=>1]);
            $messages=[];
            foreach($data as $con){
                $con->client_name=DB::table('users')->where('user_id',$client_id)->value('user_nicename');
                $con->freelancer_name=DB::table('users')->where('user_id',$freelancer_id)->value('user_nicename');
                $con->freelancer_image=DB::table('user_profile')->where('user_id',$freelancer_id)->value('profile_image');
                $messages[]=$con;
            }
        }
        return response()->json($messages,200);
    }
    public function sendfreelancermessage(Request $request)
    {

        $client_id = Session::get('login_id');
        $freelancer_id=$request->input('user_id');
        $message=$request->input('message');
        $current_date_time = Carbon::now()->toDateTimeString();
        if(!empty($converstaion_id=DB::table('conversation')->where('client_id',$client_id)->where('freelancer_id',$freelancer_id)->value('conversation_id')))
        {
            DB::table('conversation')->where('conversation_id',$converstaion_id)->update(['updated_at'=>$current_date_time]);
            DB::table('message')->insert(['conversation_id'=>$converstaion_id,'sender_id'=>$client_id,'receive_id'=>$freelancer_id,'message_contents'=>$message]);
            $message_id=DB::getPdo()->lastInsertId();
            $data=DB::table('message')
                ->where('message_id',$message_id)
                ->where('sender_id',$client_id)
                ->where('sender_seen',0)
                ->get()->toarray();
            DB::table('message')->where('message_id',$message_id)->where('sender_id',$client_id)->update(['sender_seen'=>1]);
            $messages=[];
            foreach($data as $con){
                $con->client_name=DB::table('users')->where('user_id',$client_id)->value('user_nicename');
                $con->freelancer_name=DB::table('users')->where('user_id',$freelancer_id)->value('user_nicename');
                $con->freelancer_image=DB::table('user_profile')->where('user_id',$freelancer_id)->value('profile_image');
                $messages[]=$con;
            }
        }
        else{
            DB::table('conversation')->insert(['client_id'=>$client_id,'freelancer_id'=>$freelancer_id]);
            $conv_id=DB::getPdo()->lastInsertId();
            DB::table('conversation')->where('conversation_id',$conv_id)->update(['updated_at'=>$current_date_time]);
            DB::table('message')->insert(['conversation_id'=>$conv_id,'sender_id'=>$client_id,'receive_id'=>$freelancer_id,'message_contents'=>$message]);
            $message_id=DB::getPdo()->lastInsertId();
            $data=DB::table('message')
                ->where('message_id',$message_id)
                ->where('sender_id',$client_id)
                ->where('sender_seen',0)
                ->get()->toarray();
            DB::table('message')->where('message_id',$message_id)->where('sender_id',$client_id)->update(['sender_seen'=>1]);
            $messages=[];
            foreach($data as $con){
                $con->client_name=DB::table('users')->where('user_id',$client_id)->value('user_nicename');
                $con->freelancer_name=DB::table('users')->where('user_id',$freelancer_id)->value('user_nicename');
                $con->freelancer_image=DB::table('user_profile')->where('user_id',$freelancer_id)->value('profile_image');
                $messages[]=$con;
            }
        }
        DB::table('notifications')->insert([
            'notification_type' => 'offer',
            'sender_id' => Session::get('login_id'),
            'receiver_id' => $freelancer_id,
            'message' => 'Client want to talk on your purposal please goto  message inbox and further discuss',
        ]);
        return redirect('/clmessages');

    }
    public function fr_sendMessage(Request $request){
        $freelancer_id = Session::get('login_id');
        $client_id=$request->input('client_id');
        $message=$request->input('message');
        $current_date_time = Carbon::now()->toDateTimeString();
        if(!empty($converstaion_id=DB::table('conversation')->where('client_id',$client_id)->where('freelancer_id',$freelancer_id)->value('conversation_id')))
        {
            DB::table('conversation')->where('conversation_id',$converstaion_id)->update(['updated_at'=>$current_date_time]);
            DB::table('message')->insert(['conversation_id'=>$converstaion_id,'sender_id'=>$freelancer_id,'receive_id'=>$client_id,'message_contents'=>$message]);
            $data=DB::table('message')
                ->join('conversation','message.conversation_id','=','conversation.conversation_id')
                ->where('message.conversation_id',$converstaion_id)
                ->where('message.sender_id',$freelancer_id)
                ->where('message.sender_seen',0)
                ->get()->toarray();
            DB::table('message')->where('conversation_id',$converstaion_id)->where('sender_id',$freelancer_id)->update(['sender_seen'=>1]);
            $messages=[];
            foreach($data as $con){
                $con->client_name=DB::table('users')->where('user_id',$client_id)->value('user_nicename');
                $con->freelancer_name=DB::table('users')->where('user_id',$freelancer_id)->value('user_nicename');
                $con->freelancer_image=DB::table('user_profile')->where('user_id',$freelancer_id)->value('profile_image');
                $messages[]=$con;
            }
        }
        else{

            DB::table('conversation')->insert(['client_id'=>$client_id,'freelancer_id'=>$freelancer_id]);
            $conv_id=DB::getPdo()->lastInsertId();
            DB::table('conversation')->where('conversation_id',$conv_id)->update(['updated_at'=>$current_date_time]);
            DB::table('message')->insert(['conversation_id'=>$conv_id,'sender_id'=>$freelancer_id,'receive_id'=>$client_id,'message_contents'=>$message]);
            //DB::table('message')->insert(['conversation_id'=>$conv_id,'sender_id'=>$client_id,'receive_id'=>$freelancer_id,'message_contents'=>$message]);
            $data=DB::table('message')
                ->join('conversation','message.conversation_id','=','conversation.conversation_id')
                ->where('message.conversation_id',$conv_id)
                ->where('message.sender_id',$freelancer_id)
                ->where('message.sender_seen',0)
                ->get()->toarray();
            DB::table('message')->where('conversation_id',$conv_id)->where('sender_id',$freelancer_id)->update(['sender_seen'=>1]);
            $messages=[];
            foreach($data as $con){
                $con->client_name=DB::table('users')->where('user_id',$client_id)->value('user_nicename');
                $con->freelancer_name=DB::table('users')->where('user_id',$freelancer_id)->value('user_nicename');
                $con->freelancer_image=DB::table('user_profile')->where('user_id',$freelancer_id)->value('profile_image');
                $messages[]=$con;
            }
        }
        return response()->json($messages,200);
    }
    public function getallNotification(){
        $notify = DB::table('notifications')
            ->join('users','users.user_id','=','notifications.sender_id')
            ->where('notifications.receiver_id', Session::get('login_id'))
            ->where('notifications.status',0)
            ->select('notifications.message','notifications.id','users.name','notifications.created_at')
            ->get()
            ->toArray();

        $messages=[];
        if (sizeof($notify)>0){
        foreach ($notify as $nt)
        {
            $time_act='';
            $datetime1 = new DateTime($nt->created_at);
            $datetime2 = new DateTime(date('Y-m-d h:i:s'));
            $interval = $datetime1->diff($datetime2);
            $time_act = (($interval->format('%y')!=0)?$interval->format('%y')." Year ":"");
            $time_act .= (($interval->format('%m')!=0)?$interval->format('%m')." Month ":"");
            $time_act .= (($interval->format('%d')!=0)?$interval->format('%d')." Days ":"");
            $time_act .= (($interval->format('%h')!=0)?$interval->format('%h')." Hours ":"");
            $time_act .= (($interval->format('%i')!=0)?$interval->format('%i')." Minutes":"");
            $nt->date=$time_act;
            $messages[]=$nt;
        }
        $data=[];
        $data=['messages'=>$messages,'count'=>sizeof($messages)];
            return response()->json($data,200);
        }
        else{
            return response()->json('false',201);
        }

    }
}
