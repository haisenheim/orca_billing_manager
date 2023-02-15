
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3> <i class="fa text-lg text-indigo fa-user-cog"></i> Comptes & Utilisateurs</h3>
    <hr>
    <div id="" class="container pl-5 pr-5 ml-3">
        <div class="">
            <ul style="margin:0; " class="nav nav-tabs content-submenu p-0 pb-1" id="custom-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="" data-toggle="pill" href="#tab-infos" role="tab" aria-controls="custom-tabs-tous" aria-selected="true">ENTREPRISE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="" data-toggle="pill" href="#tab-users" role="tab" aria-controls="custom-tabs-tous" aria-selected="true">UTILISATEURS</a>
                </li>
            </ul>
            <div class="tab-content" id="custom-tabs-two-tabContent">
                <div class="tab-pane fade show active" id="tab-infos" role="tabpanel" aria-labelledby="custom-tabs-tous">
                    <form enctype="multipart/form-data" action="/admin/parametres/entreprise" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    @if ($entreprise->image)
                                        <div>
                                            <img src="{{ asset($entreprise->image) }}">
                                        </div>
                                    @else
                                            <p>Aucun logo</p>
                                    @endif
                                            <input type="file" name="image" value="{{ $entreprise->images }}"/>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="">NOM</label>
                                        <input type="text" class="form-control" name="name" value="{{ $entreprise->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">RCCM</label>
                                        <input type="text" class="form-control" name="rccm" value="{{ $entreprise->rccm }}" placeholder="Votre RCCM">
                                    </div>
                                    <div class="form-group">
                                        <label for="">NIU</label>
                                        <input type="text" class="form-control" name="niu" value="{{ $entreprise->niu }}" placeholder="Votre NIU">
                                    </div>
                                    <div class="form-group">
                                        <label for="">EMAIL</label>
                                        <input type="email" class="form-control" name="email1" value="{{ $entreprise->email1 }}" placeholder="Votre Adresse email">
                                    </div>
                                    <div class="form-group">
                                        <label for="">EMAIL</label>
                                        <input type="email" class="form-control" name="email2" value="{{ $entreprise->email2 }}" placeholder="Votre Adresse email">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="">CAPITAL</label>
                                        <input type="number" class="form-control" name="capital" value="{{ $entreprise->capital }}" placeholder="Indiquer le Capital">
                                    </div>
                                    <div class="form-group">
                                        <label for="">ADRESSE</label>
                                        <textarea name="address" id="" class="form-control" placeholder="Votre adresse physique" cols="30" rows="4">
                                            {{ $entreprise->address }}
                                        </textarea>
                                    </div>
                                    <div class="form-group" style="margin-top: 2rem;">
                                        <label for="">TELEPHONE</label>
                                        <input type="text" class="form-control" name="phone1" value="{{ $entreprise->phone1 }}" placeholder="Votre Adresse Numero de telephone">
                                    </div>
                                    <div class="form-group">
                                        <label for="">TELEPHONE</label>
                                        <input type="text" class="form-control" name="phone2" value="{{ $entreprise->phone2 }}" placeholder="Votre Adresse Numero de telephone">
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <button class="btn btn-black btn-sm">ENREGISTRER</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="tab-users" role="tabpanel" aria-labelledby="custom-tabs-tous">
                    <div style="height: 70vh; display:flex;justify-content:space-between;flex-direction:column">
                        <div>
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>NOM</th>
                                        <th>EMAIL</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr data-id="{{ $user->id }}" class="tr-click" role="button">
                                            <td><span class="badge badge-{{ $user->status['color'] }}">{{ $user->status['name'] }}</span></td>
                                            <th>{{ $user->name }}</th>
                                            <td>{{ $user->email }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <div class="">
                                <a class="btn btn-sm btn-black" href="/admin/parametres/compte/0">Creer un utilisateur</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
  </div>
  <style>

    #custom-tabs>li.nav-item{
        width: 50%;
    }

    .content-submenu a.nav-link {
        background: #f4f6f9;
        border: none;
        color: #222222;
        border-radius: 0;
        padding: 0.25rem 1.5rem;
    }

    .content-submenu a.nav-link.active {
        background: #222222;
        border: 1px solid #555555;
        color: #ffffff;
        border-radius: 0;
        padding: 0.25rem 1.5rem;
        box-shadow: #555 1px 11px 11px;
    }
     ul#custom-tabs>li a.active{
        border-radius: 5px;
        box-shadow: none;
    }
    section.content ul#custom-tabs.content-submenu{
        background: none;
    }

  </style>

  <script>
    $('.tr-click').click(function(){
        var id = $(this).data('id');
        window.location.href='/admin/parametres/compte/'+id;
    });
  </script>
@endsection
