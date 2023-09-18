<?php

namespace App\Jobs;

use App\Models\Email;
use App\Models\MailSenders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailTryAgain implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $getAllMail = Email::where('status', 0)->get();

        foreach ($getAllMail as $mail){
//            $addMailSender = new MailSenders();
//            $addMailSender->id_user = $mail->id_user;
//            $addMailSender->id_content = $this->contentMail->id;
//            $addMailSender->id_mail= $mail->id;
//            $addMailSender->save();
            try {
                Mail::send('mailfb', array('content'=> "test"), function($message) use ($mail){
//                    $mail = str_replace(' ', '', $mail->email);
//                    dump($mail);
                    $message->to($mail->email)->subject('This is test e-mail');
                    Email::where('email',trim($mail->email))->update(['status'=>'1']);
                });
            }catch (\Exception $e) {
                dump($e->getMessage());
                dd(1);
                Log::debug("Mail sent error ". $e->getMessage());
            }

        }
    }
}
