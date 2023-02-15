
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3><i class="large material-icons text-warning" style="font-size: 3rem;">send</i> Mails à envoyer</h3>
    <hr>
    <div id="actions" class="container pl-5 pr-5 ml-3">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div id="clients" class="section">
                    @foreach ($data as $k)
                        @php
                            $echeance = $k['echeance'];
                            $etape = $k['etape'];
                        @endphp
                        <div data-facture_id="{{ $echeance->facture_id }}"
                            data-client_id="{{ $echeance->client_id }}"
                            data-echeance_id="{{ $echeance->id }}"
                            data-etape_id="{{ $etape->id }}"
                             data-id="{{ $echeance->id }}" data-modele="{{ $etape->modele->name }}" data-name="{{ $echeance->facture->client->name }}" class="click p-2 border-black-1 mt-1">
                            <span class="">{{ $echeance->facture->client->name }}</span>
                            <p><small>{{ $echeance->id }}-{{ $echeance->montant }}-{{ $echeance->facture->name}}-{{ date_format($echeance->dt,'d/m/Y') }}-Jour J {{ $etape->nb }}</small></p>
                            <div id="body-{{ $echeance->id }}"  class="modele-body">
                                {{ $etape->modele->body }}
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="section">
                    <div class="rounded-sm bg-light p-1">
                        <h6>Timeline - <span class="text-bold" id="tml-name"></span></h6>
                        <div id="relances_section">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <form action="/admin/actions/relances/email" method="post">
                    @csrf
                    <input type="hidden" name="facture_id" id="facture_id">
                    <input type="hidden" name="client_id" id="client_id">
                    <input type="hidden" name="echeance_id" id="echeance_id">
                    <input type="hidden" name="etape_id" id="etape_id">
                <div class="section rounded-top" style="display: flex; justify-content: space-between; flex-direction: column">
                    <div class="rounded-top p-1" style="background: #c0c0c0">
                        <h6><span class="text-bold" id="modele-name"></span></h6>
                    </div>
                    <div style="border: #c0c0c0 0.5px solid" class="p-2 m-1 pt-2 pt-3 rounded">
                        <textarea name="body" id="modele-body" class="form-control summernote" cols="3" rows="4"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm btn-black">Envoyer</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
  </div>

  <style>
    div.modele-body{
        display: none;
    }

    div.section{
        min-height: 70vh;
        border: 0.5px solid #e0e0e0;
        padding: 5px;
        border-radius: 10px;
    }
    div.rounded-sm{
        border-radius: 5px;
    }
    .click{
        cursor: pointer;
    }
  </style>

  <script>
    $('.click').click(function(){
        $('#modele-body').summernote('reset');
        $('#client_id').val($(this).data('client_id'));
        $('#facture_id').val($(this).data('facture_id'));
        $('#echeance_id').val($(this).data('echeance_id'));
        $('#etape_id').val($(this).data('etape_id'));
        $('.click').css({background:'inherit',color:'inherit'});
        $(this).css({background:'#333',color:'#fff'});
        var id = $(this).data('id');
        var echeance_id = $(this).data('echeance_id');
        var etape_id = $(this).data('etape_id');
        $("#tml-name").text($(this).data('name'));
        $("#modele-name").text($(this).data('modele'));
        var modele = $(this).find('.modele-body').clone();
        modele = modele.removeClass('modele-body');
        //console.log(modele);
       // console.log($(this).find('.modele-body').html());
      // $('#modele-body').summernote('insertText',modele.html());
       // $('#modele-body').summernote('code',modele.text());
       // var textareaValue = $('#summernote').summernote('code');
       // console.log(textareaValue);
       // $('#modele-body').summernote('pasteHTML',modele.html());
        $.ajax({
            url:'/api/v1/relances/'+echeance_id+'/2/'+etape_id,
            type:'get',
            dataType:'json',
            success:function(data){
                console.log(data);
                var relances = data.relances;
                var body = data.body;
                $('#modele-body').summernote('code',body);
                $('#relances_section').html('');
                relances.forEach(element => {
                    var card = `<div data=${ element.id } class="container mb-2">
                                <div class="relance_date"><span class="text-gray text-sm">${ element.date }</span></div>
                                <div class="relance-body card">
                                    <div class="card-body">
                                        ${element.body}
                                    </div>
                                </div>
                            </div>`;
                    $('#relances_section').append(card);
                });

            },
            error:function(err){
                console.log(err);

            }
        });
    });
  </script>
@endsection
