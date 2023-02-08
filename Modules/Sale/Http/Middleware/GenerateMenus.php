<?php

namespace Modules\Sale\Http\Middleware;

use Closure;
use Lavary\Menu\Facade as Menu;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         *
         * Module Menu for Admin Backend
         *
         * *********************************************************************
         */
        Menu::make('admin_sidebar', function ($menu) {

            // Sales
            $menu->add('<i class="nav-icon fa-regular fa-sun"></i> '.__('Sales'), [
                'route' => 'backend.sales.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 77,
                'activematches' => ['admin/sales*'],
                'permission'    => ['view_sales'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);
        })->sortBy('order');

        return $next($request);
    }
}
