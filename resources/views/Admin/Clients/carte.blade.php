
@extends('layouts.admin')



@section('content')
  <div class="container-fluid pt-5">
    <div class="row">
        <div class="col-md-4 col-lg-3 col-sm-12">
            <div class="card bg-light carte">
                <div class="card-header">
                    <h4 class="card-title">{{ $carte->client->name }}</h4>
                </div>
                <div class="card-body">
                    <img style="background-color: #FFF;" src="{{ asset($carte->fournisseur->logo) }}" alt="Logo" height="120" width="120" class="img img-round img-circle">
                </div>
                <div class="card-footer">
                    <h4 style="font-size:1rem;">SOLDE: <b>{{ number_format($carte->montant,0,',','.') }}</b></h4>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-9 col-sm-12">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">HISTORIQUE DES ACHATS</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>MONTANT</th>
                                        <th>CASHBACK</th>
                                        <th>CAISSIER(E)</th>
                                        <th>PHOTO</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carte->achats as $achat)
                                        <tr>
                                            <td>{{ date_format($achat->created_at,'d/m/Y H:i:s') }}</td>
                                            <td>{{ number_format($achat->montant,0,',','.') }}</td>
                                            <td>{{ number_format($achat->cashback,0,',','.') }}</td>
                                            <td>{{ $achat->user?$achat->user->name:'-' }}</td>
                                            <td><a href="{{ asset('/img/tickets/'.$achat->imageUri) }}">{{ $achat->imageUri }}</a></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm btn-block dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    </button>
                                                    <ul class="dropdown-menu" style="">
                                                    <li><a class="dropdown-item btn-edit" data-toggle="modal" data-target="#editMontant" data-id="{{ $achat->id }}" data-montant="{{ $achat->montant }}" href="#"><i class="fas fa-edit"></i> Modifier</a></li>
                                                    <li> <a href="/admin/achat/disable/{{ $achat->imageUri }}" title="Annuler" class="dropdown-item"><i class="fas fa-trash"></i>Supprimer</a></li>
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
  </div>

  <script>
    $('.btn-edit').click(function(){
        var id = $(this).data('id');
        $('#achat-id').val(id);
    });
  </script>

  <div class="modal fade" id="editMontant">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modifier le montant</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="/admin/achat/edit/montant">
        <div class="modal-body">
            @csrf
            <input type="hidden" name="id" id="achat-id" value="0">
            <div class="form-group">
                <input type="number" name="montant" required=true placeholder="Montant" class="form-control">
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-sm btn-primary">Enregistrer</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
