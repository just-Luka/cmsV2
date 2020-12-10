<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class FileManage
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
        if (Auth::check()){
            $accessLevel = User::find(Auth::id())->role_id;
            if ($accessLevel){
                return $next($request);
            }
            abort(403);
        }
        return redirect()->route('login');
    }
}
