
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3><i class="fa text-danger fa-pen"></i> Modèles</h3>
    <hr>
    <div id="" class="container pl-5 pr-5 ml-3">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body card-content">
                        <div class="text-center">
                            <span class="fa fa-2x fa-sms text-gray"></span>
                            <h3 class="text-center">SMS</h3>
                        </div>
                        <div class="text-center">
                            <a class="text-gray" href="/admin/parametres/modeles/sms">{{ count($sms) }} modèles</a>
                        </div>
                        <div class="text-center">
                            <button data-toggle="modal" data-target="#addSms" class="btn-black btn">Créer</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body card-content">
                        <div class="text-center">
                            <span class="fa fa-2x fa-envelope text-gray"></span>
                            <h3 class="text-center">EMAIL</h3>
                        </div>
                        <div class="text-center">
                            <a class="text-gray" href="/admin/parametres/modeles/emails">{{ count($emails) }} modèles</a>
                        </div>
                        <div class="text-center">
                            <button data-toggle="modal" data-target="#addEmail" class="btn-black btn">Créer</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body card-content">
                        <div class="text-center">
                            <span class="fa fa-2x fa-envelope-open-text text-gray"></span>
                            <h3 class="text-center">COURRIER</h3>
                        </div>
                        <div class="text-center">
                            <a class="text-gray" href="/admin/parametres/modeles/courriers">{{ count($courriers) }} modèles</a>
                        </div>
                        <div class="text-center">
                            <button data-toggle="modal" data-target="#addCourrier" class="btn-black btn">Créer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


  <div class="modal fade" id="addSms">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="/admin/parametres/modeles" method="post">
                @csrf
                <input type="hidden" name="canal_id" value="1">
                <div class="modal-header"><h5>Créer un modele de SMS</h5></div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <select required name="profil_id" id="" class="form-control">
                                        <option  value="">Choix du profil</option>
                                        @foreach ($profils as $profil)
                                            <option value="{{ $profil->id }}">{{ $profil->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input name="name" type="text" required placeholder="Titre de la relance. Ex: Sms de premiere relance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <textarea name="body" required class="form-control" id="sms-body" cols="3" rows="5" placeholder="Saisir le modele ici ..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="submit" data-toggle="modal"  class="btn-black btn">Créer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>

  <div class="modal fade" id="addEmail">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/parametres/modeles" method="post">
                @csrf
                <input type="hidden" name="canal_id" value="2">
                <div class="modal-header"><h5>Créer un modele d'EMAIL</h5></div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <select required name="profil_id" id="" class="form-control">
                                        <option  value="">Choix du profil</option>
                                        @foreach ($profils as $profil)
                                            <option value="{{ $profil->id }}">{{ $profil->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <span class="req-icon">*</span>
                                    <input name="name" type="text" placeholder="Titre de la relance. Ex: Mail de premiere relance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="">
                                    <textarea required name="body" class="form-control summernote" id="modele-body" cols="3" rows="5" ></textarea>
                                </div>
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

  <div class="modal fade" id="addCourrier">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/parametres/modeles" method="post">
                @csrf
                <input type="hidden" name="canal_id" value="4">
                <div class="modal-header"><h5>Créer un modele de Courrier</h5></div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <select required name="profil_id" id="" class="form-control">
                                        <option  value="">Choix du profil</option>
                                        @foreach ($profils as $profil)
                                            <option value="{{ $profil->id }}">{{ $profil->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <span class="req-icon">*</span>
                                    <input name="name" type="text" placeholder="Titre de la relance. Ex: Mail de premiere relance" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="">
                                    <textarea required name="body" class="form-control summernote" id="courrier-body" cols="3" rows="5" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="submit"  class="btn-black btn">Créer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>


<script>
    $('#sms-body').summernote({
        height: 150,
        toolbar: false,
        placeholder: 'Saisir le modele ici ...',
        hint: {
            mentions: ['num_facture', 'date_facture', 'montant_facture', 'date_echeance','montant_echeance','nom_dg','nom_daf'],
            match: /\B@(\w*)$/,
            search: function (keyword, callback) {
            callback($.grep(this.mentions, function (item) {
                return item.indexOf(keyword) == 0;
            }));
            },
            content: function (item) {
            return '@' + item;
            }
        }
    });
    $('#modele-body').summernote({
        height: 100,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline','fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['misc',['fullscreen','undo']],
            ['height', ['height']]
        ],
        placeholder: 'Saisir le modele ici ...',
        hint: {
            mentions: ['num_facture', 'date_facture', 'montant_facture', 'date_echeance','montant_echeance','nom_dg','nom_daf'],
            match: /\B@(\w*)$/,
            search: function (keyword, callback) {
            callback($.grep(this.mentions, function (item) {
                return item.indexOf(keyword) == 0;
            }));
            },
            content: function (item) {
            return '@' + item;
            }
        }
    });
    $('#courrier-body').summernote({
        height: 100,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline','fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['misc',['fullscreen','undo']],
            ['height', ['height']]
        ],
        placeholder: 'Saisir le modele ici ...',
        hint: {
            mentions: ['num_facture', 'date_facture', 'montant_facture', 'date_echeance','montant_echeance','nom_dg','nom_daf'],
            match: /\B@(\w*)$/,
            search: function (keyword, callback) {
            callback($.grep(this.mentions, function (item) {
                return item.indexOf(keyword) == 0;
            }));
            },
            content: function (item) {
            return '@' + item;
            }
        }
    });
</script>
  <style>
    .card-content{
        min-height: 60vh;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        padding: 10px;
    }

  </style>
@endsection
