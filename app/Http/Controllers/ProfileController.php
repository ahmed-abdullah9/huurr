<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use App\Proposals;
use App\Http\Controllers\HelperController as helper;
use App;
use View;
use Carbon\Carbon;
use Image;
class ProfileController extends Controller
{
    private $user_id;
    public function __construct(){
        $this->user_id = Session::get('login_id');
    }
    public function fr_dashboard()
    {
        $lan = App::getLocale();
        $user_id = Session::get('login_id');
        $user_data=DB::table('users')->where('user_id',$user_id)->first();
        $events = \DB::table('events')->where('user_id', $user_id)->get();
        $all_job = \DB::table('proposals')->where('user_id', $user_id)->count();
        $job_saved = \DB::table('job_saved')->where('user_id', $user_id)->where('status',1)->count();
        // $completed_jobs = \DB::table('proposals')->where('user_id', $user_id)->where('contracted',-1)->where('status',1)->count();
        $completed_jobs=DB::table('job_completed')->where('user_id',$user_id)->count();
        return view('freelancer.dashboard',compact(['user_data','all_job','job_saved','completed_jobs','events','lan']));
    }
    public function add_calender(Request $request)
    {
        $user_id = Session::get('login_id');
        $updateCL = [];
        $updateCL['user_id'] = $user_id;
        $updateCL['title'] = $request->input('title');
        $updateCL['description'] = $request->input('description');
        $updateCL['start_date'] =strtr($request->input('started'), array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
        $updateCL['end_date'] = strtr($request->input('ended'), array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
        DB::table('events')->insert($updateCL);


        die('updated');
    }

    public function update_calender(Request $request)
    {
        $user_id = Session::get('login_id');
        $updateCL = [];
        $updateCL['user_id'] = $user_id;
        $updateCL['title'] = $request->input('title');
        $updateCL['description'] = $request->input('description');
        DB::table('events')->where('id',$request->input('id'))->update($updateCL);
        die('updated');
    }

    public function delete_event(Request $request)
    {
        DB::table('events')->where('id', $request->input('id'))->delete();
        die('deleted');
    }

    public function update_online_status(Request $request)
    {
        $user_id = Session::get('login_id');
        echo Session::get('is_online').">>";
        $updateCL = [];
        $updateCL['is_online'] = $request->input('is_online');
        DB::table('users')->where('user_id',$user_id)->update($updateCL);
        Session::put('is_online',$request->input('is_online'));
    }
    public function cl_dashboard()
    {
        $user_id = Session::get('login_id');
        $all_job = \DB::table('jobs')->where('user_id', $user_id)->count();
        $faild_jobs = \DB::table('jobs')->where('user_id', $user_id)->where('status',-1)->count();
        $completed_jobs = \DB::table('job_completed')->where('client_id', $user_id)->count();
        return view('client.dashboard',compact(['all_job','faild_jobs','completed_jobs']));
    }
    public static function profile_percentage($user_id='')
    {
        if(empty($user_id))
        {
            return 0;
        }
        $percentage = 0;
        $education = DB::table('user_education')->where('user_id',$user_id)->select('user_id')->first();
        $languages = DB::table('user_languages')->where('user_id',$user_id)->select('user_id')->first();
        $profile = DB::table('user_profile')->where('user_id',$user_id)->first();
        if($education)
        {
            $percentage += 8.33;
        }
        if($languages)
        {

            $percentage += 8.33;
        }
        if($profile)
        {
            if(!empty($profile->job_title))
            {

                $percentage += 8.33;
            }
            if(!empty($profile->country))
            {

                $percentage += 8.33;
            }
            if(!empty($profile->city))
            {

                $percentage += 8.33;
            }
            if(!empty($profile->profile_image))
            {

                $percentage += 8.33;
            }
            if(!empty($profile->timezone))
            {
                //time zone missing
                $percentage += 8.33;
            }
            if(!empty($profile->hourly_rate))
            {

                $percentage += 8.33;
            }
            if(!empty($profile->profetional_skills))
            {
                $percentage += 8.33;
            }
            if(!empty($profile->overview))
            {

                $percentage += 8.33;
            }
            if(!empty($profile->availability))
            {
                //  aviliblty  missing

                $percentage += 8.33;
            }
            if(!empty($profile->availability_type))
            {

                $percentage += 8.33;
            }}

        return round($percentage);
    }

    public function cl_profile(){
        $user_id = Session::get('login_id');

        $user_data = DB::table('users')->where('user_id', $user_id)->first();
        $profetional_skills = '';
        $selected_skills = array();

        $profile_data = DB::table('user_profile')->where('user_id', $user_id)->first();

        $profetionl_skills = DB::table('profetionls')->select('profetional_id', 'name as text')->get();

        if(!empty($profile_data))
            $profetional_skills = explode(",", $profile_data->profetional_skills);

        if(!empty($profetional_skills))
            $selected_skills = DB::table('profetionls')->whereIn('profetional_id', $profetional_skills)->get();

        $all_languages = DB::table('user_languages')->where('user_id', $user_id)->get();

        $all_portfolio = DB::table('portfolios')->where('user_id', $user_id)->take(4)->get();

        $all_education = DB::table('user_education')->where('user_id', $user_id)->take(4)->get();

        $all_category = DB::table('categories')->get();

        $percentage = self::profile_percentage($user_id);
        $user_id = Session::get('login_id');

        if(Session::get('user_type') == 'admin'){
            $jobs_query = \DB::table('jobs')->join('users','users.user_id','=','jobs.user_id')->select('jobs.*','users.name')->orderBy('jobs.created_at', 'DESC')->get()->toArray();
        }else{
            $jobs_query = \DB::table('jobs')->join('users','users.user_id','=','jobs.user_id')->where('jobs.status',1)->where('jobs.user_id',$user_id)->select('jobs.*','users.name')->orderBy('jobs.created_at', 'DESC')->get()->toArray();
        }
        $jobs = [];
        foreach ($jobs_query as $job) {
            $job->hired = DB::table('proposals')->where('job_id',$job->job_id)->where('offers',1)->count();
            $jobs[] = $job;
        }

        return view('user.cl_profile', compact(['user_data', 'profile_data', 'profetionl_skills', 'selected_skills', 'all_languages', 'all_portfolio', 'all_education', 'all_category','percentage','jobs']));

    }
    public function fr_profile(){
        $user_id = Session::get('login_id');
        echo $user_id; exit;
        $user_data = DB::table('users')->where('user_id', $user_id)->first();
        $profetional_skills = '';
        $selected_skills = array();

        $profile_data = DB::table('user_profile')->where('user_id', $user_id)->first();

        $profetionl_skills = DB::table('profetionls')->select('profetional_id', 'name as text')->get();

        if(!empty($profile_data))
            $profetional_skills = explode(",", $profile_data->profetional_skills);

        if(!empty($profetional_skills))
            $selected_skills = DB::table('profetionls')->whereIn('profetional_id', $profetional_skills)->get();

        $all_languages = DB::table('user_languages')->where('user_id', $user_id)->get();

        $all_portfolio = DB::table('portfolios')->where('user_id', $user_id)->take(4)->get();

        $all_education = DB::table('user_education')->where('user_id', $user_id)->take(4)->get();

        $all_category = DB::table('categories')->get();

        $percentage = self::profile_percentage($user_id);
        $jobs  = proposals::get_completed_job();

        return view('user.fr_profile', compact(['user_data', 'profile_data', 'profetionl_skills', 'selected_skills', 'all_languages', 'all_portfolio', 'all_education', 'all_category','percentage','jobs']));

    }
    public function edit_cl_profile(){
        $user_id = Session::get('login_id');

        $user_data = DB::table('users')->where('user_id', $user_id)->first();

        //print_r($user_data);die();

        $profetional_skills = '';
        $selected_skills = array();
        //$profile_data = [];

        $profile_data = DB::table('user_profile')->where('user_id', $user_id)->first();

        $profetionl_skills = DB::table('profetionls')->select('profetional_id', 'name as text')->get();

        if(!empty($profile_data))
            $profetional_skills = explode(",", $profile_data->profetional_skills);


        if(!empty($profetional_skills))
            $selected_skills = DB::table('profetionls')->whereIn('profetional_id', $profetional_skills)->get();

        $all_languages = DB::table('user_languages')->where('user_id', $user_id)->get();

        $all_portfolio = DB::table('portfolios')->where('user_id', $user_id)->take(4)->get();

        $all_education = DB::table('user_education')->where('user_id', $user_id)->take(4)->get();

        $all_category = DB::table('categories')->get();

        $percentage = self::profile_percentage($user_id);

        return view('user.edit_cl_profile', compact(['user_data', 'profile_data', 'profetionl_skills', 'selected_skills', 'all_languages', 'all_portfolio', 'all_education', 'all_category','percentage']));

    }
    public function edit_fr_profile()
    {
        $user_id = Session::get('login_id');
        $all_languages='';
        $user_selected_skills=DB::table('users_categories')->where('user_id',$user_id)->first();
        $user_possible_skills=DB::table('categorie')->where('id',$user_selected_skills->parent_id)
            ->orWhere('parent_id',$user_selected_skills->parent_id)->get();
            
        $main_category=DB::table('categorie')->where('parent_id',0)->get();
        $categories=DB::table('categorie')->get();
        $job_fee=DB::table('admin_option')->value('job_fee');
        
        $user_data = DB::table('users')->where('user_id', $user_id)->first();
        $freelancer_parent_category="";
        $freelancer_categry="";
         
        $freelancer_categry=DB::table('users_categories')->where('user_id',$user_id)->first();
        
       
        if(!empty($freelancer_categry)){
            $freelancer_parent_category=DB::table('categorie')->where('id',$freelancer_categry->parent_id)->first();
            $freelancer_categry=DB::table('categorie')->where('id',$freelancer_categry->category_id)->first();
        }
        $profetional_skills = '';
        $profetional_skills2='';
        $selected_skills = array();
        $profile_data = DB::table('user_profile')->where('user_id', $user_id)->first();

        if(!empty($profile_data->profetional_skills)){
            $profetional_skills2=DB::table('categorie')->whereIn('id',json_decode($profile_data->profetional_skills))->get();
            $profile_data->profetional_skills2=$profetional_skills2;
            if(!empty($profetional_skills2)){
               foreach($profetional_skills2 as $s_s){
                   $selected_skills[]=$s_s->id;
               }
           }
        }


        $profetionl_skills = DB::table('profetionls')->select('profetional_id', 'name as text')->get();

        if(!empty($profile_data))
            $profetional_skills = explode(",", $profile_data->profetional_skills);


        if(!empty($profetional_skills))
            //$selected_skills = DB::table('profetionls')->whereIn('profetional_id', $profetional_skills)->get();

            $all_languages = DB::table('user_languages')->where('user_id', $user_id)->get();


        $all_portfolio = DB::table('portfolios')->where('user_id', $user_id)->get();

        $all_education = DB::table('user_education')->where('user_id', $user_id)->take(4)->get();

        $all_category = DB::table('categorie')->where('parent_id',0)->get();

        $percentage = self::profile_percentage($user_id);
        $jobs  = proposals::get_completed_job();
        
       //dd($all_portfolio);
        
        return view('user.edit_fr_profile', compact(['user_data','jobs','main_category','categories','freelancer_categry','freelancer_parent_category', 'profile_data', 'profetionl_skills', 'selected_skills', 'all_languages', 'all_portfolio', 'all_education', 'all_category','percentage','job_fee','user_possible_skills']));
    }
    public function view_fr_profile($fr_id){
        $user_id = decrypt($fr_id);
        $main_category=DB::table('categorie')->where('parent_id',0)->get();
        $categories=DB::table('categorie')->get();
        $job_fee=DB::table('admin_option')->value('job_fee');
        $user_data = DB::table('users')->where('user_id', $user_id)->first();
        $freelancer_parent_category="";
        $freelancer_categry="";
        $freelancer_categry=DB::table('users_categories')->where('user_id',$user_id)->first();
        if(!empty($freelancer_categry)){
            $freelancer_parent_category=DB::table('categorie')->where('id',$freelancer_categry->parent_id)->first();
            $freelancer_categry=DB::table('categorie')->where('id',$freelancer_categry->category_id)->first();
        }
        $profetional_skills = '';
        $profetional_skills2='';
        $selected_skills = array();
        $profile_data = DB::table('user_profile')->where('user_id', $user_id)->first();
        if(!empty($profile_data->profetional_skills)){
            $profetional_skills2=DB::table('categorie')->whereIn('id',json_decode($profile_data->profetional_skills))->get();
        }
        $profile_data->profetional_skills2=$profetional_skills2;
        $profetionl_skills = DB::table('profetionls')->select('profetional_id', 'name as text')->get();

        if(!empty($profile_data))
            $profetional_skills = explode(",", $profile_data->profetional_skills);


        if(!empty($profetional_skills))
            $selected_skills = DB::table('profetionls')->whereIn('profetional_id', $profetional_skills)->get();

        $all_languages = DB::table('user_languages')->where('user_id', $user_id)->get();

        $all_portfolio = DB::table('portfolios')->where('user_id', $user_id)->take(4)->get();

        $all_education = DB::table('user_education')->where('user_id', $user_id)->take(4)->get();

        $all_category = DB::table('categorie')->where('parent_id',0)->get();

        $percentage = self::profile_percentage($user_id);

        return view('user.view_fr_profile', compact(['user_data','main_category','categories','freelancer_categry','freelancer_parent_category', 'profile_data', 'profetionl_skills', 'selected_skills', 'all_languages', 'all_portfolio', 'all_education', 'all_category','percentage','job_fee']));
    }
    public function edit_fr_profile2(){
        $user_id = Session::get('login_id');

        $user_data = DB::table('users')->where('user_id', $user_id)->first();

        //print_r($user_data);die();

        $profetional_skills = '';
        $selected_skills = array();
        //$profile_data = [];

        $profile_data = DB::table('user_profile')->where('user_id', $user_id)->first();

        $profetionl_skills = DB::table('profetionls')->select('profetional_id', 'name as text')->get();

        if(!empty($profile_data))
            $profetional_skills = explode(",", $profile_data->profetional_skills);


        if(!empty($profetional_skills))
            $selected_skills = DB::table('profetionls')->whereIn('profetional_id', $profetional_skills)->get();

        $all_languages = DB::table('user_languages')->where('user_id', $user_id)->get();

        $all_portfolio = DB::table('portfolios')->where('user_id', $user_id)->take(4)->get();

        $all_education = DB::table('user_education')->where('user_id', $user_id)->take(4)->get();

        $all_category = DB::table('categories')->get();

        $percentage = self::profile_percentage($user_id);

        return view('user.edit_fr_profile2', compact(['user_data', 'profile_data', 'profetionl_skills', 'selected_skills', 'all_languages', 'all_portfolio', 'all_education', 'all_category','percentage']));

    }
    
    public function profileupdateImage(Request $request)
    {
        $profile_data = array();
            
        if($request->file('profile_image'))
        {

            $image = $request->file('profile_image');
            $filename = time().'_'.$image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
           
                $thumbnailImage = Image::make($image);
                $filename = time().'_'.$image->getClientOriginalName();
                $thumbnailPath = 'public/images/uploads/';
                $thumbnailImage->resize(150,150);
                $thumbnailImage->save($thumbnailPath.$filename);
                $profile_data['profile_image'] = 'public/images/uploads/'.$filename;
    //            $file = $request->file('profile_image');
    //            $destinationPath = 'public/images/uploads/'.date('Y').'/'.date('M');
    //            $filename = time().'_'.$file->getClientOriginalName();
    //            $upload_success = $file->move($destinationPath, $filename);
    //            $profile_data['profile_image'] = 'public/images/uploads/'.date('Y').'/'.date('M').'/'.$filename;
           
            
            
        }
        $user_id = Session::get('login_id');


        $profile_data['user_id'] = $user_id;
        $profile = DB::table('user_profile')->where('user_id', $user_id)->first();

        if(empty($profile)){
            DB::table('user_profile')->insert($profile_data);
            Session::put([
                'profile_image' => $profile_data['profile_image']
            ]);
            session('profile_image', $profile_data['profile_image']);
        }else{
            Db::table('user_profile')->where('user_id', $user_id)->update($profile_data);
            Session::put([
                'profile_image' => $profile_data['profile_image']
            ]);
        }
        echo url('/').'/'.$profile_data['profile_image'];
    }
    
    public function update(Request $request, $id){
        //return $request->all();
        $profile_data = array();

        $job_title = $request->input('job_title');
        $profetional_skills = $request->input('profetional_skills');
        $overview = $request->input('overview');
        $availability_type = $request->input('availability_type');
        $not_available_text = $request->input('not_available_text');


        if(!empty($request->input('country'))){
            $profile_data['country'] = $request->input('country');
        }
        if(!empty($request->input('state'))){
            $profile_data['state'] = $request->input('state');
        }
        if(!empty($request->input('timezone'))){
            $profile_data['timezone'] = $request->input('timezone');
        }
        if(!empty($request->input('city'))){
            $profile_data['city'] = $request->input('city');
        }
        if(!empty($request->input('hourly_rate'))){
            $profile_data['hourly_rate'] = $request->input('hourly_rate');
        }
        if(!empty($request->input('service_fee'))){
            $profile_data['service_fee'] = $request->input('service_fee');
        }
        if(!empty($request->input('will_be_paid'))){
            $profile_data['will_be_paid'] = $request->input('will_be_paid');
        }

        if(!empty($job_title)){
            $profile_data['job_title'] = $job_title;
        }

        if(!empty($profetional_skills)){
            $profile_data['profetional_skills'] = json_encode($profetional_skills);
        }

        if(!empty($overview)){
            $profile_data['overview'] = $overview;
        }

        if(!empty($availability_type)){
            $profile_data['availability_type'] = $availability_type;
        }

        if(!empty($not_available_text)){
            $profile_data['not_available_text'] = $not_available_text;
            $profile_data['availability_type'] = 0;
            $profile_data['availability'] = 2;
        }
        if(empty($not_available_text))
        {
            $profile_data['availability'] = 1;
            $profile_data['not_available_text'] = $not_available_text;
        }

        $user_id = Session::get('login_id');


        $profile_data['user_id'] = $user_id;


        //print_r($profile_data); die();

        $profile = DB::table('user_profile')->where('user_id', $id)->first();

        if(empty($profile)){
            // insert into freelancer_profiles
            DB::table('user_profile')->insert($profile_data);

        }else{
            // update into freelancer_profiles
            Db::table('user_profile')->where('user_id', $id)->update($profile_data);
        }


        // Language Update
        $lang_skill = $request->input('lang_skill');
        $lang_name = $request->input('lang_name');
        $lang_id = $request->input('id');
        if(!empty($lang_skill)){
            $lang_data['lang_name'] = $lang_name;
            $lang_data['lang_skill'] = $lang_skill;
            $lang_data['user_id'] = $user_id;

            if($lang_id == 0){
                DB::table('user_languages')->insert($lang_data);
            }else{

                $lang=DB::table('user_languages')->where('id', $lang_id)->update($lang_data);
            }
        }

        // Portfolio

        $portfolio = array();
        $project_title = $request->input('project_title');
        if(!empty($project_title)){

            $thumb = $request->thumb_image;
            if(!empty($request->file('thumb_image')))
            {
                $file_name = self::fileupload($request);
            }else
            {
                $file_name = '';
            }

            $portfolio['thumb_image'] = $file_name;
            $portfolio['user_id'] = $user_id;
            $portfolio['project_title'] = $project_title;

            $portfolio['project_overview'] = $request->input('project_overview');

            $portfolio['project_id'] = $request->input('project_id');

            $portfolio['category_id'] = $request->input('category_id');

            $portfolio['project_url'] = $request->input('project_url');

            $portfolio['completion_date'] = $request->input('completion_date');

            $portfolio['completion_date'] = $request->input('completion_date');

            DB::table('portfolios')->insert($portfolio);
        }

        //Education
        $education = array();
        $education = $request->all();

        if(!empty($education['school'])){
            unset($education['_token']);
            $education['user_id'] = $user_id;
            DB::table('user_education')->insert($education);
        }
        $us = DB::table('users')->select('user_role')->where('user_id',$user_id)->first();
        if($us->user_role == 'freelancer')
        {
            return redirect('/edit/fr/profile/');
        }
        return redirect('/edit/cl/profile/');
    }
    public function updateportfolio(Request $request)
    {
        $portfolio = array();
        $project_title = $request->input('project_title');
        if(!empty($project_title)){

            $thumb = $request->thumb_image;
            if(!empty($request->file('thumb_image')))
            {

                $portfolio['thumb_image'] = self::fileupload($request);
            }

            $portfolio['project_title'] = $project_title;

            $portfolio['project_overview'] = $request->input('project_overview');

            $portfolio['project_id'] = $request->input('project_id');

            $portfolio['category_id'] = $request->input('category_id');

            $portfolio['project_url'] = $request->input('project_url');

            $portfolio['completion_date'] = $request->input('completion_date');

            $portfolio['skills'] = $request->input('skills');

            DB::table('portfolios')->where('portfolio_id',$request->input('portfolio_id'))->update($portfolio);
            return redirect('edit/fr/profile');
        }
        return redirect('edit/fr/profile');
    }
    public function updateEducation(Request $request){

    }
    public function fileupload($request){

        $files = $request->file('thumb_image');

        $destinationPath = 'public/images/uploads/'.date('Y').'/'.date('M');
        $filename = str_replace(array(' ','-','`',','),'_',time().'_'.$files->getClientOriginalName());
        $upload_success = $files->move($destinationPath, $filename);
        return 'public/images/uploads/'.date('Y').'/'.date('M').'/'.$filename;

    }
    public function edit_fr_category(Request $request){
        $resp = array();
        if (!empty($request->input('sub_skill'))) {
            $check=DB::table('users_categories')->where(['user_id'=>session('login_id'),'category_id'=>$request->input('sub_skill')])->first();
            if(!empty($check)){
                $updated_time=DB::table('users_categories')->where(['user_id'=>session('login_id'),'category_id'=>$request->input('sub_skill')])->value('updated_at');
                $current_timestamp =Carbon::now()->toDateTimeString();
                $diff=strtotime($current_timestamp)-strtotime($updated_time);
                $days=floor($diff/(60*60*24));
                if ($days>7){
                    DB::table('users')->where('user_id',session('login_id'))->update(['user_status'=>2]);
                    $parent_id=DB::table('categorie')->where('id',$request->input('sub_skill'))->value('parent_id');
                    DB::table('users_categories')->where('user_id',session('login_id'))->update(['category_id'=>$request->input('sub_skill'),'parent_id'=>$parent_id,'updated_at'=>$current_timestamp]);
                    $user=DB::table('users')->where('user_id',session('login_id'))->first();
                    if($user->user_status==2) {
                        $freelancer_category = DB::table('users as u')
                            ->join('users_categories as uc', 'uc.user_id', '=', 'u.user_id')
                            ->join('categorie as c', 'c.id', '=', 'uc.category_id')
                            ->where('u.user_id','=',$user->user_id)
                            ->get();
                        $parent_skill=DB::table('categorie')->where('id',$freelancer_category[0]->parent_id)->value('freelancer_skill');
                        $total=DB::table('users_categories')->where('category_id',$request->input('sub_skill'))->count();
                        $view = View::make('templete.freelancer.freelancer_acept_reject_email',['name'=>$user->user_nicename,'email'=>$user->email,'skill'=>$parent_skill,'sub_skill'=>$freelancer_category[0]->freelancer_skill,'id'=>$user->user_id,'total'=>$total,'created_at'=>$user->created_at]);
                        $contents = (string)$view;
                        //$contents=str_replace(["name","email","parent_skill","child_skill","total","date","freelancer_id"],[$user->user_nicename,$user->email,$parent_skill,$freelancer_category[0]->freelancer_skill,$total,$user->created_at,encrypt($user->user_id)],$contents);
                        send_mail('mfarhan7333@gmail.com',config('constants.constant.admin_email'),'Huurr.com','Verify Freelancer',$contents);

                    }
                    $resp['status']=true;
                    $resp['success']="freelancer category is updated successfully";
                }
                else{
                    $resp['status']=false;
                    $resp['errors']='Please Select Sub Category Later';
                }
            }
            else{
                DB::table('users')->where('user_id',session('login_id'))->update(['user_status'=>2]);
                $parent_id=DB::table('categorie')->where('id',$request->input('sub_skill'))->value('parent_id');
                DB::table('users_categories')->where('user_id',session('login_id'))->update(['category_id'=>$request->input('sub_skill'),'parent_id'=>$parent_id,'updated_at'=>Carbon::now()->toDateTimeString()]);
                $user=DB::table('users')->where('user_id',session('login_id'))->first();
                if($user->user_status==2) {
                    $freelancer_category = DB::table('users as u')
                        ->join('users_categories as uc', 'uc.user_id', '=', 'u.user_id')
                        ->join('categorie as c', 'c.id', '=', 'uc.category_id')
                        ->where('u.user_id', '=', $user->user_id)
                        ->get();
                    $parent_skill = DB::table('categorie')->where('id', $freelancer_category[0]->parent_id)->value('freelancer_skill');
                    $total = DB::table('users_categories')->where('category_id', $request->input('sub_skill'))->count();
                    $view = View::make('templete.freelancer.freelancer_acept_reject_email');
                    $contents = (string)$view;
                    $contents = str_replace(["name", "email", "parent_skill", "child_skill", "total", "date", "freelancer_id"], [$user->user_nicename, $user->email, $parent_skill, $freelancer_category[0]->freelancer_skill, $total, $user->created_at, encrypt($user->user_id)], $contents);
                    send_mail('mfarhan7333@gmail.com', config('constants.constant.admin_email'), 'Huurr.com', 'Verify Freelancer', $contents);
                }
                $resp['status']=true;
                $resp['success']="freelancer category is updated successfully";
            }
        }
        else{
            $resp['status']=false;
            $resp['errors']='Please Select Sub Category';
        }
        echo json_encode($resp);

    }
}
