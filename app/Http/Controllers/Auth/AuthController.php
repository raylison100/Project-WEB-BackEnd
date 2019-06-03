<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 11:14
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AppController;
use App\Services\AuthService;

class AuthController extends AppController
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service  = $service;
    }

    public function getUserAuthenticated()
    {
        return $this->service->getUserByToken();
    }

    public function enableSignUp($token)
    {
        return $this->service->enableSignUp($token);
    }

    public function destroyToken(){
        return $this->service->destroyToken();
    }
}
