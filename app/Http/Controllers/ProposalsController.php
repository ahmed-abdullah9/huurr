<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Job as job;
use App\Proposals;
use Carbon\Carbon;
use App\Category;
use Session, DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\HelperController as helper;
class ProposalsController extends Controller
{
	public function index()
	{
		$proposals = proposals::get_submitted_proposals();
		$interview = proposals::get_invitaion_interview();
		$offers = proposals::get_offers();
		$active_jobs=(proposals::active_jobs());
		//$archived = proposals::get_archived_proposals();
		$completed = proposals::get_completed_proposals();	
		
		return view('proposals.proposal_list',compact(['proposals','interview','offers','completed','active_jobs']));
	}
	public function save_job()
	{
		$saved_job  = proposals::get_saved_job();
		return view('proposals.saved_job_list',compact('saved_job'));
	}

	public function reject($id='')
	{
		if(empty($id)){
			return redirect('proposals');
		}
		$result = DB::table('proposals')
        ->where('proposal_id', $id)
        ->limit(1)->update(array('offers' => '0'));
        if(!empty($result)){
            return redirect('proposals')->with('success', 'Offer rejected successfully.');
        }
        return redirect('proposals');
	}

	public function my_completed_job()
	{
		$job  = proposals::get_completed_job();
		$jobs=[];
		foreach ($job as $j){
		    if (empty(DB::table('comments')->where('job_id',$j->job_id)->where('user_id',Session::get('login_id'))->where('feedback_by',2)->where('proposal_id',$j->proposal_id)->first())){
                $j->feed_back=1;
            }
            else{
                $j->feed_back=0;
            }
		    $jobs[]=$j;
        }
		return view('proposals.my_job',compact('jobs'));
	}
	public function my_contract_job()
	{
		$jobs  = proposals::get_contract_job();
		return view('proposals.my_contract',compact('jobs'));
	}
	public function create_invite($key)
	{
		if(empty($key))
        {
            return redirect('/find/work');
        }
        $proposal_id = Crypt::decryptString($key);
        $proposals = \DB::table('proposals')->where('proposal_id', $proposal_id)->first();
        $jobs = \DB::table('jobs')->where('job_id', $proposals->job_id)->first();

        $jobs->job_skills = helper::maybe_unserialize($jobs->job_skills);        
        $job_questions = helper::maybe_unserialize($jobs->job_questions);
        $question_ans = helper::maybe_unserialize($proposals->question_ans);
        $client = DB::table('users')->where('user_id',$jobs->user_id)->select('*')->first();
        $profile = DB::table('user_profile')->where('user_id',$jobs->user_id)->select('*')->first();
        $job_count = DB::table('jobs')->where('user_id',$jobs->user_id)->count();
        //$spend_count = DB::table('proposals')->join('jobs','jobs.job_id','=','proposals.job_id')->where('proposals.status',1)->where('jobs.user_id',$jobs->user_id)->select('bid_amount')->get()->toArray();
        $spend=DB::table('invoices')->where('client_id',$client->user_id)->sum('amount');

//        $spend = [];
//        if(!empty($spend_count))
//        {
//        	foreach ($spend_count as $spnct) {
//        		$spend[] = $spnct->bid_amount;
//        	}
//        }
//        $spend = array_sum($spend);
        $hir_count = DB::table('proposals')->join('jobs','jobs.job_id','=','proposals.job_id')->where('proposals.status',1)->where('jobs.user_id',$jobs->user_id)->count();
		return view('invitation.create_notification', compact('jobs', 'job_questions','proposals','question_ans','client','profile','job_count','hir_count','spend'));
	}
    
}
