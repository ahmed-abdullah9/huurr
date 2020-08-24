<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Job as job;
use App\Proposals;
use Carbon\Carbon;
use App\Category;
use Session, DB;
use Excel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\HelperController as helper;
class ReportsController extends Controller
{
	public function earning_by_client(Request $request)
	{

	     $from_date = $request->input('from_date');
		$to_date = $request->input('to_date');
		if(empty($from_date))
		{
			$from_date = date('Y-m-d', strtotime('-30 days'));
		}
		if(empty($to_date))
		{
			$to_date = date('Y-m-d');
		}
		$user_id = Session::get('login_id');
        $service_fee= Config::get('constant.admin_email');
        $service_fee=0.2;
        $earning_client=DB::table('job_completed')->join('invoices','job_completed.job_id','=','invoices.job_id')->join('jobs','invoices.job_id','=','jobs.job_id')
            ->join('users','jobs.user_id','=','users.user_id')
            ->select('users.user_nicename as client_name','jobs.job_id as job_id',DB::raw('SUM(invoices.amount) AS payamount'),'jobs.job_title as job_title')
            ->where('invoices.freelancer_id',$user_id)
            ->where('jobs.progress',3)
            ->groupBy('job_id')
            ->get();
		return view('report.earning_by_client',compact('earning_client'));
	}
	public function lifetime_billing()
	{
		return view('report.lifetime_billing');
	}
	public function transaction_history(Request $request)
	{
		$from_date = $request->input('from_date');
		$to_date = $request->input('to_date');
		if(empty($from_date))
		{
			$from_date = date('Y-m-d', strtotime('-30 days'));
		}
		if(empty($to_date))
		{
			$to_date = date('Y-m-d');
		}
		$user_id = Session::get('login_id');
        $transaction=DB::table('with_drawrequests')
            ->join('users','with_drawrequests.freelancer_id','=','users.user_id')
            ->where('users.user_id',$user_id)
            ->where('with_drawrequests.freelancer_id',$user_id)
            ->where('with_drawrequests.is_paid',1)
            ->get();
        $user_balance=DB::table('user_balance')->where('freelancer_id',$user_id)->first();

//		$transaction = DB::table('wallet_transaction')
//								->join('proposals','proposals.proposal_id','=','wallet_transaction.proposal_id')
//								->join('jobs','jobs.job_id','=','proposals.job_id')
//								->join('users','users.user_id','=','jobs.user_id')
//								->where('wallet_transaction.user_id',$user_id)
//								->whereBetween('wallet_transaction.transaction_datetime',[$from_date, $to_date])
//								->select('wallet_transaction.*','users.name','jobs.job_title','proposals.bid_amount','proposals.pay_amount')
//								->get()
//								->toArray();
//		$wallet = DB::table('wallet_credit')->select('credit')->where('user_id',$user_id)->first();
		return view('report.transaction_history',compact('transaction','user_balance'));
	} 
	public function earning_csv($from_date = '', $to_date = '')
	{
		if(empty($from_date))
		{
			$from_date = date('Y-m-d', strtotime('-30 days'));
		}
		if(empty($to_date))
		{
			$to_date = date('Y-m-d');
		}
		$user_id = Session::get('login_id');
		$get_client = DB::table('proposals')->join('jobs','jobs.job_id','=','proposals.job_id')->where('proposals.user_id',$user_id)->select('jobs.user_id')->get()->toArray();
		$clients = [];
		foreach ($get_client as $client) {
			$clients[] = $client->user_id;
		}
		$clients = array_unique($clients);
		$earning_client = [];
		foreach($clients as $cl)
		{
			$cl_in_bid = $cl_in_pay = [];
			$trns = [];
			$transaction = DB::table('wallet_transaction')
								->join('proposals','proposals.proposal_id','=','wallet_transaction.proposal_id')								
								->join('jobs','jobs.job_id','=','proposals.job_id')
								->join('users','users.user_id','=','jobs.user_id')
								->where('jobs.user_id',$cl)
								->whereBetween('wallet_transaction.transaction_datetime',[$from_date, $to_date])
								->select('wallet_transaction.*','users.name','jobs.job_title','proposals.bid_amount','proposals.pay_amount')
								->get()
								->toArray();
			if($transaction)
			{
				$trns['name'] = $transaction[0]->name;
				$trns['job_title'] = $transaction[0]->job_title;
				foreach ($transaction as $ts) {
					$cl_in_bid[] = $ts->bid_amount;
					$cl_in_pay[] = $ts->bid_amount - $ts->pay_amount;
				}
				$trns['bid_amount'] = array_sum($cl_in_bid);
				$trns['seed_fees'] = array_sum($cl_in_pay);
				$earning_client[] = $trns;
			}			
		}
		try {
             return Excel::create('Earning BY CLIENT '.date('Y-m-d'), function($excel) use ($earning_client) {
                     $excel->sheet('sheet 1', function($sheet) use ($earning_client)
                     {
                          $sheet->fromArray($earning_client);
                     });
                })->download('xls');
          }
          catch(Exception $e) {
            if (getenv('APP_ENV') !== 'testing') {
               throw $e;
            }
          }
	}
	public function transaction_csv($from_date = '', $to_date = '')
	{
		if(empty($from_date))
		{
			$from_date = date('Y-m-d', strtotime('-30 days'));
		}
		if(empty($to_date))
		{
			$to_date = date('Y-m-d');
		}
		$user_id = Session::get('login_id');
		$transaction = DB::table('wallet_transaction')
								->join('proposals','proposals.proposal_id','=','wallet_transaction.proposal_id')
								->join('jobs','jobs.job_id','=','proposals.job_id')
								->join('users','users.user_id','=','jobs.user_id')
								->where('wallet_transaction.user_id',$user_id)
								->whereBetween('wallet_transaction.transaction_datetime',[$from_date, $to_date])
								->select('wallet_transaction.*','users.name as client_name','jobs.job_title','proposals.bid_amount','proposals.pay_amount')
								->get()
								->toArray();
		$total_trans = [];
		foreach ($transaction as $trs) {
			$total_trans[] = (array)$trs;
		}
		try {
             return Excel::create('Transaction History '.date('Y-m-d'), function($excel) use ($total_trans) {
                     $excel->sheet('sheet 1', function($sheet) use ($total_trans)
                     {
                          $sheet->fromArray($total_trans);
                     });
                })->download('xls');
          }
          catch(Exception $e) {
            if (getenv('APP_ENV') !== 'testing') {
               throw $e;
            }
          }
	}
	public function fr_earning(){
        $user_id=Session::get('login_id');
        $job=DB::table('job_completed')->join('jobs','jobs.job_id','=','job_completed.job_id')
            ->join('invoices','job_completed.job_id','=','invoices.job_id')
            ->where('job_completed.user_id',$user_id)
            ->where('jobs.progress',3)
            ->select('jobs.job_title as job_title','jobs.job_type as job_type','jobs.job_description as job_description','invoices.*')
            ->get()->toarray();
        $jobs=[];
        foreach ($job as $j){
            $client=DB::table('users')->where('user_id',$j->client_id)->value('user_nicename');
            $j->client_name=$client;
            $jobs[]=$j;
        }
	    return view('report.fr_earning_report',compact('jobs'));
    }
    public function fr_report(){
        $user_id=Session::get('login_id');
        $progress=DB::table('jobs')->join('proposals','jobs.job_id','=','proposals.job_id')
            //->join('invoices','proposals.proposal_id','=','invoices.proposal_id')
            ->where('proposals.contracted',1)
            ->where('jobs.progress',1)
            ->where('jobs.is_open',0)
            //->where('invoices.is_claim',0)
            ->where('proposals.user_id',$user_id)
            ->select('proposals.pay_amount as pay_amount','proposals.pay_amount as amount','jobs.*','jobs.user_id as client_id')
            ->get()->toarray();
        $progress_amount_sum=DB::table('jobs')->join('proposals','jobs.job_id','=','proposals.job_id')
            ->join('invoices','proposals.proposal_id','=','invoices.proposal_id')
            ->where('proposals.contracted',1)
            ->where('jobs.progress',1)
            ->where('jobs.is_open',0)
            ->where('invoices.is_claim',0)
            ->where('jobs.job_time_type','!=','hourly')
            ->where('invoices.freelancer_id',$user_id)
            ->sum('invoices.amount');
//        $progress_amount_sum1=DB::table('jobs')->join('proposals','jobs.job_id','=','proposals.job_id')
//            ->join('invoices','proposals.proposal_id','=','invoices.proposal_id')
//            ->where('proposals.contracted',1)
//            ->where('jobs.progress',1)
//            ->where('jobs.is_open',0)
//            ->where('invoices.is_claim',0)
//            ->where('jobs.job_time_type','hourly')
//            ->where('invoices.freelancer_id',$user_id)
//            ->sum('invoices.amount');


       $progress_amount=[];
       foreach ($progress as $p){
           $p->client_name=DB::table('users')->where('user_id',$p->client_id)->value('user_nicename');
           $progress_amount[]=$p;
       }
        $review=DB::table('jobs')->join('proposals','jobs.job_id','=','proposals.job_id')
            ->join('invoices','proposals.proposal_id','=','invoices.proposal_id')
            ->where('proposals.contracted',1)
            ->where('jobs.progress',2)
            ->where('jobs.is_open',0)
            ->where('jobs.job_time_type','fixed')
            ->where('jobs.job_completed',0)
            ->where('invoices.freelancer_id',$user_id)
            ->get()->toarray();
        $review_amount_sum=DB::table('jobs')->join('proposals','jobs.job_id','=','proposals.job_id')
            ->join('invoices','proposals.proposal_id','=','invoices.proposal_id')
            ->where('proposals.contracted',1)
            ->where('jobs.progress',2)
            ->where('jobs.job_time_type','fixed')
            ->where('jobs.is_open',0)
            ->where('jobs.job_completed',0)
            ->where('invoices.freelancer_id',$user_id)
            ->sum('invoices.amount');
        $review_amount=[];
        foreach ($review as $p){
            $p->client_name=DB::table('users')->where('user_id',$p->client_id)->value('user_nicename');
            $review_amount[]=$p;
        }
        $pending_amount_sum=DB::table('jobs')->join('proposals','jobs.job_id','=','proposals.job_id')
            ->join('invoices','proposals.proposal_id','=','invoices.proposal_id')
            ->join('job_completed','invoices.job_id','=','job_completed.job_id')
            ->where('proposals.contracted',-1)
            ->where('jobs.is_open',0)
            ->where('jobs.progress',3)
            ->where('jobs.job_time_type','fixed')
            ->where('invoices.payfort_key','!=',false)
            ->where('jobs.job_completed',1)
            ->where('job_completed.created_at', '>', Carbon::now()->subDays(5)->toDateTimeString())
            ->where('job_completed.user_id',$user_id)
            ->sum('invoices.amount');
        $pending_a=DB::table('hours_requests')->join('invoices','hours_requests.proposal_id','=','invoices.proposal_id')
            ->join('jobs','invoices.job_id','=','jobs.job_id')
            ->where('hours_requests.is_accept',1)
            ->where('invoices.payfort_key','!=',false)
            ->where('invoices.freelancer_id',$user_id)
            ->where('jobs.job_time_type','hourly')
            ->where('hours_requests.created_at', '>', Carbon::now()->subDays(5)->toDateTimeString())
            ->select('invoices.amount as payment')
            ->get()->toarray();
        $amount_array=[];
        if (sizeof($pending_a)>0){
            foreach ($pending_a as $pro){
                $amount_array[]=$pro->payment;
            }
            $pending_amount_sum1=array_sum($amount_array);
        }
        else{
            $pending_amount_sum1=0;
        }
        $pending_amount_sum=$pending_amount_sum+$pending_amount_sum1;

        $pending=DB::table('jobs')->join('proposals','jobs.job_id','=','proposals.job_id')
            ->join('invoices','proposals.proposal_id','=','invoices.proposal_id')
            ->join('job_completed','invoices.job_id','=','job_completed.job_id')
            ->where('proposals.contracted',-1)
            ->where('jobs.is_open',0)
            ->where('jobs.progress',3)
            ->where('jobs.job_completed',1)
            ->where('job_completed.created_at', '>', Carbon::now()->subDays(5)->toDateTimeString())
            ->where('job_completed.user_id',$user_id)
            ->select('invoices.amount as pending_amount','jobs.job_title as job_title','proposals.proposal_id as proposal_id','invoices.client_id as client_id')
            ->get()->toarray();
        $pending_amount=[];
        foreach ($pending as $p){
            $p->client_name=DB::table('users')->where('user_id',$p->client_id)->value('user_nicename');
            $pending_amount[]=$p;
        }
        $availible=DB::table('jobs')->join('proposals','jobs.job_id','=','proposals.job_id')
            ->join('invoices','proposals.proposal_id','=','invoices.proposal_id')
            ->join('job_completed','invoices.proposal_id','=','job_completed.proposal_id')
            ->where('proposals.contracted',-1)
            ->where('jobs.is_open',0)
            ->where('job_completed.created_at', '<=', Carbon::now()->subDays(5)->toDateTimeString())
            ->where('jobs.job_completed',1)
            ->where('jobs.progress',3)
            ->where('invoices.freelancer_id',$user_id)
            ->select('invoices.amount as amount','jobs.job_title as job_title','proposals.proposal_id as proposal_id','invoices.client_id as client_id')
            ->get()->toarray();
        $availible_amount=[];
        foreach ($availible as $p){
            $p->client_name=DB::table('users')->where('user_id',$p->client_id)->value('user_nicename');
            $availible_amount[]=$p;
        }
        $bank_info=DB::table('fr_bank_info')->where('freelancer_id',$user_id)->first();
        $availible_amount_sum=DB::table('user_balance')->where('freelancer_id',$user_id)
          ->value(DB::raw("SUM(amount - credit)"));
	    return view('report.freelancer_report',compact('bank_info','review_amount','progress_amount','progress_amount_sum','review_amount_sum','pending_amount_sum','pending_amount','availible_amount','availible_amount_sum'));
    }
}
