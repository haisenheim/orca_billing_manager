
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3>SCENARIOS</h3>
    <hr>
    <div class="flex-col" style="min-height:70vh;" id="" class="container pl-5 pr-5 ml-3">
        <div class="table-responsive">
            <table class="table table-hover table-sm table-striped">
                <thead>
                    <tr>
                        <th>ETAT</th>
                        <th>INTITULE</th>
                        <th>PROFIL ASSOCIE</th>
                        <th>NOMBRE DE CLIENTS</th>
                        <th>NOMBRE D'ETAPES</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($scenarios as $item)
                        <tr>
                            <td>
                                <div>
                                    <span class="badge badge-{{ $item->status['color'] }}">{{ $item->status['name'] }}</span>
                                </div>
                            </td>
                            <td><a href="/admin/parametres/scenario/{{ $item->id }}">{{ $item->name }}</a></td>
                            <td>{{ $item->profil->name }}</td>
                            <td>{{ count($item->profil->clients) }}</td>
                            <td>{{ count($item->etapes) }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pull-right">
            <a class="btn btn-black pull-right" data-toggle="modal" data-target="#addScenario" href="#">AJOUTER</a>
        </div>

    </div>
  </div>

  <div class="modal fade" id="addScenario">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/parametres/scenario" method="post">
                @csrf
                <div class="modal-header"><h5>Créer un Scenario</h5></div>
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
                                    <input name="name" type="text" placeholder="Intitule" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn-black btn">Créer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection
