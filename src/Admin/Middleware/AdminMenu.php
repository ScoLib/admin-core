<?php

namespace Sco\Admin\Middleware;

use Closure;

class AdminMenu
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->attributes->set('admin.menu', $this->getAdminMenu());
        return $next($request);
    }

    public function getAdminMenu()
    {
        return [];
    }
}
