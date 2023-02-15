<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role_id != 1){
            $request->session()->flash('danger','Acces non autorisé !!!');
            return redirect('/login');
        }

        $path = explode('/',$request->path());
	    if(in_array('dashboard',$path)){
		    Session::put('active', 1);
	    }
	    if(in_array('suivi',$path)){
		    Session::put('active', 2);
	    }

        if(in_array('actions',$path)){
		    Session::put('active', 3);
	    }

        if(in_array('parametres',$path)){
		    Session::put('active', 4);
	    }


        return $next($request);
    }
}
