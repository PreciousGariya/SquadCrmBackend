<?php

namespace Modules\File\Http\Middleware;

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

            // Files
            $menu->add('<i class="nav-icon fa-regular fa-sun"></i> '.__('Files'), [
                'route' => 'backend.files.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 77,
                'activematches' => ['admin/files*'],
                'permission'    => ['view_files'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);
        })->sortBy('order');

        return $next($request);
    }
}
