<?php

namespace App\Repositories;

use App\Presenters\MessagePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MessageRepository;
use App\Models\Message;
use App\Validators\MessagensValidator;

/**
 * Class MessagensRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MessageRepositoryEloquent extends BaseRepository implements MessageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Message::class;
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return MessagePresenter::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
