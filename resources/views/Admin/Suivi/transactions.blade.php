
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3>HISTORIQUE DES TRANSACTIONS</h3>
    <div class="mb-1 pr-2" style="display: flex; justify-content: end">


    </div>
    <div>
        <div class="table-responsive" style="">
            <table class="table table-sm table-hover table-striped table-header-dark data-table">
                <thead>
                    <tr>
                        <td>DATE</td>
                        <th>MONTANT</th>
                        <th>TYPE</th>
                        <th>&numero;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ date_format($transaction->created_at,'d/m/Y H:i') }}</td>
                            <td>{{ number_format($transaction->type['montant'],0,',','.') }}</td>
                            <td><div><span class="badge badge-{{ $transaction->type['color'] }}">{{ $transaction->type['name'] }}</span></div></td>
                            <td>{{ $transaction->type['num'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
  </div>

  <style>
    .table-header-dark>thead>tr>th{
        background-color: #333333;
        color: #ffffff;
    }
    table.table-sm tr>td{
        padding: 0.2rem;
        font-size: 0.85rem;
    }
    .btn-outline-black {
        color: #333333;
        border-color: #333333;
        }
    .btn-outline-black:hover {
        color: #ffffff;
        background-color: #222222;
        }
  </style>





@endsection
