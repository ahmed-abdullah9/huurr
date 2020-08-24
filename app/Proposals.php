<?php

namespace App;
use Session, DB;
use Illuminate\Database\Eloquent\Model;

class Proposals extends Model
{
   protected function get_submitted_proposals()
   {
   		$user_id = Session::get('login_id');
   		return DB::table('proposals')
   						->join('jobs','jobs.job_id','=','proposals.job_id')
   						->where('proposals.user_id','=',$user_id)
   						->select('*','proposals.created_at as received','proposals.user_id as Proposal_user')
   						->get()
   						->toArray();
   }

   protected function get_completed_proposals()
   {
         $user_id = Session::get('login_id');
         return DB::table('proposals')
                     ->join('jobs','jobs.job_id','=','proposals.job_id')
                     ->where('proposals.user_id','=',$user_id)
                      ->where('proposals.contracted','=','-1')
                     ->where('jobs.progress','=',3)
                     ->select('*','proposals.created_at as received','proposals.user_id as Proposal_user')
                     ->get()
                     ->toArray();
   }

   protected function get_invitaion_interview()
   {
   		$user_id = Session::get('login_id');
   		return DB::table('proposals')
   						->join('jobs','jobs.job_id','=','proposals.job_id')
   						->where('proposals.user_id','=',$user_id)
   						->where('proposals.invitation_interview',1)
                     ->where('proposals.offers',0)
                     ->where('proposals.status',0)
   						->select('*','proposals.created_at as received','proposals.user_id as Proposal_user')
   						->get()
   						->toArray();
   }
   protected function get_offers()
   {
   		$user_id = Session::get('login_id');
   		return DB::table('proposals')
   						->join('jobs','jobs.job_id','=','proposals.job_id')
   						->where('proposals.user_id','=',$user_id)
   						->where('proposals.invitation_interview',1)
                     ->where('proposals.offers',1)
                     ->where('proposals.status',0)
                     ->where('proposals.contracted',0)
   						->select('*','proposals.created_at as received','proposals.user_id as Proposal_user','jobs.progress as progress')
   						->get()
   						->toArray();
   }
   protected function get_archived_proposals()
   {
   		$user_id = Session::get('login_id');
   		return DB::table('proposals')
   						->join('jobs','jobs.job_id','=','proposals.job_id')
   						->where('proposals.user_id','=',$user_id)
   						->where('proposals.status',-1)
   						->select('*','proposals.created_at as received','proposals.user_id as Proposal_user')
   						->get()
   						->toArray();
   }
   protected function get_saved_job()
   {
      $user_id = Session::get('login_id');
      $save_job = DB::table('job_saved')->where('user_id',$user_id)->where('status',1)->select('job_id')->get()->toArray();
      $job_ids = [];
      if ($save_job)
      {
         foreach ($save_job as $jobs) {
            $job_ids[] = $jobs->job_id;
         }
         return \DB::table('jobs')->select('*')->wherein('job_id', $job_ids)->select('*')->get()->toArray();
      }
      return;
   }
   protected function get_completed_job()
   {
      $user_id = Session::get('login_id');
      return DB::table('job_completed')
                           ->join('proposals','proposals.proposal_id','=','job_completed.proposal_id')
                           ->join('invoices','job_completed.proposal_id','=','invoices.proposal_id')
                           ->join('jobs','jobs.job_id','=','job_completed.job_id')
                           ->join('users','users.user_id','=','jobs.user_id')
                           ->where('job_completed.user_id',$user_id)->where('job_completed.status',1)
          ->where('jobs.job_completed',1)
          ->where('jobs.progress',3)
                           ->select('jobs.*','invoices.amount as invoice_amount','proposals.proposal_id as proposal_id','jobs.created_at as job_created', 'job_completed.created_at as job_completed_date','users.name')->get()->toArray();
      
   }
   protected function active_jobs(){
         $active_jobs= DB::table('hired_freelancer')
             ->leftJoin('jobs','hired_freelancer.job_id','=','jobs.job_id')
             ->where('jobs.progress',1)
             ->orwhere('jobs.progress',2)
             ->where('hired_freelancer.user_id',Session::get('login_id'))
             ->get()->toarray();
         $active=[];
         foreach ($active_jobs as $active_job){
             $active_job->is_claim=DB::table('invoices')->where('job_id',$active_job->job_id)->where('proposal_id',$active_job->proposal_id)->value('is_claim');
             $active_job->is_removed=DB::table('claim_jobs')->where('job_id',$active_job->job_id)->where('proposal_id',$active_job->proposal_id)->value('is_removed');
             $active[]=$active_job;
         }
         return $active;
   }
   protected function get_contract_job()
   {
      $user_id = Session::get('login_id');
      $save_job = DB::table('proposals')
                           ->where('proposals.user_id',$user_id)->where('proposals.contracted',1)
                           ->select('proposals.job_id')->get()->toArray();
      $job_ids = [];
      if ($save_job)
      {
         foreach ($save_job as $jobs) {
            $job_ids[] = $jobs->job_id;
         }         
      }
      $hire_job = DB::table('hired_freelancer')->where('user_id',$user_id)->select('job_id')->get()->toArray();
      if($hire_job)
      {
         foreach ($hire_job as $job) {
            $job_ids[] = $job->job_id;
         }
      }
      return \DB::table('jobs')->select('*')->wherein('job_id', $job_ids)->select('*')->get()->toArray();
      return;
   }
   
}
