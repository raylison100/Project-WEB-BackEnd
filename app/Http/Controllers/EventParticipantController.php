<?php


namespace App\Http\Controllers;

use App\Services\EventParticipantService;
use App\Services\EventService;

class EventParticipantController extends AppController
{

    protected $service;

    /**
     * EventsController constructor.
     *
     * @param EventService $service
     */
    public function __construct(EventParticipantService $service)
    {
        $this->service = $service;
    }

    public function participantAdd($event_id){
        return $this->service->participantAdd($event_id);
    }
}
