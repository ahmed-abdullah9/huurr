<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Encryption\DecryptException;
use Auth;
use App\Job;
use App\Proposals;
use Carbon\Carbon;
use App\Category;
//use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\App;
//use Illuminate\View\View;
use View;
use Validator;
use Session, DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\HelperController as helper;
use App\MessageModel as message;
class JobController extends Controller
{
    // to be deleted! 
    public function jobpost_type(Request $request)
    {
        if($request->input('job_id'))
        {
            return Redirect('/create/jobpost/'.$request->input('job_type').'/'.$request->input('job_id'));
        }
        return Redirect('/create/jobpost/'.$request->input('job_type'));
    }

    public function jobpost($job_type='',$job_id=''){

        $categories = DB::table('categorie')->select('freelancer_skill','ar_freelancer_skill','id')->where('parent_id',0)->get()->toArray();
        $user_id = Session::get('login_id');
        $jobs = \DB::table('jobs')->select('job_id','job_title')->where('user_id', $user_id)->select('*')->get()->toArray();
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        if($job_type=='new-job')
        {
            return view('jobs.jobpost_new', compact(['categories','jobs','job_type','countries']));
        }
        elseif($job_type=='re-usejobe')
        {
            $job = \DB::table('jobs')->where('job_id', $job_id)->where('user_id', $user_id)->first();
            if(empty($job))
            {
                return view('jobs.jobpost_new', compact(['categories','jobs','job_type']));
            }
            $jobs = \DB::table('jobs')->where('job_id', $job_id)->first();
            $jobs->job_skills = (!empty($jobs->job_skills)?helper::maybe_unserialize($jobs->job_skills):$jobs->job_skills);
            $jobs->attachments = (!empty($jobs->attachments)?helper::maybe_unserialize($jobs->attachments):$jobs->attachments);
            $categories = DB::table('categorie')->where('parent_id',0)->get()->toarray();
            $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
            $job_questions = helper::maybe_unserialize($jobs->job_questions);
            return view('jobs.jobpost_reuse', compact('jobs', 'categories', 'job_questions','countries'));
        }
        else
        {
            return view('jobs.jobpost_type', compact(['categories','jobs']));
        }

    }
    public function invite_user_for_job($user_id='')
    {
        $categories = DB::table('categorie')->select('id','freelancer_skill')->where('parent_id',0)->get()->toArray();
        $user_data = DB::table('users')->select('*')->where('user_id',$user_id)->first();
        $user_profile = DB::table('user_profile')->where('user_id',$user_id)->select('*')->first();
        $job_skills = (!empty($user_profile->profetional_skills)?helper::maybe_unserialize($user_profile->profetional_skills):[]);
        $user_profile_skill=DB::table('categorie')->whereIn('id',json_decode($job_skills))->get();
        $score = self::profile_job_done_scoore($user_id);
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        return view('jobs.jobpost_invite', compact(['categories','user_data','user_profile','user_profile_skill','score','countries']));
    }
    public function profile_job_done_scoore($user_id)
    {
        $total_job = DB::table('proposals')->where('invitation_interview',1)->where('offers',1)->where('user_id',$user_id)->count();
        $donejob = DB::table('proposals')->where('invitation_interview',1)->where('offers',1)->where('contracted',-1)->where('status',1)->where('user_id',$user_id)->count();
        return self::calculatePercentage($total_job,$donejob);

    }
    public function calculatePercentage($oldFigure, $newFigure)
    {
        if(empty($newFigure))
        {
            return 0;
        }
        $percentChange = (($oldFigure - $newFigure) / $oldFigure) * 100;
        return round(abs($percentChange));
    }
    public function createJob(Request $request)
    {
        // dd("HOPE");
        date_default_timezone_set('Asia/Riyadh');
        $rules = [
            'job_type' => 'required',
            'job_title' => 'required',
            'category_id' => 'required',
            // 'job_time_type' => 'required',
            'job_description' => 'required',
            // 'project_type' => 'required',
            // 'sl_name' => 'required',
            // 'experience_level' => 'required',
            // 'job_duration' => 'required',
            // 'job_time' => 'required',
            'action' => 'required',
        ];
        $messages = [
            'job_type.required' => "job type id reuired",
            'job_title.required' => __('client.job_title'),
            'category_id.required' => __('client.job_category'),
            // 'job_time_type.required' => __('client.job_time_type'),
            'job_description.required' => __('client.job_description'),
            // 'project_type.required' => __('client.project_type'),
            // 'sl_name.required' => __('client.sl_name'),
            // 'experience_level.required' => __('client.experience_level'),
            // 'job_duration.required' => __('client.job_duration'),
            // 'job_time.required' => __('client.job_time'),
            'action.required' => __('client.action'),
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator->errors(), 'jobPost');
        } else {

            $job_fee=DB::table('admin_option')->value('job_fee');
            $data = $request->all();

            if ($request->job_id > 0) {
                $job = Job::find($request->job_id);
               
            } else {
                $job = new Job;
                $user_id = Session::get('login_id');
                $job->user_id = $user_id;
            }

            $job->job_type = $request->job_type;
            $job->job_title = $request->job_title;
            $job->category_id = $request->category_id;
            $job->job_time_type = 'fixed';
            $job->vat=vat();
            if ($request->countries != '') {
                $job->countries = json_encode($request->countries);
            }
            $users_data=DB::table('categorie')->join('users_categories','categorie.id','=','users_categories.parent_id')
                ->join('users','users.user_id','=','users_categories.user_id')
                ->join('user_profile','user_profile.user_id','=','users.user_id')
                ->select('freelancer_skill','email','user_nicename','users.user_id','users.user_gender','user_profile.country')
                ->where('users_categories.parent_id',$request->category_id)
                ->where("users.user_role","freelancer")
                ->get()->toarray();

            // if ($request->job_time_type == 'fixed') {
                if ($request->budget == '') {
                    return redirect()->back()->with('info', 'Your Budget input field is empty');
                } else {
                    $job->budget = $request->budget;
                }
            // }
            // else  {
            //     if ($request->job_hour_limit == '') {

            //         return redirect()->back()->with('info', 'Please Select hours');
            //     } else {
            //         $job->job_hour_limit = $request->job_hour_limit;
            //     }
            // }
            $job->job_description = $request->job_description;
            $job->project_type = $request->project_type;
            $job->fl_number = $request->fl_number;
            $job->job_skills = helper::maybe_serialize($request->job_skills);
            // $job->experience_level = $request->experience_level;
            // $job->job_duration = $request->job_duration;
            // $job->job_time = $request->job_time;
            $job->job_fee=$job_fee;
            // $job->job_questions = helper::maybe_serialize($request->job_questions);
            if ($request->file('attachments')) {
                $job->attachments = helper::maybe_serialize(self::fileupload($request));
            }
            $job->job_cover_letter = !empty($request->job_cover_letter) ? $request->job_cover_letter : 0;

            $job->job_boost = !empty($request->job_boost) ? $request->job_boost : 0;
            if ($request->input('action') == 'draft') {
                $job->status = -1;
            } else {
                $job->status = !empty($request->status) ? $request->status : 0;
                $jobSkills=$request->job_skills;
            }
            if($job->save()){
                $job_id=DB::getPdo()->lastInsertId();
                $job_id=Crypt::encryptString($job_id);

                foreach($users_data as $fr){

                    if(mb_strpos($job->countries, $fr->country) === false && (!empty($request->countries))){
                        continue;
                    }
                
                    $Joburl=url("/submit/proposal/").'/'.$job_id;
                    $message='Cheers, New job looking for a hero like you just posted.Go ahead and give your proposal.<br> <a href='.$Joburl.'>'.$job->job_title.'</a>';
                    //$message='A new Job ['.$request->job_title.'] is posted';
                    DB::table('notifications')->insert([
                        'notification_type' => 'invite',
                        'sender_id' => Session::get('login_id'),
                        'receiver_id' => $fr->user_id,
                        'message' => $message,
                    ]);
                    if($fr->user_gender=="male"){
                        $view = View::make('templete.freelancer.jobs_notification_m',["freelancer_name"=>$fr->user_nicename,"title"=>$job->job_title,"requirements"=>json_encode($jobSkills),"client"=>Session::get('name'),'job_id'=>$job_id]);
                        $contents = (string)$view;
                    }
                    elseif ($fr->user_gender=="female"){
                        $view = View::make('templete.freelancer.jobs_notification_f',["freelancer_name"=>$fr->user_nicename,"title"=>$job->job_title,"requirements"=>json_encode($jobSkills),"client"=>Session::get('name'),'job_id'=>$job_id]);
                        $contents = (string)$view;
                    }
                    //$contents=str_replace(["name","title","requirements"],[$fr->user_nicename,$job->job_title,json_encode($jobSkills)],$contents);
                    send_mail('mfarhan7333@gmail.com',$fr->email,$fr->user_nicename,'New Job Alert',$contents);
                }
            }
            return redirect('/joblist')->with('message', 'job Posted  successfully');
        }

    }
    public function createinvitepostjob(Request $request)
    {
        date_default_timezone_set('Asia/Riyadh');
//        $data = $request->all();
//        if($request->job_id > 0){
//            $job = Job::find($request->job_id);
//        }else{
//            $job = new Job;
//
//            $user_id = Session::get('login_id');
//            $job->user_id = $user_id;
//        }

        $rules = [
            'job_type' => 'required',
            'job_title' => 'required',
            'category_id' => 'required',
            // 'job_time_type' => 'required',
            'job_description' => 'required',
            'project_type' => 'required',
            'sl_name' => 'required',
            'experience_level' => 'required',
            'job_duration' => 'required',
            'job_time' => 'required',
//            'status' => 'required|numeric',
            'action' => 'required',
        ];
        $messages = [
            'job_type.required' => "job type id reuired",
            'job_title.required' => __('client.job_title'),
            'category_id.required' => __('client.job_category'),
            // 'job_time_type.required' => __('client.job_time_type'),
            'job_description.required' => __('client.job_description'),
            'project_type.required' => __('client.project_type'),
            'sl_name.required' => __('client.sl_name'),
            'experience_level.required' => __('client.experience_level'),
            'job_duration.required' => __('client.job_duration'),
            'job_time.required' => __('client.job_time'),
//            'status.required' => __('client.cover_letter_status'),
//            'status.numeric' => __('client.cover_letter_status_type'),
            'action.required' => __('client.action'),
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors(), 'jobPost');
        } else {
            $data = $request->all();
            $job_fee=DB::table('admin_option')->value('job_fee');

            if ($request->job_id > 0) {
                $job = Job::find($request->job_id);
            } else {
                $job = new Job;

                $user_id = Session::get('login_id');
                $job->user_id = $user_id;
            }

            $job->job_type = $request->job_type;
            $job->job_title = $request->job_title;
            $job->category_id = $request->category_id;
            $job->job_time_type = 'fixed';
            if ($request->countries != '') {
                $job->countries = json_encode($request->countries);
            }
            // if ($request->job_time_type == 'fixed') {
                if ($request->budget == '') {
                    return redirect()->back()->with('info', 'Your Budget input field is empty');
                } else {
                    $job->budget = $request->budget;
                }
            // } 
            // else {
            //     if ($request->job_hour_limit == '') {

            //         return redirect()->back()->with('info', 'Please Select hours');
            //     } else {
            //         $job->job_hour_limit = $request->job_hour_limit;
            //     }
            // }
            $job->job_description = $request->job_description;
            $job->project_type = $request->project_type;
            $job->fl_number = $request->fl_number;
            $job->job_skills = helper::maybe_serialize($request->job_skills);
            $job->experience_level = $request->experience_level;
            $job->job_duration = $request->job_duration;
            $job->job_time = $request->job_time;
            $job->is_open=0;
            $job->job_fee=$job_fee;
            $job->job_questions = helper::maybe_serialize($request->job_questions);
            if ($request->file('attachments')) {
                $job->attachments = helper::maybe_serialize(self::fileupload($request));
            }
            $job->job_cover_letter = !empty($request->job_cover_letter) ? $request->job_cover_letter : 0;

            $job->job_boost = !empty($request->job_boost) ? $request->job_boost : 0;
            if ($request->input('action') == 'draft') {
                $job->status = -1;
            } else {
                $job->status = !empty($request->status) ? $request->status : 0;

            }
            $job->save();

            $proposal = new Proposals();
            $proposal->job_id = $job->id;
            // if ($request->job_time_type == 'fixed') {
                $proposal->bid_amount = $request->budget;
                $proposal->pay_amount = $request->budget - ($request->budget * $job_fee / 100);
            // }
            // else{
            //     $proposal->bid_amount=$request->per_hour_amount;
            //     $proposal->pay_amount = $request->per_hour_amount - ($request->per_hour_amount * 20 / 100);
            // }
            $proposal->question_ans = helper::maybe_serialize([]);
            $proposal->duration = $request->job_duration;
            $proposal->user_id = $request->invited_user_id;
            $proposal->cover_letter = '';
            $proposal->invitation_interview = 1;
            $proposal->attachment_file = !empty($request->attachment_file) ? $request->attachment_file : 0;
            $proposal->offers=1;
            $proposal->save();
            $link=url('/').'/proposals'.'/'.encrypt($request->job_id);
            $url = "<a href=".$link.">You have invited for job please view your proposals menu to see invitaion for a job</a>";
            $message="$url";
            DB::table('notifications')->insert([
                'notification_type' => 'invite',
                'sender_id' => $user_id,
                'receiver_id' => $request->invited_user_id,
                'message' => $message,
            ]);

            return redirect('/joblist')->with('message', 'Job offered successfully');
        }
    }
    public function update_job(Request $request)
    {
        date_default_timezone_set('Asia/Riyadh');
        $rules = [
            'job_id' => 'required',
            'job_title' => 'required',
            'category_id' => 'required',
            // 'job_time_type' => 'required',
            'job_description' => 'required',
            // 'project_type' => 'required',
            // 'sl_name' => 'required',
            // 'experience_level' => 'required',
            // 'job_duration' => 'required',
            // 'job_time' => 'required',
//            'status' => 'required|numeric',
            'action' => 'required',
        ];
        $messages = [
            'job_id.required' => "job id reuired",
            'job_title.required' => __('client.job_title'),
            'category_id.required' => __('client.job_category'),
            // 'job_time_type.required' => __('client.job_time_type'),
            'job_description.required' => __('client.job_description'),
            // 'project_type.required' => __('client.project_type'),
            // 'sl_name.required' => __('client.sl_name'),
            // 'experience_level.required' => __('client.experience_level'),
            // 'job_duration.required' => __('client.job_duration'),
            // 'job_time.required' => __('client.job_time'),
//            'status.required' => __('client.cover_letter_status'),
//            'status.numeric' => __('client.cover_letter_status_type'),
            'action.required' => __('client.action'),
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors(), 'jobPost');
        } else {
            $data = array();
            $user_id = Session::get('login_id');
            $data['user_id']=$user_id;
            $data['job_title']=$request->job_title;
            $data['category_id']=$request->category_id;
            $data['job_time_type']= 'fixed';
            if ($request->countries != '') {
                $data['countries']=json_encode($request->countries);
            }
            else{
                $data['countries']='';
            }

            // if ($request->job_time_type == 'fixed') {
                if ($request->budget == '') {
                    return redirect()->back()->with('info', 'Your Budget input field is empty');
                } else {
                    $data['budget']=$request->budget;
                }
            // }
            // else  {
            //     if ($request->job_hour_limit == '') {

            //         return redirect()->back()->with('info', 'Please Select hours');
            //     } else {
            //         $data['job_hour_limit']=$request->job_hour_limit;
            //     }
            // }
            $data['job_description']=$request->job_description;
            // $data['project_type']=$request->project_type;
            $data['fl_number']= $request->fl_number;
            $data['job_skills']=helper::maybe_serialize($request->job_skills);
            // $data['experience_level'] = $request->experience_level;
            // $data['job_duration']= $request->job_duration;
            // $data['job_time']= $request->job_time;
            // $data['job_questions']=helper::maybe_serialize($request->job_questions);
            if ($request->file('attachments')) {
                $data['attachments']= helper::maybe_serialize(self::fileupload($request));
            }
            $data['job_cover_letter'] = !empty($request->job_cover_letter) ? $request->job_cover_letter : 0;

            $data['job_boost'] = !empty($request->job_boost) ? $request->job_boost : 0;
            if ($request->input('action') == 'draft') {
                $data['status'] = -1;
            } else {
                $data['status'] = !empty($request->status) ? $request->status : 0;
            }
            DB::table('jobs')->where('job_id',$request->input('job_id'))->update($data);
            return redirect('/joblist')->with('message', 'job updated  successfully');
        }
    }

    public function editjobpost($id){

        try {
            $id = Crypt::decrypt($id);
         } catch (DecryptException $e) {
            //
         }
        $user_id = Session::get('login_id');
        $jobs = \DB::table('jobs')->where('job_id', $id)->where('jobs.user_id', $user_id)->first();
        $jobs->job_skills = (!empty($jobs->job_skills)?helper::maybe_unserialize($jobs->job_skills):$jobs->job_skills);
        $jobs->attachments = (!empty($jobs->attachments)?helper::maybe_unserialize($jobs->attachments):$jobs->attachments);
        $categories = DB::table('categorie')->where('parent_id',0)->get()->toarray();
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        $job_questions = helper::maybe_unserialize($jobs->job_questions);

        return view('jobs.edit_job', compact('jobs', 'categories', 'job_questions','countries'));
    }


    public function joblisting(Request $request){
        $user_id = Session::get('login_id');
        if(Session::get('user_type') == 'admin'){
            $jobs_query = \DB::table('jobs')->join('users','users.user_id','=','jobs.user_id')->select('jobs.*','users.name')->orderBy('jobs.created_at', 'DESC')->get()->toArray();
        }else{
            $jobs_query = \DB::table('jobs')->join('users','users.user_id','=','jobs.user_id')->join('proposals','proposals.job_id','=','jobs.job_id','left')->where('jobs.user_id',$user_id)->select('jobs.*','users.name','proposals.offers','proposals.accept_offer')->orderBy('jobs.created_at', 'DESC')->get()->toArray();
        }
        
        //$jobs_query = \DB::table('jobs')->join('users','users.user_id','=','jobs.user_id')->where('jobs.user_id',$user_id)->select('jobs.*','users.name')->orderBy('jobs.created_at', 'DESC')->get()->toArray();


        //dd($jobs_query);
        $jobs =$jobs_query;
        // foreach ($jobs_query as $job) {
        //     if(in_array($job->job_id, $job_ids)) {
        //         continue;
        //     }
        //     $job->hired = DB::table('proposals')->where('job_id',$job->job_id)->where('offers',1)->count();
        //     $jobs[] = $job;
        // }
       
        if ($request->ajax()){
            if(sizeof($jobs)>0){
                $jobs=$this->paginate($jobs);
                return view('jobs.table.job_listing',  ['jobs' => $jobs])->render();
            }
        }
        $jobs=$this->paginate($jobs);
        return view('jobs.job_listing', compact('jobs'));
    }
    public function paginate($items, $perPage = 10, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    }
    public function clmylisting(){
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

        return view('jobs.my_job_listing', compact('jobs'));
    }
    public function clmy_listing($job_id='')
    {
        date_default_timezone_set("Asia/Karachi");
        if(empty($job_id))
        {
            return redirect('clmy-job');
        }
        $job_id = Crypt::decrypt($job_id);
        $user_id = Session::get('login_id');
        $jobs_hir = \DB::table('jobs')
            ->where('jobs.user_id', $user_id)
            ->where('jobs.job_id', $job_id)
            ->where('proposals.status','!=',-1)
            ->join('proposals','proposals.job_id','=','jobs.job_id')
            ->join('users as prop_user','prop_user.user_id','=','proposals.user_id')
            ->groupBy('proposals.offers')
            ->orderBy('proposals.offers','desc')
            ->select('jobs.job_title','jobs.job_time_type','jobs.budget','jobs.job_id','prop_user.name','prop_user.user_id as Proposal_user','proposals.*','proposals.user_id as freelancer_id','jobs.progress')->get()->toArray();
        $jobs = [];
        foreach ($jobs_hir as $hir) {
            $hir->hired = DB::table('hired_freelancer')->where('job_id',$hir->job_id)->where('user_id',$hir->Proposal_user)->where('client_id',$user_id)->count();
            $jobs[] = $hir;
        }

        $invited_user = \DB::table('jobs')
            ->where('jobs.user_id', $user_id)
            ->where('jobs.job_id', $job_id)
            ->where('proposals.invitation_interview',1)
            ->where('proposals.offers',0)
            ->where('proposals.status',0)
            ->join('proposals','proposals.job_id','=','jobs.job_id')
            ->join('users as prop_user','prop_user.user_id','=','proposals.user_id')
            ->select('jobs.job_title','jobs.budget','jobs.job_id','prop_user.name','prop_user.user_id as Proposal_user','proposals.*')->get()->toArray();

        $active_jobs_hir = \DB::table('jobs')
            ->where('jobs.user_id', $user_id)
            ->where('jobs.job_id', $job_id)
            ->where('proposals.invitation_interview',1)
            ->where('proposals.offers',1)
            ->where('proposals.status',0)
            ->where('jobs.progress','!=',3)
            ->join('proposals','proposals.job_id','=','jobs.job_id')
            ->join('users as prop_user','prop_user.user_id','=','proposals.user_id')
            ->select('jobs.job_title','jobs.job_time_type','jobs.progress as job_progress','jobs.budget','jobs.job_id','prop_user.name','jobs.is_open as job_is_open','prop_user.user_id as Proposal_user','jobs.job_time_type as job_time_type','proposals.*')->get()->toArray();
        $active_job = [];
        foreach ($active_jobs_hir as $obs_hir) {
            $obs_hir->hired = DB::table('hired_freelancer')->where('job_id',$obs_hir->job_id)->where('user_id',$obs_hir->Proposal_user)->where('client_id',$user_id)->count();
            $obs_hir->hire_free_id=DB::table('hired_freelancer')->where('job_id',$obs_hir->job_id)->where('user_id',$obs_hir->Proposal_user)->where('client_id',$user_id)->where('status',1)->value('hire_free_id');
            $current_date_time = Carbon::now()->toDateTimeString();
            $diff=strtotime($current_date_time)-strtotime(DB::table('invoices')->where('job_id',$obs_hir->job_id)->where('proposal_id',$obs_hir->proposal_id)->value('start_date'));
            $days=floor($diff/(60*60*24));
            $obs_hir->claim_job_days=$days;
            $obs_hir->is_claim=DB::table('invoices')->where('proposal_id',$obs_hir->proposal_id)->value('is_claim');
            $obs_hir->is_removed=DB::table('claim_jobs')->where('proposal_id',$obs_hir->proposal_id)->value('is_removed');
            $active_job[] = $obs_hir;
        }
        $completed_job = \DB::table('jobs')
            ->where('jobs.user_id', $user_id)
            ->where('jobs.job_id', $job_id)
            ->where('proposals.invitation_interview',1)
            ->where('proposals.offers',1)
            ->where('proposals.contracted',-1)
            ->where('jobs.progress',3)
            ->where('jobs.job_completed',1)
            ->where('jobs.is_open',0)
            ->join('proposals','proposals.job_id','=','jobs.job_id')
            ->join('users as prop_user','prop_user.user_id','=','proposals.user_id')
            ->select('jobs.job_title','jobs.budget','jobs.job_id as job_id','prop_user.name','prop_user.user_id as Proposal_user','proposals.*')->get()->toArray();

        return view('jobs.jobclmy_listing', compact('jobs','invited_user','active_job','completed_job','job_id'));
    }
    public function invite_user(Request $request)
    {
        DB::table('proposals')->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->update(['invitation_interview'=>1]);
        $link=url('/').'/proposals';
        $url = '<a href="'.$link.'">You have invited for job please view your proposals menu to see invitaion for a job</a>';
        $message="$url"; 
        DB::table('notifications')->insert([
            'notification_type' => 'invite',
            'sender_id' => Session::get('login_id'),
            'receiver_id' => $request['user_id'],
            'message' => $message,
        ]);
        /*message::save_send_message( [
                            'sender_id'=>Session::get('login_id'),
                            'received_id'=>$request['user_id'],
                            'message'=>$message,
                            'user_id'=>Session::get('login_id')
        ] );*/
    }

    public function Offer_job(Request $request)
    {
        DB::table('proposals')->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->update(['offers'=>1]);
        DB::table('notifications')->insert([
            'notification_type' => 'offer',
            'sender_id' => Session::get('login_id'),
            'receiver_id' => $request['user_id'],
            'message' => 'Client offer a job on testtt',
        ]);
    }
    public function accept_for_interview(Request $request)
    {
        DB::table('proposals')->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->update(['accept_interview'=>1]);
        DB::table('notifications')->insert([
            'notification_type' => 'offer',
            'sender_id' => Session::get('login_id'),
            'receiver_id' => $request['user_id'],
            'message' => 'freelancer accepted interview invitation',
        ]);
    }
    public function accept_offer(Request $request)
    {
        DB::table('proposals')->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->update(['accept_offer'=>1]);
        $proposal=DB::table('proposals')->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->first();
        $job=DB::table('jobs')->where('job_id',$proposal->job_id)->first();
        $freelancer_name=Session::get("name");
        DB::table('hired_freelancer')->insert(['status'=>0,'job_id'=>$proposal->job_id,'proposal_id'=>$request['proposal_id'],'user_id'=>Session::get('login_id'),'client_id'=> $job->user_id]);
        //DB::table('invoices')->insert(['job_id'=>$proposal->job_id,'proposal_id'=>$request['proposal_id'],'freelancer_id'=>Session::get('login_id'),'client_id'=>$job->user_id,'amount'=>$proposal->bid_amount]);
        $link=url('/').'/view/proposal/'.Crypt::encrypt($request['proposal_id']);
        $url = "<a href=".$link.">Hi Client,<br>Awesome $freelancer_name just accepted your offer and will start the job, we are looking give you the best result as you wish.Now, get relaxed and let's do the job :)</a>";
        $message="$url";
        DB::table('hired_freelancer')->where('proposal_id',$request['proposal_id'])->update(['status'=>1]);
        DB::table('jobs')->where('job_id',$proposal->job_id)->update(['progress'=>1]);
        DB::table('proposals')->where('proposal_id',$request['proposal_id'])->update(['contracted'=>1]);
        DB::table('hours_requests')->where(['freelancer_id'=>Session::get('login_id'),'client_id'=>$job->user_id,'proposal_id'=>$request['proposal_id']])
            ->update(['is_accept'=>1]);

        // $message='freelancer accepted offer for job '.$job->job_title.' Now you can start Contract';
        DB::table('notifications')->insert([
            'notification_type' => 'offer',
            'sender_id' => Session::get('login_id'),
            'receiver_id' => $job->user_id,
            'message' => $message,
        ]);
    }

    public function start_contract(Request $request)
    {
        DB::table('hired_freelancer')->where('proposal_id',$request['proposal_id'])->update(['status'=>1]);
        $proposal=DB::table('proposals')->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->first();
        $hir_f=DB::table('hired_freelancer')->where('proposal_id',$request['proposal_id'])->first();
        DB::table('invoices')->insert(['job_id'=>$proposal->job_id,'proposal_id'=>$request['proposal_id'],'freelancer_id'=>$hir_f->user_id,'client_id'=>Session::get('login_id'),'amount'=>$proposal->bid_amount]);
        DB::table('jobs')->where('job_id',$proposal->job_id)->update(['progress'=>1]);
        DB::table('proposals')->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->update(['contracted'=>1]);
        DB::table('notifications')->insert([
            'notification_type' => 'offer',
            'sender_id' => Session::get('login_id'),
            'receiver_id' => $hir_f->user_id,
            'message' => 'Your contract is start Now',
        ]);
    }
    public function post_to_complete(Request $request)
    {
        DB::table('proposals')->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->update(['contracted'=>-1]);
        //self::update_account($request['user_id'], $request['proposal_id']);
        $job = DB::table('proposals')->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->select('job_id')->first();
        if($job)
        {
            DB::table('jobs')->where('job_id',$job->job_id)->update(['status'=>0,'progress'=>3,'job_completed'=>1]);
            if(empty(DB::table('job_completed')->where('job_id',$job->job_id)->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->first()))
            {   
                DB::table('job_completed')
                    ->insert([
                        'status'=>1,
                        'job_id'=>$job->job_id,
                        'proposal_id'=>$request['proposal_id'],
                        'user_id'=>$request['user_id'],
                        'client_id'=>Session::get('login_id'),
                    ]);
            }
            $link=url('/').'/proposals';
            $url = "<a href=".$link.">Cheers Hero,<br>
            Congrats on completing your job Client has market it as completed and give you a review, go ahead and review your client.</a>";
            $message="$url";
            DB::table('notifications')->insert([
                'notification_type' => 'invite',
                'sender_id' => Session::get('login_id'),
                'receiver_id' => $request['user_id'],
                'message' => $message,
            ]);
            $freelancer=DB::table("users")->where("user_id",$request['user_id'])->first();
            $view = View::make('templete.freelancer.weldone',['name'=>$freelancer->name]);
            $contents = (string)$view;
            send_mail('mfarhan7333@gmail.com',$freelancer->email,$freelancer->name,'Job Completed',$contents);
            /*message::save_send_message( [
                       'sender_id'=>Session::get('login_id'),
                       'received_id'=>$request['user_id'],
                       'message'=>$message,
                       'user_id'=>Session::get('login_id')
           ] );*/
        }
        return redirect()->back();
    }
    public function decline_propsals(Request $request)
    {
        DB::table('proposals')->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->update(['status'=>-1]);
        $job = DB::table('proposals')->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->select('job_id')->first();
        if($job)
        {
            if(empty(DB::table('job_completed')->where('job_id',$job->job_id)->where('user_id',$request['user_id'])->where('proposal_id',$request['proposal_id'])->first()))
            {
                DB::table('job_completed')
                    ->insert([
                        'status'=>0,
                        'job_id'=>$job->job_id,
                        'proposal_id'=>$request['proposal_id'],
                        'user_id'=>$request['user_id'],
                    ]);
            }

        }
    }
    public function update_account($user_id, $proposal_id)
    {
        $job = DB::table('proposals')->where('user_id',$user_id)
            ->where('proposal_id',$proposal_id)->select('pay_amount')->first();
        if(empty(DB::table('wallet_credit')->where('user_id',$user_id)->first()))
        {
            DB::table('wallet_credit')->insert(['user_id'=>$user_id,'credit'=>0]);
        }
        date_default_timezone_set('Asia/Riyadh');
        $user_account = DB::table('wallet_credit')->select('*')->where('user_id',$user_id )->first();
        $transaction_before = (isset($user_account->credit)?$user_account->credit:0);
        $transaction_after = $transaction_before+$job->pay_amount;
        $insert_transaction = [];
        $insert_transaction['user_id']              = $user_id;
        $insert_transaction['wallet_id']            = $user_account->wallet_id;
        $insert_transaction['proposal_id']          = $proposal_id;
        $insert_transaction['transaction_before']   = $transaction_before;
        $insert_transaction['transaction_after']    = $transaction_after;
        $insert_transaction['transaction_type']     = 'project payment received';
        $insert_transaction['transaction_amount']   = $job->pay_amount;
        $insert_transaction['transaction_datetime'] = date('Y-m-d');
        $insert_transaction['transaction_year']     = date('Y');
        $insert_transaction['transaction_month']    = date('m');
        $insert_transaction['transaction_credit']   = $job->pay_amount;
        DB::table('wallet_transaction')->insertGetId($insert_transaction);
        DB::table('wallet_credit')->where('user_id',$user_id)->update(['credit'=>$transaction_after]);
    }
    public function hire_new_freelancer(Request $request)
    {
        if(!empty(DB::table('hired_freelancer')->where('job_id',$request->input('job_id'))->where('user_id',$request->input('user_id'))->where('client_id',Session::get('login_id'))->first()))
        {
            echo 'invited';
            die();
        }
        DB::table('hired_freelancer')->insert([
            'user_id'=>$request->input('user_id'),
            'job_id'=>$request->input('job_id'),
            'client_id'=>Session::get('login_id'),    
        ]);
        $link=url('/').'/proposals';
        $url = '<a href="'.$link.'">You have been hired by client please go and view Proposals menu</a>';
        $message="$url";
   
        DB::table('notifications')->insert([
            'notification_type' => 'invite',
            'sender_id' => Session::get('login_id'),
            'receiver_id' => $request->input('user_id'),
            'message' => $message,
        ]);
        /*message::save_send_message( [
                            'sender_id'=>Session::get('login_id'),
                            'received_id'=>$request->input('user_id'),
                            'message'=>$message,
                            'user_id'=>Session::get('login_id')
        ] );*/
        echo 'success';
        die();


    }
    public function hire_freelancer(Request $request)
    {
        if(empty($request->input('message')))
        {
            echo 'message';
            die();
        }
//        if(empty($request->input('price')))
//        {
//            echo 'price';
//            die();
//        }
        if (empty($request->input('job_id')))
        {
            echo 'job';
            die();
        }
        if(!empty(DB::table('proposals')->where('job_id',$request->input('job_id'))->where('user_id',$request->input('user_id'))->first()))
        {
            echo 'invited';
            die();
        }
        date_default_timezone_set('Asia/Riyadh');
        $proposal = new Proposals();

        $proposal->job_id = $request->input('job_id');
//        $proposal->bid_amount = $request->input('price');
//        $proposal->pay_amount = $request->input('price')/100*15;
        $proposal->question_ans  = helper::maybe_serialize([]);
        $proposal->duration = 00;
        $proposal->user_id = $request->input('user_id');
        $proposal->cover_letter = '';
        $proposal->invitation_interview = 1;
        $proposal->attachment_file =  0 ;
        $proposal->save();
        DB::table('jobs')->where('job_id',$request->input('job_id'))->update(['is_open'=>0]);
        $message = $request->input('message');
        DB::table('notifications')->insert([
            'notification_type' => 'invite',
            'sender_id' => Session::get('login_id'),
            'receiver_id' => $request->input('user_id'),
            'message' => $message,
        ]);

        /*message::save_send_message( [
                            'sender_id'=>Session::get('login_id'),
                            'received_id'=>$request->input('user_id'),
                            'message'=>$message,
                            'user_id'=>Session::get('login_id')
        ] );*/

    }
    public function view_proposal($key)
    {
        if(empty($key))
        {
            return redirect('/find/work');
        }
        $proposal_id = Crypt::decrypt($key);
        $user_id = Session::get('login_id');
        $proposals = \DB::table('proposals')->where('proposal_id', $proposal_id)->select('*')->first();
        $jobs = \DB::table('jobs')->where('job_id', $proposals->job_id)->where('jobs.user_id', $user_id)->first();
        $job_questions = helper::maybe_unserialize($jobs->job_questions);
        $question_ans = helper::maybe_unserialize($proposals->question_ans);
        $job_skills = helper::maybe_unserialize($jobs->job_skills);
        $vat=DB::table('admin_option')->value('vat');
        $job_skills = (is_array($job_skills)?implode('&nbsp;&nbsp;',$job_skills):$job_skills);
        return view('jobs.view_proposal', compact('jobs','job_skills','job_questions','proposals','question_ans','vat'));
    }
    public function edit_proposal($key)
    {   $key =  Crypt::decrypt($key);
        if(empty($key))
        {
            return redirect('/find/work');
        }
        $proposal_id = ($key);
        $proposals = \DB::table('proposals')->where('proposal_id', $proposal_id)->first();
        $jobs = \DB::table('jobs')->where('job_id', $proposals->job_id)->first();
        $proposals->attachment_file=(isset($proposals->attachment_file)?json_decode($proposals->attachment_file):$proposals->attachment_file);
        $job_questions = helper::maybe_unserialize($jobs->job_questions);
        $question_ans = helper::maybe_unserialize($proposals->question_ans);
        return view('jobs.edit_proposal', compact('jobs', 'job_questions','proposals','question_ans'));
    }
    public function update_proposal(Request $request, $key)
    {  
        $key =  Crypt::decrypt($key);
        if(empty($key))
        {
            return redirect('/clmy-job');
        }
        date_default_timezone_set('Asia/Riyadh');
        $proposal_id = $key;
        $proposal = [];
        $proposal['bid_amount'] = $request->input('bid_amount');
        $proposal['pay_amount'] = $request->input('pay_amount');
        $proposal['invitation_interview'] = 1;
        $proposal['accept_interview'] = 1;
        $proposal['offers'] = 1;
        DB::table('proposals')->where('proposal_id',$proposal_id)->update($proposal);
        $user_id = Session::get('login_id');
        $ppp=DB::table('proposals')->where('proposal_id',$proposal_id)->select('*')->first();
        $jobs=DB::table('jobs')->where('job_id',$ppp->job_id)->select('*')->first();
        $user=DB::table('users')->where('user_id',$user_id)->select('name')->first();
        //$message = 'you have new offer on proposal on job ['.$jobs->job_title.'] by '.$user->name ;
        $clienName=Session::get('name');
        $link=url('/').'/proposals';
        $url = "<a href=".$link.">Cheers Hero,<br>
        You got an offer from $clienName on $jobs->job_title, let's close the deal with him right now!</a>";
        $message="$url";
        DB::table('jobs')->where('job_id',$ppp->job_id)->update(['is_open'=>0]);
        //DB::table('invoices')->insert(['client_id'=>$user_id,'freelancer_id'=>$ppp->user_id,'proposal_id'=>$proposal_id,'job_id'=>$ppp->job_id,'amount'=>$request->input('pay_amount')]);
        DB::table('notifications')->insert([
            'notification_type' => 'offer',
            'sender_id' => $user_id,
            'receiver_id' => $ppp->user_id,
            'message' => $message,
        ]);
//        DB::table('hired_freelancer')->insert([
//                                                'user_id'=>$ppp->user_id,
//                                                'job_id'=>$jobs->job_id,
//                                                'proposal_id'=>$proposal_id,
//                                                'client_id'=>Session::get('login_id'),
//                                            ]);
        return redirect('/clmy/job/'.Crypt::encrypt($ppp->job_id))->with('message','Offer is Submitted Successfully');
    }
    public function fileupload($request){

        $files = $request->file('attachments');
        $uploaded_file = array();
        foreach($files as $file) {
            $destinationPath = 'public/images/uploads/'.date('Y').'/'.date('M');
            $filename = str_replace(array(' ','-','`',','),'_',time().'_'.$file->getClientOriginalName());
            $upload_success = $file->move($destinationPath, $filename);
            $uploaded_file[] = 'public/images/uploads/'.date('Y').'/'.date('M').'/'.$filename;
        }
        return $uploaded_file;
    }
    public function cl_completed_jobs(){
        $user_id=Session::get('login_id');
       
        $job=DB::table('job_completed')->join('jobs','jobs.job_id','=','job_completed.job_id')
            ->join('invoices','job_completed.job_id','=','invoices.job_id')
            ->select('invoices.*','jobs.job_title as job_title','jobs.job_skills as job_skills',DB::raw("SUM(invoices.client_pay_to_admin) as total_amount"))
            ->where('job_completed.client_id',$user_id)
            ->where('jobs.progress',3)
            ->groupBy('invoices.job_id')
            ->get()->toarray();
        $jobs=[];
        foreach ($job as $j){
            $freelancer=DB::table('users')->where('user_id',$j->freelancer_id)->value('user_nicename');
            $j->freelancer_name=$freelancer;
            $jobs[]=$j;
        }
        return view('jobs.cl_job_completed',compact('jobs'));
    }
    public function fr_mark_complete($job_id){
        if (empty(DB::table('claim_jobs')->where('job_id',$job_id)->where('freelancer_id',Session::get('login_id'))->where('is_removed',0)->first())){
            DB::table('jobs')->where('job_id',$job_id)->update(['progress'=>2]);
            $job=DB::table('jobs')->where('job_id',$job_id)->first();
            $link=url('/').'/clmy/job/'.encrypt($job_id);
            $url = "<a href=".$link.">Congrats on completing the job :)Wish you all the best,See you soon.</a>";
            $message="$url";
            DB::table('notifications')->insert([
                'notification_type' => 'invite',
                'sender_id' => Session::get('login_id'),
                'receiver_id' => $job->user_id,
                'message' =>$message,
            ]);
            return redirect()->back()->with('message','You have mark as complete Job Successfully');
        }
        else{
            $job=DB::table('jobs')->where('job_id',$job_id)->first();
            DB::table('notifications')->insert([
                'notification_type' => 'invite',
                'sender_id' => Session::get('login_id'),
                'receiver_id' => Session::get('login_id'),
                'message' => 'your cannot mark completed job '.$job->job_title.' reason is that this job is under claimed by client',
            ]);
            return redirect()->back();
        }
    }
    public function cl_active_jobs(){
        $active_jobs= DB::table('hired_freelancer')
            ->join('jobs','hired_freelancer.job_id','=','jobs.job_id')
            ->where('jobs.progress',1)
            ->orwhere('jobs.progress',2)
            ->where('hired_freelancer.client_id',Session::get('login_id'))
            ->get()->toarray();
        return view('jobs.cl_active_jobs',compact('active_jobs'));
    }
    public function post_claimJob(Request $request){
        if ($request->input('reason')==''){
            echo "reason";
        }
        else if(empty($request->input('hire_free_id')))
        {
            echo "hire_free_id";
        }
        else{
            $hire_free=DB::table('hired_freelancer')->where('hire_free_id',$request->input('hire_free_id'))->first();
            if (!empty(DB::table('claim_jobs')->where('proposal_id',$hire_free->proposal_id)->where('freelancer_id',$hire_free->user_id)->where('job_id',$hire_free->job_id)->where('client_id',$hire_free->client_id)->first()))
            {
                echo "already";
            }
            else{
                //DB::table('invoices')->where('proposal_id',$hire_free->proposal_id)->where('freelancer_id',$hire_free->user_id)->where('job_id',$hire_free->job_id)->where('client_id',$hire_free->client_id)->update(['is_claim'=>1]);
                $info=DB::table('jobs')->join('invoices','jobs.job_id','=','invoices.job_id')
                    ->join('users','jobs.user_id','=','users.user_id')
                    ->where('invoices.job_id',$hire_free->job_id)
                    ->where('invoices.client_id',$hire_free->client_id)
                    ->where('invoices.freelancer_id',$hire_free->user_id)
                    ->where('invoices.proposal_id',$hire_free->proposal_id)
                    ->first();


                $reason="";
                if ($request->input('reason')==1){
                    $reason='Work is not Completed';
                }
                else
                    if ($request->input('reason')==2){
                        $reason='Freelancer is not Responding';
                    }
                $view = View::make('templete.client.accept_reject_claim',['cname'=>$info->user_nicename,'email'=>$info->email,'c_amount'=>$info->amount,"j_title"=>$info->job_title,'hire_free_id'=>encrypt($request->input('hire_free_id')),'reason'=>$reason,'r_id'=>encrypt($request->input('reason'))]);
                $contents = (string)$view;
                send_mail($info->email,'mfarhanriaz14@gmail.com',$info->user_nicename,'Job Claim',$contents);
                echo "ok";
            }
        }
    }
    public function approve_claim($reason,$hir_id){
        $user_id=Session::get('login_id');
        $reason_id=decrypt($reason);
        $hire_id=decrypt($hir_id);
        $hire_free=DB::table('hired_freelancer')->where('hire_free_id',$hire_id)->first();
        $info=DB::table('jobs')->join('invoices','jobs.job_id','=','invoices.job_id')
            ->join('users','jobs.user_id','=','users.user_id')
            ->where('invoices.job_id',$hire_free->job_id)
            ->where('invoices.client_id',$hire_free->client_id)
            ->where('invoices.freelancer_id',$hire_free->user_id)
            ->where('invoices.proposal_id',$hire_free->proposal_id)
            ->first();
        $invoice_id=DB::table('invoices')->where('proposal_id',$hire_free->proposal_id)->where('freelancer_id',$hire_free->user_id)->where('job_id',$hire_free->job_id)->where('client_id',$hire_free->client_id)->value('id');
        DB::table('invoices')->where('id',$invoice_id)->update(['is_claim'=>1]);
        DB::table('claim_jobs')->insert(
            ['invoice_id'=>$invoice_id,'proposal_id'=>$info->proposal_id,'job_id'=>$info->job_id,'client_id'=>$info->client_id,'freelancer_id'=>$info->freelancer_id,'amount'=>$info->amount,'claim_reason'=>$reason_id]
        );
        DB::table('notifications')->insert([
            'notification_type' => 'offer',
            'sender_id' => $user_id,
            'receiver_id' => $info->client_id,
            'message' => 'Your claim is approved against job [ '.$info->job_title.' ]',
        ]);
        if ($reason_id==1){
            $reason='Your work is not completed';
        }
        else
            if ($reason_id==2){
                $reason='Your are not responding';
            }
        DB::table('notifications')->insert([
            'notification_type' => 'offer',
            'sender_id' => $user_id,
            'receiver_id' => $info->freelancer_id,
            'message' => 'Your following job [ '.$info->job_title.' ] is claimed, reason behined this '.$reason,
        ]);
        return redirect('/dashboard');
    }
    public function reject_claim($reason,$hir_id){
        $user_id=Session::get('login_id');
        $reason_id=decrypt($reason);
        $hire_id=decrypt($hir_id);
        $hire_free=DB::table('hired_freelancer')->where('hire_free_id',$hire_id)->first();
        $client=DB::table('users')->where('user_id',$hire_free->client_id)->first();
        $job=DB::table('jobs')->where('job_id',$hire_free->job_id)->first();
        $contents='Sorry Your claim for job '.$job->job_title.' is disaproved by admin';
        send_mail('admin@gmail.com',$client->email,$client->user_nicename,'Job Claim Disaprove',$contents);
        DB::table('notifications')->insert([
            'notification_type' => 'offer',
            'sender_id' => $user_id,
            'receiver_id' => $hire_free->user_id,
            'message' => 'Your following job [ '.$job->job_title.' ] for claimed is disparoved'
        ]);
        return redirect('/dashboard');
    }
    public function disclaimJob(Request $request){
        if (!empty(DB::table('claim_jobs')->where('job_id',$request->input('job_id'))->where('proposal_id',$request->input('proposal_id'))->where('is_removed',1)->first()))
        {
            echo "already";
        }
        else{
            $ok=DB::table('claim_jobs')->where('job_id',$request->input('job_id'))->where('proposal_id',$request->input('proposal_id'))->update(['is_removed'=>1]);
            if ($ok){
                DB::table('notifications')->insert([
                    'notification_type' => 'offer',
                    'sender_id' => Session::get('login_id'),
                    'receiver_id' =>DB::table('claim_jobs')->where('job_id',$request->input('job_id'))->where('proposal_id',$request->input('proposal_id'))->value('freelancer_id'),
                    'message' => 'Your following job is disclaimed by client check active job and now you can mark complete',
                ]);
                echo 'ok';
            }
            else{
                echo 'error';
            }
        }
    }
    public function claimJobsList(){
        $data=DB::table('users')
            ->join('jobs','users.user_id','=','jobs.user_id')
            ->join('invoices','jobs.job_id','=','invoices.job_id')
            ->join('claim_jobs','invoices.id','=','claim_jobs.invoice_id')
            ->where('invoices.is_claim',1)
            ->where('claim_jobs.is_removed',0)
            ->where('jobs.progress',2)
            ->select('invoices.client_id as client_id','invoices.freelancer_id as freelancer_id','jobs.job_id as job_id','jobs.job_title as job_title','claim_jobs.created_at as job_claim_date','claim_jobs.amount as amount','claim_jobs.claim_reason as reason')
            ->get()->toarray();
        $pending=DB::table('users')
            ->join('jobs','users.user_id','=','jobs.user_id')
            ->join('invoices','jobs.job_id','=','invoices.job_id')
            ->join('claim_jobs','invoices.id','=','claim_jobs.invoice_id')
            ->where('invoices.is_claim',1)
            ->where('claim_jobs.is_removed',0)
            ->where('jobs.progress',2)
            ->sum('claim_jobs.amount');
        $jobs=[];
        foreach ($data as $job){
            $job->freelancer_name=DB::table('users')->where('user_id',$job->freelancer_id)->value('user_nicename');
            $job->client_name=DB::table('users')->where('user_id',$job->client_id)->value('user_nicename');
            $jobs[]=$job;
        }
        return view('admin.clam_job_listing',compact('jobs','pending'));
    }

    public function completeJobInvoices(Request $request)
    {
        $data=DB::table('users')
            ->join('jobs','users.user_id','=','jobs.user_id')
            ->join('job_completed','jobs.job_id','=','job_completed.job_id')
            ->join('invoices','job_completed.job_id','=','invoices.job_id')
            ->where('jobs.progress',3)
            ->where('jobs.job_completed',1)
            ->select('invoices.client_id as client_id','invoices.client_pay_to_admin as amount','invoices.job_bid_amount as job_bid_amount','invoices.start_date as date','invoices.freelancer_id as freelancer_id','jobs.job_id as job_id','jobs.job_title as job_title','invoices.id as id','invoices.amount as amount_pay_to_freelancer')
            ->orderBy('invoices.job_id')
            ->get()->toarray();
        $jobs=[];
        $claimsum=DB::table('users')
            ->join('jobs','users.user_id','=','jobs.user_id')
            ->join('invoices','jobs.job_id','=','invoices.job_id')
            ->join('claim_jobs','invoices.id','=','claim_jobs.invoice_id')
            ->where('invoices.is_claim',1)
            ->sum('claim_jobs.amount');
        $total=DB::table('users')
            ->join('jobs','users.user_id','=','jobs.user_id')
            ->join('invoices','jobs.job_id','=','invoices.job_id')
            ->sum('invoices.client_pay_to_admin');
        $toatl_bid=[];
        foreach ($data as $job){
            $job->freelancer_name=DB::table('users')->where('user_id',$job->freelancer_id)->value('user_nicename');
            $job->client_name=DB::table('users')->where('user_id',$job->client_id)->value('user_nicename');
            $jobs[]=$job;
            $toatl_bid[]=$job->job_bid_amount;
        }
        if(sizeof($jobs)>0){
            $jobs=$this->paginate($jobs);
        }
        if ($request->ajax()){
            return view('admin.tables.total_job_invoices', ['jobs' => $jobs,'toatl_bid'=> $toatl_bid,'claimsum' => $claimsum,'total'=>$total])->render();
        }
        return view('admin.total_job_invoices',compact('jobs','toatl_bid','claimsum','total'));
    }
    public function start_job_task($proposal_id,$proposal_user){
        $client_id = Session::get('login_id');
        $freelancer_id=$proposal_user;
        $job_id=DB::table('proposals')->where('proposal_id',$proposal_id)->value('job_id');
        DB::table('hired_freelancer')->where('proposal_id',$proposal_id)->update(['status'=>1]);
        DB::table('jobs')->where('job_id',$job_id)->update(['progress'=>1]);
        DB::table('proposals')->where('proposal_id',$proposal_id)->update(['contracted'=>1]);

        if(!empty($converstaion_id=DB::table('conversation')->where('client_id',$client_id)->where('freelancer_id',$freelancer_id)->value('conversation_id')))
        {
            DB::table('message')->insert(['conversation_id'=>$converstaion_id,'sender_id'=>$client_id,'receive_id'=>$freelancer_id,'message_contents'=>'your Contarct is start now']);
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
            DB::table('message')->insert(['conversation_id'=>$conv_id,'sender_id'=>$client_id,'receive_id'=>$freelancer_id,'message_contents'=>'your Contarct is start now']);
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
        $clienName=DB::table('users')->where('user_id',$client_id)->value('user_nicename');
        $link=url('/').'/proposals';
        $url = "<a href=".$link.">Cheers Hero,<br>
        $clienName just start the contract, let's give him more than his expectation Hero :)</a>";
        $message="$url";
        DB::table('notifications')->insert([
            'notification_type' => 'payamount',
            'sender_id' => $client_id,
            'receiver_id' => $freelancer_id,
            'message' => $message,
        ]);
        return redirect()->back()->with('message','Contract is Started Successfully');
    }
    public function hours_requests(){
        $client_id = Session::get('login_id');
        $requests=DB::table('hours_requests')
            ->where('client_id',$client_id)->get()->toarray();
        $request_info=[];
        foreach ($requests as $req){
            $req->freelancer_name=DB::table('users')->where('user_id',$req->freelancer_id)->value('user_nicename');
            $req->job_title=DB::table('jobs')->where('job_id',$req->job_id)->value('job_title');
            $request_info[]=$req;
        }
        return view('client.hours_request',compact('request_info'));
    }
}
