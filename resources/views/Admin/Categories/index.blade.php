
@extends('layouts.admin')

@section('content')
  <div class="">
        <div class="card card-light">
            <div class="card-header">
                <div class="pull-right">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <button data-target="#add" data-toggle="modal" class="btn btn-xs btn-pink"><i class="fa fa-plus-circle" title="Ajouter un rayon"></i></button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($categories as $categorie)
                        <div class="col-md-3 col-sm-12">
                            <a href="/admin/categories/{{ $categorie->id }}">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ $categorie->photo }}" style="height: 100px; width:100%" alt="">
                                    </div>
                                    <div class="card-footer">
                                        <h6>{{ $categorie->name }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
  </div>

  <div class="modal fade" id="add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">NOUVEAU RAYON</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form enctype="multipart/form-data" method="POST" action="/admin/categories">
        <div class="modal-body">
            @csrf
          <div class="row">
              <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                      <input type="text" name="name" placeholder="Nom" class="form-control">
                  </div>
              </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="logo">IMAGE</label>
                    <input type="file" name="image"  class="form-control">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-pink">Enregistrer</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection
