<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if( 'haspermission', function ($required_permission) {
            $session = Session::get('custom_auth_fields');
            $permissions = $session[0]['permission_slugs'];
            $permitted = in_array($required_permission, $permissions);
            return $permitted;
         });
    }

    // usage 
    
    // @haspermission('required_permission')
    // <html to render when user has required permission>
    // @else
    // <html to render when user doesnt have required permission>
    // @endhaspermission

}