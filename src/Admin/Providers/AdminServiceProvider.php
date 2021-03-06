<?php

namespace Sco\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Zizaco\Entrust\EntrustServiceProvider;

/**
 *
 */
class AdminServiceProvider extends ServiceProvider
{

    protected $commands = [
        \Sco\Admin\Commands\Install::class,
    ];

    protected $middlewares = [
        'auth.scoadmin'  => \Sco\Admin\Middleware\AdminAuthenticate::class,
        'guest.scoadmin' => \Sco\Admin\Middleware\RedirectIfAuthenticated::class,
        'admin.menu'     => \Sco\Admin\Middleware\AdminMenu::class,
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
        $this->registerMiddleware();

        // 后台模板目录
        $this->loadViewsFrom($this->getBasePath() . '/resources/admin', 'admin');
        // 后台语言包目录
        $this->loadTranslationsFrom($this->getBasePath() . '/resources/lang', 'Admin');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom($this->getBasePath() . '/database/migrations');
            /*$this->publishes([
                $this->getBasePath() . '/resources' => base_path('resources')
            ], 'shop-views');*/
            $this->publishes([
                $this->getBasePath() . '/config/scoadmin.php' => config_path('scoadmin.php'),
                $this->getBasePath() . '/config/entrust.php'  => config_path('entrust.php'),
                $this->getBasePath() . '/install/public'      => base_path() . '/public',
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

        $this->commands($this->commands);

        $this->mergeConfigFrom($this->getBasePath() . '/config/scoadmin.php', 'scoadmin');

    }

    protected function registerMiddleware()
    {
        $router = $this->app['router'];
        foreach ($this->middlewares as $key => $middleware) {
            $router->middleware($key, $middleware);
        }
    }
}
