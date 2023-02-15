<?php

namespace App\Http\Controllers\Marchand;

use App\Http\Controllers\Controller;
use App\Models\RecompenseImmediate;
use Illuminate\Http\Request;

class FideliteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('/Marchand/Fidelite/index');
    }

    public function saveob(Request $request){
        $offre = RecompenseImmediate::create(
            [
                'name'=>$request->name,
                'taux'=>$request->taux,
                'fournisseur_id'=>auth()->user()->fournisseur_id,
                'user_id'=>auth()->user()->id,
                'type'=>1,
            ]
        );

        $request->session()->flash('success','ok');

        return back();
    }

    public function saveact(Request $request){
        $offre = RecompenseImmediate::create(
            [
                'name'=>$request->name,
                'coef'=>$request->coef,
                'fournisseur_id'=>auth()->user()->fournisseur_id,
                'user_id'=>auth()->user()->id,
                'type'=>2,
                'validity'=>$request->validity,
                'echeance'=>$request->echeance
            ]
        );

        $request->session()->flash('success','ok');

        return back();
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
	public function show($token)
	{
		//$projet = Creance::where('token',$token)->first();


		return view('/Consultant/Creances/show')->with(compact('projet'));
	}


}
