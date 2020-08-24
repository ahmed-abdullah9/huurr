<?php

require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer//src/SMTP.php';
require './vendor/phpmailer/phpmailer//src/Exception.php';


 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

 use Intervention\Image\Facades\Image;
 use App\AdminPortfolio;
 use Illuminate\Support\Facades\DB;
 function send_mail($from,$to,$name=false,$subject=false,$contents=false,$attachment=false){

     $mail = new PHPMailer(true);
     try{

         //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
         $mail->isSMTP();
         $mail->Host = "mail.huurr.com";
         $mail->SMTPAuth   = true;
         $mail->Port =25 ; //26,143 or 587
         $mail->IsHTML(true);
         $mail->Username = "noreply@huurr.com";
         $mail->Password = "Y&dFq&8)@*D@";
         $mail->SetFrom("noreply@huurr.com");
         $mail->Subject = $subject;
         $mail->Body = $contents;
         $mail->AddAddress($to);
         if (!empty($attachment)){
             $mail->AddAttachment($attachment->getPathName(),
                 $attachment->getClientOriginalName());
         }
         $mail->send();
         //$mail->send();
     }
     catch (Exception $e) {
         echo $e->getMessage(); //Boring error messages from anything else!
     }


 }
 function vat(){
     return DB::table('admin_option')->value('vat');
 }
 function jobFee(){
     return DB::table('admin_option')->value('job_fee');
 }
 function findJobFee($job_id){
    return DB::table('jobs')->where('job_id',$job_id)->value('job_fee');
 }
 
 function send()
 {
          $mail = new PHPMailer;
    //   $mail->IsSMTP(); // enable SMTP
    //     $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    //     $mail->SMTPAuth = true; // authentication enabled
    //     $mail->SMTPSecure = 'tls'; // tls secure transfer enabled REQUIRED for Gmail
        $mail->Host = "huurr.com";
        $mail->Port = 587; // or 587
        $mail->IsHTML(true);
        $mail->Username = "info@huurr.com";
        $mail->Password = "farhanahmad786";
        $mail->SetFrom("noreply@huurr.com");
        $mail->Subject = "Test";
        $mail->Body = "hello from my test ";
        $mail->AddAddress("mfarhanriaz14@gmail.com");
        $mail->send();
     
 }
 function portfolioLimit($skill,$demension){
              $count=AdminPortfolio::where(['skill'=>$skill,'demension'=>$demension])->count();
             if ($demension==0){
                 if ($count>1){
                     return false;
                 }
                 else{
                     return true;
                 }
             }
            else
                if ($demension==1){
                    if ($count>2){
                        return false;
                    }
                    else{
                        return true;
                    }
                }


 }
 function  jobCategory($id){
     return DB::table('categorie')->where('id',$id)->first();
 }

?>