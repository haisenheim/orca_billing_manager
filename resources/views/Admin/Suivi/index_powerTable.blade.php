
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3><i class="material-icons">verified_user</i> SUIVI</h3>
    <hr>
    <div id="suivi" class="container pl-5 pr-5 ml-3">
        <div class="table-responsive">
            <table class="table table-sm table-striped table-dark data-table">
                <thead>
                    <tr>
                        <th>Id Client</th>
                        <th>Client</th>
                        <th>Montant facturé</th>
                        <th>Montant payé</th>
                        <th>Montant du</th>
                        <th>Montant impayé</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <hr>
    <div class="MuonW PowerTable">
        <div id="table1"></div>
    </div>
  </div>




<script type="module">
import { PowerTable } from '/js/powertable.js'
let ptData= [{"id": 1, "name": "Fay","color":"<div style='background:#0CBCFF; width:15px; height:15px; float:left; margin:5px 5px 0 0;'> </div><span style='font-size:14px;'>Bleu</span>"}, {"id": 2, "name": "Luca","color":"#AD2100"}];
let ptInstructs = [
    {key: 'id'},
    {key: 'name', title: 'Nom'},
    {key:'color',title:'couleur',parseAs:'unsafe-html'}
];
let ptOptions = {
    uniquePrefix: 'myTable1',
    rowsPerPageOptions: [10, 100, 200],
    footerText: false,
    footerFilters: false,
    checkboxColumn:true,
}

const myTable = new PowerTable({
    target: document.getElementById('table1'),
    props: { ptData,ptInstructs,ptOptions}
});
$('.MuonW.PowerTable div[data-name=search-container]>label>span').hide();
$('.MuonW.PowerTable input[data-name=search-input]').prop({'placeholder':'Rechercher ...'});
$('.MuonW.PowerTable div[data-name=topBar]>div[data-name=pagination-container]').hide();
//$('.MuonW.PowerTable div[data-name=table-container] table').addClass('table-dark table-sm');
</script>

  <style>

  </style>
@endsection
