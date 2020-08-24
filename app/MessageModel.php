<?php
namespace App;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\Eloquent\Model;
use DB;
use Crypt;
class MessageModel extends Model
{
	protected function get_new_message($user_id)
	{
		$new_query = DB::table('message')
							->join('users as send','send.user_id','=','message.sender_id')
							->join('users as receive','receive.user_id','=','message.receive_id')
							->select('message.*','receive.name as receivename','send.name as sendername')
							->where(function ($query) use($user_id) 
							{
									$query->where('message.receive_id','=',$user_id)
										  ->orWhere('message.sender_id','=',$user_id);
							})
							->where('message.message_status',1)
							->orderBy('message.last_update', 'desc')
							->get()
							->toArray();

		if($new_query)
		{
			$return_data = array();
			foreach($new_query as $qu)
			{
				
				$qu->message = DB::table('message_content')
										->join('users','users.user_id','=','message_content.message_sender_id')
										->select('message_content.*','users.name')
										->where('message_content.message_id',$qu->message_id)										
										->orderBy('message_content.message_content_id', 'asc')
										->get()
										->toArray();
				$return_data[] = $qu;				
			}
			return $return_data;
		}else
		{
			return;
		}
	}
	protected function get_retrievemessage($message_id)
	{
		$new_query = DB::table('message')
							->join('users as send','send.user_id','=','message.sender_id')
							->join('users as receive','receive.user_id','=','message.receive_id')
							->select('message.*','receive.name as receivename','send.name as sendername')
							->where('message.message_id',$message_id)
							->where('message.message_status',1)
							->orderBy('message.last_update', 'desc')
							->get()
							->first();
		if($new_query)
		{
			$new_query->message = DB::table('message_content')
									->join('users','users.user_id','=','message_content.message_sender_id')
									->select('message_content.*','users.name')
									->where('message_content.message_id',$new_query->message_id)
									->orderBy('message_content.message_content_id', 'asc')
									->get()
									->toArray();		
			return $new_query;
		}else
		{
			return 'empty';
		}
	}
	
	protected function save_send_message( $request )
	{

		$check_query = DB::table('message')
							->select('message_id','sender_id','receive_id')
							->where('message_status',1)
							->where(function ($query)  use($request)
									{
										  $query->orWhere('sender_id', $request['sender_id'])
												->orWhere('receive_id', $request['sender_id']);
									})
							->get()
							->toArray();
		$message_id = '';
		foreach($check_query as $check)
		{
			if(in_array($request['received_id'], array($check->sender_id,$check->receive_id)))
			{
				$message_id = $check->message_id;
			}
		}
		date_default_timezone_set('Asia/Riyadh');
		if(empty($message_id))
		{
			$insert_message = array();
			$insert_message['sender_id'] 		= ( isset( $request['sender_id'] ) ? $request['sender_id'] : '' );
			$insert_message['receive_id'] 		= ( isset( $request['received_id'] ) ? $request['received_id'] : '' );
			$insert_message['last_update'] 		= date('y-m-d h:i:s');
			
			$message_id = DB::table('message')->insertGetId( $insert_message );
			
			$insert_message_content = array();
			$insert_message_content['message_id'] 			= $message_id;
			$insert_message_content['message_content'] 		= ( isset( $request['message'] ) ? $request['message'] : '' );
			$insert_message_content['message_sender_id'] 	= ( isset( $request['user_id'] ) ? $request['user_id'] : '' );
			$insert_message_content['sender_read'] 			= 1;
			$insert_message_content['receive_read'] 		= 0;
			$insert_message_content['message_created']		= date('y-m-d');
			$insert_message_content['message_time'] 		= date('h:i:s');				
			DB::table('message_content')->insert($insert_message_content);

		}else
		{
			$insert_message_content = array();
			$insert_message_content['message_id'] 			= $message_id;
			$insert_message_content['message_content'] 		= ( isset( $request['message'] ) ? $request['message'] : '' );
			$insert_message_content['message_sender_id'] 	= ( isset( $request['user_id'] ) ? $request['user_id'] : '' );
			$insert_message_content['sender_read'] 			= 1;
			$insert_message_content['receive_read'] 		= 0;
			$insert_message_content['message_created']		= date('y-m-d');
			$insert_message_content['message_time'] 		= date('h:i:s');	
			DB::table('message_content')->insert($insert_message_content);

		}
		
	}
	protected function get_sendmessage( $request )
	{
		date_default_timezone_set('Asia/Riyadh');
		$insert_message_content = array();
		$insert_message_content['message_id'] 			= $request['message_id'];
		$insert_message_content['message_content'] 		= ( isset( $request['message'] ) ? $request['message'] : '' );
		$insert_message_content['message_sender_id'] 	= ( isset( $request['user_id'] ) ? $request['user_id'] : '' );
		$insert_message_content['sender_read'] 			= 1;
		$insert_message_content['receive_read'] 		= 0;
		$insert_message_content['message_created']		= date('y-m-d');
		$insert_message_content['message_time'] 		= date('h:i:s');	
		DB::table('message_content')->insert($insert_message_content);	
		DB::table('message_content')->where('message_sender_id','!=', $request['user_id'])->update(['receive_read'=>1]);	

	}
	protected function delete_chat( $message_id )
	{
		DB::table('message')->where('message_id', $message_id)->delete();
	}
	protected function delete_conversation ( $message_content_id )
	{
		DB::table('message_content')->where('message_content_id','!=', $message_content_id)->delete();
	}
	
}