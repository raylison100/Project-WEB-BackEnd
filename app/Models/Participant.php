<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Participant.
 *
 * @package namespace App\Models;
 */
class Participant extends Model implements Transformable
{
    use TransformableTrait,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class,'event_participants');
    }

    public function user(){
        return $this->hasOne(User::class,'user_id');
    }
}
