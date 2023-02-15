
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3>PROFILS CLIENTS</h3>
    <hr>
    <div id=""  class="container pl-5 pr-5 ml-3">
        <div class="card">
            <form action="/admin/parametres/profils" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input required name="name" type="text" class="form-control" placeholder="Nom du profil">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input id="chooseColor" required class="colorValue form-control" placeholder="Couleur" type="text" name="color">
                            </div>
                        </div>
                    </div>
                    <fieldset>
                        <legend>Chiffre d'affaires <span class="optional">optionnel</span></legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" name="ca_min" class="form-control" placeholder="Minimum">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" name="ca_max" class="form-control" placeholder="Maximum">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Taux de recouvrement <span class="optional">(optionnel)</span></legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="taux_recovery_min" class="form-control" placeholder="% Minimum">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="taux_recovery_max" class="form-control" placeholder="% Maximum">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="p-1 form-group">
                        <span class="req-icon">*</span>
                        <textarea required name="description" placeholder="Description du profil" class="form-control" id="" cols="5" rows="3"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="pull-right">
                        <button class="btn-black btn">Créer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>

  <style>
    span.optional{
        color: #aaaaaa;
        padding-left: 10px;
    }
    span.req-icon{
        color: red;
        float: right;
        margin-right: 10px;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="{{asset('js/choose-color.js')}}"></script>
  <script>

    $(document).ready(() => {
        $.support.cors = true;
        const $button = $('#chooseColor')
        const $colorValue = $('.colorValue')
        const $colorDisplay = $('.colorDisplay')
       // $($button).salut();
        $($button).jojoColorChoice({
            selecionarCor: (color) => {
            $($colorValue).val(color)
            $colorValue.css('background-color', color)
            //console.log($($colorValue).val());
            },
        })
    });
  </script>

 @endsection
