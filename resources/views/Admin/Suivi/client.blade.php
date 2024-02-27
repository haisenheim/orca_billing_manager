
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <div id="suivi" class="container pl-5 pr-5 ml-3">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div>
                    <h6>{{ $client->name }} <span><small><span style="background: {{ $client->profil->color }}" class="badge">{{ $client->profil->name }}</span></small></span></h6>
                    <div style="display: flex; justify-content: space-between">
                        <div><span>Contacts: &nbsp; </span></div>
                        <div>
                            @if(!empty($client->contacts))
                                <ul class="list-inline m-0">
                                    @foreach ($client->contacts as $contact)
                                        <li class="list-inline-item text-xs">{{ $contact->name }} - {{ $contact->poste->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="list-inline m-0">
                                    <li class="list-inline-item text-xs"><span class="text-sm">{{$client->email }}</span></li>
                                    <li class="list-inline-item text-xs"><span class="text-sm">{{ $client->phone }}</span></li>
                                </ul>
                            @endif
                        </div>
                        <div class="">
                            <a href="#" data-target="#addAvoirModal" data-toggle="modal" class="btn btn-xs btn-info"><i class="fa fa-plus-square"></i> Enregister un avoir</a>
                            <a href="/admin/suivi/transactions/{{ $client->id }}"  class="btn btn-xs btn-warning">Journal</a>
                        </div>
                    </div>
                    <hr style="margin:0.5rem 0;">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="card bg-gradient-secondary">
                               <div class="card-body text-sm-center text-xs">
                                    <p class="mb-0">Total facturé</p>
                                    <p class="mb-0 text-center"><span class="value text-black">{{ number_format($client->montant_facture ,0,',','.') }}</span></p>
                               </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="card bg-gradient-success">
                                <div class="card-body text-sm-center text-xs">
                                     <p class="mb-0">Total payé</p>
                                     <p class="mb-0 text-center"><span class="value text-black">{{ number_format($client->montant_paye,0,',','.') }}</span></p>
                                </div>
                             </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="card bg-gradient-primary">
                                <div class="card-body text-sm-center text-xs">
                                     <p class="mb-0">Total du</p>
                                     <p class="mb-0 text-center"><span class="value text-black">{{ number_format($client->montant_du,0,',','.') }}</span></p>
                                </div>
                             </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="card bg-gradient-danger">
                                <div class="card-body text-sm-center text-xs">
                                     <p class="mb-0">Total retard</p>
                                     <p class="mb-0 text-center"><span class="value text-black">{{ number_format($client->impaye,0,',','.') }}</span></p>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="display:flex; justify-content: end; flex-direction:column" class="col-md-4 col-sm-12">
                <div class="row">
                    <div style="display: grid; align-content: flex-end;" class="col-md-6 col-sm-12">
                        <div class="card bg-light mt-3 border-black-2 text-xs text-center">
                            <div class="card-body">
                                <p>Recouvrement</p>
                                <p> <span class="value">{{ number_format($client->taux_recovery,1,',','.') }}%</span></p>
                            </div>
                        </div>
                    </div>
                    <div style="display:grid; align-content: flex-end;" class="col-md-6 col-sm-12">
                        <a data-target="#avoirsModal" data-toggle="modal" href="#">
                            <div style="">
                                <div class="card mt-3 bg-warning border-black-2 text-xs text-center">
                                    <div class="card-body">
                                        <p>AVOIRS</p>
                                        <p> <span class="value">{{ number_format($client->solde_avoirs,0,',','.') }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 30vh; overflow: scroll" class="table-responsive">
            <table class="table text-xs  table-bordered table-sm table-striped table-header-dark">
                <thead class="table-dark text-sm-center text-xs">
                    <tr class="">
                        <th>Date</th>
                        <th>&numero; Facture</th>
                        <th>&numero; ORCA</th>
                        <th>Montant</th>
                        <th>Encaissements</th>
                        <th>Impayés</th>
                        <th>Date du BL</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($client->factures as $facture)
                    <tr role="button" data-id={{ $facture->id }} class="tr-click">
                        <td>{{ date_format($facture->created_at,'d/m/Y') }}</td>
                        <td>{{ $facture->name }}</td>
                        <td>{{ $facture->numero }}</td>
                        <td>{{ number_format($facture->montant,0,',','.') }}</td>
                        <td>{{ number_format($facture->encaissement,0,',','.') }}</td>
                        <td>{{ number_format($facture->impaye,0,',','.') }}</td>
                        <td>{{ $facture->delivered_at?date_format($facture->delivered_at,'d/m/Y'):'-' }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" style="padding:0 0.5rem;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu" style="">
                                    <li><a data-toggle="modal" class="dropdown-item" data-target="#editFactureModal" href="#"><i class="fa fa-pen"></i> Modifier</a></li>
                                    <li><a data-toggle="modal" class="dropdown-item" data-target="#addPaiementModal" href="#"><span style="font-size: 1rem;" class="material-icons">monetization_on</span><span> payer</span></a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="height: 30vh; overflow: scroll" class="row">
            <div class="col-md-6 col-sm-12 table-responsive">
                <fieldset>
                    <legend>Historique des paiements</legend>
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
                </fieldset>
            </div>
            <div class="col-md-6 col-sm-12 table-responsive">
                <fieldset>
                    <legend>Echeancier</legend>
                    <table id="t_echeancier" class="table text-xs table-sm table-bordered table-striped">
                        <thead class="table-dark">
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Versement</th>
                            <th>Reste</th>
                            <th >En souffrance</th>
                            <th></th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>

    </div>
    </div>
  </div>

  <div class="modal fade" id="editFactureModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6>EDITION DE LA FACTURE</h6>
            </div>
            <div class="modal-body">
                <div class="p-2">
                    <button id="btn-new-ech" class="btn-sm btn-info btn"><i class="fa fa-plus-circle"></i> Ajouter une echeance</button>
                </div>
                <div id="facture-content" class="container">

                </div>
                <div>
                    <div>
                        <button class="btn btn-info btn-sm" id="btn-facture-save">ENREGISTRER</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="avoirsTraceModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6>HISTORIQUE DE PAIEMENTS</h6>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table text-sm table-bordered table-sm">
                        <thead class="table-dark">
                            <tr>
                                <td>DATE</td>
                                <td>MONTANT</td>
                                <td>ECHEANCE</td>
                                <th>FACTURE</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="avoirsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6>HISTORIQUES DES AVOIRS</h6>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table text-sm table-bordered table-sm">
                        <thead class="table-dark">
                            <tr>
                                <td>DATE</td>
                                <td>MONTANT</td>
                                <td>SOLDE</td>
                                <td>MEMO</td>
                                <td>MODE DE PAIEMENT</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($client->avoirs as $avoir)
                                <tr data-id="{{ $avoir->id}}" class="av-click">
                                    <td>{{ date_format($avoir->created_at,'d/m/Y') }}</td>
                                    <td>{{ number_format($avoir->montant,0,',','.') }}</td>
                                    <td>{{ number_format($avoir->solde,0,',','.') }}</td>
                                    <td>{{ $avoir->memo }}</td>
                                    <td>{{ $avoir->mode?$avoir->mode->name:'-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="addPaiementModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Entrer un paiement</h5>
            </div>
            <div class="modal-body">
                <form id="ech_pay_form_1" action="/admin/suivi/paiement/add" method="post">
                    @csrf
                    <input type="hidden" id="facture_id" name="facture_id">
                    <div class="">
                        <div class="">
                            <label for="">DATE</label>
                            <div class="form-group">
                                <input type="date" name="done_at" required class="form-control"></div>
                        </div>
                        <div class="">
                            <label for="">MONTANT</label>
                            <div class="form-group">
                                <input type="number" id="mt_1" name="montant" required class="form-control"></div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="">Echeance</label>
                                <select required name="echeance_id" id="echeance_id" class="form-control">
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <div class="form-group">
                                <label for="">MONTANT RESTANT</label>
                                <input disabled  id="mt_max_1" class="form-control">
                            </div>
                        </div>

                        <div class="">
                            <div class="form-group">
                                <label for="">Mode de paiement</label>
                                <select required name="mode_id" id="mp" class="form-control">
                                    <option value="">choisir mode de paiement</option>
                                    @foreach ($modes as $mode)
                                        <option value="{{ $mode->id }}">{{ $mode->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <select style="display: none;" name="avoir_id" id="av_id" class="avoir_id form-control">
                                    <option value="0">choisir un avoir</option>
                                    @foreach ($client->avoirs as $av)
                                        <option value="{{ $av->id }}">{{ date_format($av->created_at,'d/m/Y') }} - {{ number_format($av->montant,0,',','.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <button class="btn btn-sm btn-black">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="addAvoirModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Engistrer un avoir</h5>
            </div>
            <div class="modal-body">
                <form action="/admin/suivi/avoir/add" method="post">
                    @csrf
                    <input type="hidden" id="client_id" name="client_id" value="{{ $client->id }}">
                    <div class="">
                        <div class="">
                            <label for="">MONTANT</label>
                            <div class="form-group">
                                <input type="number" name="montant" required class="form-control"></div>
                        </div>

                        <div class="">
                            <div class="form-group">
                                <label for="">Memo</label>
                                <textarea required name="memo" id="" name="memo" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="">Mode de paiement</label>
                                <select required name="mode_id" id="mode_id" class="form-control">
                                    <option value="">choisir mode de paiement</option>
                                    @foreach ($modes->where('id','<',5) as $mode)
                                        <option value="{{ $mode->id }}">{{ $mode->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <button class="btn btn-sm btn-black">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="addPaiementModal2">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Entrer un paiement</h5>
            </div>
            <div class="modal-body">
                <form id="ech_pay_form" action="/admin/suivi/paiement/add" method="post">
                    @csrf
                    <input type="hidden" id="fact_id" name="facture_id">
                    <input type="hidden" name="echeance_id" id="ech_id">
                    <div class="">
                        <div class="">
                            <label for="">DATE</label>
                            <div class="form-group">
                                <input type="date" name="done_at" required class="form-control"></div>
                        </div>
                        <div class="">
                            <label for="">TOTAL RESTE</label>
                            <div class="form-group">
                                <input type="number" id="mt_max" disabled class="form-control"></div>
                        </div>
                        <div class="">
                            <label for="">MONTANT</label>
                            <div class="form-group">
                                <input type="number" id="ech-mt" name="montant" required class="form-control"></div>
                        </div>

                        <div class="">
                            <div class="form-group">
                                <label for="">Mode de paiement</label>
                                <select required name="mode_id" id="mode_id" class="form-control">
                                    <option value="">choisir mode de paiement</option>
                                    @foreach ($modes as $mode)
                                        <option value="{{ $mode->id }}">{{ $mode->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <select style="display: none;" name="avoir_id" id="avoir_id" class="avoir_id form-control">
                                    <option value="0">choisir un avoir</option>
                                    @foreach ($client->avoirs as $av)
                                        <option value="{{ $av->id }}">{{ date_format($av->created_at,'d/m/Y') }} - {{ number_format($av->montant,0,',','.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <button id="btn-ech-save" class="btn btn-sm btn-black">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  <script>
    $('#btn-new-ech').click(function(){
        var ndt= $('#ndt').val();
        var nmt = $('#nmt').val();
        var div = `<div class="form-group">
                                <div data-id="0" class="row ">
                                    <div class="col-4"><input type="date" class="form-control" /></div>
                                    <div class="col-6"><input type="number" class="form-control" /></div>
                                    <div class="col-2"><button class="btn btn-xs mt-1 btn-danger btn-remove"><i class="fa fa-trash"></i></button></div>
                                </div>
                        </div>`;
        $('#facture-content').append(div);
        $('.btn-remove').click(function(){
                    $(this).parent().parent().remove();
                });
    });

   $('#btn-facture-save').click(function(){
     var echeances = [];
     $('#facture-content .form-group>.row').each(function(){

        var elt = {'id':$(this).data('id'),'date':$(this).find('input[type=date]').val(),'montant':$(this).find('input[type=number]').val()};
        echeances.push(elt);
     });
     console.log(echeances);
     var id = $('#facture_id').val();
     $.ajax({
        url:'/api/v1/suivi/facture/save',
        type:'post',
        dataType:'json',
        data:{echeances:echeances,id:id},
        success:function(data){
            window.location.reload();
        },
        error:function(error){
            console.log(error);
            alert('Erreur du serveur');
        }
     })
   });

    $('.tr-click').click(function(){

        $('.tr-click').css({background:'inherit'});
        var id = $(this).data('id');
        $('#facture_id').val(id);
        $(this).css({background:'#5a9d6a'});
        $.ajax({
            url:'/api/v1/suivi/facture/'+id,
            type:'get',
            dataType:'json',
            success:function(data){
                $('#t_paiements').find('tbody').html('');
                $('#t_echeancier').find('tbody').html('');
                $('#facture-content').html('');
                console.log(data);
                var paiements = data.paiements;
                var echeances = data.echeances;
                var lignes = data.raw;
                var fmt = 0;
                paiements.forEach(element => {
                    var tr = '<tr><td>'+ element.date +'</td><td>'+ element.montant +'</td><td>'+ (element.echeance!=null?element.echeance.name:'-') +'</td><td>'+ element.mode +'</td></tr>';
                    $('#t_paiements').find('tbody').append(tr);
                });
                $('#echeance_id').html('');
                $('#echeance_id').append('<option>Choisir une echeance ...</option>');
                echeances.forEach(ech=>{
                    var option = `<option data-reste="${ech.reste_total}"  value="${ech.id}">${ech.name}</option>`;
                    $('#echeance_id').append(option);
                    var element = ech;
                    var tr = '<tr><td>'+ element.date +'</td><td>'+ element.montant +'</td><td class="text-bold text-success">'+ (element.versement) +'</td><td>'+ element.reste +'</td><td class="text-danger">'+ element.impaye +'</td><td><a data-toggle="modal" class="btn btn-xs btn-black btn-ech" data-facture='+ id +' data-reste='+ element.reste_total +' data-id='+ element.id +' data-target="#addPaiementModal2" href="#"><i class="fa fa-plus-circle"></i></a></td></tr>';
                    $('#t_echeancier').find('tbody').append(tr);
                });

                lignes.forEach(ech=>{
                    fmt = fmt+ech.montant;
                    var div = `<div class="form-group">
                                <div data-id=${ech.id} class="row">
                                    <div class="col-4"><input type="date" class="form-control" value="${ech.date}" /></div>
                                    <div class="col-6"><input type="number" ${ech.remove?'':'readonly'} class="form-control" value="${ech.montant}" /></div>
                                    <div class="col-2"><button class="btn btn-xs mt-1 ${ech.remove?'btn-danger btn-remove':'btn-light btn-disabled'}"><i class="fa fa-trash"></i></button></div>
                                </div>
                        </div>`;
                    $('#facture-content').append(div);
                });
               /* var ldiv = `<div class="row">
                                    <div class="col-6">MONTANT GLOBAL :</div>
                                    <div class="col-5"><input type="number" readonly class="form-control" value="${fmt}" /></div>
                                </div>`;
                $('#facture-content').append(ldiv); */

                $('.btn-ech').click(function(){
                    $('#ech_id').val($(this).data('id'));
                    $('#fact_id').val($(this).data('facture'));
                    $('#mt_max').val($(this).data('reste'));
                });
                $('.btn-remove').click(function(){
                    $(this).parent().parent().remove();
                });
            },
            error:function(err){
                console.log("Erreur : "+err);
            }
        });

    })



    $('#mode_id').change(function(){
        var id = $(this).val();
        if(id == 5){
            $('#avoir_id').show();
        }else{
            $('#avoir_id').hide();
        }
    });

    $('#mp').change(function(){
        var id = $(this).val();
        if(id == 5){
            $('#av_id').show();
        }else{
            $('#av_id').hide();
        }
    });

    $('#echeance_id').change(function(){
        var mt = $('#echeance_id option:selected').data('reste');
        $('#mt_max_1').val(mt);
    });

    $('#ech_pay_form').submit(function(e){
                    e.preventDefault();
                    var mt_max = parseFloat($('#mt_max').val());
                    var mt = parseFloat($('#ech-mt').val());
                    console.log(mt);
                    console.log(mt_max);
                    console.log(mt>mt_max);
                    if(mt>mt_max){
                        alert("Montant invalide! Le montant doit-etre inferieur ou egal a "+mt_max);
                    }else{
                        $(this).unbind('submit').submit()
                    }
    });
    $('#ech_pay_form_1').submit(function(e){
                    e.preventDefault();
                    var mt_max = parseFloat($('#mt_max_1').val());
                    var mt = parseFloat($('#mt_1').val());
                    console.log(mt);
                    console.log(mt_max);
                    console.log(mt>mt_max);
                    if(mt>mt_max){
                        alert("Montant invalide! Le montant doit-etre inferieur ou egal a "+mt_max);
                    }else{
                        $(this).unbind('submit').submit()
                    }
    });

$('.av-click').click(function(){

$('.av-click').css({background:'inherit'});
var id = $(this).data('id');
$(this).css({background:'#5a9d6a'});
$.ajax({
    url:'/api/v1/suivi/avoir/paiements/'+id,
    type:'get',
    dataType:'json',
    success:function(data){
        console.log(data);
        $('#avoirsTraceModal table>tbody').html('');
        var paiements = data.paiements;
        var tbody = '';
        paiements.forEach(function(p){
            var tr = `<tr>
                        <td>${p.date}</td>
                        <td>${p.montant}</td>
                        <td>${p.echeance.name}</td>
                        <td>${p.echeance.facture.name}-${p.echeance.facture.montant}-${p.echeance.facture.dt}</td>
                    </tr>`;
                    tbody = tbody + tr;
        });
        $('#avoirsTraceModal table>tbody').html(tbody);
        $('#avoirsTraceModal').modal('show');
        $('#avoirsModal').modal('hide');
    },
    error:function(err){
        console.log("Erreur : "+err);
    }
});

})
  </script>
@endsection
