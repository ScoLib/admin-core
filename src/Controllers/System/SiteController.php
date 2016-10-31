<?php

namespace Sco\Http\Controllers\Admin\System;

use Illuminate\Http\Request;
use Sco\Http\Controllers\Admin\BaseController;
use Sco\Repositories\ConfigRepository;

/**
 * 站点设置
 * Class SiteController
 *
 * @package Sco\Http\Controllers\Admin\System
 */
class SiteController extends BaseController
{

    /**
     * 站点设置
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $configs = app(ConfigRepository::class)->getConfigs();
        return $this->render('system.site.index', compact('configs'));
    }

    /**
     * 保存设置信息
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postIndex(Request $request)
    {
        $configs = $request->input('configs');
        app(ConfigRepository::class)->saveConfigs($configs);
        return response()->json(success());
    }

}