<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Auth;
use App\Job as job;
use App\Proposals;
use Carbon\Carbon;
use App\Category;
use Session, DB;
use Redirect;
use View;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\HelperController as helper;
class FindworkController extends Controller
{
	public function index(Request $request)
	{
		$user_id = Session::get('login_id');
		$user_data = DB::table('users')->where('user_id', $user_id)->first();
        $profile_data = DB::table('user_profile')->where('user_id', $user_id)->first();
        if($profile_data)
        {		
        $profile_data->profetional_skills = helper::maybe_unserialize($profile_data->profetional_skills);
      }
      $percentage = 0;
        $education = DB::table('user_education')->where('user_id',$user_id)->select('user_id')->first();
        $languages = DB::table('user_languages')->where('user_id',$user_id)->select('user_id')->first();
        $profile = DB::table('user_profile')->where('user_id',$user_id)->select('user_id')->first();
        if($education)		        {            $percentage += 8.33;        }
        if($languages)        {            $percentage += 8.33;        }
        if($profile)
        {            if(empty($profile->job_title))
        {                $percentage += 8.33;            }
        if(empty($profile->country))
        {                $percentage += 8.33;            }
        if(empty($profile->city))
        {                $percentage += 8.33;            }
        if(empty($profile->profile_image))
        {                $percentage += 8.33;            }
        if(empty($profile->timezone))
        {                $percentage += 8.33;            }
        if(empty($profile->hourly_rate))
        {                $percentage += 8.33;            }
        if(empty($profile->profetional_skills))
        {                $percentage += 8.33;            }
        if(empty($profile->overview))
        {                $percentage += 8.33;            }
        if(empty($profile->availability))
        {                $percentage += 8.33;            }
        if(empty($profile->availability_type))
        {                $percentage += 8.33;            }
        }
        $percentage = round($percentage);
       
        $offset = (empty($request->get('offset'))?0:$request->get('offset'));
        $keyword = (empty($request->input('search_keyword'))?'':$request->input('search_keyword'));
        if(!empty($request->find)){
          $keyword = $request->find;
        }
        $result = job::search_job($keyword,$offset);
      
       
        $user_id = Session::get('login_id');
        $fr = DB::table('user_profile')->where('user_id', $user_id)->first();
        $fr_country="";
        if(!empty($fr->country)){
            $fr_country = $fr->country;
        }
        $search = [];
        if(!empty($result)){
          foreach($result as $row){
            //echo $row->countries."<br>";
             if(strpos($row->countries, $fr_country) !== false || empty($row->countries)){
                $search[] = $row;
             }
          }
        }
        $searches =  $this->search_html($search);
        if(sizeof($searches)>0){
         $searches=$this->paginate($searches);
         }
        if($request->ajax()){
          return view('jobs.table.find_job',  ['searches' => $searches])->render();
        }
		return view('jobs.find_job', compact(['user_data','profile_data','percentage','searches']));
	}
	public function get_search(Request $request)
	{
		$offset = (empty($request->get('offset'))?0:$request->get('offset'));
		$keyword = (empty($request->input('search_keyword'))?'':$request->input('search_keyword'));
		$result = job::search_job($keyword,$offset);

    $user_id = Session::get('login_id');
    $fr = DB::table('user_profile')->where('user_id', $user_id)->first();
    $fr_country = $fr->country;
    
    $search = [];
    if(!empty($result)){
      foreach($result as $row){
        //echo $row->countries."<br>";
         if(strpos($row->countries, $fr_country) !== false || empty($row->countries)){
            $search[] = $row;
         }
      }
    }

    // echo "<pre>";
    // print_r($search);
    // exit;
		if ($search)
		{
     $searches =  $this->search_html($search);
     if(sizeof($searches)>0){
      $searches=$this->paginate($searches);
      }
      return view('jobs.table.find_job',  ['searches' => $searches])->render();
			// echo json_encode(array('html'=>self::search_html($search)/*,'pagination'=>self::search_pagination($request)*/));
			die();
		}else
		{
			echo json_encode(array('html'=>'<tr><td colspan="5"><h2 align="center">Sorry, there is no job found with your criteria</h2></td></tr>'/*,'pagination'=>''*/));
			die();
		}		
	}
	public function search_html($searchs)
	{
    
    $html ='';
    $searches=array();
		foreach ($searchs as $search) {
			$search->pp_count = job::get_job_proposal_count($search->job_id);
			$user_cont = DB::table('user_profile')->where('user_id',$search->job_id)->select('country')->first();
			$country = (($user_cont)?$user_cont->country:'');
			$search->job_skills = helper::maybe_unserialize($search->job_skills);
			$search->job_skills = (is_array($search->job_skills)?implode(' , ',$search->job_skills):$search->job_skills);
      $search->created_at= self::get_duration_time($search->created_at );
      if (empty($search->budget)){
                $search->budget='N/A';
            }
            $searches[]=$search;
          //  $searches[]=$search;
			// $html .='<tr>
      //       <td><a  href="'.url('/job/proposal/').'/'.Crypt::encryptString($search->job_id).'" class="readmore table-header-title">'.$search->job_title.'</a></td>
      //       <td>'.$job_skills.'</td>
      //       <td>'.$pp_count->job_time_type.'</td>
      //       <td >'.$search->budget.'</td>
      //       <td>'.$pp_count->fl_number.'</td>
      //       <td>'.self::get_duration_time($search->created_at ).' ago </td>
      //       <td>
      //       <a class="btn btn-round btn-default btn-color" target="_blank" href="'.url('/submit/proposal/').'/'.Crypt::encryptString($search->job_id).'">'.__("freelancer.submit_proposal").'</a>
      //      <button class="btn btn-round btn-default save_job btn-color" data-ng_bind="'.Crypt::encryptString($search->job_id).'">'.__("freelancer.save_project").'</button>
      //       </td>
          
            
      //     </tr>';
    }
		return $searches;
	}
	public function get_duration_time($date)
	{
		$t1 = Carbon::parse($date);
		$t2 = Carbon::parse();
		$diff = $t1->diff($t2);
		return $diff->format('%d')." days ". $diff->format('%h')." Hours ".$diff->format('%i')." Minutes";
  }
  public function paginate($items, $perPage = 10, $page = null, $options = [])

  {

      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

      $items = $items instanceof Collection ? $items : Collection::make($items);

      return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

  }
	public function search_pagination($request)
	{
		$keyword = $request->input('search_keyword');
		$offset = $request->input('offset')+1;
		$count = job::get_search_count($keyword);
		if(($count/15)<=$offset)
		{
			return;
		}
		return '<a href="'.url('/find/work').'?search_keyword='.$keyword.'&offset='.$offset.'">Load More</a>';
	}

	public function job_proposal($key='')
	{
		if(empty($key))
		{
			return redirect('/find/work');
		}
		$user_id = Session::get('login_id');
		$job_id = Crypt::decryptString($key);
		$client_id=DB::table('jobs')->where('job_id',$job_id)->value('user_id');
		$jobs = job::get_job_proposal($job_id);
		$jobs->job_skills = helper::maybe_unserialize($jobs->job_skills);
        $jobs->attachments = (!empty($jobs->attachments)?helper::maybe_unserialize($jobs->attachments):$jobs->attachments);
	///	$saved_job = DB::table('job_saved')->where('job_id',$job_id)->where('user_id',$user_id)->select('status')->first();
		$proposals = DB::table('proposals')->where('job_id',$job_id)->count();
		//$proposal_user = DB::table('proposals')->where('user_id',$user_id)->get()->count();
		$total__active_jobs=DB::table('jobs')->where('user_id',$client_id)->count();
        $client__active_jobs=DB::table('jobs')->where('user_id',$client_id)->where('is_open',0)->where('progress',1)->count();
        $client_created=DB::table('users')->where('user_id',$client_id)->value('created_at');
        $ttt = DB::table('jobs')->where('user_id',$jobs->user_id)->count();
        $open_jobs=DB::table('jobs')->where('user_id',$client_id)->where('is_open',1)->count();
        $closed = DB::table('jobs')->where('user_id',$jobs->user_id)->where('is_open',0)->count();
        $percentChange = self::calculatePercentage($ttt, $closed);
        $comments = DB::table('comments')->join('jobs','jobs.job_id','=','comments.job_id')->join('users','users.user_id','=','comments.user_id')->where('comments.owner_id',$jobs->user_id)->select('*')->get()->toArray();
        $total_client_amount=DB::table('invoices')->where('client_id',$client_id)->sum('invoices.amount');
        $hired_freelancer=DB::table('hired_freelancer')->where('client_id',$client_id)->count();
        return view("jobs.job_bidding", compact('jobs','proposals','percentChange','comments','total__active_jobs','open_jobs','client_created','total_client_amount','hired_freelancer','client__active_jobs'));
	}
  public function calculatePercentage($oldFigure, $newFigure)
{
   if(empty($newFigure))
        {
            return 0;
        }
    $percentChange = (($newFigure) / $oldFigure) * 100;
    return round(abs($percentChange));
}
	public function proposal($key,$proposal_id="")
	{
		if(empty($key))
		{
			return redirect('/find/work');
		}

		$job_id = Crypt::decryptString($key);
        $jobs = \DB::table('jobs')->where('job_id', $job_id)->first();   
        if(empty($jobs))
        {
        	return redirect('/find/work');
        }     
        $job_questions = helper::maybe_unserialize($jobs->job_questions);
        $interview = DB::table('proposals')->where('job_id',$job_id)->where('invitation_interview',1)->count();
        $offer = DB::table('proposals')->where('job_id',$job_id)->where('offers',1)->count();
        $actve = DB::table('proposals')->where('job_id',$job_id)->where('accept_offer',1)->count();
        $unanserder = DB::table('proposals')->where('job_id',$job_id)->where('accept_interview',0)->count();
        $total_job = DB::table('jobs')->where('user_id',$jobs->user_id)->count();
        $open_job = DB::table('jobs')->where('user_id',$jobs->user_id)->where('is_open',1)->count();
        $spent_hire = DB::table('proposals')->join('jobs','jobs.job_id','=','proposals.job_id')->where('proposals.status',1)->select('bid_amount')->get()->toArray();
        $profile = DB::table('users')->where('user_id',$jobs->user_id)->select('created_at')->first();
        $profile_data = DB::table('user_profile')->where('user_id',$jobs->user_id)->select('city','country')->first();
        $error_msg = '';
        $user_id = Session::get('login_id');
        if(!empty(DB::table('proposals')->where('user_id',$user_id)->where('job_id',$job_id)->where('invitation_interview',0)->first()))
        {
          $error_msg = 'You are already applied for this job';
        }
        return view('jobs.submit_proposal', compact('jobs', 'job_questions','interview','offer','unanserder','total_job','open_job','spent_hire','profile','profile_data','error_msg','proposal_id'));
    }
    public function fr_view_proposal($key)
    {
        if(empty($key))
        {
            return redirect('/find/work');
        }
        $user_id = Session::get('login_id');
        $job_id = Crypt::decryptString($key);
        $jobs = \DB::table('jobs')->where('job_id', $job_id)->first(); 
        $proposals = \DB::table('proposals')->where('job_id', $job_id)->where('user_id', $user_id)->select('*')->first(); 
        $job_questions = helper::maybe_unserialize($jobs->job_questions);
        $question_ans = helper::maybe_unserialize($proposals->question_ans);
        $job_skills = helper::maybe_unserialize($jobs->job_skills);
        $job_skills = (is_array($job_skills)?implode('&nbsp;&nbsp;',$job_skills):$job_skills);
        return view('jobs.view_proposal', compact('jobs', 'job_questions','proposals','question_ans','job_skills'));
    }
    public function createproposal(Request $request){
        $data = $request->all();
       if (!empty($request->input('proposal_id'))){
           $proposal_id= decrypt($request->input('proposal_id'));
           $proposal = [];
           $proposal['bid_amount'] = $request->input('bid_amount');
           $proposal['pay_amount'] = $request->input('pay_amount');
          //  $proposal['cover_letter'] = $request->input('cover_letter');
          //  $proposal['question_ans']  = helper::maybe_serialize($request->input("question_ans"));
          //  $proposal['duration'] = $request->input('duration');
          //  if($request->has('attachments'))
          //  {
          //      $proposal->attachment_file = json_encode(self::fileupload1($request));
          //  }
           $proposal['invitation_interview'] =0;
           DB::table('proposals')->where('proposal_id',$proposal_id)->update($proposal);
           return redirect('/proposals')->with('message','Proposal Submitted Successfully');
           //$user_id = Session::get('login_id');
           //$ppp=DB::table('proposals')->where('proposal_id',$proposal_id)->select('*')->first();
           //$jobs=DB::table('jobs')->where('job_id',$ppp->job_id)->select('*')->first();
           //$user=DB::table('users')->where('user_id',$user_id)->select('name')->first();
           //$message = 'you have new offer on proposal on job ['.$jobs->job_title.'] by '.$user->name ;
           //DB::table('jobs')->where('job_id',$ppp->job_id)->update(['is_open'=>0]);
           //DB::table('invoices')->insert(['client_id'=>$user_id,'freelancer_id'=>$ppp->user_id,'proposal_id'=>$proposal_id,'job_id'=>$ppp->job_id,'amount'=>$request->input('pay_amount')]);
//            DB::table('notifications')->insert([
//                'notification_type' => 'offer',
//                'sender_id' => $user_id,
//                'receiver_id' => $ppp->user_id,
//                'message' => $message,
//            ]);
       }
        $user_id = Session::get('login_id');
        $proposal = new Proposals();

        if(!empty(DB::table('proposals')->where('user_id',$user_id)->where('job_id',$request->job_id)->where('invitation_interview',0)->first()))
        {
        	return Redirect::back()->withErrors(['You are already applied for this job']);
        }

        $proposal->job_id = $request->job_id;
        $proposal->bid_amount = $request->bid_amount;
        $proposal->pay_amount = $request->pay_amount;
        // $proposal->cover_letter = $request->cover_letter;
        // $proposal->question_ans  = helper::maybe_serialize($request->question_ans);
        // $proposal->duration = $request->duration;
        $proposal->user_id = $user_id;
        // if($request->has('attachments'))
        // {
        //     $proposal->attachment_file = json_encode(self::fileupload1($request));
        // }
        
        $proposal->save();
        $proposalid=DB::getPdo()->lastInsertId();
        $jobs=DB::table('jobs')->where('job_id',$request->job_id)->select('*')->first();
        $user=DB::table('users')->where('user_id',$user_id)->select('name')->first();
        $clientinfo=DB::table('users')->where('user_id',$jobs->user_id)->select('name','email')->first();
        $link=url('/').'/view/proposal/'.Crypt::encrypt($proposalid);
        $url = '<a href="'.$link.'">Knock Knock!<br> You have received new proposal on your '.$jobs->job_title.'</a>';
        $message="$url"; 
        //$message = 'you have new proposal on your job ['.$jobs->job_title.'] by '.$user->name.' also check you mail' ;
        DB::table('notifications')->insert([
                                            'notification_type' => 'proposal',
                                            'sender_id' => $user_id,
                                            'receiver_id' => $jobs->user_id,
                                            'message' => $message,
                                            ]);
        $freelancer=DB::table('users')->where('user_id',$user_id)->first();
        $jobskills=helper::maybe_unserialize($jobs->job_skills);
        $url=url('view/proposal').'/'.$proposalid;
        $view = View::make('templete.client.proposal_notification',["freelancer_name"=>Session::get('name'),"title"=>$jobs->job_title,"client"=>$clientinfo->name,'skills'=>json_encode($jobskills),'url'=>$url]);
        $contents = $view->render();
       // $contents='You have a new proposal on job '.$jobs->job_title.' by freelancer '.$freelancer->user_nicename;
        send_mail('mfarhanriaz14@gmail.com',$clientinfo->email,$clientinfo->name,'Job Proposal',$contents,$attachment=false);

        return redirect('/proposals')->with('message','Proposal Submitted Successfully');
    }
    public function fileupload1($request){

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
    public function save_job(Request $request)
    {
    	$user_id = Session::get('login_id');
    	$job_id = Crypt::decryptString($request->input('job_id'));
    	if(empty($saved_job = DB::table('job_saved')->where('job_id',$job_id)->where('user_id',$user_id)->first()))
		{
			DB::table('job_saved')->insert(array('job_id'=>$job_id,'user_id'=>$user_id,'status'=>1,));
		}else
		{
			if($saved_job->status==1)
			{
				$status = 0;
			}else
			{
				$status = 1;
			}
			DB::table('job_saved')->where('job_id',$job_id)->where('user_id',$user_id)->update(array('status'=>$status));
		}
		$saved_job = DB::table('job_saved')->where('job_id',$job_id)->where('user_id',$user_id)->first();
		return $saved_job->status;
    }
    
}
