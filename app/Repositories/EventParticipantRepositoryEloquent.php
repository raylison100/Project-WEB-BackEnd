<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\event_participantRepository;
use App\Models\EventParticipant;
use App\Validators\EventParticipantValidator;

/**
 * Class EventParticipantRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EventParticipantRepositoryEloquent extends BaseRepository implements EventParticipantRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EventParticipant::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
