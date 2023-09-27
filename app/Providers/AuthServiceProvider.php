<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Access\Response;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-check', function (User $user) {
            return $user->user_type < 2
                ? Response::allow()
                : Response::deny();
        });

        Gate::define('agent-check', function (User $user) {
            return $user->user_type == 2
                ? Response::allow()
                : Response::deny();
        });

        Gate::define('allow-view', function(User $user, $module){
            if($user->user_type < 2) return Response::allow();
            
            if(!$module) return Response::deny();
            
            $ua = $user->userAccessArray;
            if(!$ua) return Response::deny();
            $key = array_search($module,array_column($ua,'module'));
            if($key === FALSE) return Response::deny();

            return $ua[$key]['enabled'] == true
            ? Response::allow()
            : Response::deny();
        });

        Gate::define('allow-create', function(User $user, $module){
            if($user->user_type < 2) return Response::allow();
            
            if(!$module) return Response::deny();
            
            $ua = $user->userAccessArray;
            if(!$ua) return Response::deny();
            $key = array_search($module,array_column($ua,'module'));
            if($key === FALSE) return Response::deny();

            if($ua[$key]['enabled'] == false) return Response::deny();

            return $ua[$key]['access_level'] > 0
            ? Response::allow()
            : Response::deny();
        });

        Gate::define('allow-edit', function(User $user, $module){
            if($user->user_type < 2) return Response::allow();
            
            if(!$module) return Response::deny();

            $ua = $user->userAccessArray;
            if(!$ua) return Response::deny();
            $key = array_search($module,array_column($ua,'module'));
            if($key === FALSE) return Response::deny();

            if($ua[$key]['enabled'] == false) return Response::deny();

            return $ua[$key]['access_level'] > 1
            ? Response::allow()
            : Response::deny();
        });

        Gate::define('allow-delete', function(User $user, $module){
            if($user->user_type < 2) return Response::allow();
            
            if(!$module) return Response::deny();

            $ua = $user->userAccessArray;
            if(!$ua) return Response::deny();
            $key = array_search($module,array_column($ua,'module'));
            if($key === FALSE) return Response::deny();

            if($ua[$key]['enabled'] == false) return Response::deny();

            return $ua[$key]['access_level'] > 2
            ? Response::allow()
            : Response::deny();
        });

        Gate::define('access-enabled', function(User $user, $module){
            if($user->user_type < 2) return Response::allow();
            
            if(!$module) return Response::deny();

            $ua = $user->userAccessArray;
            if(!$ua) return Response::deny();
            $key = array_search($module,array_column($ua,'module'));
            if($key === FALSE) return Response::deny();

            if($ua[$key]['enabled'] == false) return Response::deny();

            return Response::allow();
        });
    }
}
