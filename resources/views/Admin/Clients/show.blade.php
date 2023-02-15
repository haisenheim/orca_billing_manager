
@extends('layouts.admin')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0 text-dark">Comptes Clients</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/national/dashboard">ACCUEIL</a></li>
              <li class="breadcrumb-item">Clients</li>
              <li class="breadcrumb-item active">Comptes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection

@section('content')
  <div class="container-fluid pt-3">
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="card bg-light carte">
                <div class="card-header">
                    <h4 class="card-title">{{ $client->name }}</h4>
                </div>
                <div class="card-body">
                    <h3>NOM : <b>{{ $client->last_name }}</b></h3>
                    <h3>PRENOM : <b>{{ $client->first_name }}</b></h3>
                    <h4>TEL: <b>{{ $client->phone }}</b></h4>
                    <h4>EMAIL : <b>{{ $client->email?$client->email:'-' }}</b></h4>
                    <h5>AGE : {{ $client->dtn?\Carbon\Carbon::parse($client->dtn)->diffInYears().' ans' :'-'  }}</h5>
                    <h5>TRANCHE DE REVENU : {{ $client->tranche?$client->tranche->name:'-' }}</h5>
                    <h5>CATEGORIE SOCIO PROF : {{ $client->categorie?$client->categorie->name:'-' }}</h4>
                     <a href="/admin/compte/reset-password/{{ $client->token }}" class="btn btn-sm btn-danger">Reset le MDP</a>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="container">
                <div class="row">
                    @foreach ($client->cartes as $carte )
                        <div class="col-md-4 col-sm-12">
                            <div class="card bg-info">
                                <a href="/admin/compte/carte/{{ $carte->token }}">
                                    <div class="card-body">
                                        <img style="background-color: #FFF;" src="{{ asset($carte->fournisseur->logo) }}" alt="Logo" height="120" width="120" class="img img-round img-circle">
                                    </div>
                                    <div class="card-footer">
                                        <h4 style="font-size:1rem;">SOLDE: <b>{{ number_format($carte->montant,0,',','.') }}</b></h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

      </div>
  </div>

  <style>
    .carte h3{
        font-size: 1.1rem;
    }
    .carte h4{
        font-size: 0.9rem;
    }
    .carte h5{
        font-size: 0.75rem;
    }
    .carte h6{
        font-size: 0.7rem;
    }
  </style>
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/canvasjs.min.js')}}"></script>

@include('includes.data-table')
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>


@endsection
