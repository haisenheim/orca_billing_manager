
@extends('layouts.admin')



@section('content')
  <div class="container p-2">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">CATALOGUE</h3>
            <div class="pull-right">
                <a href="" data-toggle="modal" data-target="#btn-add" class="btn btn-xs btn-pink">Ajouter</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered data-table">
                <thead>
                    <tr>
                        <th>ARTICLE</th>
                        <th>CATEGORIE</th>
                        <th>PRIX</th>
                        <th>EN STOCK</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{ $article->name }}</td>
                            <td>{{ $article->category?$article->category->name:'-' }}</td>
                            <td>{{ number_format($article->price,0,',','.') }}</td>
                            <td>{{ number_format($article->quantity,0,',','.') }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
  <div class="modal fade" id="btn-add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">NOUVEL ARTICLE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form enctype="multipart/form-data" method="POST" action="/admin/articles">
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
                    <input type="number" name="price" placeholder="Prix" class="form-control">
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <input type="number" name="quantity" placeholder="Quantite" class="form-control">
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <select name="category_id" id="" required class="form-control">
                        <option value="">Choisir</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="logo">PHOTO</label>
                    <input type="file" name="image"  class="form-control">
                </div>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-pink btn-sm">Enregistrer</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection
