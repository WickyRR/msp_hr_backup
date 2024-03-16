<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employment;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\ActiveYears;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller

{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    protected function redirectTo()
    {
        /**
         *retrive and store user role varibles
         */

        $user_id = auth()->user()->id;
        $active_year = ActiveYears::firstWhere('is_active', 1)->id;
        //change the query
        $employment = Employment::with('role', 'role.permissions', 'permissions')
            ->where('user_id', $user_id)
            ->where('active_year_id', $active_year)
            ->first();

        if($employment == null){
            //redirect to a public page
            return redirect('/unauthorized');
            //die();
        }
        //dd($employment);

        $role = $employment->role;
        $role_id = $role->id;
        $role_slug = $role->role_slug;
        $position_id = $role->member_position_id;
        $pillar_id = $role->pillar_id;

        $permissions = $employment->permissions;
        $permissions_through_role = $role->permissions;
        $permission_ids = $permissions->pluck('permissions.id')->toArray() +
            $permissions_through_role->pluck('permissions.id')->toArray();
        $permission_slugs = $permissions->pluck('permission_slug')->toArray() +
            $permissions_through_role->pluck('permission_slug')->toArray();

        /*$employment = User::find($user_id)->employments()->firstWhere('active_year_id', $active_year);
        $position_id = $employment ? $employment->role()->first()->member_position_id : null;
        $pillar_id = $employment && $employment->role()->first() ? $employment->role()->first()->pillar_id :  null;
        $role = $employment ? $employment->role()->first() : null;
        $role_id = $role ? $role->id : null;
        $role_slug = $role ? $role->role_slug : null;
        $permission_ids = $employment->permissions()->pluck('permissions.id')->toArray();
            + $employment->role()->first()->permissions()->pluck('permissions.id')->toArray();
        $permission_slugs = $employment->permissions()->pluck('permissions.permission_slug')->toArray()
            + $employment->role()->first()->permissions()->pluck('permissions.permission_slug')->toArray();*/

        // set session values
        $custom_auth_fields = [
            'position' => $position_id,
            'employment' => $employment == null ? null : $employment->id,
            'pillar' => $pillar_id,
            'role_id' => $role_id,
            'role_slug' => $role_slug,
            'member_position_id' => 1,
            'permission_slugs' => $permission_slugs,
            'permission_ids' => $permission_ids,

        ];

        Session::push('custom_auth_fields', $custom_auth_fields);
        // redirect to home page
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
