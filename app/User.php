<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use View;
use DJB\Confer\Traits\CanConfer;
class User extends Authenticatable
{
    use Notifiable;

    use CanConfer;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'avatar', 'is_in_use'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static $signupRules = array(
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'user_role'=>'required',
            'user_gender'=>'required',
        );
    public static $resetRules = array(
            'email' => 'required|string|email|max:255',
        );
    public static $resetupRules = array(
            'password' => 'required|string|min:6|confirm',
        );
    function send_mail(){
        $subject = 'The anti-bullying Healthy Workplace Bill';
        $mail = new PHPMailer;
        $mail->setFrom('mfarhanriaz14@gmail.com', 'farhan'); //dfalzoi2@gmail.com  mfarhan7333@gmail.com
        $mail->addAddress('mfarhanriaz14@gmail.com','farhanjani');
        $mail->Subject  = 'Hurr.com';
        $mail->Body     = 'huurr body';
        $mail->IsHTML(false);
        if(!$mail->send()) {
            // echo 'Message was not sent.';
            //echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
             echo 'Message has been sent.';
        }
    }
    protected function store($request) 
    {
       $validation = Validator::make($request, self::$signupRules);
        if($validation->passes())
        {
            if($request['user_role']!='client'){
            if (empty($request['skill'])){
                echo json_encode(['status' =>3,'response'=>'']);
                die();
            }
            if (empty($request['sub_skill'])){
                echo json_encode(['status' =>4,'response'=>'']);
                die();
            }
            }
            if(DB::table('users')->where('email',$request['email'])->first())
            {
                echo json_encode(['status'=>true,'message'=>'Email ID already exit','response'=>'']);
                die();
            }
            date_default_timezone_set('Asia/Riyadh');
            $random_key = sha1(mt_rand(10000,99999).time().$request['email']);
            $SaveData = DB::table('users')->insertGetId([
                'name' => $request['name'],
                'last_name' => $request['last_name'],
                'user_nicename' => $request['name'].' '.$request['last_name'],
                'user_role' => $request['user_role'],
                'email' => $request['email'],
                'user_gender'=>$request['user_gender'],
                'password' => '$2y$10$sYwPSVmXDNa8hKotAlq'.md5($request['password']),
                'token' => $random_key,
                'user_status' => 0,
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s')
            ]);
            
            if (!$SaveData) {
               echo json_encode(['status'=>false,'message'=>'Something went wrong','response'=>'']);
               die();
            }else
            {
                 if($request['user_role']!='client'){
                $parent_id=DB::table('categorie')->where('id', $request['sub_skill'])->value('parent_id');
                DB::table('users_categories')->insert(['category_id'=> $request['sub_skill'],'parent_id'=>$parent_id,'user_id'=>$SaveData]);
}
                DB::table('wallet_credit')->insert(['user_id'=>$SaveData,'credit'=>0]);
                $url=url('/activate/account')."/".$random_key;
                $view = View::make('templete.welcome',['name'=>$request['name'],'url'=>$url]);
                $contents = (string)$view;

                $login=url('/login');
                //$contents=str_replace(["Click_me","Freelancer","link1"],["<a style='background-color:blue;text-decoration:none;color:white;text-align:center;height:30px;width:150px;'  href='".url('/activate/account')."/".$random_key."'>Activate link</a>",$request['name'],$url],$contents);
                send_mail('mfarhan7333@gmail.com',$request['email'],$request['name'].' '.$request['last_name'],'User Email Verification',$contents);
                if ($request['language']=='en') {
                    $message ='Hello '.$request['name'].' Your account has been created successfully. An Email has been sent to you,Please check your inbox/junk';
                }
                else{

                    $message='مرحبًا اسم تم إنشاء حسابك بنجاح. تم إرسال بريد إلكتروني إليك ، والتحقق من بريدك الوارد / غير الهام';
                    $message=str_replace('اسم',$request['name'],$message);
                }
                echo json_encode(['status'=>true,'message'=>$message,'response'=>$SaveData]);
                die();
            }
        }else
        {
            echo json_encode(['status' => false, 'message' => $validation->getMessageBag()->first(),'response'=>'']);
            die();
        }
    }
    protected function activate_account($token)
    {

        if($user=DB::table('users')->where('token',$token)->first())
        {
            $status = (isset($user->user_role) && $user->user_role == 'freelancer') ? 2 : 1;
           // DB::table('users')->where('token',$token)->where('user_role','client')->update(['user_status'=>1]);
            DB::table('users')->where('token',$token)->update(['user_status'=>$status]);
            DB::table('users')->where('token',$token)->update(['token'=>'']);
            $view = View::make('templete.freelancer.thanks_freelancer_email');
            $contents = (string)$view;
            send_mail('mfarhan7333@gmail.com',$user->email,$user->user_nicename,'Thanx for Verifying your Email',$contents);
            if($status==2) {
                $skill=DB::table('users_categories')->where('user_id',$user->user_id)->first();
                $parent_skill=DB::table('categorie')->where('id',$skill->parent_id)->value('freelancer_skill');
                $child_skill=DB::table('categorie')->where('parent_id',$skill->parent_id)->value('freelancer_skill');
                $total=DB::table('users_categories')->where('category_id', $skill->category_id)->count();
                $view = View::make('templete.freelancer.freelancer_acept_reject_email',['skill'=>$parent_skill,'sub_skill'=>$child_skill,'total'=>$total,'name'=>$user->user_nicename,'email'=>$user->email,'created_at'=>$user->created_at,'id'=>encrypt($user->user_id)]);
                $contents = (string)$view;
                //$contents=View::make('templete.freelancer.thanks_freelancer_email');
                  send_mail('mfarhan7333@gmail.com',config('constants.constant.admin_email'),'Huurr.com','Freelancer Category',$contents);
            }
        }else
        {
            return 'empty';
        }
    }
    protected function reset_password($request)
    {
        $validation = Validator::make($request, self::$resetRules);
        if($validation->passes())
        {
            if(!DB::table('users')->where('email',$request['email'])->first())
            {
                return 'Look Like your account is not exists in our system';
            }            
            $random_key = sha1(mt_rand(10000,99999).time().$request['email']);
            DB::table('users')->where('email',$request['email'])->update(['reset_token'=>$random_key]);
            self::wp_mail_reset($request['email'],$random_key);
            return 'Email has been sent you, Follow instruction to reset your password';
           
        }else
        {
            return $validation->getMessageBag()->first();
        }
    }
    protected function reset_update_password($request,$reset_token)
    {
        if(strlen($request['password'])<8)
        {
            return 'Minimum 8 character required is password';
        }
        if($request['password']!=$request['confirm'])
        {
            return 'Confirm password did not match';
        }
        if(!$user_d = DB::table('users')->where('reset_token',$reset_token)->select('user_id','name','email')->first())
        {
            return 'Look Like Something went wrong, Please try after some time';
        }            
        DB::table('users')->where('reset_token',$reset_token)->update(['password'=>'$2y$10$sYwPSVmXDNa8hKotAlq'.md5($request['password']),'reset_token'=>'']);
        $message = 'Your request for password update accepted successfully' ; 
        DB::table('notifications')->insert([
                                    'notification_type' => 'invite',
                                    'sender_id' => $user_d->user_id,
                                    'receiver_id' => $user_d->user_id,
                                    'message' => $message,
                                    ]);
        self::wp_mail_update($user_d->name, $user_d->email);
        return 'updated';
    }
    protected function wp_mail_update($name, $email)
    {
        if($_SERVER['HTTP_HOST']=='localhost')
        {
            return;
        }
        if(empty($email))
        {
            return;
        }
        $subject = "Update Password";

        $message = "        
        <h3>Password Updated!</h3>";
        
        $message .= " <p>Your password update request accepted successfully</p>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($email,$subject,$message,$headers);
    }
    protected function wp_mail_reset($email, $random_key)
    {
        if($_SERVER['HTTP_HOST']=='localhost')
        {
            return;
        }
        if(empty($email))
        {
            return;
        }
        $subject = "Reset Password";

        $message = "<h3>Reset password request confirm!</h3>";
        
        $message .= " <p>Please <a href='".url('/reset/password')."/".$random_key."'>click</a> on this link to update your password</p>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($email,$subject,$message,$headers);
    }
    protected function wp_mail($name, $email, $random_key, $type)
    {


        /////////////////////////////////////////////////////////////////////
        /*
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // tls secure transfer enabled REQUIRED for Gmail
        $mail->Host = "huurr.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "info@huurr.com";
        $mail->Password = "farhanahmad786";
        $mail->SetFrom("noreply@huurr.com");
        $mail->Subject = "Test";
        $mail->Body = "hello";
        $mail->AddAddress("mfarhanriaz14@gmail.com");
        $mail->send();
        */
    }
}
