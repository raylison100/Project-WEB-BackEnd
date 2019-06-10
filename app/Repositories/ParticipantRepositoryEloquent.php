<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\participantRepository;
use App\Models\Participant;
use App\Validators\ParticipantValidator;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class ParticipantRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ParticipantRepositoryEloquent extends BaseRepository implements ParticipantRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Participant::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
