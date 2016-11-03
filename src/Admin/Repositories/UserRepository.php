<?php
namespace Sco\Admin\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Http\Request;
use Sco\Admin\Models\User;
use Sco\Repositories\Criteria\UserCriteria;
use DB;

/**
 * Class UserRepository
 *
 * @package Sco\Repositories
 */
class UserRepository extends Repository
{

    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(UserCriteria::class));
    }

    public function createUser(Request $request)
    {
        DB::transaction(function () use($request) {
            $data = $request->except('role');
            $data['password'] = bcrypt($data['password']);
            $user = $this->create($data);
            $user->roles()->sync($request->input('role'));
        });
        return true;
    }

    public function updateUser(Request $request, $uid)
    {
        DB::transaction(function () use($request, $uid) {
            $data = $request->except(['role', 'password']);
            if ($request->has('password')) {
                $data['password'] = bcrypt($request->input('password'));
            }

            $user = $this->update($data, $uid);
            $user->roles()->sync($request->input('role'));
        });
        return true;
    }

}