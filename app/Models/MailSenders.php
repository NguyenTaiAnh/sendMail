<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailSenders extends Model
{
    use HasFactory;

    protected $table = "mail_senders";
    protected $fillable = [
        "id_user",
        "id_content",
        "id_mail",
        "status"
    ];
}
