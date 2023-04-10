
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3><i class="material-icons">verified_user</i> SUIVI</h3>
    <div class="mb-1 pr-2" style="display: flex; justify-content: end">

        <div class="mr-4">
            <a href="#" data-target="#importModal" data-toggle="modal" class="btn btn-sm btn-outline-black"><i class="fa fa-download"></i>Importer factures</a>
        </div>
        <div class="mr-2">
            <a href="#" data-target="#addPaiementModal" data-toggle="modal" class="btn btn-sm btn-black"><i class="fa fa-coins"></i> Ajouter un paiement</a>
        </div>
    </div>
    <div id="suivi" style="height: 500px; display:flex; justify-content: space-between" class="container flex-column pl-5 pr-5 ml-3">
        <div class="table-responsive" style="">
            <table class="table table-sm table-hover table-striped table-header-dark data-table">
                <thead>
                    <tr>
                        <td id="search-input">

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <th>Id Client</th>
                        <th>Client</th>
                        <th>Montant facturé</th>
                        <th>Montant payé</th>
                        <th>Montant dû</th>
                        <th>Montant impayé</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                    <tr class="tr-click" data-id="{{ $client->id }}" role="button">
                        <td><span><i style="color: {{ $client->profil->color }}" class="fa fa-dot-circle"></i></span></td>
                        <td>{{ $client->code }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ number_format($client->montant_facture,0,',','.') }}</td>
                        <td>{{ number_format($client->montant_paye,0,',','.') }}</td>
                        <td>{{ number_format($client->montant_du,0,',','.') }}</td>
                        <td class="text-danger">{{ number_format($client->impaye,0,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="display: flex; justify-content: end;">
            <div>
                <a data-toggle="modal" data-target="#addClientModal" href="#" class="btn btn-sm btn-outline-black"><i class="fa fa-plus"></i> Ajouter un client</a>
            </div>
            <div class="ml-2">
                <a data-toggle="modal" data-target="#addFactureModal" href="#" class="btn btn-sm btn-outline-black"><i class="fa fa-plus"></i> Ajouter une facture</a>
            </div>
        </div>
        <!---
        <hr>
        <div style="margin-left:20px">
            <table id="jqGrid"></table>
            <div id="jqGridPager"></div>
        </div>
        --->
    </div>
    </div>
  </div>

  <style>
    .table-header-dark>thead>tr>th{
        background-color: #333333;
        color: #ffffff;
    }
    table.table-sm tr>td{
        padding: 0.2rem;
        font-size: 0.85rem;
    }
    .btn-outline-black {
        color: #333333;
        border-color: #333333;
        }
    .btn-outline-black:hover {
        color: #ffffff;
        background-color: #222222;
        }
  </style>

<div class="modal fade" id="addPaiementModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Entrer un paiement</h5>
            </div>
            <div class="modal-body">
                <div style="display: flex; justify-content: space-around" class="container">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" value="1" id="radio_client" name="optradio" value="option1" checked>Par Client
                        <label class="form-check-label" for="radio1"></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio_facture" name="optradio" value="2">Par Facture
                        <label class="form-check-label" for="radio2"></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="radio_montant" value="3" name="optradio">Par montant
                        <label class="form-check-label"></label>
                    </div>
                </div>
                <div id="paiement_content" class="content">
                    <div style="" id="content_client">
                        <div class="form-group">
                            <select class="form-control basicAutoSelect" id="_client_id" name="_client_id"
                            placeholder="Choisir un client..."
                            data-url="/api/v1/clients" autocomplete="off"></select>
                        </div>
                        <div class="table-responsive">
                            <table id="t_factures" class="table-sm table-striped table">
                                <thead class="table-dark">
                                    <th>#</th>
                                    <th>&numero; Facture</th>
                                    <th>Montant</th>
                                    <th>Encaissements</th>
                                    <th>Solde</th>
                                    <th>Date BL</th>
                                    <th></th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="importModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Importer vos factures</h5>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p class="text-lg"><i>Icon</i></p>
                    <p>Faites glisser le fichier ici ou cliquez et parcourez</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addFactureModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Nouvelle Facture</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-sm-12">
                            <div class="form-group">
                                <select class="form-control basicAutoSelect eventsAutoComplete" id="my_clients" name="client_id"
                                placeholder="Choisir un client..."
                                data-url="/api/v1/clients" autocomplete="off"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label for="">MONTANT</label>
                                <input type="number" name="montant" id="montant" placeholder="Saisir le montant..." class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">DATE DU BL</label>
                                <input type="date" name="dt_bl" id="dt_bl" class="form-control">
                            </div>
                        </div>
                    </div>
                    <fieldset>
                        <legend>Fixer un echeancier ?</legend>
                        <div class="form-group">
                             <div class="form-check">
                                <input class="form-check-input" type="radio" id="non" value=1 name="echeance_radio">
                                <label class="form-check-label">NON</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" id="oui" type="radio" value=2 name="echeance_radio">
                                <label class="form-check-label">OUI</label>
                              </div>
                        </div>
                        <div class="form-group div-ech" id="div-non">
                            <label for="">Fixer le delai de paiement</label>
                            <input type="number" name="delai" class="form-control" id="delai">
                            <button class="btn btn-sm btn-black" id="btn-non-save">Enregistrer</button>
                        </div>
                        <div class="container div-ech" id="div-oui">
                            <div style="">

                                <div>
                                    <ul style="margin:0; display:flex; justify-content: space-between;" class="nav nav-tabs content-submenu" id="custom-tabs" role="tablist">
                                        <li class="nav-item">
                                          <a class="nav-link active" id="custom-tabs-tranche-tab" data-toggle="pill" href="#custom-tabs-tous" role="tab" aria-controls="custom-tabs-tous" aria-selected="true">Par montant</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link" id="custom-tabs-percent-tab" data-toggle="pill" href="#custom-tabs-bienvenu" role="tab" aria-controls="custom-tabs-bienvenu" aria-selected="false">Par %</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                    <div class="tab-content echeancier" id="custom-tabs-two-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-tous" role="tabpanel" aria-labelledby="custom-tabs-tous">
                                            <div class="row">
                                                <div class="col-md-5 col-sm-2">
                                                    <div class="form-group">
                                                        <label for="">MONTANT A PAYER</label>
                                                        <input type="number" class="form-control" value="0" id="mt">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-2">
                                                    <div class="form-group">
                                                        <label for="">DATE</label>
                                                        <input type="date" class="form-control" value="0" id="mt_dt">
                                                    </div>
                                                </div>
                                                <div class="col-md-1 col-sm-2">
                                                    <div class="form-group mt-3">
                                                        <button id="btn-mt-add" class="btn btn-black btn-sm mt-3"><i class="fa fa-plus-circle"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="mt_table" class="table echeancier-table table-sm table-bordered table-striped">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            <th>&numero; Echeance</th>
                                                            <th>MONTANT A PAYER</th>
                                                            <th>DATE</th>
                                                            <th>RESTE A PAYER</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                                <div class="form-group">
                                                    <button id="btn-mt-save" type="submit" class="btn btn-black">Enregistrer</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-bienvenu" role="tabpanel" aria-labelledby="custom-tabs-bienvenu">
                                            <div class="container table-responsive">

                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-black">Creer</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="paiementModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Entrer un paiement</h5>
            </div>
            <div class="modal-body">
                <form action="/admin/suivi/paiement/add" method="post">
                    @csrf
                    <input type="hidden" id="facture_id" name="facture_id">
                    <div class="row">
                        <div class="col-md-2 col-sm-12">
                            <label for="">DATE</label>
                            <div class="form-group">
                                <input type="date" name="done_at" required class="form-control"></div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="">MONTANT</label>
                            <div class="form-group">
                                <input type="number" name="montant" required class="form-control"></div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">Echeance</label>
                                <select name="echeance_id" id="echeance_id" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="">Mode de paiement</label>
                                <select name="mode_id" id="" class="form-control">
                                    <option value="">choisir mode de paiement</option>
                                    @foreach ($modes as $mode)
                                        <option value="{{ $mode->id }}">{{ $mode->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-12">
                            <div class="form-group pt-4">
                                <button class="btn btn-sm btn-black">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <h6>Historique des paiements</h6>
                        <table id="t_paiements" class="table text-xs table-sm table-bordered table-striped">
                            <thead class="table-dark">
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Echeance</th>
                                <th>Mode de paiement</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>


  <div class="modal fade" id="addClientModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <div class="custom-control custom-radio custom-control-inline">
                    <input value="0" type="radio" id="customRadioInline1" name="client_input" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">Personne physique</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input value="1" type="radio" id="customRadioInline2" name="client_input" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Entreprise</label>
                  </div>
            </div>
            <div class="modal-body">
                <div style="display: none" id="dpp">
                    <h4>Personne Physique</h4>
                    <form action="/admin/suivi/client/add" method="post">
                        @csrf
                        <input type="hidden" name="type_id" value="0">
                        <div class="">
                            <div class="form-group">
                                <label for="name">Nom(s)</label>
                                <input type="text" required placeholder="Saisir les noms et prenoms" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Telephone</label>
                                <input type="text" required placeholder="Saisir le numero de telephone" name="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" placeholder="Saisir l'email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">NIU</label>
                                <input type="text" placeholder="Saisir le NIU" name="niu" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name">Adresse physique</label>
                                <textarea name="address" class="form-control" placeholder="Saisir l'adresse physique client" id="" cols="30" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">PROFIL</label>
                                <select name="profil_id" class="form-control" id="">
                                    <option value="">Choisir un profil...</option>
                                    @foreach ($profils as $profil)
                                        <option value="{{ $profil->id }}">{{ $profil->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn-sm btn-black">Creer</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div style="display: none" id="den">
                    <h4>Personne morale</h4>
                    <form action="/admin/suivi/client/add" method="post">
                        @csrf
                        <input type="hidden" name="type_id" value="1">
                        <div class="">
                            <ul style="margin:0; display:flex; justify-content: space-between;" class="nav nav-tabs content-submenu" id="custom-tabs" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="custom-tabs-tous-tab" data-toggle="pill" href="#tab-info" role="tab" aria-controls="custom-tabs-tous" aria-selected="true">Informations legales</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="custom-tabs-bienvenu-tab" data-toggle="pill" href="#tab-contact" role="tab" aria-controls="custom-tabs-bienvenu" aria-selected="false">Contacts</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="custom-tabs-two-tabContent">
                              <div class="tab-pane fade show active" id="tab-info" role="tabpanel" aria-labelledby="custom-tabs-tous">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Raison sociale</label>
                                            <input type="text" required placeholder="Saisir la raison sociale" name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">NIU</label>
                                            <input type="text" placeholder="Saisir le NIU" name="niu" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Telephone</label>
                                            <input type="text" required placeholder="Saisir le numero de telephone" name="phone" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Email</label>
                                            <input type="email" placeholder="Saisir l'email" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">PROFIL</label>
                                            <select name="profil_id" class="form-control" id="">
                                                <option value="">Choisir un profil...</option>
                                                @foreach ($profils as $profil)
                                                    <option value="{{ $profil->id }}">{{ $profil->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">RCCM</label>
                                            <input type="text" required placeholder="Saisir le rccm" name="rccm" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Adresse physique</label>
                                            <textarea name="address" class="form-control" placeholder="Saisir l'adresse physique client" id="" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="tab-contact" role="tabpanel" aria-labelledby="custom-tabs-bienvenu">
                                    <div class="">
                                        <fieldset>
                                            <legend>Contact 1</legend>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" name="fn1" placeholder="Prenom(s)" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" name="ln1" placeholder="Nom(s)" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="email" name="email1" placeholder="Email" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" name="phone1" placeholder="Telephone" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <select name="poste_1_id" required id="" class="form-control">
                                                            <option value="">Fonction</option>
                                                            @foreach ($postes as $poste)
                                                                <option value="{{ $poste->id }}">{{ $poste->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Contact 2</legend>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" name="fn2" placeholder="Prenom(s)" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" name="ln2" placeholder="Nom(s)" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="email" name="email2" placeholder="Email" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <input type="text" name="phone2" placeholder="Telephone" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <select name="poste_2_id" id="" class="form-control">
                                                            <option value="">Fonction</option>
                                                            @foreach ($postes as $poste)
                                                                <option value="{{ $poste->id }}">{{ $poste->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-black">Creer</button>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
  <style>
    #addClientModal .tab-pane{
        min-height: 380px;
    }
    .toggle.btn{
        min-width: 300px;
    }
    .content-submenu a.nav-link {
        background: #ffffff;
        border: 1px solid #222222;
        color: #222222;
        border-radius: 0;
        padding: 0.25rem 1.25rem;
    }
    .echeancier-table th, .echeancier-table td{
        font-size: 12px;
    }
    .echeancier{
        font-size: 12px;
    }
    .content-submenu a.nav-link.active {
        background: #222222;
        border: 1px solid #555555;
        color: #ffffff;
        border-radius: 0;
        padding: 0.25rem 1.5rem;
        box-shadow: #555 1px 11px 11px;
    }
    ul#custom-tabs>li{
        width: 50%;
    }
  </style>



 <script>

    $(document).ready(function(){
        $('#montant').val('');
        $('#mt').val('');
        $('#mt_dt').val('');
        $('#dt_bl').val();
        $('.div-ech').hide();
    });
    var count = 0;
    var montant = 0;
    var reste = 0;
    $('#montant').keyup(function(){
        montant = $('#montant').val();
        reste = montant;
    });

    //console.log(montant);
    //console.log(reste);
    $('#btn-mt-add').click(function(){
        //$('#montant').prop({'disabled':true});
        var mt = $('#mt').val();
        var dt = $('#mt_dt').val();
        reste = reste - mt;
       // console.log(reste);
        count++;
        var tr ='<tr data-montant="'+ mt+'" data-dt="'+ dt +'"><td>'+ count +'</td><td>'+ mt +'</td><td>'+ dt +'</td><td class"text-bold">'+ reste +'</td></tr>';
        $('#mt_table').find('tbody').append(tr);
        $('#mt').val('');
        $('#mt_dt').val('');
    });

    $('#btn-mt-save').click(function(){
        //$('#montant').prop({'disabled':true});
        var echeances = [];
        $('#mt_table').find('tbody tr').each(function(){
            var elt = {'mt':$(this).data('montant'),'dt':$(this).data('dt')};
            echeances.push(elt);
        });
        console.log(echeances);
        $.ajax({
            url:'/admin/suivi/facture/add/echeance/mt',
            dataType:'json',
            type:'post',
            data:{
                echeances:echeances,montant:$('#montant').val(), dt_bl:$('#dt_bl').val(),
                client_id:$('input[name=client_id]').val(),_token:$('input[name=_token]').val()
            },
            success:function(data){
                window.location.reload();
            },
            error:function(){
                alert('Une erreur s\'est produite. Veuillez reessayer!');
            }
        });
    });

    $('input[name=client_input]').click(function(){
        console.log($(this).val());
        var val = $(this).val();
        if(val==0){
            $('#dpp').show();
            $('#den').hide();
            $('#addClientModal>.modal-dialog').removeClass('modal-lg');
        }
        if(val==1){
            $('#den').show();
            $('#dpp').hide();
            $('#addClientModal>.modal-dialog').addClass('modal-lg');
        }
    });
    $('.tr-click').click(function(){
        var id = $(this).data('id');
        window.location.href='/admin/suivi/client/'+id;
    });
</script>
<script src="{{ asset('js/autocomplete.js') }}"></script>
<script>
    $('.basicAutoComplete').autoComplete();
</script>
<script>
    $('.basicAutoSelect').autoComplete();
    $('#_client_id').autoComplete();
    $('#my_clients').autoComplete();
    $('#clients_list').autoComplete({
    resolverSettings: {
        url: '/data/client.json'
        }
    });

    $('#_client_id').on('autocomplete.change',function(evt,item){
        console.log("Ooowwooouuuhhh!!!");
       console.log();
    });

    $('.basicAutoSelect').on('autocomplete.select', function(evt, item) {
        console.log(item.value);
        var id = item.value;
        $.ajax({
            url:'/api/v1/factures-by-client/'+id,
            type:'get',
            dataType:'json',
            success:function(data){
                console.log(data);
                var i = 0;
                data.forEach(function(){
                    console.log($(this));
                    var k = i+1;
                    var f = data[i];
                    var tr = '<tr><td>'+ k +'</td><td>'+ f.name +'</td><td>'+ f.montant +'</td><td>'+ f.encaissement +'</td><td>'+ f.solde +'</td><td>'+ f.dt +'</td><td><a data-id="'+ f.id +'" data-toggle="modal" data-target="#paiementModal" class="btn btn-add-paiement btn-info btn-sm">Entrer un paiement</td></tr>';
                    $('#t_factures').find('tbody').append(tr);
                    i++;
                });

                $('.btn-add-paiement').click(function(){
                    var fid = $(this).data('id');
                    $.ajax({
                        url:'/api/v1/suivi/facture/paiements/'+fid,
                        type:'get',
                        dataType:'json',
                        success:function(data){
                            $('#t_paiements').find('tbody').html('');
                            console.log(data);
                            var paiements = data.paiements;
                            var echeances = data.echeances;
                            paiements.forEach(element => {
                                var tr = '<tr><td>'+ element.date +'</td><td>'+ element.montant +'</td><td>'+ (element.echeance!=null?element.echeance.name:'-') +'</td><td>'+ element.mode +'</td></tr>';
                                $('#t_paiements').find('tbody').append(tr);
                            });
                            $('#echeance_id').html('');
                            $('#echeance_id').append('<option>Choisir une echeance ...</option>');
                            echeances.forEach(ech=>{
                                var option = '<option = value="'+ ech.id +'">'+ ech.name+'</option>';
                                $('#echeance_id').append(option);
                            });
                        },
                        error:function(err){
                            console.log("Erreur : "+err);
                        }
                    });
                    $('#addPaiementModal').modal('hide');
                    $('#facture_id').val($(this).data('id'));
                });

            }
        });
	});



    $('.bootstrap-autocomplete a.dropdown-item.active').click(function(){
        console.log('ok ok ok');
    })

    $('#btn-non-save').click(function(){
        console.log($('input[name=client_id]').val());
        $.ajax({
            url:'/admin/suivi/facture/echeance/non',
            type:'post',
            dataType:'json',
            data:{client_id:$('input[name=client_id]').val(),_token:$('input[name=_token]').val(),montant:$('#montant').val(),delivered_at:$('#dt_bl').val(),delai:$('#delai').val()},
            success:function(data){
                window.location.reload();
            },
            error:function(){
                alert('Erreur de connexion !!!');
            }

        });
    })
</script>

<script>
    $('input[name=echeance_radio]').click(function(){
        console.log('ok ok ok');
        var val = $(this).val();
        console.log(val == 1);
        if(val==1){
            $('#div-oui').hide();
            $('#div-non').show();
        }
        if(val==2){
            $('#div-oui').show();
            $('#div-non').hide();
        }
    });
</script>




@endsection
