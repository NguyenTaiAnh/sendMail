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
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

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
        $getAllMail = Email::all();

        foreach ($getAllMail as $mail){
            $addMailSender = new MailSenders();
            $addMailSender->id_user = $mail->id_user;
            $addMailSender->id_content = $this->contentMail->id;
            $addMailSender->id_mail= $mail->id;
            $addMailSender->save();
            Mail::send('mailfb', array('content'=> $this->contentMail->content), function($message) use ($mail){
                $message->to($mail->email)->subject('This is test e-mail');
            });


        }




    }
}
