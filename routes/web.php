<?php


use App\Models\Article;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/phpinfo',function(){

    phpinfo();

});

Route::get('/', function () {
	return view('auth/login');
});

Route::get('/policy',function(){
    return view('policy');
});

Route::get('/ip', function () {
	dd(request());
});




Route::get('/articles/normalize', function () {
	$articles = Article::all();
    foreach($articles as $article){
        if($article->price==0){
            $article->is_active = 0;
        }else{
            $article->is_active = 1;
        }
        $article->save();
    }
    return back();
});


Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');





Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin','check.active'])
    ->name('admin.')
    ->group(function(){
        Route::get('kpi','DashboardController@getKpi');
        Route::get('/dashboard','DashboardController');
        Route::resource('/articles', 'ArticleController');
        Route::resource('/clients', 'ClientController');
        Route::resource('/categories', 'CategoryController');
        Route::resource('/orders', 'OrderController');
        Route::get('/compte', 'CompteController@index');
        Route::get('/compte/{token}', 'CompteController@show');
        Route::get('/compte/reset-password/{token}', 'CompteController@resetPassword');
        Route::get('/compte/carte/{token}', 'CompteController@getCard');
        Route::get('/compte/enable/{id}', 'CompteController@enable');
        Route::get('/compte/disable/{id}', 'CompteController@disable');
        Route::get('/parametres','ParametreController@index');
        Route::get('/parametres/profils','ParametreController@getProfils');
        Route::post('/parametres/profils','ParametreController@storeProfil');
        Route::get('/parametres/scenarios','ParametreController@getScenarios');
        Route::get('/parametres/modeles','ParametreController@getModeles');
        Route::get('/parametres/modeles/emails','ParametreController@getModelesEmails');
        Route::get('/parametres/modeles/sms','ParametreController@getModelesSms');
        Route::get('/parametres/modeles/courriers','ParametreController@getModelesCourriers');
        Route::post('/parametres/modeles','ParametreController@storeModele');
        Route::post('/parametres/scenario/etape','ParametreController@storeEtape');
        Route::get('/parametres/comptes','ParametreController@getComptes');
        Route::post('/parametres/compte','ParametreController@saveCompte');
        Route::get('/parametres/compte/{id}','ParametreController@getCompte');
        Route::get('parametres/profil/add','ParametreController@createProfil');
        Route::get('parametres/scenario/add','ParametreController@createScenario');
        Route::get('parametres/scenario/{id}','ParametreController@getScenario');
        Route::post('parametres/scenario','ParametreController@storeScenario');
        Route::get('parametres/modele/add','ParametreController@createModele');
        Route::get('parametres/canal/modeles/{canal_id}/{profil_id}','ParametreController@getModelesByProfil');
        Route::post('/parametres/entreprise','ParametreController@saveProfile');

        # Gestions des actions

        Route::get('/actions','ActionController@index');
        Route::get('/actions/emails','ActionController@getEmails');
        Route::get('/actions/courrier','ActionController@getCourrier');
        Route::get('/actions/sms','ActionController@getSms');
        Route::get('/actions/appels','ActionController@getAppels');
        Route::get('/actions/courriers','ActionController@getCourriels');
        Route::post('/actions/relances/email','ActionController@relanceEmail');
        Route::post('/actions/relances/appel','ActionController@relanceAppel');
        Route::post('/actions/relances/sms','ActionController@relanceSms');
        Route::get('/actions/sms/batch','ActionController@relanceBatchSms');


        #Gestion du suivi
        Route::get('/suivi','SuiviController@index');
        Route::get('/suivi/client/{id}','SuiviController@getClient');
        Route::post('/suivi/client/add','SuiviController@addClient');
        Route::post('/suivi/facture/add','SuiviController@addFacture');
        Route::get('/suivi/facture/{id}','SuiviController@getFcature');
        Route::post('suivi/facture/add/echeance/mt','SuiviController@addFactureEcheanceMt');
        Route::post('/suivi/paiement/add','SuiviController@addPaiement');
        Route::post('/suivi/facture/echeance/non','SuiviController@addFactureEcheanceNon');
        Route::post('/suivi/avoir/add','SuiviController@addAvoir');
        Route::get('/suivi/transactions/{client_id}','SuiviController@getTransactions');
    });



Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
