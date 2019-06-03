<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserType.
 *
 * @package namespace App\Entities;
 */
class UserType extends Model
{
    const ADMIN  = 1;
    const COMMON = 2;

    protected $fillable = [
       'name'
    ];
}
