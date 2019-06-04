<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Message.
 *
 * @package namespace App\Models;
 */
class Message extends Model implements Transformable
{
    use TransformableTrait,SoftDeletes;

    protected $table =  'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'user_id',
        'event_id',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function event(){
        return $this->belongsTo(Ticket::class,'event_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
