<?php

namespace Sco\Http\Controllers\Admin\Users;


use Illuminate\Http\Request;
use Sco\Http\Controllers\Admin\BaseController;
use Sco\Repositories\RoleRepository;
use Sco\Repositories\PermissionRepository;

/**
 * 角色管理
 * Class RoleController
 *
 * @package Sco\Http\Controllers\Admin\Users
 */
class RoleController extends BaseController
{
    /**
     * 角色列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $roles = app(RoleRepository::class)->getAllRoles();
        return $this->render('users.role.index', compact('roles'));
    }

    /**
     * 新增角色
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        return $this->render('users.role.add');
    }

    /**
     * 保存新增角色
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'name'         => 'bail|required|unique:roles',
            'display_name' => 'bail|required'
        ]);

        app(RoleRepository::class)->create($request->all());
        return response()->json(success('新增角色完成', ['url' => route('admin.users.role')]));
    }

    /**
     * 编辑角色
     *
     * @param integer $id 角色ID
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $role = app(RoleRepository::class)->find($id);
        return $this->render('users.role.edit', compact('role'));
    }

    /**
     * 保存编辑角色
     *
     * @param \Illuminate\Http\Request $request 提交数据
     * @param integer                  $id      角色ID
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEdit(Request $request, $id)
    {
        $this->validate($request, [
            'name'         => 'bail|required|unique:roles,name,' . $id,
            'display_name' => 'bail|required'
        ]);
        app(RoleRepository::class)->update($request->all(), $id);
        return response()->json(success('编辑角色完成', ['url' => route('admin.users.role')]));

    }

    /**
     * 角色授权
     *
     * @param integer $id 角色ID
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAuthorize($id)
    {
        $role        = app(RoleRepository::class)->find($id);
        $permList    = app(PermissionRepository::class)->getPermRouteList();
        $rolePermIds = $role->perms()->getRelatedIds();
        return $this->render('users.role.authorize', compact('role', 'permList', 'rolePermIds'));
    }

    /**
     * 保存角色授权
     *
     * @param \Illuminate\Http\Request $request 提交数据
     * @param integer                  $id      角色ID
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAuthorize(Request $request, $id)
    {
        app(RoleRepository::class)->find($id)->savePermissions($request->input('perms'));
        return response()->json(success('授权完成', ['url' => route('admin.users.role')]));
    }

    /**
     * 删除角色
     *
     * @param integer $id 角色ID
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDelete($id)
    {
        app(RoleRepository::class)->delete($id);
        return response()->json(success('删除角色完成'));

    }
}