
@extends('layouts.marchand')


@section('content')
    <div class="container">
        <div class="card card-light">
            <div class="card-header">
                <h4>MENUS</h4>
                <div class="pull-right">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="/marchand/menus/create" class="btn btn-outline-secondary">Ajouter un menu</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                @foreach ($menus as $menu)
                <div class="col-md-3 col-sm-12">
                    <div>
                        <img src="{{ $menu->photo }}" style="height: 220px; width:100%" alt="">
                    </div>
                    <div>
                        @if($menu->active)
                            <a href="/marchand/menu/disable" class="btn btn-danger btn-sm">Desactiver</a>
                        @else
                            <a href="/marchand/menu/enable" class="btn btn-danger btn-sm">Activer</a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
