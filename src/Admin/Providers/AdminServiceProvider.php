<?php

namespace Sco\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{

    protected $commands = [
        \Sco\Admin\Commands\Install::class,
    ];

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
            /*$this->publishes([
                $this->getBasePath() . '/resources' => base_path('resources')
            ], 'shop-views');*/
            $this->publishes([
                $this->getBasePath() . '/install' => base_path()
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(\Zizaco\Entrust\EntrustServiceProvider::class);
        $this->app->register(\Bosnadev\Repositories\Providers\RepositoryProvider::class);

        $this->commands($this->commands);
    }
}
