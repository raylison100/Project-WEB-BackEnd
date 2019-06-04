<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 18/02/19
 * Time: 15:44
 */

namespace App\Services;

use App\Repositories\EventRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Http\Request;

class EventService
{
    use CrudMethods;

    protected $repository;
    protected $auth;

    public function __construct(EventRepository $repository, AuthService $auth)
    {
        $this->repository = $repository;
        $this->auth = $auth;
    }

    public function participantAdd($event_id){
        $user =  $this->auth->getUserByToken();
        return null;
    }
}
