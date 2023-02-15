
@extends('layouts.admin')


@section('content')
  <div class="container-fluid p-2">
    <div class="">

        <table class="table table-bordered table-striped table-sm data-table">
            <thead>
                <tr>
                    <th>NOM</th>
                    <th>TELEPHONE</th>
                    <th>AGE</th>
                    <th>VILLE</th>
                    <th>Inscrit le</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client )
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->dtn?\Carbon\Carbon::parse($client->dtn)->diffInYears().' ans' :'-'  }}</td>
                        <td>{{ $client->ville }}</td>
                        <td>{{ date_format($client->created_at, 'd/m/Y H:i') }}</td>
                        <td></td>
                    </tr>
                @endforeach
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
