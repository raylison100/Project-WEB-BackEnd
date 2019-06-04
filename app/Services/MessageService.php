<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 18/02/19
 * Time: 15:44
 */

namespace App\Services;


use App\Repositories\MessageRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Support\Facades\DB;

class MessageService
{
    protected $repository;

    protected $authService;

    public function __construct(MessageRepository $repository, AuthService $authService)
    {
        $this->repository = $repository;
        $this->authService = $authService;
    }

    public function create(array $data)
    {
       try{
           $user = $this->authService->getUserByToken();

           $data['user_id'] = $user->id;
           $data['user_type_id'] = $user->user_type_id;
           DB::beginTransaction();
           $message = $this->repository->create($data);
           DB::commit();
           return $message;
       }catch (\Exception $e){
           DB::rollBack();
           return response()->json([
               "erro"       => true,
               'message' => "Failed to create message"
           ],401);
       }

    }

    public function update(array $data, $id)
    {
        try {
            $user = $this->authService->getUserByToken();

            $data['user_id'] = $user->id;
            $data['user_type_id'] = $user->user_type_id;
            DB::beginTransaction();
            $message = $this->repository->update($data, $id);
            DB::commit();
            return $message;
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                "erro"       => true,
                'message' => "Failed to update data"
            ],401);
        }
    }
}

