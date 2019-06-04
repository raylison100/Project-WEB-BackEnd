<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends AppController
{
    use CrudMethods;

    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function store(UserCreateRequest $request)
    {
        return $this->service->create($request->all());
    }

    public function update(UserUpdateRequest $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function eventsParticipants($id){
        return $this->service->eventsParticipants($id);
    }
}
