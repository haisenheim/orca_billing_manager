<?php

namespace App\Http\Controllers\Marchand;

use App\Exports\BonAchatExport;
use App\Http\Controllers\Controller;
use App\Models\BonAchat;
use App\Models\Carte;
use App\Models\Facture;
use App\Models\Fournisseur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FacturationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('/Marchand/Clients/index');
    }

    public function exportBonAchatByDate($dt){
        $bons = BonAchat::where('expired_at',$dt)->get();


        return Excel::download(new BonAchatExport($bons),'Bons_achat-'.date('d-m-Y').'.xlsx');
    }

    public function getBonAchat($token){
        $bon = BonAchat::where('token',$token)->first();
        QrCode::size(200)->generate($token, public_path('qrcodes/qrcode.svg'));
        $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
        //$pdf = Pdf::loadView('exports.pdf.bon', compact('bon','fournisseur','qrcode'));
        //return $pdf->stream('bon_'.$bon->name.'.pdf');
        return view('Marchand.Facturation.bon')->with(compact('bon','fournisseur'));
    }

    public function ExportPreviewBonAchat(){
        $data = [];
        $cartes = Carte::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        //dd($cartes);
        foreach($cartes as $carte){
          // dd($this->division($carte->cashback,1000));
          $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
          $nb = floor($carte->montant/1000);
            if($carte->montant>= $fournisseur->min_bon_achat){
                //dd($this->division($carte->cashback,1000));
                //dd(($carte->montant - $carte->montant % 35000)/35000);
                $nb = (int)floor($carte->montant - ($carte->montant % 5000));
                $reste = $carte->montant - $nb;
                $data[] = ['carte'=>$carte,'nb'=>$nb,'reste'=>$reste];
            }
        }
        return Excel::download(new BonAchatExport($data),'Bons_achats'.date('d-m-Y').'.xlsx');
    }

    public function getFacture($token){
        $facture = Facture::where('token',$token)->first();
        return view('/Marchand/Facturation/facture')->with(compact('facture'));
    }

    private function division($a,$b){
       return ($a - $a%$b)/$b;
    }

    public function previewBon(){
        $data = [];
        $cartes = Carte::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        //dd($cartes);
        foreach($cartes as $carte){
          // dd($this->division($carte->cashback,1000));
          $nb = floor($carte->montant/1000);
          $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
            if($carte->montant >= $fournisseur->min_bon_achat){
                //dd($this->division($carte->cashback,1000));
                //dd(($carte->montant - $carte->montant % 35000)/35000);
                $nb = (int)floor($carte->montant - ($carte->montant % 5000));
                $reste = $carte->montant - $nb;
                $data[] = ['carte'=>$carte,'nb'=>$nb,'reste'=>$reste];
            }
        }
        $dt = Carbon::today()->addDays(30);
        return view('Marchand/Facturation/preview_bons')->with(compact('data','dt'));
    }

    public function genererBon(){
        $data = [];
        $cartes = Carte::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        //dd($cartes);
        $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
        foreach($cartes as $carte){
          // dd($this->division($carte->cashback,1000));
          $fournisseur = Fournisseur::find(auth()->user()->fournisseur_id);
          $nb = floor($carte->montant/1000);
            if($carte->montant >= $fournisseur->min_bon_achat){
                $nb = (int)floor($carte->montant - ($carte->montant % 5000));
                $reste = $carte->montant - $nb;
                $bon = BonAchat::create([
                    'carte_id'=>$carte->id,
                    'client_id'=>$carte->client_id,
                    'fournisseur_id'=>$carte->fournisseur_id,
                    'token'=>sha1(now()->timestamp . $carte->id),
                    'name'=>date('yms').($carte->id%255).($carte->client_id%255).$carte->fournisseur_id,
                    'montant'=>$nb,
                    'semaine'=>date('W'),
                    'mois'=>date('m'),
                    'annee'=>date('Y'),
                    'expired_at'=>Carbon::today()->addDays(30),
                ]);
                if($bon){
                    $carte->montant = $reste;
                    $carte->save();
                }
                $data[] = $bon;

            }
        }

        //dd($data);
        $dt = Carbon::today()->addDays(30);

        return view('Marchand/Facturation/bons')->with(compact('data','dt'));
    }

    public function getAllBonAchat(){
        $bons = BonAchat::where('fournisseur_id',auth()->user()->fournisseur_id)->get();
        return view('Marchand/Facturation/all_bons')->with(compact('bons',));
    }

    public function validateBonAchat($token){
        $bon = BonAchat::where('token',$token)->first();
        $bon->validated_at = new \DateTime();
        $bon->validated_by = auth()->user()->id;
        $bon->save();
         return redirect()->back();
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
