
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3> {{ $user->name }}</h3>
    <hr>
    <div id="" class="container pl-5 pr-5 ml-3">
        <div class="">
            <form enctype="multipart/form-data" action="/admin/parametres/compte" method="post">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="form-group">
                                <label for="">NOM</label>
                                <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                            </div>
                            <div class="form-group">
                                <label for="">PRENOM</label>
                                <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                            </div>
                            <div class="form-group">
                                <label for="">TELEPHONE</label>
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="">EMAIL</label>
                                <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="">MOT DE PASSE</label>
                                <input type="text" class="form-control" name="password" placeholder="Mot de passe">
                            </div>

                        </div>
                        <div class="col-md-5 col-sm-12 pl-4">

                            <fieldset>
                                <legend>HABILITATIONS</legend>
                                <div>
                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" class="mr-3" name="apercu" {{ $user->apercu?'checked':'' }}>
                                                <label for=""> APERCU</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" class="mr-3" name="suivi" {{ $user->suivi?'checked':'' }} >
                                                <label for=""> SUIVI</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" class="mr-3" name="actions" {{ $user->actions?'checked':'' }} >
                                                <label for=""> ACTIONS</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group">
                                                <input type="checkbox" class="mr-3" name="parametres" {{ $user->parametres?'checked':'' }}>
                                                <label for=""> PARAMETRES</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <input type="checkbox" class="mr-3" name="active" {{ $user->active?'checked':'' }}>
                                <label for=""> ACTIF</label>
                            </div>

                        </div>
                    </div>
                    <div class="">
                        <button class="btn btn-black btn-sm">ENREGISTRER</button>
                    </div>
                </div>
            </form>

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
