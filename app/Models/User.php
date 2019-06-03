<?php

namespace App\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User.
 *
 * @package namespace App\Models;
 */
class User extends Authenticatable implements Transformable
{
    use SoftDeletes,TransformableTrait, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type_id',
        'active',
        'activation_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'activation_token'
    ];

    protected $dates = ['deleted_at'];


    public function userType()
    {
        return $this->belongsTo(UserType::class ,'user_type_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
