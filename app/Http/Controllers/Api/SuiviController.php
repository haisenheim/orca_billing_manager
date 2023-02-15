<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ExtendedController;
use App\Http\Resources\EcheanceResource;
use App\Http\Resources\FactureDetailsResource;
use App\Http\Resources\FactureResource;
use App\Http\Resources\KeyValueResource;
use App\Http\Resources\PaiementResource;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Echeance;
use App\Models\Facture;
use App\Models\Paiement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuiviController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::all();
        return response()->json('clients');
       // return view('/Admin/Suivi/index')->with(compact('clients','profils','postes'));
    }

    public function getClients(Request $request){
        $value = $request->q;
        $clients = Client::where('name','like','%'.$value.'%')->get();
        return response()->json(KeyValueResource::collection($clients));
    }

    public function getClient($id){
        $client = Client::find($id);
        return view('/Admin/Suivi/client')->with(compact('client'));
    }



    public function addClient(Request $request){


        if(!$request->type_id){
            $data = $request->except('type_id');
            $client = Client::create($data);
        }
        else{
            $data = $request->except('type_id','ln1','fn1','phone1','email1','poste_1_id','ln2','fn2','phone2','email2','poste_2_id');
            $client = Client::create($data);
            $contact = new Contact();
            $contact->firstname = $request->fn1;
            $contact->lastname = $request->ln1;
            $contact->phone = $request->phone1;
            $contact->email = $request->email1;
            $contact->poste_id = $request->poste_1_id;
            $contact->client_id = $client->id;
            $contact->save();
            if($request->ln2 && $request->poste_2_id){
                $contact = new Contact();
                $contact->firstname = $request->fn2;
                $contact->lastname = $request->ln2;
                $contact->phone = $request->phone2;
                $contact->email = $request->email2;
                $contact->poste_id = $request->poste_2_id;
                $contact->client_id = $client->id;
                $contact->save();
            }
        }
        $client->code = str_pad($client->id,5,'A0',STR_PAD_BOTH);
        $client->save();
        return redirect()->back();
    }

    public function getPaiementsFacture($id){
        $paiements = Paiement::where('facture_id',$id)->get();
        $echances = Echeance::where('facture_id',$id)->get();
        return response()->json(['paiements'=>PaiementResource::collection($paiements),'echeances'=>EcheanceResource::collection($echances)]);
    }

    public function saveFacture(Request $request){
        $lignes = $request->echeances;
        $id = $request->id;
        $echeances = Echeance::where('facture_id',$id)->get();
        $ids=[];
        foreach($echeances as $ech){
            $ids[] = $ech->id;
        }
        for($i=0;$i<count($lignes);$i++){
            $elt = $lignes[$i];
            if($elt['id']==0){
                Echeance::create(['facture_id'=>$id,'dt'=>$elt['date'],'montant'=>$elt['montant']]);
            }else{
                Echeance::updateOrCreate(['id'=>$elt['id']],['dt'=>$elt['date'],'montant'=>$elt['montant']]);
            }

           // $echeance = $echeances->where('id',$elt['id'])->first();
           /* if($echeance){
                $echeance->dt = $elt['date'];
                $echeance->montant = $elt['montant'];
                $echeance->save();
            }else{
                if($elt['id']==0){
                    Echeance::create(['facture_id'=>$id,'dt'=>$elt['date'],'montant'=>$elt['montant']]);
                }
            }
            */
        }

        return response()->json('ok');
    }

    public function getFacture($id){
        //$paiements = Paiement::where('facture_id',$id)->get();
        //$echances = Echeance::where('facture_id',$id)->get();
        $facture = Facture::find($id);
        return response()->json(new FactureDetailsResource($facture));
    }

    public function getPaiementsAvoir($id){
        $paiements = Paiement::where('avoir_id',$id)->get();
        return response()->json(['paiements'=>PaiementResource::collection($paiements)]);
    }

    public function getFacturesByClient($id){
        $factures = Facture::where('client_id',$id)->get();
        return response()->json(FactureResource::collection($factures));
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
       /*  $data = $request->except('image');
        $image = $request->image;
        $data['image'] = $this->entityImgCreate($image,'article',time().auth()->user()->id);
        $data['token'] = sha1(time().auth()->user()->id);
        $promotion = Article::create($data);
        return redirect()->back(); */
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
