<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailContent extends Model
{
    use HasFactory;

    protected $table = "mail_contents";
    protected $fillable = ["filepath", "content", "subject"];

    public function mail_sender(): HasMany
    {
        return $this->hasMany(MailSenders::class);
    }
}
