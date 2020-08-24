<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Session;
use Validator;
use View;
use App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\AdminPortfolio;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function testmail(Request $request){
        phpinfo();
//        $data1=View::make('templete.freelancer.thanks_freelancer_email');
//        $data1=(string)$data1;
//        $MailData            = array();
//        $MailData['from']    = "mfarhanriaz14@gmail.com";
//        $MailData['to']      = 'mfarhanriaz14@gmail.com';
//        $MailData['recipient-variables']      = '{"sample1@gmail.com": {"first":"Bob", "id":1}, "sample2@gmail.com": {"first":"Alice", "id": 2}}';
//        $MailData['subject'] = 'This is test thing';
//        $MailData['html']    =$data1;
//        $api_key='6ec3e1de562393731d83dd1d19817229-9dfbeecd-742b6665';
//        $domain='sandbox799bf0df0491492fa0e7bee9dae874da.mailgun.org';
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//        curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//        curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages');
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $MailData);
//        $result = curl_exec($ch);
//        curl_close($ch);
//       print_r($result);

//        $user=['email'=>'mfarhanriaz14@gmail.com'];
//        Mail::send('templete.freelancer.thanks_freelancer_email', $user, function($message) use ($user) {
//
//            $message->to('mfarhanriaz14@gmail.com');
//
//            $message->subject('Mailgun Testing');
//
//        });
//
//        dd('Mail Send Successfully');
////        send();
//        $freelancer = DB::table('users as u')
//            ->join('users_categories as uc', 'uc.user_id', '=', 'u.user_id')
//            ->join('categorie as c', 'c.id', '=', 'uc.category_id')
//            ->where('u.user_role', '=', "freelancer")
//            ->paginate(5);
//        $subCategories=DB::table('categorie')->where('parent_id', '!=',  0 )->get();
//        if ($request->ajax()){
//            $freelancer = DB::table('users as u')
//                ->join('users_categories as uc', 'uc.user_id', '=', 'u.user_id')
//                ->join('categorie as c', 'c.id', '=', 'uc.category_id')
//                ->where('u.user_role', '=', "freelancer");
//
//              if(!empty($request->input('sub_category'))){
//                  $freelancer=$freelancer->where('c.id', '=', $request->input('sub_category'));
//              }
//              if (!empty($request->input('search'))) {
//                  $freelancer=$freelancer->where('user_nicename', 'like', '%'.$request->input('search').'%');
////                    ->orWhere('email', 'LIKE', '%'.$request->input('search').'%')
////                    ->orWhere('name', 'LIKE','%'.$request->input('search').'%');
//              }
//            if(!empty($request->input('status'))&&$request->input('status')==1){
//                $freelancer=$freelancer->where('u.is_verify', '=',1);
//            }
//            if(!empty($request->input('status'))&&$request->input('status')==2){
//                $freelancer=$freelancer->where('u.is_verify', '=', 0);
//            }
//            if(!empty($request->input('status'))&&$request->input('status')==3){
//                $freelancer=$freelancer->where('u.user_status', '=', 1);
//            }
//            if(!empty($request->input('status'))&&$request->input('status')==4){
//                $freelancer=$freelancer->where('u.account_suspended', '=', 1);
//            }
//            if (!empty($request->input('export'))){
//                Excel::create('products', function($excel) use($freelancer) {
//                    $excel->sheet('sheet 1', function($sheet) use($freelancer){
//                        $sheet->fromArray($freelancer);
//                    });
//                })->export('xls');
//            }
//            $freelancer=$freelancer->paginate(5);
//            return view('admin.test', ['freelancer' => $freelancer,'subCategories'=>$subCategories])->render();
//
//
//        }
//        else {
//
//            return view('admin.manage_freelancer_test', compact('freelancer','subCategories'));
//        }
    }
     public function welcome(){
        $qouts = DB::table('qouts')
            ->offset(0)
            ->limit(3)->orderBy('id', 'DESC')
            ->get();
         $freelancer = DB::table('users')->where('user_role', 'freelancer')->count();   
         $client = DB::table('users')->where('user_role', 'client')->count();  
          $jobs = DB::table('jobs')->where('is_draft', 0)->count();
         $main_skills = DB::table('categorie')->where('parent_id',0)
             ->offset(0)
             ->limit(4)->orderBy('id', 'DESC')
             ->get();
         $skills=DB::table('categorie')->get();
         $portfolios=AdminPortfolio::all();
        return view('welcome',compact('qouts','freelancer','client','jobs','main_skills','skills','portfolios'));
    }
    public function home_skills()
    {
        $skills = DB::table('profetionls')->select('*')->get()->toArray();
        return view('home_skills',compact('skills'));
    }

    public function view_sub_skills($id){
        $data=DB::table('categorie')->where('parent_id',$id)->get();
        $resp=array();
        $sub_skills=array();
        $resp['status']=true;
        $i=0;
        foreach($data as $skills){
            $sub_skills[$i]['categorie']=$skills->freelancer_skill;
            $sub_skills[$i]['ar_categorie']=$skills->ar_freelancer_skill;
            $sub_skills[$i]['skill_id']=$skills->id;
            $i++;
        }
        $resp['data']=$sub_skills;
        echo json_encode($resp);
    }
        public function get_skills(Request $request)
    {
        $resp= array();
        $query='';
        $test='';
        $lang= $request->input('lang');
       $search_query = $request->input('query');
        if ($lang=='en') {
            $query = DB::table('categorie')->select('freelancer_skill','id')
                ->where('freelancer_skill', 'like', '%' . $search_query . '%')
                ->get();
        }
        else{
            $query = DB::table('categorie')->select('ar_freelancer_skill as freelancer_skill','id')->where('ar_freelancer_skill', 'like', '%' . $search_query . '%')
                ->get();
        }
       $i=0;
       foreach($query as $row)
       {
               $resp[$i]['value'] = $row->freelancer_skill;
               $resp[$i]['data']  = $row->id;
               $i++;
       }
        $finaresp['suggestions'] = $resp;
        echo  json_encode($finaresp);
    }
    public function set_get_started(Request $request)
    {
        Session::put([
            'profetional_skills' => $request->input('profetional_skills'),
            'availability_type' =>$request->input('availability_type'),
            'is_find_freelancer' =>true
        ]);
    }
    public function subcription(Request $request){
        $error=array();
        $resp=array();
        $data=array();
        $rules=[
            'subcriber_email' => 'required|email|unique:subcription,email'
        ];
        $messages=[
            'subcriber_email.required'=>'Email is Required',
            'subcriber_email.email'=>'Please Enter Valid Email Address',
            'subcriber_email.unique'=>'Your have already subscribed'
        ];
        $validater=Validator::make($request->all(),$rules,$messages);
        if ($validater->fails()) {
            $resp['status'] = false;
            $resp['errors'] = $validater->errors();
        }
        else{
            $data=[
                'email' => $request->input('subcriber_email'),
            ];
            $insert=DB::table('subcription')->insert($data);
            if ($insert){
                $resp['status']=true;
                $resp['success']='You have Subscribe Suucessfully';
                $this->send_email_to_subcriber($request->input('subcriber_email'));
            }
            else{
                $resp['status']=false;
                $resp['errors']='Something going wrong';
            }
        }

      echo json_encode($resp);
    }
    public function send_email_to_subcriber($email){
        if($_SERVER['HTTP_HOST']=='localhost')
        {
            return;
        }
        if(empty($email))
        {
            return;
        }
        $subject = "Subscribe";

        $message = "<h3>Hello Thanks For Subcription with huurr.com!</h3>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";
        mail($email,$subject,$message,$headers);
    }
    
     public function send_email_contact_us($email,$name,$company,$contact_email,$message){
        if($_SERVER['HTTP_HOST']=='localhost')
        {
            return;
        }
        if(empty($email))
        {
            return;
        }
        $subject = "Contact Us";

        $message = "        
        <h3>Name:</h3>";
        $message .= " <p>'.$name.'</p>";
        $message = "        
        <h3>company:</h3>";
        $message .= " <p>'.$company.'</p>";
        $message = "        
        <h3>Email:</h3>";
        $message .= " <p>'.$contact_email.'</p>";
        $message = "        
        <h3>Message:</h3>";
        $message .= " <p>'.$message.'</p>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($email,$subject,$message,$headers);
    }
    public function contact_us(){
        return view('contact');
    }
    public function contact_submit(Request $request){
           $resp=array();
           $data=array();
        $rules=[
            'email' => 'required|email',
            'name'=>'required',
            'company'=>'required',
            'message'=>'required'
        ];
        $messages=[
            'email.required'=>'Email is Required',
            'email.email'=>'Please Enter Valid Email Address',
            'name.required'=>'Please Write Your good Name!',
            'company.required'=>'Please write Company Name',
            'message.required'=>'Please Write Message!'
        ];
        $validater=Validator::make($request->all(),$rules,$messages);
        if ($validater->fails()) {
            $resp['status'] = false;
            $resp['errors'] = $validater->errors();
        }
        else{
            $data=[
                'email' => $request->input('email'),
                'name'=>$request->input('name'),
                'company'=>$request->input('company'),
                'message'=>$request->input('message')
            ];
            $insert=DB::table('contact_us')->insert($data);
            if ($insert){
                $resp['status']=true;
                $resp['success']='Thanx for Contact with Huurr.com';
                $this->send_email_contact_us('mfarhanriaz14@gmail.com',$request->input('name'),$request->input('company'),$request->input('email'),$request->input('message'));
            }
            else{
                $resp['status']=false;
                $resp['errors']='Something going wrong';
            }
        }
     echo json_encode($resp);

    }
    public function moreSkills(){
        $main_skills=DB::table('categorie')->where('parent_id',0)->get();
        $skills=DB::table('categorie')->get();
        return view('MoreSkills',['main_skills'=>$main_skills,'skills'=>$skills]);
    }
}
