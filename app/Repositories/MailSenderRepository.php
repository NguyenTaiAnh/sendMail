<?php
namespace App\Repositories;

interface MailSenderRepository extends BaseRepository
{
    public function createMailSender($request);
}
