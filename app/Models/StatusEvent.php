<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusEvent extends Model
{

    const STATUS_CREATED = 1;
    const STATUS_ACCOMPLISHED = 2;
    const STATUS_CANCELED = 4;

    protected $fillable = [
        'name'
    ];
}
