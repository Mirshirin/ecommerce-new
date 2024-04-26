<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class AdminAuthenticated
{
 
        
    public function handle($request, Closure $next)
    {
        dd($request->user());
        if ($request->user() && ($request->user()->isSuperUser() || $request->user()->isStaffUser())) {
            //return $next($request);
            return redirect()->route('admin-dashboard');
         
        }else{
            return redirect('/');

        }

    }




 }

