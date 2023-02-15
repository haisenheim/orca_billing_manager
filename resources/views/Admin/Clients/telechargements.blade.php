
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
  <div class="container-fluid">
    <div class="mb-3 mt-4">
        <form action="/admin/get_telechargements" method="get">
            <div class="row">
                <div class="col-sm-12 col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Telephone">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <select name="category_id" class="form-control" id="">
                            <option value="">CATEGORIE SOCIO PROF.</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <select name="tranche_id" class="form-control" id="">
                            <option value="">TRANCHE DE REVENUS</option>
                            @foreach ($tranches as $tranche)
                                <option value="{{ $tranche->id }}">{{ $tranche->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <input type="date" name="from" class="form-control float-right" id="reservation">
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <input type="date" name="to" class="form-control float-right" id="reservation">
                    </div>
                </div>

                <div class="col-sm-12 col-md-2">
                    <div class="form-group">
                       <button class="btn btn-info">Soumettre</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">

        <table class="table table-bordered table-striped table-sm data-table">
            <thead>
                <tr>
                    <th> NOM</th>
                    <th>TELEPHONE</th>
                    <th>AGE</th>
                    <th>Categorie</th>
                    <th>Tranche</th>
                    <th>Inscrit(e) le</th>
                    <th>Parrain</th>
                    <th>Enfants</th>
                    <th>CASHBACKS</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($clients))
                @foreach ($clients as $client )
                    <tr>
                        <td><a href="/admin/compte/{{ $client->token }}">{{ $client->name }}</a></td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->dtn?\Carbon\Carbon::parse($client->dtn)->diffInYears().' ans' :'-'  }}</td>
                        <td>{{ $client->categorie?$client->categorie->name:'-' }}</td>
                        <td>{{ $client->tranche?$client->tranche->name:'-' }}</td>
                        <td>{{ date_format($client->created_at, 'd/m/Y H:i') }}</td>
                        <td>{{ $client->parent?$client->parent->name:'-' }}</td>
                        <td>{{ count($client->children) }}</td>
                        <td>{{ number_format($client->cashbacks,0,',','.') }}</td>
                        <td></td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
      </div>
  </div>
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
