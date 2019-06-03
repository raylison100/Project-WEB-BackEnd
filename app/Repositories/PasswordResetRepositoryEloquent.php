<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 13/02/19
 * Time: 10:49
 */

namespace App\Repositories;

use App\Models\PasswordReset;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class PasswordResetRepositoryEloquent extends BaseRepository implements PasswordResetRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PasswordReset::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
