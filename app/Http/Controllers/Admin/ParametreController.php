<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ExtendedController;
use App\Models\Canal;
use App\Models\Entreprise;
use App\Models\Etape;
use App\Models\Habilitation;
use App\Models\Modele;
use App\Models\Poste;
use App\Models\Profil;
use App\Models\Scenario;
use App\User;
use Illuminate\Http\Request;

class ParametreController extends ExtendedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('/Admin/Parametres/index');
    }

    public function getProfils(){
        $profils = Profil::all();
        return view('/Admin/Parametres/profils')->with(compact('profils'));
    }

    public function getScenarios(){
        $scenarios = Scenario::all();
        $profils = Profil::all();
        return view('/Admin/Parametres/scenarios')->with(compact('scenarios','profils'));
    }

    public function getScenario($id){
        $scenario = Scenario::find($id);
        $postes = Poste::all();
        $canaux = Canal::all();
        return view('/Admin/Parametres/scenario')->with(compact('scenario','canaux','postes'));
    }

    public function storeEtape(Request $request){
        $etape = Etape::create($request->all());
        return redirect()->back();
    }

    public function getModelesByProfil($canal_id,$profil_id){
        $modeles = Modele::where('profil_id',$profil_id)->where('canal_id',$canal_id)->get();
        return response()->json($modeles);
    }

    public function storeScenario(Request $request){
        $scenario = Scenario::create($request->all());
        return redirect('/admin/parametres/scenario/'.$scenario->id);
    }

    public function getComptes(){
        $users = User::all();
        $entreprise = Entreprise::find(1);
        return view('/Admin/Parametres/comptes')->with(compact('entreprise','users'));
    }

    public function getCompte($id){
        if($id==0){
            $user = new User();
        return view('/Admin/Parametres/compte')->with(compact('user'));
        }
        $user = User::find($id);
        return view('/Admin/Parametres/compte')->with(compact('user'));
    }

    public function saveCompte(Request $request){

        $data = $request->except('password');
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        if(isset($request->apercu)){
            $data['apercu'] = 1;
        }else{
            $data['apercu'] = 0;
        }
        if(isset($request->suivi)){
            $data['suivi'] = 1;
        }else{
            $data['suivi'] = 0;
        }
        if(isset($request->actions)){
            $data['actions'] = 1;
        }else{
            $data['actions'] = 0;
        }
        if(isset($request->parametres)){
            $data['parametres'] = 1;
        }else{
            $data['parametres'] = 0;
        }
        if(isset($request->active)){
            $data['active'] = 1;
        }else{
            $data['active'] = 0;
        }
        $data['role_id'] = 1;
        $user = User::updateOrCreate(['id'=>$request->id],$data);
        return back();
    }

    public function getModeles(){
        $modeles = Modele::all();
        $sms = $modeles->where('canal_id',1);
        $emails = $modeles->where('canal_id',2);
        $courriers = $modeles->where('canal_id',4);

        $profils = Profil::all();
        return view('/Admin/Parametres/modeles/index')->with(compact('modeles','sms','emails','courriers','profils'));
    }

    public function getModelesEmails(){
        $modeles = Modele::all();
        $emails = $modeles->where('canal_id',2)->groupBy(function($item){
            return $item->profil->name;
        });
        return view('/Admin/Parametres/modeles/emails')->with(compact('emails'));
    }

    public function getModelesSms(){
        $modeles = Modele::all();
        $sms = $modeles->where('canal_id',1)->groupBy(function($item){
            return $item->profil->name;
        });
        //dd($sms);
        return view('/Admin/Parametres/modeles/sms')->with(compact('sms'));
    }

    public function getModelesCourriers(){
        $modeles = Modele::all();
        $courriers = $modeles->where('canal_id',4)->groupBy(function($item){
            return $item->profil->name;
        });
        return view('/Admin/Parametres/modeles/courriers')->with(compact('courriers'));
    }

    public function createProfil(){

        return view('/Admin/Parametres/profil');
    }

    public function storeProfil(Request $request){
        $data = $request->all();
        $profil = Profil::create($data);
        return redirect('/admin/parametres/profils');
    }

    public function createScenario(){
        $profils = Profil::all();
        return view('/Admin/Parametres/scenario')->with(compact('profils'));
    }

    public function createModele(){

        return view('/Admin/Parametres/modele');
    }

    public function storeModele(Request $request){
        $data = $request->except('files');
        $data['address'] = trim($data['address']);
        $profil = Modele::create($data);
        return redirect('/admin/parametres/modeles');
    }

    public function saveProfile(){

        $data = request()->except('image');
        Entreprise::updateOrCreate(['id'=>1],$data);
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
        $data = $request->except('image');
        $image = $request->image;
        $data['image'] = $this->entityImgCreate($image,'article',time().auth()->user()->id);
        $data['token'] = sha1(time().auth()->user()->id);

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
