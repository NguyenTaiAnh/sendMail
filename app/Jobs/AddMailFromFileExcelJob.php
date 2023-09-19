<?php

namespace App\Jobs;

use App\Models\Email;
use App\Models\ImportEmail;
use App\Models\MailSenders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

class AddMailFromFileExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $contentMail;
    public function __construct($contentMail)
    {
        //
        $this->contentMail = $contentMail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Excel::import(new ImportEmail(), public_path("assets/files/".$this->contentMail->filepath));
        //
        $getAllMail = Email::where('status', 0)->get();

        foreach ($getAllMail as $mail){
            $addMailSender = new MailSenders();
            $addMailSender->id_user = $mail->id_user;
            $addMailSender->id_content = $this->contentMail->id;
            $addMailSender->id_mail= $mail->id;
            $addMailSender->save();
            try {
                $mailSender = str_replace("\u{A0}", '', $mail->email);
                Mail::send('mailfb', array('content'=> $this->contentMail->content, 'id_mail'=> $mail->id), function($message) use ($mailSender,$mail){
                    try{
                        $key = env('API_KEY_HUNTER_EMAIL');
                        $response = Http::get("https://api.hunter.io/v2/email-verifier?email=$mailSender&api_key=$key");
                        $data = $response->json();

                        if(count($data) > 1){
                            if ( $data['data'] && $data['data']['status'] == 'valid') {
                                // Địa chỉ email hợp lệ, bạn có thể gửi email
                                // ...
//                                echo "Địa chỉ email hợp lệ, bạn có thể gửi email";
                                $message->to($mailSender)->subject('This is test e-mail');
                                Log::info("Send mail success: ". $mailSender);
                                Email::where('email',$mail->email)->update(['status'=>Email::SUCCESS]);
                            }
                        }else{
                            if ($data['errors'] && $data['errors'][0]['id'] == 'invalid_email'){
                                echo $data['errors'][0]['details'];
                                Log::info("Mail error  01". $data['errors'][0]['details']);
                                Email::where('email',$mail->email)->update(['status'=>Email::ERROR]);
                            }
                        }
                    }catch(\Exception $e){
                        Email::where('email',$mail->email)->update(['status'=>Email::FAILED]);
                        Log::debug("Mail sent error 1 ". $e->getMessage());
                    }

                });
            }catch (\Exception $e) {
                Email::where('email',$mail->email)->update(['status'=>Email::FAILED]);
                Log::debug("Mail sent error 2 ". $e->getMessage());
            }

        }
    }
}
