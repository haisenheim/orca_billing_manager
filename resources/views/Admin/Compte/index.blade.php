
@extends('layouts.admin')



@section('content')
  <div class="container p-2">
      <div class="card bg-light">
          <div class="card-header">
              <h4 class="card-title">Comptes utilisateurs</h4>
          </div>
          <div class="card-body">
              <table class="table table-bordered table-sm table-striped">
                  <thead>
                      <tr>
                          <th>NOM</th>
                          <th>TELEPHONE</th>
                          <th>EMAIL</th>
                          <th><button data-target="#addCompte" data-toggle="modal" class="btn btn-xs btn-info"><i class="fa fa-plus-circle" title="Ajouter un compte"></i></button> </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $user)
                          <tr>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->phone }}</td>
                              <td>{{ $user->email }}</td>

                              <td>
                                  @if ($user->active)
                                   <a class="btn btn-xs btn-danger" href="/admin/compte/disable/{{$user->id}}"><i class="fa fa-lock"></i></a>
                                  @else
                                  <a class="btn btn-xs btn-success" href="/admin/compte/enable/{{$user->id}}"><i class="fa fa-unlock"></i></a>
                                  @endif
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <div class="modal fade" id="addCompte">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">NOUVEAU COMPTE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="/marchand/comptes">
        <div class="modal-body">
            @csrf
          <fieldset>
              <legend>Infos du compte</legend>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="fn" required=true placeholder="Prenom" class="form-control">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="ln" required=true placeholder="Nom" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Telephone" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="email" placeholder="Email" required=true class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="password" required placeholder="Mot de passe" class="form-control">
                    </div>
                </div>
              </div>
          </fieldset>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection
