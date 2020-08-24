<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Crypt;
//use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Controllers\HelperController as helper;

class ClientController extends Controller
{
    public function index($type='',Request $request)
    {
    //    if(empty($type)){
    //        $type = "freelancer";
    //    }   
       $name="";
        $profetional_skills =  Session::get('profetional_skills');
        $availability_type =  Session::get('availability_type');
         Session::put('profetional_skills','');
          Session::put('availability_type','');
          $perPage = DB::table('users')
          ->orderBy('updated_at', 'DESC')->count();
        $user_id = Session::get('login_id');
        // if($type=="freelancer"){
        //   $name = $request->input('find');
        // }
        $skills = DB::table('categorie')->where('parent_id', '!=', 0)->get();
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        $user_data = DB::table('users')->where('user_id', $user_id)->first();
        $freelancers=array();
        if(isset($profetional_skills) && $profetional_skills!='')
        {
            $freelancers = DB::table('users as  u')->join('user_profile as  up', 'u.user_id', '=', 'up.user_id')->where('u.user_role', 'freelancer')->where('u.user_status', '1')->where('u.user_nicename', 'LIKE', '%'.$name.'%')->where('up.availability_type', $availability_type)->where('up.job_title','LIKE','%'.$profetional_skills.'%');
           
        }
        else
        {
            if(!empty($request->get('rating')) ){
                $freelancers = DB::table('users')->join('users_categories','users_categories.user_id','=','users.user_id')->join('user_profile','user_profile.user_id','=','users.user_id')->Join("comments","comments.user_id","=","user_profile.user_id")->Join("feedback_rating","feedback_rating.feedback_id","=","comments.comment_id")->select("users.*","user_profile.profetional_skills","user_profile.hourly_rate","user_profile.country","feedback_rating.avg_rate", \DB::raw('AVG(feedback_rating.avg_rate) AS rating'))->where('users.user_role', 'freelancer')->where('user_status', '1')->groupBy('users.user_id');    
             }
             else{
                 $freelancers = DB::table('users')->join('users_categories','users_categories.user_id','=','users.user_id')->join('user_profile','user_profile.user_id','=','users.user_id')->select("users.*","user_profile.profetional_skills","user_profile.hourly_rate","user_profile.country")->where('users.user_role', 'freelancer')->where('user_status', '1')->groupBy('users.user_id');
             }
         
        }
        if($request->ajax()){
          if(!empty($request->get('find'))){
            if($type=="freelancer"){
                $name = $request->input('find');
              }
            $freelancers=$freelancers->where('user_nicename', 'LIKE', '%'.$name.'%');
          }
          if(!empty($request->get('skill')) ){
                
            $skill =$request->input('skill');
            $i = 0;
             foreach($skill as $id){
                if( $i == 0) {
                    $freelancers = $freelancers->Where('user_profile.profetional_skills', 'like', '%\"'.$id.'"%');
                
                } else {
                    $freelancers = $freelancers->Where('user_profile.profetional_skills', 'like', '%\"'.$id.'"%');
                }
                $i++;
             
            }       
        }
      if(!empty($request->get('range'))){
        $range = $request->get('range');
        if (str_contains($range, '+-+')) { 
            $range = str_replace('+-+','-',$range);
        }
        else if (str_contains($range, '-')) { 
            $range = str_replace(' - ','-',$range);
        }
        else{
            $range = str_replace('+-','-',$range);
        }
         $range =explode('-',$range);
         $freelancers=$freelancers->where('user_profile.hourly_rate','>=',intval($range[0]))->where('user_profile.hourly_rate','<=',intval($range[1]));
        }
    if(!empty($request->get('country')) && $request->get('country') !=''){
        $country = $request->get('country');
        $freelancers=$freelancers->where('user_profile.country',$country);
    }
    if(!empty($request->get('rating')) && $request->get('rating') !=''){
        $rating = $request->get('rating');
        $freelancers=$freelancers->having('feedback_rating.avg_rate','<=',$rating);
    }
        }
        $freelancers= $freelancers->get()->toArray();
        $freelancer =array();
        if (!empty($freelancers) && sizeof($freelancers)>0) {
            foreach ($freelancers as $frelncer) {
                $frelncer->status = DB::table('saved_freelancer')->where('client_id', $user_id)->where('user_id', $frelncer->user_id)->select('status')->first();
                $frelncer->profile = DB::table('user_profile')->where('user_id', $frelncer->user_id)->select('*')->first();
                $frelncer->earn =self::fr_total_earning($frelncer->user_id);
                $frelncer->score = self::profile_job_done_scoore($frelncer->user_id);
                $frelncer->hired = DB::table('hired_freelancer')->where('user_id', $frelncer->user_id)->where('client_id', $user_id)->count();
                $frelncer->report = DB::table('report_freelancer')->where('freelancer_id', $frelncer->user_id)->where('client_id', $user_id)->select('description')->first();
                $freelancer[] = $frelncer;
            }
        }
        $saved_freelancer = DB::table('saved_freelancer')
                                ->join('users', 'users.user_id', '=', 'saved_freelancer.user_id')
                                ->where('users.user_role', 'freelancer')
                                ->where('saved_freelancer.client_id', $user_id)
                                ->where('saved_freelancer.status', 1)
                                ->select('*')
                                ->get()->toArray();
        $saved_freelancers = [];
        if (!empty($saved_freelancer)) {
            foreach ($saved_freelancer as $svfrelncer) {
                $svfrelncer->earn = self::fr_total_earning($svfrelncer->user_id);
                $svfrelncer->score = self::profile_job_done_scoore($svfrelncer->user_id);
                $saved_freelancers[] = $svfrelncer;
            }
        }

        $hired_freelancer = DB::table('hired_freelancer')
                                ->join('users', 'users.user_id', '=', 'hired_freelancer.user_id')
                                ->where('users.user_role', 'freelancer')
                                ->where('hired_freelancer.client_id', $user_id)
                                 ->groupBy('hired_freelancer.user_id')
                                ->select('*')
                                ->get()->toArray();
                            
        $hired_freelancers = [];
        if (!empty($hired_freelancer)) {
            foreach ($hired_freelancer as $hdfrelncer) {
                $hdfrelncer->earn = self::fr_total_earning($hdfrelncer->user_id);
                $hdfrelncer->score = self::profile_job_done_scoore($hdfrelncer->user_id);
                $hdfrelncer->profile = DB::table('user_profile')->where('user_id', $hdfrelncer->user_id)->select('*')->first();
                $hired_freelancers[] = $hdfrelncer;
            }
        }
        
        if(sizeof($hired_freelancers)>0){
             $h_free=$hired_freelancers;
           // $hired_freelancers=$this->paginate($hired_freelancers,$perPage = 1, $page = null);  
           $hired_freelancers=$this->paginate($hired_freelancers);
          if(sizeof($hired_freelancers)==0){
                  $hired_freelancers=$this->paginate($h_free,$perPage = 1, $page = 1); 
          }
        }
        if(sizeof($freelancer)>0){
            $freelancer=$this->paginate($freelancer);
        }
        if(sizeof($saved_freelancers)>0){
            $s_free=$saved_freelancers;
            $saved_freelancers=$this->paginate($saved_freelancers);
            if(sizeof($saved_freelancers)==0){
                $saved_freelancers=$this->paginate($s_free,$perPage = 1, $page = 1); 
        }
        }
      
        $all_job = DB::table('jobs')->select('job_title', 'job_id')->where('user_id', $user_id)->where('progress','=',0)->get()->toArray();
        $reponse = array();
        if ($request->ajax()){
            if($type=="freelancer"){
                $reponse["response"] = "freelancer";
                $reponse["freelancer"] = view('client.table.freelancer_listing',  ['freelancer' => $freelancer,'user_data'=>$user_data])->render();
            }
            else if($type=="hired_freelancers"){
                $reponse["hired_freelancer"] = view('client.table.hired_freelancer',  ['hired_freelancers' => $hired_freelancers,'user_data'=>$user_data])->render();
            }
            else if($type=="savedfreelancer"){
               
                $reponse["response"] = "savedfreelancer";
                $reponse["saved_freelancer"] = view('client.table.saved_freelancer',  ['saved_freelancers' => $saved_freelancers,'user_data'=>$user_data])->render();

            }
            echo  json_encode($reponse);
            exit;
        }
        $tab = "";
        return view('client.find_freelancer', compact('user_data', 'freelancer', 'saved_freelancers', 'tab', 'all_job', 'hired_freelancers','skills','countries'));
    }
    public function paginate($items, $perPage = 10, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    }
  
    public function search_freelancer(Request $request){
        $user_id = Session::get('login_id');
        $user_data = DB::table('users')->where('user_id', $user_id)->first(); 
        if(!empty($request->get('rating')) ){
           $freelancers = DB::table('users')->join('users_categories','users_categories.user_id','=','users.user_id')->join('user_profile','user_profile.user_id','=','users.user_id')->Join("comments","comments.user_id","=","user_profile.user_id")->Join("feedback_rating","feedback_rating.feedback_id","=","comments.comment_id")->select("users.*","user_profile.profetional_skills","user_profile.hourly_rate","user_profile.country","feedback_rating.avg_rate", \DB::raw('AVG(feedback_rating.avg_rate) AS rating'))->where('users.user_role', 'freelancer')->where('user_status', '1')->groupBy('users.user_id');    
        }
        else{
            $freelancers = DB::table('users')->join('users_categories','users_categories.user_id','=','users.user_id')->join('user_profile','user_profile.user_id','=','users.user_id')->select("users.*","user_profile.profetional_skills","user_profile.hourly_rate","user_profile.country")->where('users.user_role', 'freelancer')->where('user_status', '1')->groupBy('users.user_id');
        }
       
        if($request->ajax()){
            if(!empty($request->get('find'))){
                  $name = $request->input('find');
                 $freelancers=$freelancers->where('user_nicename', 'LIKE', '%'.$name.'%');
            }
            if(!empty($request->get('country')) ){
                $country = $request->get('country');
                $freelancers=$freelancers->where('user_profile.country',$country);
            }  
            if(!empty($request->get('skill')) ){
                
                $skill =$request->input('skill');
                $i = 0;
                 foreach($skill as $id){
                    if( $i == 0) {
                        $freelancers = $freelancers->Where('user_profile.profetional_skills', 'like', '%\"'.$id.'"%');
                    
                    } else {
                        $freelancers = $freelancers->Where('user_profile.profetional_skills', 'like', '%\"'.$id.'"%');
                    }
                    $i++;
                 
                }       
            }
          if(!empty($request->get('range'))){
                $range = $request->get('range');
                
                if (str_contains($range, '+-+')) { 
                    $range = str_replace('+-+','-',$range);
                }
                else if (str_contains($range, '-')) { 
                    $range = str_replace(' - ','-',$range);
                }
                else{
                    $range = str_replace('+-','-',$range);
                }  
                $range =explode('-',$range);
                $freelancers=$freelancers->where('user_profile.hourly_rate','>=',intval($range[0]))->where('user_profile.hourly_rate','<=',intval($range[1]));
                 
           }
           
            if(!empty($request->get('rating'))){
                $rating = $request->get('rating');
                $freelancers=$freelancers->having('rating','<=',$rating);
            }
          }  

        // echo  $freelancers->toSql();
        //  exit;
          $freelancers=$freelancers->get()->toArray();
        $freelancer =array();
        if (!empty($freelancers) && sizeof($freelancers)>0) {
            foreach ($freelancers as $frelncer) {
                $frelncer->status = DB::table('saved_freelancer')->where('client_id', $user_id)->where('user_id', $frelncer->user_id)->select('status')->first();
                $frelncer->profile = DB::table('user_profile')->where('user_id', $frelncer->user_id)->select('*')->first();
                $frelncer->earn =self::fr_total_earning($frelncer->user_id);
                $frelncer->score = self::profile_job_done_scoore($frelncer->user_id);
                $frelncer->hired = DB::table('hired_freelancer')->where('user_id', $frelncer->user_id)->where('client_id', $user_id)->count();
                $frelncer->report = DB::table('report_freelancer')->where('freelancer_id', $frelncer->user_id)->where('client_id', $user_id)->select('description')->first();
                $freelancer[] = $frelncer;
            }
         
        }
        if(sizeof($freelancer)>0){
            $freelancer=$this->paginate($freelancer);
           return view('client.table.freelancer_listing',  ['freelancer' => $freelancer,'user_data'=>$user_data])->render();
               
        }
       
    }
    public function fr_total_earning($fr_id){
        $amount=0;
        $total_earn=DB::table('user_balance')->where('freelancer_id',$fr_id)->get();
        if (sizeof($total_earn)>0){
            $amount+=$total_earn[0]->amount+$total_earn[0]->credit;
        }

        return $amount;
    }
    public function profile_job_done_scoore($user_id)
    {
        $fr_feedback=DB::table('comments')->join('feedback_rating','comments.comment_id','=','feedback_rating.feedback_id')
            ->where('comments.feedback_by',2)
            ->where('comments.user_id',$user_id)
            ->sum('feedback_rating.avg_rate');
        $total_fr_feedback=DB::table('comments')->join('feedback_rating','comments.comment_id','=','feedback_rating.feedback_id')
            ->where('comments.feedback_by',2)
            ->where('comments.user_id',$user_id)
            ->count();
        if($fr_feedback>0&&$total_fr_feedback>0){
            $avg_feedback=$fr_feedback/$total_fr_feedback;
        }
       else{
           $avg_feedback=1;
       }
        return self::calculatePercentage($avg_feedback);
    }
    public function calculatePercentage($feedback_score)
    {
        if (empty($feedback_score)) {
            return 0;
        }
        switch ($feedback_score)
        {
            case ($feedback_score>3.5):
                return 100;
               break;
            case ($feedback_score==3.4):
                return 95;
                break;
            case ($feedback_score==3.3):
                return 90;
                break;
            case ($feedback_score==3.2):
                return 85;
                break;
            case ($feedback_score==3.1):
                return 80;
                break;
            case ($feedback_score==3):
                return 75;
                break;
            case (($feedback_score>=2.5)&&($feedback_score<=3)):
                return 65;
                break;
            case (($feedback_score>=2)&&($feedback_score<=2.5)):
                return 50;
                break;
            case (($feedback_score>=1.5)&&($feedback_score<=2)):
                return 40;
                break;
            case (($feedback_score>1)&&($feedback_score<=1.5)):
                return 30;
                break;
            default:
                return 0;
        }
    }
    public function save_freelancer(Request $request)
    {
        $client_id = Session::get('login_id');
        $user_id = Crypt::decryptString($request->input('user_id'));
        if (empty($saved_job = DB::table('saved_freelancer')->where('client_id', $client_id)->where('user_id', $user_id)->first())) {
            DB::table('saved_freelancer')->insert(array('client_id'=>$client_id,'user_id'=>$user_id,'status'=>1));
        } else {
            if ($saved_job->status==1) {
                $status = 0;
            } else {
                $status = 1;
            }
            DB::table('saved_freelancer')->where('client_id', $client_id)->where('user_id', $user_id)->update(array('status'=>$status));
        }
        $saved_job = DB::table('saved_freelancer')->where('client_id', $client_id)->where('user_id', $user_id)->first();
        return $saved_job->status;
    }
    public function report_freelancer()
    {
        $report_freelancer = DB::table('report_freelancer')->where('freelancer_id', $_REQUEST['freelancer_id'])->where('client_id', $_REQUEST['client_id'])->select('description')->first();
        if(empty($report_freelancer)) {
            DB::table('report_freelancer')->insert(array('client_id'=>$_REQUEST['client_id'],'freelancer_id'=>$_REQUEST['freelancer_id'],'description'=>$_REQUEST['description']));
        } else {
            DB::table('report_freelancer')->where('freelancer_id', $_REQUEST['freelancer_id'])->where('client_id', $_REQUEST['client_id'])->update(['description' => $_REQUEST['description']]);
        }
        return 1;
    }
}
