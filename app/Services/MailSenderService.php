<?php
namespace App\Services;

use App\Repositories\MailSenderRepository;

class MailSenderService
{
    /**
     * @var MailSenderRepository
     */
    private $mailSenderRepository;
    public function __construct(MailSenderRepository $mailSenderRepository)
    {
//        $this->middleware('auth:api', ['except' => ['index','increaseViews','detail']]);
        $this->mailSenderRepository = $mailSenderRepository;
    }

    public function sendMail(){

    }

}
