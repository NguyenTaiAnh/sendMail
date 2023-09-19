<?php

namespace App\Repositories\Eloquent;

use App\Models\Email;
use App\Models\ImportEmail;
use App\Models\MailContent;
use App\Models\MailSenders;
use App\Repositories\EmailsRepository;
use App\Repositories\MailSenderRepository;
use Maatwebsite\Excel\Facades\Excel;

class EloquentEmailsRepository extends EloquentBaseRepository implements EmailsRepository
{
    public function getEmails()
    {
        // TODO: Implement getEmails() method.
        return $this->model->select('*');
    }

    public function updateData($id, $data)
    {
        // TODO: Implement updateData() method.
        $email = $this->model->find($id);
        return $email ? $email->update($data) : FALSE;
    }
}
