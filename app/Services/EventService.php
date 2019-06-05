<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 18/02/19
 * Time: 15:44
 */

namespace App\Services;

use App\Repositories\EventRepository;
use App\Services\Traits\CrudMethods;

class EventService
{
    use CrudMethods;

    protected $repository;


    public function __construct(EventRepository $repository )
    {
        $this->repository = $repository;
    }

    public function create(array $data, $skipPresenter = false)
    {
        try{
            DB::beginTransaction();
            dd($data);
            $data =  $this->repository->skipPresenter($skipPresenter)->create($data);
            DB::commit();
            return $data;
        }catch (\Exception $e){
            DB::rollBack();
            return [
                'error' => true,
                'message' => "Failed to create data"
            ];
        }
    }

    public function participantAdd(){

        return null;
    }
}
