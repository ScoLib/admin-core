<?php

namespace Sco\Admin\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;
use Bosnadev\Repositories\Traits\CacheableTrait;
use Illuminate\Http\Request;
use Sco\Admin\Models\Permission;
use Sco\Tree\Traits\TreeTrait;

/**
 * Class PermissionRepository
 *
 * @package Sco\Repositories
 */
class PermissionRepository extends Repository
{
    use TreeTrait, CacheableTrait;

    protected $treeNodeParentIdName = 'pid';

    private $allRoutes = null;

    private $validList = null;

    private $permList = null;

    private $menuList = null;


    public function model()
    {
        return Permission::class;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getMenuTreeList()
    {
        $routes = $this->getDescendants(0);
        //dd($routes);
        return $routes;
    }

    private function getAll()
    {
        if ($this->allRoutes) {
            return $this->allRoutes;
        }

        $this->allRoutes = $this->remember('all', function () {
            return $this->model->orderBy('sort')->get();
        });
        return $this->allRoutes;
    }

    /**
     * Tree Trait 获取所有节点
     *
     * @return mixed|null
     */
    protected function getTreeAllNodes()
    {
        return $this->getAll();
    }

    /**
     * 获取有效的路由列表
     *
     * @return \Illuminate\Support\Collection
     */
    public function getValidRouteList()
    {
        if ($this->validList) {
            return $this->validList;
        }

        $all = $this->getAll();

        $this->validList = collect([]);
        foreach ($all as $route) {
            if (!empty($route->uri) && $route->uri != '#') {
                $this->validList->push($route);
            }
        }
        return $this->validList;
    }

    /**
     * 获取权限列表
     *
     *
     * @return \Illuminate\Support\Collection|null
     */
    public function getPermRouteList()
    {
        if ($this->permList) {
            return $this->permList;
        }

        return $this->permList = $this->getLayerOfDescendants(0);
    }

    public function getMenuList()
    {
        if ($this->menuList) {
            return $this->menuList;
        }
        $all = $this->getAll();

        $routes = collect([]);
        foreach ($all as $route) {
            if ($route->is_menu) {
                $routes->push($route);
            }
        }

        $this->setAllNodes($routes);
        return $this->menuList = $this->getLayerOfDescendants(0);
    }

    public function getInfoById($id)
    {
        return $this->getSelf($id);
    }

    public function getInfoByName($name)
    {
        $all = $this->getAll();
        $key = $all->search(function ($item) use ($name) {
            return $item->name == $name;
        });
        return $key === false ? false : $all->get($key);
    }

    public function getParentTree($id)
    {
        return $this->getAncestors($id);
    }

    public function getParentTreeAndSelfById($id)
    {
        $self = $this->getInfoById($id);
        if ($self) {
            $parent = $this->getParentTree($self->id);
            $parent->push($self);
            return $parent;
        }
        return false;
    }

    public function getParentTreeAndSelfByName($name)
    {
        $self   = $this->getInfoByName($name);
        if ($self) {
            $parent = $this->getParentTree($self->id);
            $parent->push($self);
            return $parent;
        }
        return false;

    }

    public function saveMenu(Request $request, $id = 0)
    {
        $input = $request->input();
        $this->updateOrCreate(['id' => $id], $input);
        return true;
    }

}