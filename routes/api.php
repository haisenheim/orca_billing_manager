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
