<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    const SUCCESS = '1';
    const WAITING = '0';
    const FAILED = '2';
    const ERROR = '3';



    use HasFactory;
    protected $table="emails";
    protected $fillable= ['email','id_user','status'];

}
