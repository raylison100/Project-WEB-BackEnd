<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageCreateRequest;
use App\Http\Requests\MessageUpdateRequest;
use App\Services\MessageService;

/**
 * Class MessagesController.
 *
 * @package namespace App\Http\Controllers;
 */
class MessagesController extends AppController
{

    protected $service;

    /**
     * MessagesController constructor.
     *
     * @param MessageService $service
     */
    public function __construct(MessageService $service)
    {
        $this->service = $service;
    }

    public function store(MessageCreateRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function update(MessageUpdateRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }
}
