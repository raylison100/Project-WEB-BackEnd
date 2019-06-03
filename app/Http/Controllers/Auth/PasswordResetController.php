<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordCreateRequest;
use App\Http\Requests\PasswordConfirmationRequest;
use App\Services\PasswordResetService;

class PasswordResetController extends Controller
{

    protected $service;

    public function __construct(PasswordResetService $service)
    {
        $this->service = $service;
    }

    public function create(PasswordCreateRequest $request)
    {
        return $this->service->create($request);
    }

    public function find($token)
    {
        return $this->service->find($token);
    }

    public function reset(PasswordConfirmationRequest $request)
    {
        return $this->service->reset($request);
    }
}
