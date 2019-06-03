<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 05/02/19
 * Time: 14:53
 */

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use App\Repositories\UserRepository;
use App\Repositories\PasswordResetRepository;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use Illuminate\Support\Facades\DB;


class PasswordResetService
{

    protected $repositoryAdminUser;

    protected $repositoryPasswordReset;

    /**
     * @param UserRepository $adminUserRepository
     * @param PasswordResetRepository $passwordResetRepository
     */
    public function __construct(UserRepository $adminUserRepository, PasswordResetRepository $passwordResetRepository)
    {
        $this->repositoryAdminUser = $adminUserRepository;
        $this->repositoryPasswordReset = $passwordResetRepository;
    }


    public function create($request)
    {
        try{

            $adminUser = $this->repositoryAdminUser->skipPresenter()->findByField('email',$request->email)->first();
            DB::beginTransaction();
            $passwordReset = $this->repositoryPasswordReset->updateOrCreate(
                [   'email' => $adminUser->email],
                [
                    'email' => $adminUser->email,
                    'token' => str_random(60)
                ]
            );
            DB::commit();
            if (isset($adminUser) && isset($passwordReset))
                $adminUser->notify( new PasswordResetRequest($passwordReset->token));
            return response()->json([
                'message' => 'We have e-mailed your password reset link!'
            ]);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message' => "We can't find a user with that e-mail address."], 404);
        }
    }

    public function find($token)
    {
        $passwordReset = $this->repositoryPasswordReset->findByField('token', $token)->first();

        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(60)->isPast()) {

            $this->repositoryPasswordReset->delete($passwordReset->id);

            return response()->json([
                'message' => 'This password reset token expired.'
            ], 404);
        }

        return response()->json($passwordReset);
    }

    public function reset($request)
    {
        $where =[
            'token' => $request->token,
            'email' => $request->email
        ];
        $passwordReset = $this->repositoryPasswordReset->skipPresenter()->findWhere($where)->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);

        $adminUser = $this->repositoryAdminUser->skipPresenter()->findByField('email', $passwordReset->email)->first();

        if (!isset($adminUser)) {

            return response()->json([
                'message' => "We can't find a user with that e-mail address."
            ], 404);
        }

        $adminUserData = [
            'password' => bcrypt($request->password)
        ];

        try{
            DB::beginTransaction();
            $this->repositoryAdminUser->update($adminUserData,$adminUser->id);
            $passwordReset->notify(new PasswordResetSuccess());
            $this->repositoryPasswordReset->delete($passwordReset->id);
            DB::commit();
            return response()->json([
                'message' => 'This password reset success .'
            ], 200);
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

    }
}
