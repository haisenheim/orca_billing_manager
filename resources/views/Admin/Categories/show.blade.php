@extends('layouts.admin')
@section('content')
@if ($category->parent_id==0)
<div class="">
    <div class="card card-light">
        <div class="card-header">
            <h3>{{ $category->name }}</h3>
            <div class="pull-right">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <button data-target="#add" data-toggle="modal" class="btn btn-xs btn-pink"><i class="fa fa-plus-circle" title="Ajouter un sous rayon"></i></button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($category->children as $categorie)
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
        <h4 class="modal-title">NOUVEAU SOUS RAYON</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form enctype="multipart/form-data" method="POST" action="/admin/categories">
        <div class="modal-body">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $category->id }}">
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
@else
<div class="">
    <div class="card card-light">
        <div class="card-header">
            <h3>{{ $category->name }}</h3>
            <div class="pull-right">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <button data-target="#add" data-toggle="modal" class="btn btn-xs btn-pink"><i class="fa fa-plus-circle" title="Ajouter un article"></i> Ajouter un article</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($category->articles as $categorie)
                    <div class="col-md-3 col-sm-12">
                        <a href="/admin/categorie/articles/{{ $categorie->id }}">
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
        <h4 class="modal-title">NOUVEL ARTICLE</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <form enctype="multipart/form-data" method="POST" action="/admin/articles">
        <div class="modal-body">
            @csrf
            <input type="hidden" name="category_id" value="{{ $category->id }}">

        <div class="row">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <input type="text" name="ref" placeholder="Reference de l'article" class="form-control">
                    </div>
                </div>
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
                    <textarea name="description" class="form-control" id="" cols="10" rows="3" placeholder="Saisir une description du produit"></textarea>
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
@endif
@endsection
