<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 18/02/19
 * Time: 15:44
 */

namespace App\Services;

use App\Models\StatusEvent;
use App\Repositories\EventParticipantRepository;
use App\Repositories\EventRepository;
use App\Repositories\ParticipantRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventService
{
    use CrudMethods;

    protected $repository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->repository = $eventRepository;
    }

    public function create(array $data, $skipPresenter = false)
    {
        try{
            DB::beginTransaction();
            $data['user_id']  =  Auth::user()->getAuthIdentifier();
            $data['status_event_id']  =  StatusEvent::STATUS_CREATED;
            $data =  $this->repository->create($data);
            DB::commit();
            return $data;
        }catch (\Exception $e){
            DB::rollBack();
            return [
                'error' => true,
                'message' => "Failed to create data"
            ];
        }
    }

}
