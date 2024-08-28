<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1','namespace'=>'Api'], function () {
    Route::get('test/onesignal','NotificationController@send');
    Route::post('/send-oneSignal-notifications', 'NotificationController@sendNotifications');
    Route::post('/connecter', 'UserController@connecter');
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');
    Route::post('/save', 'UserController@updateUser');
    Route::post('/account/delete', 'UserController@deleteAccount');
    Route::get('/category/{id}','FournisseurController@getCategory');
    Route::get('/order/{id}/{fournisseur_id}','OrderController@getById');
    Route::post('/order','OrderController@store');
    Route::get('/home','CategoryController@index');
    Route::get('category/{id}','CategoryController@getCategory');
    Route::get('subcategory/{id}','CategoryController@getSubCategory');
    Route::get('/clients','SuiviController@getClients');
    Route::get('/factures-by-client/{id}','SuiviController@getFacturesByClient');
    Route::get('/suivi/facture/paiements/{id}','SuiviController@getPaiementsFacture');
    Route::get('/suivi/facture/{id}','SuiviController@getFacture');
    Route::post('/suivi/facture/save','SuiviController@saveFacture');
    Route::get('/suivi/avoir/paiements/{id}','SuiviController@getPaiementsAvoir');
    Route::get('/relances/{echeance_id}/{canal_id}/{etape_id}','ActionController@getRelances');
    Route::get('/kpi/debiteurs','KpiController@getDebiteurs');
    Route::get('/kpi/unpaid_coming','KpiController@getUnpaidAndComing');
    Route::get('/kpi/ba','KpiController@getBalanceAgee');
    Route::get('/kpi/fvp','KpiController@getFacturationVsPaiement');
    Route::get('/kpi/nb-relances','KpiController@getRelances');
    Route::get('/kpi/creances-profils','KpiController@getCreancesByProfil');
    Route::get('/kpi/litiges','KpiController@getLitiges');
    Route::get('/kpi/dso','KpiController@getDso');
    Route::get('/kpi/risk','KpiController@getRisk');
});


Route::group(['prefix' => 'ic4a'], function () {
    Route::post('/seeds/podcasts', function(){
        $data = request()->all();
       // dd(request()->file_fr);
        //$seed = Seed::find($request->seed_id);
        $token = $data['token'];
        $resp = ['token'=>$data['token']];
        if(request()->file_fr){
			$file = request()->file_fr;
			$ext = $file->getClientOriginalExtension();
			$arr_ext = array('mp3');
			if(in_array($ext,$arr_ext)) {
				if(!file_exists(public_path('podcasts/seeds/fr')))
					mkdir(public_path('podcasts/seeds/fr'),0777,true);
				$file->move(public_path('podcasts/seeds/fr'),$token.'.'.$ext);
				$resp['fr']='podcasts/seeds/fr/'.$token.'.'.$ext;
			}else{
				//$request->session()->flash('danger','L\'extension de votre fichier audio en francais n\'est pas correcte !!!');
				return response()->json("Erreur de l'audio en francais",500);
			}

		}
        if(request()->file_en){
			$file = request()->file_en;
			$ext = $file->getClientOriginalExtension();
			$arr_ext = array('mp3');
			if(in_array($ext,$arr_ext)) {
				if(!file_exists(public_path('podcasts/seeds/en')))
					mkdir(public_path('podcasts/seeds/en'),0777,true);
				$file->move(public_path('podcasts/seeds/en'),$token.'.'.$ext);
				$resp['en']='podcasts/seeds/en/'.$token.'.'.$ext;
			}else{
				//$request->session()->flash('danger','L\'extension de votre fichier audio en anglais n\'est pas correcte !!!');
				return response()->json("Erreur de l'audio en anglaise",500);
			}

		}

		if(request()->file_locale){
			$file = request()->file_locale;
			$ext = $file->getClientOriginalExtension();
			$arr_ext = array('mp3');
			if(in_array($ext,$arr_ext)) {
				if(!file_exists(public_path('podcasts/seeds/locale')))
					mkdir(public_path('podcasts/seeds/locale'),0777,true);
				$file->move(public_path('podcasts/seeds/locale'),$token.'.'.$ext);
				$resp['locale']='podcasts/seeds/locale/'.$token.'.'.$ext;
			}else{
				//$request->session()->flash('danger','L\'extension de votre fichier audio en anglais n\'est pas correcte !!!');
				return response()->json("Erreur de l'audio en langue locale",500);
			}

		}
        return response()->json($resp);
    });

    Route::post('/preseeds/podcasts', function(){
        $data = request()->all();
       // dd(request()->file_fr);
        //$seed = Seed::find($request->seed_id);
        $token = $data['token'];
        $resp = ['token'=>$data['token']];
        if(request()->file_fr){
			$file = request()->file_fr;
			$ext = $file->getClientOriginalExtension();
			$arr_ext = array('mp3');
			if(in_array($ext,$arr_ext)) {
				if(!file_exists(public_path('podcasts/preseeds/fr')))
					mkdir(public_path('podcasts/preseeds/fr'),0777,true);
				$file->move(public_path('podcasts/preseeds/fr'),$token.'.'.$ext);
				$resp['fr']='podcasts/preseeds/fr/'.$token.'.'.$ext;
			}else{
				//$request->session()->flash('danger','L\'extension de votre fichier audio en francais n\'est pas correcte !!!');
				return response()->json("Erreur de l'audio en francais",500);
			}

		}
        if(request()->file_en){
			$file = request()->file_en;
			$ext = $file->getClientOriginalExtension();
			$arr_ext = array('mp3');
			if(in_array($ext,$arr_ext)) {
				if(!file_exists(public_path('podcasts/preseeds/en')))
					mkdir(public_path('podcasts/preseeds/en'),0777,true);
				$file->move(public_path('podcasts/preseeds/en'),$token.'.'.$ext);
				$resp['en']='podcasts/preseeds/en/'.$token.'.'.$ext;
			}else{
				//$request->session()->flash('danger','L\'extension de votre fichier audio en anglais n\'est pas correcte !!!');
				return response()->json("Erreur de l'audio en anglaise",500);
			}

		}
		if(request()->file_locale){
			$file = request()->file_locale;
			$ext = $file->getClientOriginalExtension();
			$arr_ext = array('mp3');
			if(in_array($ext,$arr_ext)) {
				if(!file_exists(public_path('podcasts/preseeds/locale')))
					mkdir(public_path('podcasts/preseeds/locale'),0777,true);
				$file->move(public_path('podcasts/preseeds/locale'),$token.'.'.$ext);
				$resp['locale']='podcasts/preseeds/locale/'.$token.'.'.$ext;
			}else{
				//$request->session()->flash('danger','L\'extension de votre fichier audio en anglais n\'est pas correcte !!!');
				return response()->json("Erreur de l'audio en langue locale",500);
			}

		}
        return response()->json($resp);
    });

	Route::post('/pmes/podcasts', function(){
        $data = request()->all();
       // dd(request()->file_fr);
        //$seed = Seed::find($request->seed_id);
        $token = $data['token'];
        $resp = ['token'=>$data['token']];
        if(request()->file_fr){
			$file = request()->file_fr;
			$ext = $file->getClientOriginalExtension();
			$arr_ext = array('mp3');
			if(in_array($ext,$arr_ext)) {
				if(!file_exists(public_path('podcasts/pmes/fr')))
					mkdir(public_path('podcasts/pmes/fr'),0777,true);
				$file->move(public_path('podcasts/pmes/fr'),$token.'.'.$ext);
				$resp['fr']='podcasts/pmes/fr/'.$token.'.'.$ext;
			}else{
				//$request->session()->flash('danger','L\'extension de votre fichier audio en francais n\'est pas correcte !!!');
				return response()->json("Erreur de l'audio en francais",500);
			}

		}
        if(request()->file_en){
			$file = request()->file_en;
			$ext = $file->getClientOriginalExtension();
			$arr_ext = array('mp3');
			if(in_array($ext,$arr_ext)) {
				if(!file_exists(public_path('podcasts/pmes/en')))
					mkdir(public_path('podcasts/pmes/en'),0777,true);
				$file->move(public_path('podcasts/pmes/en'),$token.'.'.$ext);
				$resp['en']='podcasts/pmes/en/'.$token.'.'.$ext;
			}else{
				//$request->session()->flash('danger','L\'extension de votre fichier audio en anglais n\'est pas correcte !!!');
				return response()->json("Erreur de l'audio en anglaise",500);
			}

		}
		if(request()->file_locale){
			$file = request()->file_locale;
			$ext = $file->getClientOriginalExtension();
			$arr_ext = array('mp3');
			if(in_array($ext,$arr_ext)) {
				if(!file_exists(public_path('podcasts/pmes/locale')))
					mkdir(public_path('podcasts/pmes/locale'),0777,true);
				$file->move(public_path('podcasts/pmes/locale'),$token.'.'.$ext);
				$resp['locale']='podcasts/pmes/locale/'.$token.'.'.$ext;
			}else{
				//$request->session()->flash('danger','L\'extension de votre fichier audio en anglais n\'est pas correcte !!!');
				return response()->json("Erreur de l'audio en langue locale",500);
			}

		}
        return response()->json($resp);
    });
});
