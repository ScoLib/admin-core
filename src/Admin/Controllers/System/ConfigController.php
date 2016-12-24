<?php

namespace Sco\Admin\Controllers\System;

use Illuminate\Http\Request;
use Sco\Admin\Controllers\BaseController;
use Sco\Admin\Models\Config;
use Sco\Admin\Repositories\ConfigRepository;

/**
 * 配置设置
 * Class SiteController
 *
 * @package Sco\Http\Controllers\Admin\System
 */
class ConfigController extends BaseController
{

    /**
     * 站点设置
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $configs = (new Config())->getConfigs();
        return $this->render('system.config.index', compact('configs'));
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
        (new Config())->saveConfigs($configs);
        return response()->json(success());
    }

}