<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usr = Auth::user();
        //dd($usr);
        if(!empty($usr)){
           // return  redirect('admin/dashboard');
            if(Auth::user()->apercu){
                return  redirect('admin/dashboard');
            }
            else{
                if(Auth::user()->suivi){
                    return redirect('admin/suivi');
                }
                if(Auth::user()->actions){
                    return redirect('admin/actions');
                }
                if(Auth::user()->parametres){
                    return redirect('admin/parametres');
                }
                return redirect('/logout');
            }
        }
        return view('home');
    }
}
