
@extends('layouts.marchand')


@section('content')
    <div class="container">
        <div class="card card-light mt-3">
            <div class="card-header">
                <h4>CREER UN MENU</h4>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <form action="/marchand/menus" enctype="multipart/form-data" class="p-4" method="POST">
                            @csrf
                            
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">IMAGE</label>
                                <div class="col-sm-8">
                                <input type="file" required class="form-control" name="image_uri" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <button class="btn btn-sm btn-danger" type="submit">ENREGISTRER</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="bg-gray"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
