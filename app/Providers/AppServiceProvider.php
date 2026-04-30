<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;

use App\Models\User;
use App\Models\Tipo;
use Spatie\Permission\Models\Permission;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * 1. TIPOS PARA EL NAVBAR (disponibles en todas las vistas)
         */
        View::composer('*', function ($view) {
            if (Schema::hasTable('tipos')) {
                $view->with('tipos', Tipo::orderBy('id')->get());
            } else {
                $view->with('tipos', collect());
            }
        });

        /**
         * 2. BACKDOOR PARA Desarrollador
         */
        Gate::before(function (User $user, $ability) {
            if ($user->hasRole('Desarrollador')) {
                return true;
            }
        });

        /**
         * 3. PERMISOS DINÁMICOS DESDE LA BD
         */
        try {
            if (Schema::hasTable('permissions')) {

                $permisos = Permission::all();

                foreach ($permisos as $permiso) {
                    Gate::define($permiso->name, function (User $user) use ($permiso) {
                        return $user->hasPermissionTo($permiso->name);
                    });
                }

            }
        } catch (\Exception $e) {
        }
    }

}
