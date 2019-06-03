<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:55
 */

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService
 * @package App\Services
 */
class AuthService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * AuthService constructor.
     * @param UserRepository $repository
     * @param UserService $userService
     */
    public function __construct(UserRepository $repository, UserService $userService)
    {
        $this->repository  = $repository;
        $this->userService = $userService;
    }


    public function getUserByToken()
    {
        $user = Auth::user();

        if(!isset($user)){
            return[
            "error" => true,
            "message" => "Usuário não encontrado!"
        ];
        }
        return $user;
    }

    public function enableSignUp($token)
    {
        $userService = $this->repository->skipPresenter()->findByField('activation_token', $token)->first();
        if (!$userService) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $userServiceData = [
            'active'             => true,
            'activation_token'   => '',
        ];

        $this->repository->update($userServiceData,$userService->id);

        return [
            "error" => false,
            "message" => "Cadastro confirmado com sucesso!",
        ];
    }

    public function destroyToken(){

        $user = $this->getUserByToken();
        if (isset($user)) {
            $user->token()->revoke();
            return response()->json([
                'erro'    => 'false',
                'message' => 'Successfully logged out'
            ]);
        }

        return response()->json([
            'erro' => 'true',
            'message' => 'User not found'
        ]);

    }
}
