<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Marchand
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
        if(Auth::user()->role_id != 2){
            $request->session()->flash('danger','Acces non autorisé !!!');
            return redirect('/login');
        }

        $path = explode('/',$request->path());
	    if(in_array('dashboard',$path)){
		    Session::put('active', 1);
	    }
	    if(in_array('parametres',$path)){
		    Session::put('active', 2);
	    }
        if(in_array('budget',$path)){
		    Session::put('active', 3);
	    }
	    if(in_array('cartes',$path)){
		    Session::put('active', 4);
	    }
        if(in_array('menus',$path)){
		    Session::put('active', 5);
	    }
	    if(in_array('promotions',$path)){
		    Session::put('active', 6);
	    }
        if(in_array('rapports',$path)){
		    Session::put('active', 7);
	    }
	    if(in_array('stats',$path)){
		    Session::put('active', 8);
	    }

        if(in_array('compte',$path)){
		    Session::put('active', 9);
	    }
	    if(in_array('factures',$path)){
		    Session::put('active', 10);
	    }

        return $next($request);
    }
}
