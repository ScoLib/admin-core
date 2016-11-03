<?php

namespace Sco\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{

    public function getBasePath()
    {
        return dirname(dirname(__DIR__));
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 后台模板目录
        $this->loadViewsFrom($this->getBasePath() . 'resources/admin', 'admin');
        // 后台语言包目录
        $this->loadTranslationsFrom($this->getBasePath() .  'resources/lang', 'Admin');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom($this->getBasePath() . '/database/migrations');
            $this->publishes([
                $this->getBasePath() . '/resources' => base_path('resources')
            ], 'shop-views');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Zizaco\Entrust\EntrustServiceProvider::class);
        $this->app->register(\Bosnadev\Repositories\Providers\RepositoryProvider::class);
    }
}
