<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\User;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Permission
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
        /* TODO make more understandable*/
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $availableModules = config('modules.root');
        $currentModuleName = $request->segment(3); // like : dashboard
        $mutationUrl = $request->segment(4) ?? 'index'; // like : index, create, edit

        if(isset($availableModules[$currentModuleName]['status']) && $availableModules[$currentModuleName]['status']){
            if(isset($availableModules[$currentModuleName]['fields'][$mutationUrl]) && $availableModules[$currentModuleName]['fields'][$mutationUrl]){
                $user = User::find(Auth::id());
                $allowedModules = Role::getAllowedModules($user->role_id);

                if(isset($allowedModules[$currentModuleName][$mutationUrl]) && $allowedModules[$currentModuleName][$mutationUrl]){

                    return $next($request);
                }
                abort(403);
//                dd( "you have not access on this module" );
            }else{
                abort(403);
//                dd( "this action is disabled or not allowed" );
            }
        }else{
            abort(404);
//            dd( "module does not exist or disabled" );
        }

    }
}
