<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Dashboard\DebiteurResource;
use App\Models\Client;
use App\Models\Echeance;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Profil;
use Carbon\Carbon;

class KpiController extends Controller
{

    public function getDebiteurs(){
        $clients = Client::all();
        $data = [];
        foreach($clients as $client){
            if($client->montant_facture > $client->montant_paye){
                //$data[] = $client;
                $factures = $client->factures;
                $date = Carbon::today();
                foreach($factures as $facture){
                    if($facture->montant > $facture->encaissement){
                        if($date>$facture->delivered_at){
                            $date = $facture->delivered_at;
                        }
                    }
                }
                $interval = $date->diff(Carbon::today());
                $days = $interval->format('%a');
                $data[] = ['client'=>new DebiteurResource($client),'nb'=>$days];
            }
        }

       // $m = count($data[0])?$data[0]['nb']:null;
       // $sort=[];
        for($i=0;$i<count($data)-1;$i++){
          //$c = $data[$i]['nb'];
          for($j=$i+1;$j<count($data);$j++){
            if($data[$i]['nb']<$data[$j]['nb']){
                $tmp = $data[$i];
                $data[$i] = $data[$j];
                $data[$j] = $tmp;
            }
          }

        }

        return response()->json($data);
    }

    public function getUnpaidAndComing(){
        $clients = Client::all();
        $impayes = $clients->reduce(function($carry,$item){
            return $carry + $item->impaye;
        });

        $dus = $clients->reduce(function($carry,$item){
            return $carry + $item->montant_du;
        });

       // $coming = $dus?round(($dus - $impayes)*100/$dus,2):0;
       // $unpaid =  $dus?round(($impayes)*100/$dus,2):0;

        $echeances = Echeance::all();
        $reste = $echeances->reduce(function($carry, $echeance){
            return $carry + $echeance->reste;
        });

        $imp = $echeances->reduce(function($carry, $echeance){
            return $carry + $echeance->impaye;
        });

        $total = $reste + $imp;
        $r = $total?round(($reste)*100/$total,2):0;
        $i = $total?round(($imp)*100/$total,2):0;
        return response()->json([
            'unpaid'=>['per'=>$i,'qty'=>number_format($imp,0,',','.')],
            'coming'=>['per'=>$r,'qty'=>number_format($reste,0,',','.')],
            'total'=>number_format($total,0,',','.')]);
    }

    public function getBalanceAgee(){

       $echeances = Echeance::all();
       $tranches = ['t1'=>0,'t2'=>0,'t3'=>0,'t4'=>0];
       foreach($echeances as $echeance){
            $mt = $echeance->impaye;
            if($mt>0){
                $interval = $echeance->dt->diff(Carbon::today());
                    $days = $interval->format('%a');
                if($days>0 && $days<=30){
                    $tranches['t1'] = $tranches['t1'] + $mt;
                }
                if($days>30 && $days<=60){
                    $tranches['t2'] = $tranches['t2'] + $mt;
                }
                if($days>60 && $days<=90){
                    $tranches['t3'] = $tranches['t3'] + $mt;
                }
                if($days>90){
                    $tranches['t4'] = $tranches['t4'] + $mt;
                }
            }
       }

       return response()->json($tranches);

     }

     public function getFacturationVsPaiement(){
        $today = Carbon::today();
       // $date6 = $today->subMonths(6);
       // dd($date6->format('d-m-Y'));
        $data = [];
        for($i=6;$i>0;$i--){
            $clone = $today->clone();
            $date = $clone->subMonths($i);
            //dd($date->format('d-m-Y'));
            $from = $clone->clone()->firstOfMonth();
            //dd($from->format('d-m-Y'));
            $to = $clone->clone()->lastOfMonth();
            $factures = Facture::whereBetween('delivered_at',[$from->format('Y-m-d'),$to->format('Y-m-d')])->get();
            //dd($factures);
            $ftotal = $factures->reduce(function($carry,$item){
                return $carry + $item->montant;
            });
           // $paiements = Paiement::where('done_at','>=','2022-05-01')->where('done_at','<=','2022-05-31')->get();
           $paiements = Paiement::where('done_at','>=',$from->format('Y-m-d'))->where('done_at','<=',$to->format('Y-m-d'))->get();
           //dd($paiements);
            $ptotal = $paiements->reduce(function($carry,$item){
                return $carry + $item->montant;
            });
            //dd($ptotal);
            $data['m'.$i] = [
                                'f'=>$ftotal,
                                'p'=>$ptotal,
                                'name'=>$date->translatedFormat('M'),
                                'from'=>$from->format('d-m-Y'),
                                'to'=>$to->format('d-m-Y')
                            ];
        }
        return response()->json($data);
     }


     public function getCreancesByProfil(){
        $echeances = Echeance::all();
        $data = [];
        $profils = Profil::all();
        foreach($profils as $prof){
            $data[$prof->id] = ['name'=>$prof->name,'color'=>$prof->color,'montant'=>0,'id'=>$prof->id];
        }
        foreach($echeances as $echeance){
            $reste = $echeance->restetotal;
            if($reste>0){
                if($echeance->facture){
                    if($echeance->facture->client){
                        $p= $echeance->facture->client->profil;
                        $data[$p->id]['montant'] = $data[$p->id]['montant'] + round($reste);
                    }
                }

            }
        }

        return response()->json(array_values($data));
     }

     public function getRelances(){
        $factures = Facture::all();
        $today = Carbon::today();

        $nb = 0;
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
                                        $nb = $nb + 1;
                                       // dd($today==$date);
                                       // $data[$etape->canal_id] = $data[$etape->canal_id]+1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return response()->json($nb);
     }

     public function getLitiges(){
        $echeances = Echeance::all();

        $somme = 0;
        $clients = [];
        foreach($echeances as $echeance){
            $reste = $echeance->impaye;
            if($reste>0){
                $clients[$echeance->client_id] =1;
                $somme = $somme + $echeance->montant;
            }
        }

        return response()->json(['nb'=>count($clients),'montant'=>number_format($somme,0,',','.')]);
     }

     public function getDso(){
        $echeances = Echeance::all();
        $today = Carbon::today();
        $data = [];
        $creances = $echeances->filter(function($item){
            return $item->restetotal<=0;
        });
        $crs = [];
        for($i=5;$i>=0;$i--){
            $clone = $today->clone();
            $date = $clone->subMonths($i);
            $from = $clone->clone()->firstOfMonth();
            $to = $clone->clone()->lastOfMonth();
           // $echeances = $echeances->whereBetween('created_at',[$from->format('Y-m-d'),$to->format('Y-m-d')])->get();
            //$factures = Facture::whereBetween('delivered_at',[$from->format('Y-m-d'),$to->format('Y-m-d')])->get();
           // dd($date);
            $all=[];
            $total = 0;
            foreach($creances as $creance){
                $lastp = $creance->paiements->last();
                if($lastp){
                    $done_at = $lastp->done_at;

                    //dd($date);
                    if(($lastp->done_at>=$from->format('Y-m-d')) && ($lastp->done_at<=$to->format('Y-m-d'))){
                        $interval = $done_at->diff($creance->created_at);
                        $days = $interval->format('%a');
                        $total = $total + $days;
                        $all[] = $creance;
                    /* $crs[$i]['creances'][] = [
                            'creance'=>$creance,
                            'nb'=>$days,
                        ]; */
                    }
                }

            }
            $avg = count($all)?round($total/count($all)):0;
            $crs[$i] =[
                'name'=>$date->translatedFormat('M'),
                'from'=>$from->format('d-m-Y'),
                'to'=>$to->format('d-m-Y'),
                'days'=>$total,
                'nb'=>count($all),
                'dso'=>$avg,
                'color'=>$i==0?'#66BB66':'#ccc'
            ];

        }
        return response()->json($crs);
     }

     public function getRisk(){
        $today = Carbon::today();
        $data = [];
        for($i=3;$i>=0;$i--){
            $k = $i+3;
            $clone = $today->clone();
            $date = $clone->subMonths($k);
            $cdt = $today->clone()->subMonths($i);
            $echeances_old = Echeance::where('dt','<=',$date)->get();
            $impayes = $echeances_old->filter(function($item){
                return $item->restetotal > $item->encaissement;
            });
            $echeances_current = Echeance::where('dt','<=',$cdt)->get();
            $co = $impayes->count();
            $cc = $echeances_current->count();
            $p = $cc?round($co*100/$cc,2):0;
            $data[$i] = [
                    'name'=>$cdt->translatedFormat('M'),
                    'per'=>$p,
                    'color'=>$i==0?'#ee4444':'#ccc'
                ];
        }

        return response()->json($data);
     }


    }
