<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EventParticipant.
 *
 * @package namespace App\Models;
 */
class EventParticipant extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'event_participant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'participant_id',
        'event_id'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
