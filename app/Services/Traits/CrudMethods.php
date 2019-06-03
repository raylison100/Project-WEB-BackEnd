<?php

namespace App\Services\Traits;

use Illuminate\Support\Facades\DB;

/**
 * Class CrudMethods
 * @package app\Services\Traits
 */
trait CrudMethods
{

    protected $repository;

    public function all($limit = 20)
    {
        return $this->repository->paginate($limit);
    }

    public function create(array $data, $skipPresenter = false)
    {
        try{
            DB::beginTransaction();
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

    public function find($id, $skipPresenter = false)
    {
        try{
            return $this->repository->skipPresenter($skipPresenter)->find($id);
        }catch (\Exception $e){
            return [
                'error' => true,
                'message' => "Request not found"
            ];
        }
    }

    public function update(array $data, $id)
    {
        try{
            DB::beginTransaction();
            $data =  $this->repository->update($data, $id);
            DB::commit();
            return $data;
        }catch (\Exception $e){
            DB::rollBack();
            return [
                'error' => true,
                'message' => "Failed to update data"
            ];
        }
    }

    public function findWhere(array $data, $first = false, $presenter = false, $count = false)
    {

        try{
            if ($first) {
                return $this->repository->skipPresenter()->findWhere($data)->first();
            }
            if ($presenter) {
                return $this->repository->findWhere($data)->first();
            }
            if ($count) {
                return $this->repository->skipPresenter()->findWhere($data)->count();
            }
            return $this->repository->skipPresenter()->findWhere($data);
        }catch (\Exception $e){
            return [
                'error' => true,
                'message' => "Request not found"
            ];
        }
    }

    public function delete($id)
    {
        try{
            $this->repository->delete($id);
            return [
                'error' => false,
                'message' => 'Successfully deleted'
            ];
        }catch (\Exception $e){
            return [
                'error' => true,
                'message' => "Failed to delete data"
            ];
        }
    }

    public function clearMask($string)
    {
        $vowels = [ ":","(", ")", "+", "-", "*", "_", "."];

        return str_replace($vowels, "", $string);
    }
}
