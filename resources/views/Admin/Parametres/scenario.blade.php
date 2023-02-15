
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3><i class="material-icons">aspect_ratio</i> SCENARIO</h3>
    <hr>
    <div id=""  class="container pl-5 pr-5 ml-3">
        <div class="">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">{{ $scenario->name }} - <span class="text-dark text-bold">{{ $scenario->profil->name }}</span></h3>
              </div>
              <div class="card-body">
                <div class="card bs-stepper">
                  <div class="card-header pt-0 pb-0 bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    @php
                        $i=1;
                    @endphp
                    @foreach ($scenario->etapes as $etape)
                        @php
                            $k=$i++;
                        @endphp
                      <div data-id={{ $k }} class="step" data-target="#etape-{{ $k }}">
                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="etape-{{ $k }}-part-trigger">
                            <span class="bs-stepper-label"><i class="material-icons text-warning">{{ $etape->canal->icon }}</i></span>
                            <span class="bs-stepper-circle">{{ $k }}</span>
                            <span class="bs-stepper-title">{{ $etape->nb }} jours</span>
                        </button>
                      </div>
                      @if($k<$scenario->etapes->count())
                        <div class="line"></div>
                      @endif
                    @endforeach
                  </div>
                  <div class="card-body bs-stepper-content pb-0">
                    <!-- your steps content here -->
                        @php
                            $i=1;
                        @endphp
                        @foreach ($scenario->etapes as $etape)
                        @php
                            $k=$i++;
                        @endphp
                        <div id="etape-{{ $k }}" class="content" role="tabpanel" aria-labelledby="etape-{{ $k }}-part-trigger">
                            <div>
                                <h5 class="text-bold">ETAPE - {{ $k }}</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div style="display: flex; justify-content: start">
                                            <span class="label">Type de relance : </span>
                                            <span class="value">{{ $etape->canal->name }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div style="display: flex; justify-content: start">
                                            <span class="label">Modele : </span>
                                            <span class="value">{{ $etape->modele->name }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div style="display: flex; justify-content: start">
                                            <span class="label">A JOUR J : </span>
                                            <span class="value">{{ $etape->nb }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div style="display: flex; justify-content: start">
                                            <span class="label">Interlocuteur : </span>
                                            <span class="value">{{ $etape->interlocuteur?$etape->interlocuteur->name:'Tout le monde' }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer" style="margin: 0 -20px">
                                @if($k>1)
                                <button class="btn btn-danger btn-xs" onclick="stepper.previous()">PRECEDENT</button>
                                @endif
                                @if($k<$scenario->etapes->count())
                                <button class="btn btn-black btn-xs" onclick="stepper.next()">SUIVANT</button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="#" data-toggle="modal" data-target="#addStep" class="btn btn-black btn-sm pull-right">AJOUTER UNE ETAPE</a>
            </div>
            </div>
            <!-- /.card -->

        </div>
    </div>
  </div>

  <div class="modal fade" id="addStep">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" name="" id="profil_id" value="{{ $scenario->profil_id }}">
            <form action="/admin/parametres/scenario/etape" method="post">
                @csrf
                <input type="hidden" name="scenario_id" value="{{ $scenario->id }}">
                <div class="modal-header"><h5>NOUVELLE ETAPE</h5></div>
                <div class="modal-body">
                    <div class="container">
                        <div class="">
                                <div class="form-group">
                                    <span class="fa fa-question-circle" title="Utiliser un nombre negatif pour relancer avant l'echeance"></span>
                                    <span class="req-icon">*</span>
                                    <input name="nb" required type="number" placeholder="Nombre de jour avant/apres l'echeance" class="form-control">
                                </div>
                                <div class="form-group">
                                    <select required name="canal_id" id="canal_id" class="form-control">
                                        <option  value="">TYPE DE RELANCE</option>
                                        @foreach ($canaux as $profil)
                                            <option value="{{ $profil->id }}">{{ $profil->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <div class="">
                                <div class="form-group">
                                   <select name="modele_id" id="modele_id" required class="form-control">
                                        <option value="">Choix du modele</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Interlocuteur</label>
                                <select required name="interlocuteur_id" id="interlocuteur_id" class="form-control">
                                    <option  value="0">TOUT LE MONDE</option>
                                    @foreach ($postes as $profil)
                                        <option value="{{ $profil->id }}">{{ $profil->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="submit" data-toggle="modal" data-target="#addCourriel" class="btn-black btn">Créer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>

  <!-- BS-Stepper -->
<script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>

<script>
      // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'),{
        animation: true
      })
  });

  $('.step').click(function(){
    var id = $(this).data('id');

    var stepper = new Stepper(document.querySelector('.bs-stepper'));
    stepper.to(id);

  });
</script>

  <script>
    $('#canal_id').change(function(){
        var canal_id = $('#canal_id').val();
        var profil_id = $('#profil_id').val();
        $.ajax({
            url:'/admin/parametres/canal/modeles/'+canal_id+'/'+profil_id,
            type:'get',
            dataType:'json',
            success:function(data){
                console.log(data);
                $('#modele_id').html('');
                var options = '<option>Choix du modele</option>';
                data.forEach(element => {
                    options += '<option value="'+ element.id +'">'+ element.name +'</option>';
                });
                $('#modele_id').html(options);
            }
        });
    });
  </script>

  <style>
    div.step>button.step-trigger{
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100px;
    }
    .value{
        font-weight: 700;
        margin-left: 10px;
    }

    button.step-trigger .bs-stepper-title{
        font-size: 0.6rem;
        color: #000;
    }
    .step{
        cursor: pointer;
    }

    .bs-stepper .material-icons{
        font-size: 0.9rem;
    }

    .step-trigger {
        flex-direction: column;
    }
    div.step>.bs-stepper-label{
        margin: 0;
    }
    .active .bs-stepper-circle {
        background-color: #000;
    }
    .bs-stepper button.step-trigger{
        padding: 5px;
    }

    .bs-stepper .line{
        margin-top: 55px;
    }

    .bs-stepper .step-trigger {
        font-size: 0.7rem;
        font-weight: 500;
        line-height: 1.2;
        color: #6c757d;
        text-align: center;
        white-space: nowrap;
        }
  </style>

 @endsection
