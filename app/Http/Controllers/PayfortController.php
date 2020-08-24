<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Job;
use App\Proposals;
use Carbon\Carbon;
use App\Category;
use App\MessageModel as message;
use View;
use PDF;
use Illuminate\Support\Facades\Crypt;
use Session, DB;
class PayfortController extends Controller
{
	public $gatewayHost        = 'https://checkout.payfort.com/';
    public $gatewaySandboxHost = 'https://sbcheckout.payfort.com/';
    public $language           = 'en';
    public $merchantIdentifier = 'hnGjbGHJ';
    public $accessCode         = 'X6zK3ft6rriFRbpJAxDS';
    public $SHARequestPhrase   = 'TESTSHAIN';
    public $SHAResponsePhrase 	= 'TESTSHAOUT';
    public $SHAType       		= 'sha256';
    public $command       		= 'AUTHORIZATION';
    public $currency           = 'SAR';
    public $sandboxMode        = true;
    public function verifyCheckout($proposal_id="",$user_id="")
    {
        $owner_id = Session::get('login_id');
        if(empty($proposal_id) || empty($user_id))
        {
            return redirect('/clmy-job');
        }
        $proposals = \DB::table('proposals')->where('proposal_id', $proposal_id)->where('user_id', $user_id)->first(); 
        if(empty($proposals))
        {
            return redirect('/clmy-job');
        }
        $jobs = \DB::table('jobs')->where('job_id', $proposals->job_id)->first();
        if ($jobs->job_time_type=='hourly'){
            $hours=DB::table('hours_requests')->where('job_id',$proposals->job_id)
                ->where('proposal_id',$proposal_id)->where('is_accept',0)->first();
        }
        else{
            $hours='if_not';
        }
        $client = DB::table('users')->where('user_id',$owner_id)->select('*')->first();
        $user = DB::table('users')->where('user_id',$user_id)->select('*')->first();
        if ($jobs->job_time_type=='fixed'){
            $payfort = DB::table('payfort_response')->where('status',02 )->where('user_id',$owner_id)->where('freelancer_id',$user_id)->where('proposal_id',$proposal_id)->select('amount')->get()->toArray();
        }
        else{
            $payfort=['amount'=>0];
        };
        $vat=DB::table('admin_option')->value('vat');
        return view('payfort.varifycheckout',compact(['proposals','hours','jobs','client','user','payfort','vat']));
        
    }
    public function returnRedirectUrl(Request $request, $key)
    {
        $owner_id = Session::get('login_id');
        $key =  Crypt::decrypt($key);
        if(empty($key))
        {
            return redirect('/clmy-job');
        }
        $proposal_id = $key;
        $proposal = [];
        // $proposal['bid_amount'] = $request->input('bid_amount');
        // $proposal['pay_amount'] = $request->input('pay_amount');
        // $proposal['invitation_interview'] = 1;
        // $proposal['accept_interview'] = 1;
        // $proposal['offers'] = 1;
        // DB::table('proposals')->where('proposal_id',$proposal_id)->update($proposal);
        // $proposal_id = $request->input("proposal_id");
        $proposals = \DB::table('proposals')->where('proposal_id', $proposal_id)->first(); 
        if(empty($proposals))
        {
            return redirect('/clmy-job');
        }
        $jobs = \DB::table('jobs')->where('job_id', $proposals->job_id)->first();
        if (!empty($request->input('hours'))){
            session('hours',$request->input('hours'));
        }
        $client = DB::table('users')->where('user_id',$owner_id)->select('*')->first();

    	$paymentMethod = 'creditcard';
    	$merchantReference = $this->generateMerchantReference();
    	$postData = array(
            'amount'              => ($request->input('pay_amount')*100),
            'currency'            => strtoupper($this->currency),
            'merchant_identifier' => $this->merchantIdentifier,
            'access_code'         => $this->accessCode,
            'merchant_reference'  => $merchantReference.'-'.$proposal_id.'-'.$jobs->job_id.'-'.$owner_id.'-'.$proposals->user_id.'-'.$request->input('bid_amount'),
            'customer_email'      => $client->email,
            'customer_name'       => $client->name,
            'command'             => $this->command,
            'language'            => $this->language,
            'return_url'          => url('/').'/pay/freelancer/success',
        );

        if ($paymentMethod == 'sadad') {
            $postData['payment_option'] = 'SADAD';
        }
        elseif ($paymentMethod == 'naps') {
            $postData['payment_option']    = 'NAPS';
            $postData['order_description'] = $jobs->job_title;
        }
        elseif ($paymentMethod == 'installments') {
            $postData['installments']    = 'STANDALONE';
            $postData['command']         = 'PURCHASE';
        }
        $postData['signature'] = $this->calculateSignature($postData, 'request');
        $redirectUrl = self::getApiUrl();
		echo "<html xmlns='http://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
		echo "<form action='".$redirectUrl."' method='post' name='frm'>\n";
		foreach ($postData as $a => $b) {
		    echo "\t<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>\n";
		}
		echo "\t<script type='text/javascript'>\n";
		echo "\t\tdocument.frm.submit();\n";
		echo "\t</script>\n";
		echo "</form>\n</body>\n</html>";
    }
    public function getApiUrl()
    {
    	if ($this->sandboxMode) {
            $gatewayUrl = $this->gatewaySandboxHost . 'FortAPI/paymentPage';
        }
        else {
            $gatewayUrl = $this->gatewayHost . 'FortAPI/paymentPage';
        }
        return $gatewayUrl;
    }
    public function calculateSignature($arrData, $signType = 'request')
    {
        $shaString             = '';
        ksort($arrData);
        foreach ($arrData as $k => $v) {
            $shaString .= "$k=$v";
        }

        if ($signType == 'request') {
            $shaString = $this->SHARequestPhrase . $shaString . $this->SHARequestPhrase;
        }
        else {
            $shaString = $this->SHAResponsePhrase . $shaString . $this->SHAResponsePhrase;
        }
        $signature = hash($this->SHAType, $shaString);

        return $signature;
    }
    public function generateMerchantReference()
    {
        return rand(time(),mt_getrandmax());
    }
    public function returnResponsePayfort(Request $request)
    {
        date_default_timezone_set('Asia/Riyadh');
    	$newrequest = $request->all();

        $amount = $newrequest['amount'] = ($newrequest['amount']/100);
    	if($newrequest['status']==02)
    	{
            $merchant_reference = explode('-',$newrequest['merchant_reference']);
    		$newrequest['user_id'] = $merchant_reference[3];
    		$newrequest['job_id'] = $merchant_reference[2];
    		$newrequest['proposal_id'] = $merchant_reference[1];
            $newrequest['merchant_reference'] = $merchant_reference[0];
            $newrequest['freelancer_id'] = $merchant_reference[4];
            $job_bid_amount=$merchant_reference[5];
    		if(!empty(DB::table('payfort_response')->where('fort_id',$newrequest['fort_id'])->where('merchant_reference',$newrequest['merchant_reference'])->first()))
    			{
    				DB::table('payfort_response')->where('fort_id',$newrequest['fort_id'])->where('merchant_reference',$newrequest['merchant_reference'])->update($newrequest);
    			}else
    			{
	    			DB::table('payfort_response')->insert($newrequest);
	    		}
                    
                    if(empty(DB::table('wallet_credit')->where('user_id',$newrequest['freelancer_id'])->first()))
                    {
                        DB::table('wallet_credit')->insert(['user_id'=>$newrequest['freelancer_id'],'credit'=>0]);
                    }

                    $user_account = DB::table('wallet_credit')->select('*')->where('user_id',$newrequest['freelancer_id'] )->first();
                    $transaction_before = (isset($user_account->credit)?$user_account->credit:0);
                    $transaction_after = $transaction_before+$amount;
                    $insert_transaction = [];
                    $insert_transaction['user_id']              = $newrequest['freelancer_id'];
                    $insert_transaction['wallet_id']            = $user_account->wallet_id;
                    $insert_transaction['proposal_id']          = $newrequest['proposal_id'];
                    $insert_transaction['transaction_before']   = $transaction_before;
                    $insert_transaction['transaction_after']    = $transaction_after;
                    $insert_transaction['transaction_type']     = 'project payment received';
                    $insert_transaction['transaction_amount']   = $amount;
                    $insert_transaction['transaction_datetime'] = date('Y-m-d');
                    $insert_transaction['transaction_year']     = date('Y');
                    $insert_transaction['transaction_month']    = date('m');
                    $insert_transaction['transaction_credit']   = $amount;
                    DB::table('wallet_transaction')->insertGetId($insert_transaction);
                    DB::table('wallet_credit')->where('user_id',$newrequest['freelancer_id'])->update(['credit'=>$transaction_after]);
                    $payfort = DB::table('payfort_response')->where('merchant_reference',$newrequest['merchant_reference'])->select('*')->first();
                        $freelancer=DB::table('users')->where('user_id',$newrequest['freelancer_id'])->select('email','name')->first();
                    $client = DB::table('users')->where('user_id',$payfort->user_id)->select('*')->first();
                    $link=url('/').'/fr_earning/report';
                    $url = "<a href=".$link.">Cheers Hero,<br>
                    $client->name just sent you an offer, let's give him more than his expectation Hero :)</a>";
                 
                    $message="$url";
                    DB::table('notifications')->insert([
                                            'notification_type' => 'offer',
                                            'sender_id' => $newrequest['user_id'],
                                            'receiver_id' => $newrequest['freelancer_id'],//put your freelancer id
                                            'message' => $message,
                ]);
                $hourlJobcheck=DB::table("jobs")->where('job_id',$newrequest['job_id'])->first();
                if ($hourlJobcheck->job_time_type=="hourly"){
                    $hours=session('hours');
                    $link=url('/').'/fr_earning/report';
                    $url = "<a href=".$link.">Cheers Hero,<br>
                    Your ( Requested hours) working hours accepted from the client on job $hourlJobcheck->job_title and the money has been saved in your pocket.</a>";
                    $message="$url";
                    DB::table('notifications')->insert([
                        'notification_type' => 'offer',
                        'sender_id' => $newrequest['user_id'],
                        'receiver_id' => $newrequest['freelancer_id'], //put your freelancer id  
                        'message' =>$message ,
                    ]);
                }
             $check=$newrequest['fort_id'];
//                 DB::table('invoices')->where('proposal_id',$newrequest['proposal_id'])
//                 ->where('job_id',$newrequest['job_id'])
//                 ->where('freelancer_id',$newrequest['freelancer_id'])
//                 ->where('client_id',$newrequest['user_id'])
//                 ->first();

                if (!empty($newrequest['fort_id'])){
                    $job_fee=DB::table('jobs')->where('job_id',$newrequest['job_id'])->value('job_fee');
                    $client_pay_fr=$job_bid_amount-$job_bid_amount*$job_fee/100;
                    $vatFee=$job_bid_amount*vat()/100;
                    $client_pay_to_admin=$job_bid_amount+$vatFee;
                    DB::table('invoices')->insert(['proposal_id'=>$newrequest['proposal_id'],'job_id'=>$newrequest['job_id'],'freelancer_id'=>$newrequest['freelancer_id'],'client_id'=>$newrequest['user_id'],'amount'=>$client_pay_fr,'job_bid_amount'=>$job_bid_amount,'client_pay_to_admin'=>$client_pay_to_admin,'payfort_key'=>$newrequest['fort_id'],'vat_fee'=>$vatFee]);
                    $invoice_id=DB::getPdo()->lastInsertId();
                    $key_value=DB::table('invoices')->where('id',$invoice_id)->value('payfort_key');
                    if ($key_value!='false'){
                        // DB::table('hired_freelancer')->where('proposal_id',$newrequest['proposal_id'])->update(['status'=>1]);
                        // DB::table('jobs')->where('job_id',$newrequest['job_id'])->update(['progress'=>1]);
                        // DB::table('proposals')->where('proposal_id',$newrequest['proposal_id'])->update(['contracted'=>1]);
                        // DB::table('hours_requests')->where(['freelancer_id'=>$newrequest['freelancer_id'],'client_id'=>$newrequest['user_id'],'proposal_id'=>$newrequest['proposal_id']])
                        //     ->update(['is_accept'=>1]);
                    }
                }
//                else{
//                    DB::table('invoices')
//                        ->where('proposal_id',$newrequest['proposal_id'])
//                        ->where('job_id',$newrequest['job_id'])
//                        ->where('freelancer_id',$newrequest['freelancer_id'])
//                        ->where('client_id',$newrequest['user_id'])
//                        ->update(['payfort_key'=>$newrequest['fort_id']]);
//                    DB::table('hired_freelancer')->where('proposal_id',$newrequest['proposal_id'])->update(['status'=>1]);
//                    DB::table('jobs')->where('job_id',$newrequest['job_id'])->update(['progress'=>1]);
//                    DB::table('proposals')->where('proposal_id',$newrequest['proposal_id'])->update(['contracted'=>1]);
//                }
                //make communcation
            $client_id = Session::get('login_id');
            $freelancer_id=$newrequest['freelancer_id'];
            if(!empty($converstaion_id=DB::table('conversation')->where('client_id',$client_id)->where('freelancer_id',$freelancer_id)->value('conversation_id')))
            {
                DB::table('message')->insert(['conversation_id'=>$converstaion_id,'sender_id'=>$client_id,'receive_id'=>$freelancer_id,'message_contents'=>'you have new offer']);
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
                DB::table('message')->insert(['conversation_id'=>$conv_id,'sender_id'=>$client_id,'receive_id'=>$freelancer_id,'message_contents'=>'you have new offer']);
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
    		    return redirect('clmy/job/'.Crypt::encrypt($newrequest['job_id']).'?tab=active');
    	}else
    	{
            $merchant_reference = explode('-',$newrequest['merchant_reference']);
            $newrequest['user_id'] = $merchant_reference[3];
            $newrequest['job_id'] = $merchant_reference[2];
            $newrequest['proposal_id'] = $merchant_reference[1];
            $newrequest['merchant_reference'] = $merchant_reference[0];
            $newrequest['freelancer_id'] = $merchant_reference[4];
            $newrequest['fort_id'] = (isset($newrequest['fort_id'])?$newrequest['fort_id']:0);
            if(!empty(DB::table('payfort_response')->where('fort_id',$newrequest['fort_id'])->where('merchant_reference',$newrequest['merchant_reference'])->first()))
                {
                    DB::table('payfort_response')->where('fort_id',$newrequest['fort_id'])->where('merchant_reference',$newrequest['merchant_reference'])->update($newrequest);
                }else
                {
                    DB::table('payfort_response')->insert($newrequest);
                }
                $message = 'Your transaction is failed of amount {'.$amount.'}. Please Complete payment to pay freelnacer'; 
                DB::table('notifications')->insert([
                                            'notification_type' => 'payamount',
                                            'sender_id' => 0,
                                            'receiver_id' => $newrequest['user_id'],
                                            'message' => $message,
                                            ]);
                $payfort = DB::table('payfort_response')->where('fort_id',$newrequest['fort_id'])->where('merchant_reference',$newrequest['merchant_reference'])->select('payfort_id')->first();
    		return redirect('/payfort/cancel/'.$payfort->payfort_id);
    	}
    }
    public function payfortSuccess($payfort_id='')
    {
    	$payfort = DB::table('payfort_response')->where('payfort_id',$payfort_id)->select('*')->first();
        if(empty($payfort))
        {
            return redirect('/clmy-job');
        }
        $proposals = \DB::table('proposals')->where('proposal_id', $payfort->proposal_id)->first();
        $jobs = \DB::table('jobs')->where('job_id', $proposals->job_id)->first();
        $client = DB::table('users')->where('user_id',$payfort->user_id)->select('*')->first();
        $user = DB::table('users')->where('user_id',$payfort->freelancer_id)->select('*')->first();
       
        return view('payfort.thankyousuccess',compact(['proposals','jobs','client','user']));
    }
    public function payfortCancel($payfort_id='')
    {
        $payfort = DB::table('payfort_response')->where('payfort_id',$payfort_id)->select('*')->first();
        if(empty($payfort))
        {
            return redirect('/clmy-job');
        }
        $proposals = \DB::table('proposals')->where('proposal_id', $payfort->proposal_id)->first(); 
        
        $jobs = \DB::table('jobs')->where('job_id', $proposals->job_id)->first();
        $client = DB::table('users')->where('user_id',$payfort->user_id)->select('*')->first();
        $user = DB::table('users')->where('user_id',$payfort->freelancer_id)->select('*')->first();
        return view('payfort.thankyoucancel',compact(['proposals','jobs','client','user']));
    }
    public function paynow_fr(Request $request){
        print_r($request->all());
        exit;
    }
    public function withDrawRequest(){
        $user_id = Session::get('login_id');
        if(empty($bank_info=DB::table('fr_bank_info')->where('freelancer_id',$user_id)->first())){
            return redirect('fr/bank_info');
        }
        else{
            $availible_amount_sum=DB::table('user_balance')->where('freelancer_id',$user_id)
                ->value(DB::raw("SUM(amount - credit)"));
            return view('freelancer.withdraw_amount',['fr_bank_info'=>$bank_info,'amount'=>$availible_amount_sum]);
        }
    }
    public function payment_request(Request $request){
        $user_id = Session::get('login_id');
        $req_amount=decrypt($request->input('amount'));
        $fr_bank_info=decrypt($request->input('fr_bank_info_id'));
        $availible_amount_sum=DB::table('user_balance')->where('freelancer_id',$user_id)
            ->value(DB::raw("SUM(amount - credit)"));
        if ($availible_amount_sum>=$req_amount){
           $credit=DB::table('user_balance')->where('freelancer_id',$user_id)
               ->value('credit');
           $credit=$credit+$req_amount;
            DB::table('user_balance')->where('freelancer_id',$user_id)
                ->update(['credit'=>$credit]);
            $data=[
                'freelancer_id'=>$user_id,
                'fr_bank_info'=>$fr_bank_info,
                'amount_request'=>$req_amount
            ];
            DB::table('with_drawrequests')->insert($data);
            return redirect('fr_earning/report');
        }
        else{
            return redirect()->back();
        }

    }
    public function crownjob(){
        $availible=DB::table('jobs')->join('proposals','jobs.job_id','=','proposals.job_id')
            ->join('invoices','proposals.proposal_id','=','invoices.proposal_id')
            ->join('job_completed','invoices.proposal_id','=','job_completed.proposal_id')
            ->where('proposals.contracted',-1)
            ->where('jobs.is_open',0)
            ->where('invoices.payfort_key','!=',false)
            ->where('job_completed.created_at', '<=', Carbon::now()->subDays(5)->toDateTimeString())
            ->where('jobs.job_completed',1)
            ->where('jobs.progress',3)
            ->get()->toarray();
        foreach ($availible as $p){
         if (empty($amount=DB::table('user_balance')->where('freelancer_id',$p->freelancer_id)->first())){
             $data=['freelancer_id'=>$p->freelancer_id,'amount'=>$p->amount];
             DB::table('user_balance')->insert($data);
         }
        else{
             $amounts=DB::table('invoices')->where('freelancer_id',$p->freelancer_id)->sum('amount');
            DB::table('user_balance')->where('freelancer_id',$p->freelancer_id)
                ->update(['amount'=>$amounts]);
            }
        }

    }
    public function download_receipent($id,$type=''){
        $role=session('user_role');
        if(!empty($type)){
            $role = $type;
        }
        $invoiceId=decrypt($id);
        if(!empty($invoice=DB::table('invoices')->where('id',$invoiceId)->first())){
            $freelancer=DB::table('users')->where('user_id',$invoice->freelancer_id)->first();
            $client=DB::table('users')->where('user_id',$invoice->client_id)->first();
            $job=DB::table('jobs')->where('job_id',$invoice->job_id)->first();
            if($role=="freelancer"){
                return view('templete.users.fr_invoice',compact('role','freelancer','client','job','invoice'));
            }
            elseif($role=="client"){
                return view('templete.users.cl_invoice',compact('role','freelancer','client','job','invoice'));

            }
            else{
                return view('templete.users.invoice',compact('role','freelancer','client','job','invoice'));
            }
        }
        else{
            return redirect()->back();
        }

    }
    public function fr_withdraw_requests(){
        $fr_requests=DB::table('with_drawrequests')->where('is_paid',0)->get()->toarray();
        $request_info=[];
        foreach ($fr_requests as $f_r){
            $f_r->email=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('fr_email');
            $f_r->account_no=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('bank_account_no');
            $f_r->bank_name=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('bank_name');
            $f_r->bank_address=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('bank_address');
            $f_r->first_name=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('first_name');
            $f_r->last_name=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('last_name');
            $request_info[]=$f_r;
        }
       return view('admin.withdrawrequests',compact('request_info'));
    }
    public function fr_withdraw_money(){
        $fr_requests=DB::table('with_drawrequests')->where('is_paid',1)->get()->toarray();
        $request_info=[];
        foreach ($fr_requests as $f_r){
            $f_r->email=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('fr_email');
            $f_r->account_no=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('bank_account_no');
            $f_r->bank_name=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('bank_name');
            $f_r->bank_address=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('bank_address');
            $f_r->first_name=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('first_name');
            $f_r->last_name=DB::table('fr_bank_info')->where('id',$f_r->fr_bank_info)->value('last_name');
            $request_info[]=$f_r;
        }
        return view('admin.withdrawMoney',compact('request_info'));
    }
    public function amount_tr_fr($req_id){
        $req_id=decrypt($req_id);
        if(!empty($request_info=DB::table('with_drawrequests')->where('id',$req_id)->first())){
            $fr_bank_info=DB::table('fr_bank_info')->where('id',$request_info->fr_bank_info)->first();
            return view('admin.send_amount_form',compact('request_info','fr_bank_info'));
        }
       else{
            return redirect()->back();
       }
    }
    public function fr_amount_tansfer(Request $request){
        $req_id=decrypt($request->input('request_id'));
        $data=array();
        if(!empty($request_info=DB::table('with_drawrequests')->where('id',$req_id)->first())){
            $fr_bank_info=DB::table('fr_bank_info')->where('id',$request_info->fr_bank_info)->first();
            $freelancer_email=DB::table('users')->where('user_id',$request_info->freelancer_id)->value('email');
            if ($request->hasFile('bank_rec')){
                $image=$request->file('bank_rec');
                $name = time().$image->getClientOriginalName();
                $destinationPath = public_path('/images/bankReceipent');
                $image->move($destinationPath, $name);
                $data['bank_rec']=$name;
            }
            $data['is_paid']=1;
            DB::table('with_drawrequests')->where('id',$req_id)->update($data);
            send_mail('',$freelancer_email,'farhan','Bank transfer','this is only test',$request->file('bank_rec'));
            send_mail('',$fr_bank_info->fr_email,'farhan','Bank transfer','this is only test',$request->file('bank_rec'));
            return redirect('withdraw/requests')->with('info','Amount is Transffered Successfully');
        }
        else{
            return redirect()->back()->with('info','Sorry something is going wrong');
        }
    }
    public function fr_request_hours($job_id){
         $job_id=decrypt($job_id);
         if (!empty(DB::table('jobs')->where('job_id',$job_id)->where('progress',1)->first()))
         {
             return view('freelancer.hours_request_form',compact('job_id'));
         }
         else{
             return redirect()->back();
         }

    }
    public function post_fr_request_hours(Request $request){
    $info=DB::table('hired_freelancer')->where('job_id',$request->input('job_id'))->first();
        $data=[
      'client_id'=>$info->client_id,
            'freelancer_id'=>Session::get('login_id'),
            'proposal_id'=>$info->proposal_id,
            'job_id'=>$info->job_id,
            'request_from'=>$request->input('from'),
            'request_to'=>$request->input('to'),
            'hours'=>$request->input('hours')
    ];
        DB::table('hours_requests')->insert($data);
        $jobs=DB::table('jobs')->where('job_id',$info->job_id)->first();
        $jobTitle=$jobs->job_title;
        $hours=$request->input('hours');
        $link=url('/').'/cl/hours/req';
        $url = "<a href=".$link.">Hi Client,<br>
        Your freelancer ask send you request for $hours hours on job $jobTitle for approval, your action is needed :)</a>";
        $message="$url";
        DB::table('notifications')->insert([
            'notification_type' => 'payamount',
            'sender_id' => Session::get('login_id'),
            'receiver_id' =>$info->client_id,
            'message' => $message,
        ]);
        return redirect('proposals');
    }
}
