<?php

namespace App\Jobs;

use App\Models\Email;
use App\Models\ImportEmail;
use App\Models\MailSenders;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;
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

        $pass = Str::random(8);
//        $pass = Hash::make(Str::random(8));
        $getAllMail = Email::where('status', 0)->get();
        User::firstOrCreate(['name' => $getAllMail[0]->id_user], [
            'name' => $getAllMail[0]->id_user,
            'email' => $getAllMail[0]->id_user.'@ant.com',
            'password' => bcrypt($pass),
            'password_user'=> $pass,
            'is_admin'  => false
        ]);
        User::create([
            'name' => $getAllMail[0]->id_user,
            'email' => $getAllMail[0]->id_user.'@ant.com',
            'password' => Hash::make($pass),
            'password_user'=> $pass,
            'is_admin'  => false
        ]);
        Email::where('status', 0)->chunkById(2, function ($mails) {
            foreach ($mails as $mail) {
                Log::info("Begin sending mail: " .$mail);
                $addMailSender = new MailSenders();
                $addMailSender->id_user = $mail->id_user;
                $addMailSender->id_content = $this->contentMail->id;
                $addMailSender->id_mail = $mail->id;
                $addMailSender->save();

                try {
                    $mailSender = str_replace("\u{A0}", '', $mail->email);
                    Log::info("sending mail");
                    $validator = new EmailValidator();
                    $multipleValidations = new MultipleValidationWithAnd([
                        new RFCValidation(),
                        new DNSCheckValidation()
                    ]);
                    $subject = $this->contentMail->subject;

                    $checkMail = $validator->isValid($mailSender, $multipleValidations);

                    if ($checkMail) {
                        Mail::send('mailfb', array('content' => $this->contentMail->content, 'id_mail' => $mail->id), function ($message) use ($mailSender, $mail, $subject) {
                            $message->to($mailSender)->subject($subject);
                            Log::info("Send mail success: " . $mailSender);
                            Email::where('id', $mail->id)->update(['status' => Email::SUCCESS]);
                        });
                    } else {
                        Log::info("Send mail FAILED: " . $mailSender);
                        Email::where('id', $mail->id)->update(['status' => Email::FAILED, 'note' => 'email not exists']);
                    }
                } catch (\Exception $e) {
                    Log::debug("Send mail FAILED: " . $e->getMessage());
                    Log::info("Send mail ERROR: " . $mailSender);
                    Email::where('id', $mail->id)->update(['status' => Email::ERROR, 'note' => $e->getMessage()]);
                }
            }
        },'id');

    }
}
