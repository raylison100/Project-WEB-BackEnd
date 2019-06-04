<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Ticket.
 *
 * @package namespace App\Models;
 */
class Event extends Model implements Transformable
{
    use TransformableTrait,SoftDeletes;


    protected $fillable = [
        'subject',
        'status_event_id',
        'user_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function statusEvent(){
        return $this->hasOne(StatusEvent::class,'id','status_event_id' );
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class,'event_participants');
    }
}
