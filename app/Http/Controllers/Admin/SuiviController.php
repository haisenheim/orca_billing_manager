<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ExtendedController;
use App\Models\Article;
use App\Models\Avoir;
use App\Models\Category;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Echeance;
use App\Models\Facture;
use App\Models\Mode;
use App\Models\Paiement;
use App\Models\Poste;
use App\Models\Profil;
use App\Models\Transaction;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
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
        $profils = Profil::all();
        $postes = Poste::all();
        $modes = Mode::all();
        return view('/Admin/Suivi/index')->with(compact('clients','profils','postes','modes'));
    }

    public function getClient($id){
        $client = Client::find($id);
        $modes = Mode::all();
        return view('/Admin/Suivi/client')->with(compact('client','modes'));
    }

    public function getTransactions($client_id)
    {
        //
        $transactions = Transaction::orderBy('created_at','DESC')->where('client_id',$client_id)->get();
        return view('/Admin/Suivi/transactions')->with(compact('transactions'));
    }

    public function addPaiement(Request $request){
        $data = $request->all();
        $facture = Facture::find($request->facture_id);
        $data['client_id'] = $facture->client_id;
        $data['user_id'] = auth()->user()->id;
        $paiement = Paiement::create($data);
        $paiement->name = str_pad($paiement->id.date('my'),8,'0P');
        $paiement->save();
        Transaction::create([
            'client_id'=>$facture->client_id,
            'paiement_id'=>$paiement->id,
            'montant'=>$paiement->montant,
            'token'=>sha1(time())
        ]);
        return redirect()->back();
    }

    public function addAvoir(Request $request){
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $paiement = Avoir::create($data);
        Transaction::create([
            'client_id'=>$paiement->client_id,
            'avoir_id'=>$paiement->id,
            'montant'=>$paiement->montant,
            'token'=>sha1(time())
        ]);
        return redirect()->back();
    }

    public function addFactureEcheanceNon(Request $request){
        $dt_bl = Carbon::parse($request->delivered_at);
        //dd($dt_bl);
        $facture = Facture::create([
            'delivered_at'=>$request->delivered_at,
            'montant'=>$request->montant,
            'client_id'=>$request->client_id,
            'user_id'=>auth()->user()->id,
        ]);
        $facture->name = str_pad($facture->id,6,"F0",STR_PAD_BOTH);
        $facture->save();

        $echeance = Echeance::create([
            'montant'=>$request->montant,
            'dt'=>$dt_bl->addDays($request->delai),
            'facture_id'=>$facture->id,
            'client_id'=>$request->client_id,
            'name'=>$facture->name,
        ]);
        Transaction::create([
            'client_id'=>$facture->client_id,
            'facture_id'=>$facture->id,
            'montant'=>$facture->montant,
            'token'=>sha1(time())
        ]);


        return response()->json('ok');
    }

    public function addFactureEcheanceMt(Request $request){
        $dt_bl = Carbon::parse($request->dt_bl);

        $facture = Facture::create([
            'delivered_at'=>$dt_bl,
            'montant'=>$request->montant,
            'client_id'=>$request->client_id,
            'user_id'=>auth()->user()->id,
            'numero'=>$request->facture_name,
        ]);
        $facture->name = str_pad($facture->id,6,"F0",STR_PAD_BOTH);
        $facture->save();
        $echeances = $request->echeances;
        for($i=0;$i<count($echeances);$i++){
            $echeance = Echeance::create([
                'montant'=>$echeances[$i]['mt'],
                'dt'=>$echeances[$i]['dt'],
                'facture_id'=>$facture->id,
                'client_id'=>$request->client_id,
                'name'=>$facture->name.$i,
            ]);
        }
        return response()->json('ok');
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

    public function getFacture($id){
        $facture = Facture::find($id);
        return view('/Admin/Suivi/facture')->with(compact('facture'));
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
