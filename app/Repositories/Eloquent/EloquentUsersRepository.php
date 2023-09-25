<?php

namespace App\Repositories\Eloquent;

use App\Models\Email;
use App\Models\ImportEmail;
use App\Models\MailContent;
use App\Models\MailSenders;
use App\Repositories\EmailsRepository;
use App\Repositories\MailSenderRepository;
use App\Repositories\UsersRepository;
use Maatwebsite\Excel\Facades\Excel;

class EloquentUsersRepository extends EloquentBaseRepository implements UsersRepository
{
    public function getUsers()
    {
        // TODO: Implement getEmails() method.
        return $this->model->select('*')->where('is_admin', false);
    }

    public function updateData($id, $data)
    {
        // TODO: Implement updateData() method.
        $email = $this->model->find($id);
        return $email ? $email->update($data) : FALSE;
    }
}
