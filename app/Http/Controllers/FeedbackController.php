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
class FeedbackController extends Controller
{
	public function index($key='')
	{
	    $key=decrypt($key);
	    if(empty($key))
		{
			return redirect('/');
		}
		//$jobs = DB::table('jobs')->where('job_id',$key)->select('*')->first();
		//$user_data = DB::table('users')->where('user_id',$jobs->user_id)->select('*')->first();
		//$user_profile = DB::table('user_profile')->where('user_id',$jobs->user_id)->select('*')->first();
		//$proposals = DB::table('proposals')->where('job_id',$jobs->job_id)->where('user_id',Session::get('login_id'))->select('*')->first();
		//$clcomment = DB::table('comments')->where('job_id',$jobs->job_id)->where('owner_id',$jobs->user_id)->select('*')->first();

        $frcomment = DB::table('comments')
            ->join('feedback_rating','comments.comment_id','=','feedback_rating.feedback_id')
            ->join('jobs','comments.job_id','=','jobs.job_id')
            ->where('comments.job_id',$key)->where('comments.user_id',Session::get('login_id'))
            ->where('comments.feedback_by',2)
            ->first();
		$for_feedback=DB::table('hired_freelancer')->where('job_id',$key)->where('user_id',Session::get('login_id'))->where('status',1)->first();
        $clcomment=DB::table('comments')
            ->join('feedback_rating','comments.comment_id','=','feedback_rating.feedback_id')
            ->where('comments.job_id',$key)->where('comments.owner_id',$for_feedback->client_id)
            ->where('comments.feedback_by',1)
            ->first();
	    return view('feedback.feedbackfreelancer',compact(['for_feedback','frcomment','clcomment']));
	}
	public function clfeedback($key='')
	{
	    $key=decrypt($key);
		if(empty($key))
		{
			return redirect('/');
		}
        $clcomment = DB::table('comments')
            ->join('feedback_rating','comments.comment_id','=','feedback_rating.feedback_id')
            ->join('jobs','comments.job_id','=','jobs.job_id')
            ->join('proposals','comments.proposal_id','=','proposals.proposal_id')
            ->where('comments.job_id',$key)->where('comments.owner_id',Session::get('login_id'))
            ->where('comments.feedback_by',1)
            ->first();
        $for_feedback=DB::table('hired_freelancer')
            ->where('job_id',$key)->where('client_id',Session::get('login_id'))
            ->where('status',1)->first();
//		$proposals = DB::table('proposals')->where('proposal_id',$key)->select('*')->first();
//		$jobs = DB::table('jobs')->where('job_id',$proposals->job_id)->select('*')->first();
//		$user_data = DB::table('users')->where('user_id',$proposals->user_id)->select('*')->first();
//		$user_datacl = DB::table('users')->where('user_id',Session::get('login_id'))->select('*')->first();
//		$clcomment = DB::table('comments')->where('job_id',$jobs->job_id)->where('owner_id',$proposals->user_id)->select('*')->first();
		$frcomment = DB::table('comments')
            ->join('feedback_rating','comments.comment_id','=','feedback_rating.feedback_id')
            ->where('comments.job_id',$key)->where('comments.user_id',$for_feedback->user_id)
            ->where('comments.feedback_by',2)
            ->first();
		return view('feedback.feedbackclient',compact(['clcomment','for_feedback','frcomment']));
	}
    public function save_cl_feedback(Request $request)
    {
        $info=DB::table('hired_freelancer')
            ->where('proposal_id',decrypt($request->input('proposal_id')))
            ->where('status',1)
            ->first();
        $data1=[
            'feedback_by'=>decrypt($request->input('feedback_by')),
            'proposal_id'=>decrypt($request->input('proposal_id')),
            'user_id'=>$info->user_id,
            'owner_id'=>$info->client_id,
            'job_id'=>$info->job_id,
            'comment'=>$request->input('message')
        ];
        DB::table('comments')->insert($data1);
        $feedback_id=DB::getPdo()->lastInsertId();
        $sum=($request->input('experience')+$request->input('response_time')+$request->input('communication')+$request->input('skills'));
        //$plus=$sum*100;
        $avg_rate=$sum/4;
        $data2=[
            'feedback_id'=>$feedback_id,
            'experience'=>$request->input('experience'),
            'response_time'=>$request->input('response_time'),
            'com_experience'=>$request->input('communication'),
            'tech_skills'=>$request->input('skills'),
            'avg_rate'=>$avg_rate
        ];
        DB::table('feedback_rating')->insert($data2);
        return redirect()->back()->with('info','You have submited FeedBack Successfully');
    }
	public function save_fr_feedback(Request $request)
	{
	    $info=DB::table('hired_freelancer')
            ->where('proposal_id',decrypt($request->input('proposal_id')))
                ->where('status',1)
                ->first();
	    $data1=[
            'feedback_by'=>decrypt($request->input('feedback_by')),
            'proposal_id'=>decrypt($request->input('proposal_id')),
            'user_id'=>$info->user_id,
            'owner_id'=>$info->client_id,
            'job_id'=>$info->job_id,
            'comment'=>$request->input('message')
        ];
	    DB::table('comments')->insert($data1);
	    $feedback_id=DB::getPdo()->lastInsertId();
	    $sum=($request->input('experience')+$request->input('response_time')+$request->input('communication')+$request->input('skills'));
	    //$plus=$sum*100;
	    $avg_rate=$sum/4;
	    $data2=[
	       'feedback_id'=>$feedback_id,
           'experience'=>$request->input('experience'),
           'response_time'=>$request->input('response_time'),
           'com_experience'=>$request->input('communication'),
           'tech_skills'=>$request->input('skills'),
           'avg_rate'=>$avg_rate
       ];
        DB::table('feedback_rating')->insert($data2);
        return redirect()->back()->with('info','You have submited FeedBack Successfully');
	}
}
