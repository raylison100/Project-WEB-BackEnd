<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:52
 */

namespace App\Services;

use App\Models\Participant;
use App\Models\UserType;
use App\Notifications\SignupActivate;
use App\Repositories\UserRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserService
{
    use CrudMethods;

    protected $repository;
    protected $auth;

    public function __construct(UserRepository $repository,AuthService $auth)
    {
        $this->repository = $repository;
        $this->auth = $auth;
    }

    public function create(array $data, $skipPresenter = true)
    {
        try{
            $data['password']           = bcrypt($data['password']);
            $data['activation_token']   = Str::random(60);
            $data['user_type_id']       = UserType::COMMON;
            DB::beginTransaction();
            $user =  $skipPresenter ? $this->repository->skipPresenter()->create($data) : $this->repository->create($data);
            $user->notify(new SignupActivate($user));
            DB::commit();
            return response()->json([
                'error' => false,
                'message' => "Please check you email"
            ]);
        }catch (\Exception $e){
            DB::rollBack();
//            return response()->json([
//                'error' => true,
//                'message' => "Fail create user"
//            ]);
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(array $data, $id)
    {
        try{
            if(!empty($data['password'])){
                $data['password'] =  bcrypt($data['password']);
            }
            DB::beginTransaction();
            $data =  $this->repository->update($data, $id);
            DB::commit();
            return $data;
        }catch (\Exception $e){
            DB::rollBack();
            return [
                'error' => true,
                'message' => "Failed to update user"
            ];
        }
    }

    public function eventsParticipants(){
        $user =  $this->auth->getUserByToken();

        $events = Participant::where()->get();

        return null;
    }
}
