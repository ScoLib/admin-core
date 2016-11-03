<?php
namespace Sco\Admin\Repositories\Criteria;

use Bosnadev\Repositories\Contracts\CriteriaInterface;
use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class UserCriteria
 *
 * @package Sco\Repositories\Criteria
 */
class UserCriteria implements CriteriaInterface
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model                  $model
     * @param \Bosnadev\Repositories\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (($uid = intval($this->request->input('uid')))) {
            $model = $model->where('uid', $uid);
        }

        if ($this->request->has('username')) {
            $model = $model->where('username', 'like', "%{$this->request->input('username')}%");
        }

        if ($this->request->has('email')) {
            $model = $model->where('email', $this->request->input('email'));
        }

        if (($role = intval($this->request->input('role')))) {
            $model = $model->whereHas('roles', function ($query) use ($role) {
                $query->where('id', $role);
            });
        }
        $model = $model->orderBy('uid', 'desc');

        return $model;
    }
}