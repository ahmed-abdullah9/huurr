<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Session;
use App\Http\Controllers\HelperController as helper;
class Job extends Model
{
   protected function search_job($keyword,$offset)
   {
       $user_id = Session::get('login_id');
       $user_category= DB::table('users_categories')->join('users','users.user_id','=','users_categories.user_id')->first();

       //$job_skills=helper::maybe_unserialize($profile_data->profetional_skills);
       //$offset = 15*$offset;
       $skills=DB::table('categorie')->where('id',$user_category->category_id)->value('freelancer_skill');
       return DB::table('jobs')->select('*')
           ->where(function($query) use ($keyword) {
               return     $query->where('job_skills', 'LIKE','%'.$keyword.'%')
                   ->orwhere('job_title','like','%'.$keyword.'%')
                   ->orwhere('job_description','like','%'.$keyword.'%');
           })
           ->where('is_open',1)
           ->where('is_draft',0)
           ->limit(15)->offset($offset)
           ->orderBy('jobs.created_at', 'DESC')
           ->get()->toArray();
   }
   
   protected function get_search_count($keyword)
   {
   	   return DB::table('jobs')->select('*')->orwhere('job_skills','like','%'.$keyword.'%')->orwhere('job_title','like','%'.$keyword.'%')->orwhere('job_description','like','%'.$keyword.'%')->where('status',1)->count();
   }

   protected function get_job_proposal($job_id)
   {
   		return \DB::table('jobs')->where('job_id', $job_id)->first();
   }

   protected function get_job_proposal_count($job_id)
   {
      return   DB::table('jobs')->where('job_id',$job_id)->first();
          //DB::table('proposals')->where('job_id',$job_id)->get()->count();
   }

}
