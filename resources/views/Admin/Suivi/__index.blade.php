
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3><i class="material-icons">verified_user</i> SUIVI</h3>
    <hr>
    <div id="suivi" class="container pl-5 pr-5 ml-3">
        <div class="table-responsive">
            <table class="table table-sm table-striped table-header-dark data-table">
                <thead>
                    <tr>
                        <td id="search-input">

                        </td>
                    </tr>
                    <tr>
                        <th>Id Client</th>
                        <th>Client</th>
                        <th>Montant facturé</th>
                        <th>Montant payé</th>
                        <th>Montant du</th>
                        <th>Montant impayé</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>5767</td>
                        <td>Hippo Plastic</td>
                        <td>56.789.000</td>
                        <td>45.678.000</td>
                        <td>11.134.000</td>
                        <td>7.078.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div style="margin-left:20px">
            <table id="list2"></table>
            <div id="pager2"></div>
        </div>
    </div>
    </div>
  </div>

  <style>
    .table-header-dark>thead>tr>th{
        background-color: #333333;
        color: #ffffff;
    }
  </style>
<script src="//cdn.jsdelivr.net/free-jqgrid/4.8.0/js/i18n/grid.locale-fr.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.8.0/js/jquery.jqgrid.min.js"></script>

<script>
    jQuery("#list2").jqGrid({
   	url:'/data/data.json',
	datatype: "json",
   	colNames:['Id Client','Entreprise', 'Tel', 'Code postal','Pays','Ville'],
   	colModel: [
            {
                label: 'Customer ID',
                name: 'CustomerID',
                width: 75,
                key: true
            },
            {
                label: 'Company Name',
                name: 'CompanyName',
                width: 140,
                editable: true // must set editable to true if you want to make the field editable
            },
            {
                label : 'Phone',
                name: 'Phone',
                width: 100,
                editable: true
            },
            {
                label: 'Postal Code',
                name: 'PostalCode',
                width: 80,
                editable: true
            },
            {
                name: 'Country',
                width: 200,
                editable: true,
                edittype: "select",
                editoptions: {
                    value: "USA:USA;UK:UK;Canada:Canada"
                }
            },
            {
                name: 'City',
                width: 200,
                editable: true,
                edittype: "select",
                editoptions: {
                    value: "Select a City"
                }
            }
        ],
   	rowNum:10,
   	rowList:[10,20,30],
   	pager: '#pager2',
   	sortname: 'CustomerID',
    viewrecords: true,
    sortorder: "desc",
    caption:"Liste des Clients"
});
jQuery("#list2").jqGrid('navGrid','#pager2',{edit:true,add:true,del:true});
</script>







@endsection
