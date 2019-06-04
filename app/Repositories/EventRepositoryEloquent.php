<?php

namespace App\Repositories;

use App\Presenters\EventPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Ticket;

/**
 * Class TicketsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EventRepositoryEloquent extends BaseRepository implements EventRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Ticket::class;
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return EventPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
