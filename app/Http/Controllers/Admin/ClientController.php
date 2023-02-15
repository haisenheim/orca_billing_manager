<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::orderBy('created_at','DESC')->get();
        return view('/Admin/Clients/index')->with(compact('clients'));
    }


    public function getTransactions($client_id)
    {
        //
        $transactions = Transaction::orderBy('created_at','DESC')->where('client_id',$client_id)->get();
        return view('/Admin/Clients/transactions')->with(compact('transactions'));
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
