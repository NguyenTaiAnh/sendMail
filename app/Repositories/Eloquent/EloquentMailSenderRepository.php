<?php

namespace App\Repositories\Eloquent;

use App\Models\Email;
use App\Models\ImportEmail;
use App\Models\MailContent;
use App\Models\MailSenders;
use App\Repositories\MailSenderRepository;
use Maatwebsite\Excel\Facades\Excel;

class EloquentMailSenderRepository  extends EloquentBaseRepository implements MailSenderRepository
{

    public function createMailSender($request)
    {
        // TODO: Implement createMailSender() method.
        $addContentMail = new MailContent();
        $addContentMail->content = $request['content'];
        if($request->hasFile('filepath')){
            Excel::import(new ImportEmail(), $request->file('filepath'));
            $file = $request->file('filepath');
            $name = time().'.'.$file->getClientOriginalExtension();
            // Thư mục upload
            $path =public_path() . '/assets/files';
            // Bắt đầu chuyển file vào thư mục
            $file->move($path,$name);
            $addContentMail->filepath =$name;
        }
        $addContentMail->save();

        $getAllMail = Email::all();

        foreach ($getAllMail as $mail){
            dump($mail);
            $addMailSender = new MailSenders();
            $addMailSender->id_content = $addContentMail->id;
            $addMailSender->id_mail= $mail->id;
            $addMailSender->save();
        }
    }
}
