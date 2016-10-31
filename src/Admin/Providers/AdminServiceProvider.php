<?php

namespace Sco\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 后台模板目录
        $this->loadViewsFrom(base_path('resources/admin'), 'admin');
        // 后台语言包目录
        //$this->loadTranslationsFrom(base_path('resources/lang/admin'), 'Admin');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
