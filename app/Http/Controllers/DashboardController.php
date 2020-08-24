<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
// use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
//use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use Redirect;
use Validator;
use Image;
use View;
use Session;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class DashboardController extends Controller
{


public function test(){
    $view = View::make('templete.freelancer.weldone');
    $contents = $view->render();
    // $contents='You have a new proposal on job '.$jobs->job_title.' by freelancer '.$freelancer->user_nicename;
    send_mail('mfarhanriaz14@gmail.com','mfarhanriaz14@gmail.com','jani','job Proposal ',$contents,$attachment=false);
    echo "ok";
}
    public function index()
    {
        $all_job= \DB::table('jobs')->join('users','users.user_id','=','jobs.user_id')->select('jobs.*','users.name')->orderBy('jobs.created_at', 'DESC')->count();
//        $all_job = \DB::table('jobs')->get()->count();
        $faild_jobs = DB::table('job_completed')
            ->join('proposals','proposals.proposal_id','=','job_completed.proposal_id')
            ->join('jobs','jobs.job_id','=','job_completed.job_id')
            ->join('users','users.user_id','=','jobs.user_id')
            ->where('job_completed.status',0)->count();
        //$completed_jobs = \DB::table('jobs')->where('job_completed', 1)->where('status', 0)->get()->count();
        $completed_jobs=DB::table('job_completed')
            ->join('proposals','proposals.proposal_id','=','job_completed.proposal_id')
            ->join('jobs','jobs.job_id','=','job_completed.job_id')
            ->join('users','users.user_id','=','jobs.user_id')
            ->where('job_completed.status',1)->count();
        return view('admin.dashboard', compact(['all_job','faild_jobs','completed_jobs']));
    }
    public function jobListing(Request $request){
        $user_id = Session::get('login_id');
        $jobs_query = \DB::table('jobs')->join('users','users.user_id','=','jobs.user_id')->select('jobs.*','users.name')->orderBy('jobs.created_at', 'DESC')->get()->toArray();
        $jobs = [];
        $perPage = 5;
        $currentPage = Paginator::resolveCurrentPage();
        if ($request->ajax()){
           // $jobs_query = \DB::table('jobs')->join('users','users.user_id','=','jobs.user_id')->select('jobs.*','users.name')->orderBy('jobs.created_at', 'DESC')->get()->toArray();
            $jobs_query = \DB::table('jobs')->join('users','users.user_id','=','jobs.user_id');
            if ($request->input('limit')!=''){
                $perPage=$request->input('limit');
            }
            if ($request->input('search')!=''){
                $jobs_query=$jobs_query->where('job_title','like','%'.$request->input('search').'%');
            }
            $jobs_query=$jobs_query->select('jobs.*','users.name')->orderBy('jobs.created_at', 'DESC')->get()->toArray();
            foreach ($jobs_query as $job) {
                $job->hired = DB::table('proposals')->where('job_id',$job->job_id)->where('offers',1)->count();
                $jobs[] = $job;
            }
            $col = collect($jobs);
            $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $jobs = new Paginator($currentPageItems, count($col), $perPage);
            $jobs->setPath($request->url());
            $jobs->appends($request->all());
            return view('admin.tables.job_listing', ['jobs' => $jobs])->render();
        }
        foreach ($jobs_query as $job) {
            $job->hired = DB::table('proposals')->where('job_id',$job->job_id)->where('offers',1)->count();
            $jobs[] = $job;
        }

        $col = collect($jobs);
        $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $jobs = new Paginator($currentPageItems, count($col), $perPage);
        $jobs->setPath($request->url());
        $jobs->appends($request->all());
        return view('admin.jobListing', compact('jobs'));
    }
    public function allUsersDetails(Request $request){
        if (!empty($request->get('export'))&&$request->get('export')=='pdf'){
            $users=User::all();
            if (!empty($request->get('limit'))){
            $users=$users->limit($request->get('limit'));
        }
            if (!empty($request->get('user_type'))){
                $users=$users->where('user_role',$request->get('user_type'));
            }
               $html = view('templete.users.users_collection',compact('users'));
        $pdf = PDF::loadHTML($html);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('users.pdf');

        }
        else
            if (!empty($request->get('export'))&&$request->get('export')=='xls'){
                $limit=0;
                $type='false';
                if (!empty($request->get('limit'))){
                    $limit=$request->get('limit');
                }
                if (!empty($request->get('user_type'))){
                    $type=$request->get('user_type');
                }

                  return Excel::download(new UsersExport($limit,$type), 'users.xlsx');

            }



        $user_id = Session::get('login_id');
        $jobs_query = DB::table('users')
            ->orderBy('updated_at', 'DESC');
        $perPage = DB::table('users')
            ->orderBy('updated_at', 'DESC')->count();
        if ($request->ajax()){
            if ($request->input('limit')!=''){
                $perPage=$request->input('limit');
            }
            if ($request->input('user_type')!=''){
                $jobs_query=$jobs_query->where('user_role',$request->input('user_type'));
            }
            if($request->input('search')!=''){
                $jobs_query=$jobs_query->where('email','Like','%'.$request->input('search').'%')
                    ->orWhere('user_nicename','Like','%'.$request->input('search').'%');
            }
            
           $jobs=$jobs_query->where('user_role','!=','admin')->paginate($perPage);
           
            return view('admin.tables.user_listing', ['jobs' => $jobs])->render();
        }
       $jobs=$jobs_query->where('user_role','!=','admin')->paginate($perPage);
        return view('admin.usersListing', compact('jobs'));
    }
    public function userDetail($user_id){
        $user_id=decrypt($user_id);
        if (!empty($user=DB::table('users')->where('user_id',$user_id)->first())){
            if ($user->user_role=='freelancer'){
                $role=$user->user_role;
                $profile=DB::table('users')->join('user_profile','users.user_id','=','user_profile.user_id')
                    ->join('users_categories','user_profile.user_id','=','users_categories.user_id')
                    ->join('categorie','users_categories.category_id','=','categorie.id')
                    ->where('users.user_id',$user_id)->first();
                $total_purposal=DB::table('proposals')->where('user_id',$user_id)->count();
                $hire_fre=DB::table('hired_freelancer')->where('user_id',$user_id)->where('status',1)->count();
                $completed_jobs=DB::table('job_completed')->join('jobs','job_completed.job_id','=','jobs.job_id')
                    ->where('jobs.progress',3)
                    ->where('job_completed.user_id',$user_id)->count();
                $total_earnings=DB::table('invoices')->join('job_completed','invoices.job_id','=','job_completed.job_id')
                    ->where('invoices.freelancer_id',$user_id)
                    ->where('job_completed.status',1)
                    ->sum('invoices.amount');
                $total_calim=DB::table('claim_jobs')->where('freelancer_id',$user_id)->sum('amount');
                $claim_jobs=DB::table('claim_jobs')->where('freelancer_id',$user_id)->count();
                $jobs_info=DB::table('users')->join('job_completed','users.user_id','=','job_completed.user_id')
                    ->join('jobs','job_completed.job_id','=','jobs.job_id')
                ->join('invoices','jobs.job_id','=','invoices.job_id')
                ->where('users.user_id',$user_id)->orderBy('jobs.created_at','DESC')->get()->toarray();
                $info=[];
                foreach($jobs_info as $inf){
                    $inf->client_name=DB::table('users')->where('user_id',$inf->client_id)->value('user_nicename');
                    $inf->client_email=DB::table('users')->where('user_id',$inf->client_id)->value('email');
                   $info[]=$inf;
                }
                return view('admin.user_detail',compact('role','claim_jobs','profile','info','total_purposal','hire_fre','completed_jobs','total_earnings','total_calim'));
            }
            else if($user->user_role=='client'){
                $role=$user->user_role;
                $profile=DB::table('users')->where('user_id',$user_id)->first();
                $hire_fre=DB::table('hired_freelancer')->where('client_id',$user_id)->where('status',1)->count();
                $completed_jobs=DB::table('job_completed')->join('jobs','job_completed.job_id','=','jobs.job_id')
                    ->where('jobs.progress',3)
                    ->where('job_completed.client_id',$user_id)->count();
                $total_earnings=DB::table('invoices')->join('job_completed','invoices.job_id','=','job_completed.job_id')
                    ->where('invoices.client_id',$user_id)
                    ->where('job_completed.status',1)
                    ->sum('invoices.client_pay_to_admin');
                $total_calim=DB::table('claim_jobs')->where('client_id',$user_id)->sum('amount');
                $claim_jobs=DB::table('claim_jobs')->where('client_id',$user_id)->count();
                $jobs_info=DB::table('users')->join('job_completed','users.user_id','=','job_completed.client_id')
                    ->join('jobs','job_completed.job_id','=','jobs.job_id')
                    ->join('invoices','jobs.job_id','=','invoices.job_id')
                    ->select('*','invoices.client_pay_to_admin as client_pay_to_admin')
                    ->where('users.user_id',$user_id)
                    ->orderBy('jobs.created_at','DESC')
                    ->get()->toarray();
                $info=[];
                foreach($jobs_info as $inf){
                    $inf->freelancer_name=DB::table('users')->where('user_id',$inf->freelancer_id)->value('user_nicename');
                    $inf->freelancer_email=DB::table('users')->where('user_id',$inf->freelancer_id)->value('email');
                    $info[]=$inf;
                }
                return view('admin.user_detail',compact('role','claim_jobs','profile','info','hire_fre','completed_jobs','total_earnings','total_calim'));
            }
            else{
                return redirect()->back();
            }
        }

        else{
            return redirect()->back();
        }
    }
    public function SuccessJobListing(){
        $user_id = Session::get('login_id');
        $jobs_query = DB::table('job_completed')
            ->join('proposals','proposals.proposal_id','=','job_completed.proposal_id')
            ->join('jobs','jobs.job_id','=','job_completed.job_id')
            ->join('users','users.user_id','=','jobs.user_id')
            ->where('job_completed.status',1)
            ->where('jobs.progress',3)
            ->select('jobs.*','users.name')->orderBy('jobs.created_at', 'DESC')->get()->toArray();
        $jobs = [];
        foreach ($jobs_query as $job) {
            $job->hired = DB::table('proposals')->where('job_id',$job->job_id)->where('offers',1)->count();
            $jobs[] = $job;
        }
        return view('admin.successJobListing', compact('jobs'));
    }
    public function faildJobs(Request $request){
        $user_id = Session::get('login_id');
        $jobs_query = \DB::table('jobs')->join('users','users.user_id','=','jobs.user_id')->where('jobs.job_completed', 0)->where('jobs.status', -1)->select('jobs.*','users.name')->orderBy('jobs.created_at', 'DESC')->get()->toArray();
        $jobs = [];
        $perPage = 5;
        $currentPage = Paginator::resolveCurrentPage();
        if ($request->ajax()){
            $jobs_query = \DB::table('jobs')->join('users','users.user_id','=','jobs.user_id')->where('jobs.job_completed', 0)->where('jobs.status', -1);
            if ($request->input('limit')!=''){
                $perPage=$request->input('limit');
            }
            if ($request->input('search')!=''){
                $jobs_query=$jobs_query->where('job_title','like','%'.$request->input('search').'%');
            }
            $jobs_query=$jobs_query->select('jobs.*','users.name')->orderBy('jobs.created_at', 'DESC')->get()->toArray();
            foreach ($jobs_query as $job) {
                $job->hired = DB::table('proposals')->where('job_id',$job->job_id)->where('offers',1)->count();
                $jobs[] = $job;
            }
            $col = collect($jobs);
            $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $jobs = new Paginator($currentPageItems, count($col), $perPage);
            $jobs->setPath($request->url());
            $jobs->appends($request->all());
            return view('admin.tables.faild_jobTable', ['jobs' => $jobs])->render();
        }
        foreach ($jobs_query as $job) {
            $job->hired = DB::table('proposals')->where('job_id',$job->job_id)->where('offers',1)->count();
            $jobs[] = $job;
        }

        $col = collect($jobs);
        $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $jobs = new Paginator($currentPageItems, count($col), $perPage);
        $jobs->setPath($request->url());
        $jobs->appends($request->all());
        return view('admin.faildJobListing', compact('jobs'));
    }
    public function manage_client(Request $request)
    {    $name = '';
        if(!empty($request->search_keyword)){
            $name = $request->search_keyword;
          }
        $clients = DB::table('users')->select("*")->where('user_role', 'client')->where('user_nicename', 'LIKE', '%'.$name.'%')->get()->toArray();
        if(!empty($clients)){
            $clients=$this->paginate($clients);
        }
        
        if($request->ajax()){
          
            return view('admin.tables.manage_client',  ['clients' => $clients])->render();
        }
        return view('admin.manage_client', compact('clients'));
    }
    public function paginate($items, $perPage = 2, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new Paginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    }
    public function manage_freelancer(Request $request)
    {   $name = '';
        if(!empty($request->search_keyword)){
            $name = $request->search_keyword;
          }
          $freelancer = DB::table('users')->select("*")->where('user_role', 'freelancer')->where('user_nicename', 'LIKE', '%'.$name.'%')->orderBy('created_at','asc')->get()->toArray();
          if(!empty($freelancer)){
            $freelancer=$this->paginate($freelancer);
        }
        
        if($request->ajax()){
          
            return view('admin.tables.manage_freelancer',  ['freelancer' => $freelancer])->render();
        }
        return view('admin.manage_freelancer', compact('freelancer'));
    }
    public function manage_terms()
    {
        $result = DB::table('term_conditions')->select("*")->get()->toArray();
        $terms = $result[0]->text;
        return view('admin.manage_terms', compact('terms'));
    }
    public function save_terms()
    {
        DB::table('term_conditions')->where('id', 1)->update(['text' => $_REQUEST['terms_conditions']]);
        return Redirect::back();
    }
    public function suspend_user($user_id)
    {
        DB::table('users')->where('user_id', $user_id)->update(['account_suspended'=>1]);
        return Redirect::back();
    }
    public function activate_suspend_user($user_id)
    {
        DB::table('users')->where('user_id', $user_id)->update(['account_suspended'=>0]);
        return Redirect::back();
    }
     public function approve_user($user_id)
    {
       $update= DB::table('users')->where('user_id', $user_id)->update(['user_status'=>1]);
       if ($update){
           $email=DB::table('users')->where('user_id', $user_id)->value('email');
           $this->email_approved_account($email);
           return Redirect::back()->with('status','Freelancer is approved successfully');
       }

    }
    public function email_approved_account($email){
        if(empty($email))
        {
            return;
        }
        $subject = "Status";
        $message = "<h3>You are approved successfully!</h3>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";
        mail($email,$subject,$message,$headers);

    }
    public function verify_user($user_id)
    {
        DB::table('users')->where('user_id', $user_id)->update(['is_verify'=>1]);
        return Redirect::back();
    }
    public function unverify_user($user_id)
    {
        DB::table('users')->where('user_id', $user_id)->update(['is_verify'=>0]);
        return Redirect::back();
    }
    public function update_option_view()
    {
        $option = DB::table('admin_option')->select("*")->first();
        return view('admin.admin_option', compact('option'));
    }
     public function update_option_with_admin(Request $request)
    {
        if ($request->hasFile('image')) {
            $image=$request->file('image');
            $insert_update['image'] = $image->getClientOriginalName();
        }
        $insert_update['facebook'] = $request->input('facebook');
        $insert_update['twitter'] = $request->input('twitter');
        $insert_update['google'] = $request->input('google');
        $insert_update['job_fee'] = $request->input('job_fee');
        $insert_update['linkedin'] = $request->input('linkedin');
        $insert_update['phone'] = $request->input('phone');
        $insert_update['email'] = $request->input('email');
        $insert_update['date_to'] = $request->input('date_to');
        $insert_update['date_from'] = $request->input('date_from');
        $insert_update['vat'] = $request->input('vat');
        $insert_update['terms']=$request->input('terms');
        if ($option = DB::table('admin_option')->where('option_id', $request->input('option_id'))->first()) {
            $image_name=$option->image;
            DB::table('admin_option')->where('option_id', $request->input('option_id'))->update($insert_update);
            if ($request->hasFile('image')) {
                $this->upload_background_Photo($request->file('image'));
                $filename = public_path().'/images/qouts/background_images/'. $image_name;
                \File::delete($filename);
            }

        } else {
            DB::table('admin_option')->insert($insert_update);
            if ($request->hasFile('image')) {
                $this->upload_background_Photo($request->file('image'));
            }
        }
        return Redirect::back();
    }
    public function upload_background_Photo($image1){
        $name = $image1->getClientOriginalName();
        $destinationPath = public_path('/images/qouts/background_images');
        $image1->move($destinationPath, $name);
    }
    public function report_abuse_freelancer()
    {
        $sql = "SELECT rf.client_id, rf.freelancer_id, rf.description, rf.created_at, CONCAT(f.name, ' ', f.last_name) AS freelancer, CONCAT(c.name, ' ', c.last_name) AS client FROM report_freelancer AS rf LEFT JOIN users AS f ON rf.freelancer_id = f.user_id LEFT JOIN users AS c ON rf.client_id = c.user_id ORDER BY created_at DESC";
        $freelancer = DB::select($sql);
        return view('admin.reportabuse_freelancer', compact('freelancer'));
    }
     public function manage_qouts_form(){
        return view('admin.qouts_form');
    }
     public function manage_qouts(){
         $all_qouts = DB::table('qouts')->get();
        return view('admin.qouts_manage',compact('all_qouts'));
    }
    public function edit_qouts_form($id){
        $qouts = DB::table('qouts')->where('id',$id)->get();
        return view('admin.qouts_edit_form',compact('qouts'));
    }
    public function post_qouts(Request $request){
          $resp=array();

          $rules = [
      'qouts_image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
       'title'=>'required',
       'ar_title'=>'required',
       'description'=>'required|min:10',
       'ar_description'=>'required|min:10'
                   ];
          $messages=[
        'qouts_image.mimes'=>'image type should be jpeg,jpg,png,gif',
        'qouts_image.image'=>'Your input type is not image',
        'qouts_image.max'=>'your image size is large',
        'title.required'=>'Write qouts title in english!',
        'ar_title.required'=>'Write qouts title in arabic!',
        'description.required'=>'Write qouts description in english',
        'ar_description.required'=>'Write qouts description in arabic',
        'description.min'=>'Your description should be more than 10 character',
        'ar_description.min'=>'Your description should be more than 10 character',
                   ];
        $validater=Validator::make($request->all(),$rules,$messages);
        if ($validater->fails()) {
            $resp['status'] = false;
            $resp['errors'] = $validater->errors();
        }
        else{
            $resp['status']=true;
            $resp['success']='You have add Qouts Successfully';
            //$this->upload_image_thumbnails(Input::file('qouts_image'));
            $new_image_name='default.jpg';
            if (!empty($request->file('qouts_image'))) {
                $originalImage=$request->file('qouts_image');
                $this->upload_image_thumbnails($request->file('qouts_image'));
                $this->uploadOriginalPhoto($originalImage);
                $new_image_name='thumbnail'.time().$originalImage->getClientOriginalName();
            }


            $data=[
            'title'=>$request->input('title'),
            'ar_title'=>$request->input('ar_title'),
            'description'=>$request->input('description'),
            'ar_description'=>$request->input('ar_description'),
            'image'=>$new_image_name
            ];
            DB::table('qouts')->insert($data);
        }
echo json_encode($resp);
    
    }
    public function edit_post_qouts(Request $request){
        $resp=array();
        $rules = [
            'qouts_image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'title'=>'required',
            'ar_title'=>'required',
            'description'=>'required|min:10',
            'ar_description'=>'required|min:10'
        ];
        $messages=[
            'qouts_image.mimes'=>'image type should be jpeg,jpg,png,gif',
            'qouts_image.image'=>'Your input type is not image',
            'qouts_image.max'=>'your image size is large',
            'title.required'=>'Write qouts title in english!',
            'ar_title.required'=>'Write qouts title in arabic!',
            'description.required'=>'Write qouts description in english',
            'ar_description.required'=>'Write qouts description in arabic',
            'description.min'=>'Your description should be more than 10 character',
            'ar_description.min'=>'Your description should be more than 10 character',
        ];
        $validater=Validator::make($request->all(),$rules,$messages);
        if ($validater->fails()) {
            $resp['status'] = false;
            $resp['errors'] = $validater->errors();
        }
        else{
            $resp['status']=true;
            $resp['success']='You have add Qouts Successfully';
            $image = DB::table('qouts')->where('id',$request->input('qout_id'))->first();
            $new_image_name=$image->image;
            if (!empty($request->file('qouts_image'))) {
                $image = DB::table('qouts')->where('id',$request->input('qout_id'))->first();
                $file= $image->image;
                if ($file!='default.jpg') {
                $filename = public_path().'/images/qouts/'.$file;
                \File::delete($filename);
         }
                $originalImage=$request->file('qouts_image');
                $this->upload_image_thumbnails($request->file('qouts_image'));
                $this->uploadOriginalPhoto($originalImage);
                $new_image_name='thumbnail'.time().$originalImage->getClientOriginalName();
            }


            $data=[
                'title'=>$request->input('title'),
                'ar_title'=>$request->input('ar_title'),
                'description'=>$request->input('description'),
                'ar_description'=>$request->input('ar_description'),
                'image'=>$new_image_name
            ];
            DB::table('qouts')->where('id',$request->input('qout_id'))->update($data);
        }
        echo json_encode($resp);

    }
    public function upload_image_thumbnails($image){
        $originalImage=$image;
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/images/qouts/thumbnail';
        $thumbnailImage->resize(300,300);
        $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());   
}

public function uploadOriginalPhoto($image1){
        $image = $image1;
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/qouts/qouts');
        $image->move($destinationPath, $name); 
    }
   public function destroy_qouts($id){
       $image = DB::table('qouts')->where('id', $id)->first();
       $file= $image->image;
       if ($file!='default.jpg') {
       $filename = public_path().'/images/qouts/'.$file;
       \File::delete($filename);
       }
        $check=DB::table('qouts')->where('id',$id)->delete();
    if ($check){
       return redirect('/manage_qouts')->with('message','You have deleted qouts Success fully');
    }
    else{
       return redirect('/manage_qouts')->with('message','Sorry Due to some problem You cannot delete it');
    }
   }
    public function manage_skills(){
        $all_qouts = DB::table('categorie')->where('parent_id',0)->get();
        return view('admin.skills_manage',compact('all_qouts'));
    }
    public function manage_sub_skills($id){
        $all_qouts = DB::table('categorie')->where('parent_id',$id)->get();
        return view('admin.sub_skills_manage',['all_qouts'=>$all_qouts,'id'=>$id]);
    }
    public function manage_skills_form(){

        return view('admin.skills_form');
    }
    public function post_skill(Request $request){
        $resp=array();

        $rules = [
            'title'=>'required',
            'ar_title'=>'required',
        ];
        $messages=[

            'title.required'=>'Write Skills title in english!',
            'ar_title.required'=>'Write Skills title in arabic!'

        ];
        $validater=Validator::make($request->all(),$rules,$messages);
        if ($validater->fails()) {
            $resp['status'] = false;
            $resp['errors'] = $validater->errors();
        }
        else{
            $resp['status']=true;
            $resp['success']='You have add Skill Successfully';
            $data=[
                'freelancer_skill'=>ucwords($request->input('title')),
                'ar_freelancer_skill'=>ucwords($request->input('ar_title'))
            ];
            DB::table('categorie')->insert($data);
        }
        echo json_encode($resp);

    }
    public function destroy_skill($id){
        $check1=DB::table('categorie')->where('id',$id)->delete();
        $check=DB::table('categorie')->where('parent_id',$id)->delete();
        if ($check){
            return redirect('/manage_skills')->with('message','You have deleted Skill Success fully');
        }
        else{
            return redirect('/manage_skills')->with('message','Sorry Due to some problem You cannot delete it');
        }
    }
    public function edit_skill_form($id){
        $skill_id = DB::table('categorie')->where('id',$id)->first();
        return view('admin.edit_skill_form',compact('skill_id'));
    }
    public function edit_post_skill(Request $request){
        $resp=array();

        $rules = [
            'title'=>'required',
            'ar_title'=>'required',
        ];
        $messages=[

            'title.required'=>'Write Skills title in english!',
            'ar_title'=>'Write Skills title in arabic!'

        ];
        $validater=Validator::make($request->all(),$rules,$messages);
        if ($validater->fails()) {
            $resp['status'] = false;
            $resp['errors'] = $validater->errors();
        }
        else{
            $resp['status']=true;
            $resp['success']='You have add Skill Successfully';
            $data=[
                'freelancer_skill'=>ucwords($request->input('title')),
                'ar_freelancer_skill'=>ucwords($request->input('ar_title'))
            ];
            DB::table('categorie')->where('id',$request->input('skill_id'))->update($data);
        }
        echo json_encode($resp);
    }
    public function manage_sub_skills_form($id){
        return view('admin.sub_skill_form',['id'=>$id]);
    }
    public function post_sub_skill(Request $request){
        $resp=array();

        $rules = [
            'title'=>'required',
            'ar_title'=>'required',
        ];
        $messages=[

            'title.required'=>'Write Skills title in english!',
            'ar_title.required'=>'Write Skills title in arabic!'

        ];
        $validater=Validator::make($request->all(),$rules,$messages);
        if ($validater->fails()) {
            $resp['status'] = false;
            $resp['errors'] = $validater->errors();
        }
        else{
            $resp['status']=true;
            $resp['success']='You have add Skill Successfully';
            $resp['redirect']='view/'.$request->input('parent_id').'/manage_subSkills';
            $data=[
                'freelancer_skill'=>ucwords($request->input('title')),
                'ar_freelancer_skill'=>ucwords($request->input('ar_title')),
                'parent_id'=>$request->input('parent_id')
            ];
            DB::table('categorie')->insert($data);
        }
        echo json_encode($resp);
    }
    public function destroy_sub_skill($id){
        $check=DB::table('categorie')->where('id',$id)->delete();
        if ($check){
            return redirect()->back()->with('message','You have deleted Skill Success fully');
        }
        else{
            return redirect()->back()->with('message','Sorry Due to some problem You cannot delete it');
        }
    }
       public function aprove_freelancer($id){
          DB::table('users')->where('user_id',decrypt($id))->update(['user_status'=>1]);
          $email=DB::table('users')->where('user_id',decrypt($id))->first();
           $view = View::make('templete.freelancer.welcome_freelancer_mail');
           $contents = (string)$view;
          send_mail('mfarhan7333@gmail.com',$email->email,$email->user_nicename,'Welcome You are approved',$contents);
           return redirect('manage/freelancer')->with('message','Freelancer is Aproved Successfully');
       }
       public function reject_freelancer($id){
           DB::table('users')->where('user_id',decrypt($id))->update(['user_status'=>3]);
           $email=DB::table('users')->where('user_id',decrypt($id))->first();
           $view = View::make('templete.freelancer.freelancer_reject_mail',['name'=>$email->user_nicename]);
           $contents = (string)$view;
           send_mail('mfarhan7333@gmail.com',$email->email,$email->user_nicename,'Sorry Your Profile is under Waiting list',$contents);
           return redirect('manage/freelancer')->with('message','Freelancer is Reject Successfully');
       }
       public function fr_bank_info($freelancer_id=''){
           $freelancer_id = Session::get('login_id');
           $bank_info=DB::table('fr_bank_info')->where('freelancer_id',$freelancer_id)->first();
          return view('freelancer.bank_form',compact('bank_info'));
       }
       public function update_fr_bank_info(Request $request){
          $rules=[
            'first_name'=>'required',
              'last_name'=>'required',
              'birth_place'=>'required',
              'email'=>'required|email',
              'bank_name'=>'required',
              'bank_address'=>'required',
              'acount_no'=>'required|numeric'
          ];
          $messages=[
           'first_name.required'=>'FirstName is Required',
              'last_name'=>'LastName is Required',
              'birth_place.required'=>'Birth Place is Required',
              'email.required'=>'Email is Required',
              'email.email'=>'Enter Valid Email address',
              'acount_no.required'=>'Account# is required',
              'acount_no.numeric'=>'Invalid Account#',
          ];
       $validator=Validator::make($request->all(),$rules,$messages);
       if ($validator->fails()){
           return redirect('fr/bank_info')->withErrors($validator->errors(), 'add_bank_info');
       }
       else{
           $freelancer_id = Session::get('login_id');
           if (empty($bank_info=DB::table('fr_bank_info')->where('freelancer_id',$freelancer_id)->first())){
               $data=[
                   'freelancer_id'=>$freelancer_id,
                   'fr_email'=>$request->input('email'),
                   'first_name'=>$request->input('first_name'),
                   'last_name'=>$request->input('last_name'),
                   'bank_address'=>$request->input('bank_address'),
                   'bank_name'=>$request->input('bank_name'),
                   'birth_place'=>$request->input('birth_place'),
                   'bank_account_no'=>$request->input('acount_no')
               ];
               DB::table('fr_bank_info')->insert($data);
           }
           else{
               $data=[
                   'fr_email'=>$request->input('email'),
                   'first_name'=>$request->input('first_name'),
                   'last_name'=>$request->input('last_name'),
                   'bank_address'=>$request->input('bank_address'),
                   'bank_name'=>$request->input('bank_name'),
                   'birth_place'=>$request->input('birth_place'),
                   'bank_account_no'=>$request->input('acount_no')
               ];
               DB::table('fr_bank_info')->where('freelancer_id',$freelancer_id)->update($data);
           }
           return redirect('fr_earning/report');
       }

       }
       public function delete_user($user_id){
           if (empty($user_id)){
               return redirect()->back()->with('status','Something is going wrong');
           }
           else{
               $del=DB::table('users')->where('user_id',$user_id)->delete();
               if($del){
                   return redirect()->back()->with('status','user is deleted successfully');
               }
               else{
                   return redirect()->back()->with('status','Something is going wrong');
               }
           }
       }

}
