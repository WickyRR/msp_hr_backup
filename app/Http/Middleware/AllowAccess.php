<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AllowAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $required_permission)
    {
        $session = Session::get('custom_auth_fields');

        #check whether required permission in users permission list
        if (in_array($required_permission, $session[0]['permission_slugs'])) {
            return $next($request);
        } else {
            #TODO add logic for the case of no permissions
            //echo ('<p>Unauthorized</p>');
            abort(403);
        }
    }
}
