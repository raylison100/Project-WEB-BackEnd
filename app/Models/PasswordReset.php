<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class PasswordReset extends Model
{
    use Notifiable;

    protected $fillable = [
        'email', 'token'
    ];
}
