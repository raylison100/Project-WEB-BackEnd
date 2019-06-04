<?php

namespace App\Http\Controllers;

use App\Http\Requests\ticketUpdateRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

/**
 * Class EventsController.
 *
 * @package namespace App\Http\Controllers;
 */
class EventsController extends AppController
{

    protected $service;

    /**
     * EventsController constructor.
     *
     * @param EventService $service
     */
    public function __construct(EventService $service)
    {
        $this->service = $service;
    }

    public function participantAdd($id){
        return $this->service->participantAdd($id);
    }
}
