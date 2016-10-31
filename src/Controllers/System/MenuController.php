<?php

namespace Sco\Http\Controllers\Admin\System;

use Sco\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Sco\Repositories\PermissionRepository;

/**
 * 菜单管理
 * Class MenuController
 *
 * @package Sco\Http\Controllers\Admin\System
 */
class MenuController extends BaseController
{

    /**
     * 菜单列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $menus = app(PermissionRepository::class)->getMenuTreeList();

        return $this->render('system.menu.index', compact('menus'));
    }

    /**
     * 新增菜单
     *
     * @param int $pid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd($pid = 0)
    {

        if ($pid) {

        }

        $menus = app(PermissionRepository::class)->getMenuTreeList();
        return $this->render('system.menu.add', compact('menus'));
    }

    /**
     * 保存菜单信息
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'pid'          => 'integer',
            'display_name' => 'required',
            'name'         => ['bail', 'required', 'regex:/^[\w\.]+$/'],
            //'' => '',
        ]);

        app(PermissionRepository::class)->saveMenu($request);
        return response()->json(success('新增菜单完成', ['url' => route('admin.system.menu')]));
    }

    /**
     * 编辑菜单
     *
     * @param integer $id 菜单ID
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $menu  = app(PermissionRepository::class)->find($id);
        $menus = app(PermissionRepository::class)->getMenuTreeList();
        return $this->render('system.menu.edit', compact('menu', 'menus'));
    }

    /**
     * 保存菜单信息
     *
     * @param \Illuminate\Http\Request $request 提交数据
     * @param integer                  $id      菜单ID
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEdit(Request $request, $id)
    {
        $this->validate($request, [
            'pid'          => 'integer',
            'display_name' => 'required',
            'name'         => ['bail', 'required', 'regex:/^[\w\.]+$/'],
            //'' => '',
        ]);

        app(PermissionRepository::class)->saveMenu($request, $id);
        return response()->json(success('编辑菜单完成', ['url' => route('admin.system.menu')]));
    }

    /**
     * 删除菜单
     *
     * @param integer $id
     */
    public function getDelete($id)
    {

    }


}