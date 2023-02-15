<?php

namespace App\Http\Controllers\Marchand;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all()->where('fournisseur_id',auth()->user()->fournisseur_id)->where('role_id',3);
        return view('/Marchand/Compte/index')->with(compact('users'));
    }

    public function enable($token){
        $user = User::where('token',$token)->first();
        $user->active = 1;
        $user->save();
        request()->session()->flash('success','Ok');
        return back();
    }

    public function disable($token){
        $user = User::where('token',$token)->first();
        $user->active = 0;
        $user->save();
        request()->session()->flash('success','Ok');
        return back();
    }

    public function store(Request $request)
    {
        //
        //dd($request->all());
        $request->validate([
            'phone' => 'required|unique:users,phone',
            'email' => 'unique:users,email',
        ]);
        $ud = [
            'first_name'=>$request->fn,
            'last_name'=>$request->ln,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
            'role_id'=>3,
        ];

        $ud['fournisseur_id'] = auth()->user()->fournisseur_id;
        $ud['token'] = sha1(auth()->user()->id . date('Yhmids'));
       // dd($ud);

        $user = User::create($ud);
        $request->session()->flash('success','Ok');

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
