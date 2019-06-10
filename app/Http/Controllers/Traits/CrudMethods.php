<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 10:40
 */

namespace App\Http\Controllers\Traits;

use Prettus\Validator\Contracts\ValidatorInterface;
use Illuminate\Http\Request;

/**
 * Class CrudMethods
 * @package app\Http\Controllers\Traits
 */
trait CrudMethods
{
    protected $service;

    protected $validator;

    public function index(Request $request)
    {
        return response()->json($this->service->all($request->query->get('limit', 15)));
    }

    public function show(int $id)
    {
        return response()->json($this->service->find($id));
    }

    public function store(Request $request)
    {
        if($this->validator){
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
        }
        return $this->service->create($request->all());
    }

    public function update(Request $request, $id)
    {
        if($this->validator){
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }
        return $this->service->update($request->all(), $id);
    }

    public function restore($id)
    {
        return $this->service->restore($id);
    }

    public function trash($id)
    {
        return $this->service->delete($id);
    }


    public function destroy($id)
    {
        return $this->service->delete($id);
    }

    public function findWhere(Request $request)
    {
        return $this->service->findWhere($request->all());
    }
}
