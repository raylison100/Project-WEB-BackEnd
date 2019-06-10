<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\EventService;


/**
 * Class EventsController.
 *
 * @package namespace App\Http\Controllers;
 */
class EventsController extends AppController
{

    use CrudMethods;
    
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
}
