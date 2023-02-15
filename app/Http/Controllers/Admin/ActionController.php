<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ExtendedController;
use App\Mail\HelloEmail;
use App\Models\Article;
use App\Models\Etape;
use App\Models\Facture;
use App\Models\Relance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ActionController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // $echeances = Echeance::all();
        $factures = Facture::all();
        $today = Carbon::today();
        $data=[
            '1'=>0,
            '2'=>0,
            '3'=>0,
            '4'=>0
        ];
        foreach($factures as $facture){
            $soldee = $facture->encaissement>=$facture->montant;
            if(!$soldee){
                $echeances = $facture->echeances;
                foreach($echeances as $echeance){
                    $sold = $echeance->encaissement>= $echeance->montant;
                    //dd($sold);
                    if(!$sold){
                        $profil = $facture->client->profil;
                       // dd($profil);
                        if($profil){
                            $scenarios = $profil->scenarios;
                           // dd($scenarios);
                            foreach($scenarios as $scenario){
                                $etapes = $scenario->etapes;
                               // dd($etapes);
                                foreach($etapes as $etape){
                                    $date = Carbon::parse($echeance->dt)->addDays($etape->nb);
                                   // dd($today==$date);
                                    if($today==$date){
                                       // dd($today==$date);
                                        $data[$etape->canal_id] = $data[$etape->canal_id]+1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
       // dd($data);
        return view('/Admin/Actions/index')->with(compact('data'));
    }

    public function getEmails(){
        // $echeances = Echeance::all();
        $data = [];
        $factures = Facture::all();
        $today = Carbon::today();
        foreach($factures as $facture){
            $soldee = $facture->encaissement>=$facture->montant;
            if(!$soldee){
               // $relances = $relances->where('facture_id',$facture->id);
                $echeances = $facture->echeances;
                foreach($echeances as $echeance){
                    $sold = $echeance->encaissement>= $echeance->montant;
                    //dd($sold);
                    if(!$sold){
                        $profil = $facture->client->profil;
                       // dd($profil);
                        if($profil){
                            $scenarios = $profil->scenarios;
                           // dd($scenarios);
                            foreach($scenarios as $scenario){
                                $etapes = $scenario->etapes;
                               // dd($etapes);
                                foreach($etapes as $etape){
                                    $date = Carbon::parse($echeance->dt)->addDays($etape->nb);
                                   // dd($today==$date);
                                    if($today==$date){
                                        if($etape->canal_id == 2){
                                            $relances = Relance::where('canal_id',2)
                                            ->where('echeance_id',$echeance->id)
                                            ->get();
                                            $relance = $relances->where('etape_id',$etape->id)->first();
                                            $data[] = ['echeance'=>$echeance, 'etape'=>$etape,'relances'=>$relances];
                                            /* if(!$relance){
                                                $data[] = ['echeance'=>$echeance, 'etape'=>$etape,'relances'=>$relances];
                                            } */
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //dd($data);
        return view('Admin/Actions/emails')->with(compact('data'));
    }

    public function getAppels(){
        // $echeances = Echeance::all();
        $data = [];
        $factures = Facture::all();
        $today = Carbon::today();
        foreach($factures as $facture){
            $soldee = $facture->encaissement>=$facture->montant;
            if(!$soldee){
               // $relances = $relances->where('facture_id',$facture->id);
                $echeances = $facture->echeances;
                foreach($echeances as $echeance){
                    $sold = $echeance->encaissement>= $echeance->montant;
                    //dd($sold);
                    if(!$sold){
                        $profil = $facture->client->profil;
                       // dd($profil);
                        if($profil){
                            $scenarios = $profil->scenarios;
                           // dd($scenarios);
                            foreach($scenarios as $scenario){
                                $etapes = $scenario->etapes;
                               // dd($etapes);
                                foreach($etapes as $etape){
                                    $date = Carbon::parse($echeance->dt)->addDays($etape->nb);
                                   // dd($today==$date);
                                    if($today==$date){
                                        if($etape->canal_id == 3){
                                            $relances = Relance::where('canal_id',3)
                                            ->where('echeance_id',$echeance->id)
                                            ->get();
                                            $relance = $relances->where('etape_id',$etape->id)->first();
                                            $data[] = ['echeance'=>$echeance, 'etape'=>$etape,'relances'=>$relances];
                                            /* if(!$relance){
                                                $data[] = ['echeance'=>$echeance, 'etape'=>$etape,'relances'=>$relances];
                                            } */
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //dd($data);
        return view('Admin/Actions/appels')->with(compact('data'));
    }

    public function relanceEmail(Request $request){
       // dd($request->all());
        $data = $request->except('files');
        $data['canal_id'] = 2;
       // $etape = Etape::find($request->etape_id);
       Relance::create($data);
       /* Mail::send('emails.contact', ['body'=>request()->body], function ($m)  {
			$m->from('clementessomba@obac-alert.com', 'ici quelque chose');
			//$m->to('clementessomba@gmail.com')->subject("Prise de contact");
            $m->to('clementessomba@gmail.com')->subject('email de relance');
        });*/
       // Mail::to('clementessomba@gmail.com')->send(new HelloEmail);
        return redirect()->back();
    }

    public function relanceSms(Request $request){
         $data = $request->except('files');
         $data['canal_id'] = 1;

        Relance::create($data);
         return redirect()->back();
    }

    public function relanceBatchSms(){
        // $echeances = Echeance::all();
        $data = [];
        $factures = Facture::all();
        $today = Carbon::today();
        foreach($factures as $facture){
            $soldee = $facture->encaissement>=$facture->montant;
            if(!$soldee){
               // $relances = $relances->where('facture_id',$facture->id);
                $echeances = $facture->echeances;
                foreach($echeances as $echeance){
                    $sold = $echeance->encaissement>= $echeance->montant;
                    //dd($sold);
                    if(!$sold){
                        $profil = $facture->client->profil;
                       // dd($profil);
                        if($profil){
                            $scenarios = $profil->scenarios;
                           // dd($scenarios);
                            foreach($scenarios as $scenario){
                                $etapes = $scenario->etapes;
                               // dd($etapes);
                                foreach($etapes as $etape){
                                    $date = Carbon::parse($echeance->dt)->addDays($etape->nb);
                                   // dd($today==$date);
                                    if($today==$date){
                                        if($etape->canal_id == 1){
                                            $data[] = ['echeance'=>$echeance, 'etape'=>$etape];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach($data as $k){
            $echeance = $k['echeance'];
            $etape = $k['etape'];
            $text = $etape->modele->body;
            $tags = [
                    '@date_echeance'=>date_format($echeance->dt,'d/m/Y'),
                    '@montant_echeance'=>number_format($echeance->montant,0,',','.'),
                    '@date_facture'=>date_format($echeance->facture->delivered_at,'d/m/Y'),
                    '@montant_facture'=>number_format($echeance->facture->montant,0,',','.'),
                    '@num_facture'=>$echeance->facture->name,
            ];
            $repl = str_replace(array_keys($tags), array_values($tags),$text);
            Relance::create(['canal_id'=>1,'body'=>$repl,'echeance_id'=>$echeance->id,'etape_id'=>$etape->id,'facture_id'=>$echeance->facture_id,'client_id'=>$echeance->client_id]);
        }
        return back();
    }

    public function relanceAppel(Request $request){
         $data = $request->except('files');
         $data['canal_id'] = 3;
        Relance::create($data);
         return redirect()->back();
     }

     public function getCourrier(){
        // $echeances = Echeance::all();
        $data = [];
        $factures = Facture::all();
        $today = Carbon::today();
        foreach($factures as $facture){
            $soldee = $facture->encaissement>=$facture->montant;
            if(!$soldee){
               // $relances = $relances->where('facture_id',$facture->id);
                $echeances = $facture->echeances;
                foreach($echeances as $echeance){
                    $sold = $echeance->encaissement>= $echeance->montant;
                    //dd($sold);
                    if(!$sold){
                        $profil = $facture->client->profil;
                       // dd($profil);
                        if($profil){
                            $scenarios = $profil->scenarios;
                           // dd($scenarios);
                            foreach($scenarios as $scenario){
                                $etapes = $scenario->etapes;
                               // dd($etapes);
                                foreach($etapes as $etape){
                                    $date = Carbon::parse($echeance->dt)->addDays($etape->nb);
                                   // dd($today==$date);
                                    if($today==$date){
                                        if($etape->canal_id == 4){
                                            $relances = Relance::where('canal_id',4)
                                            ->where('echeance_id',$echeance->id)
                                            ->get();
                                            $relance = $relances->where('etape_id',$etape->id)->first();
                                            $data[] = ['echeance'=>$echeance, 'etape'=>$etape,'relances'=>$relances];
                                            /* if(!$relance){
                                                $data[] = ['echeance'=>$echeance, 'etape'=>$etape,'relances'=>$relances];
                                            } */
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //dd($data);
        return view('Admin/Actions/courrier')->with(compact('data'));
    }


    public function getSms(){
        // $echeances = Echeance::all();
        $data = [];
        $factures = Facture::all();
        $today = Carbon::today();
        foreach($factures as $facture){
            $soldee = $facture->encaissement>=$facture->montant;
            if(!$soldee){
               // $relances = $relances->where('facture_id',$facture->id);
                $echeances = $facture->echeances;
                foreach($echeances as $echeance){
                    $sold = $echeance->encaissement >= $echeance->montant;
                    //dd($sold);
                    if(!$sold){
                        $profil = $facture->client->profil;
                       // dd($profil);
                        if($profil){
                            $scenarios = $profil->scenarios;
                           // dd($scenarios);
                            foreach($scenarios as $scenario){
                                $etapes = $scenario->etapes;
                               // dd($etapes);
                                foreach($etapes as $etape){
                                    $date = Carbon::parse($echeance->dt)->addDays($etape->nb);
                                   // dd($today==$date);
                                    if($today==$date){
                                        if($etape->canal_id == 1){
                                            $relances = Relance::where('canal_id',1)
                                            ->where('echeance_id',$echeance->id)
                                            ->get();
                                            $relance = $relances->where('etape_id',$etape->id)->first();
                                           // $data[] = ['echeance'=>$echeance, 'etape'=>$etape,'relances'=>$relances];
                                             if(!$relance){
                                                $data[] = ['echeance'=>$echeance, 'etape'=>$etape,'relances'=>$relances];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //dd($data);
        return view('Admin/Actions/sms')->with(compact('data'));
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
        $data = $request->except('image');
        $image = $request->image;
        $data['image'] = $this->entityImgCreate($image,'article',time().auth()->user()->id);
        $data['token'] = sha1(time().auth()->user()->id);
        $promotion = Article::create($data);
        return redirect()->back();
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
